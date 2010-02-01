
<?php
/**
 * PostNuke Application Framework
 *
 * @copyright (c) 2007, PostNuke Development Team
 * @link http://www.postnuke.com
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @package PostNuke_Generated_Modules
 * @subpackage MUTransport
 * @author Michael Ueberschaer
 * @url mu-t-beratung.de
 */

/*
 * generated at Sat Dec 12 18:12:57 CET 2009 by ModuleStudio 0.4.3 (http://modulestudio.de)
 */

/**
 * This handler class handles the page events of the pnForm called by the MUTransport_admin_edit() function.
 * It aims on the modul object type.
 *
 * Member variables in a form handler object are persisted accross different page requests. This means
 * a member variable $this->X can be set on one request and on the next request it will still contain
 * the same value.
 *
 * A form handler will be notified of various events that happens during it's life-cycle.
 * When a specific event occurs then the corresponding event handler (class method) will be executed. Handlers
 * are named exactly like their events - this is how the framework knows which methods to call.
 *
 * The list of events is:
 *
 * - <b>initialize</b>: this event fires before any of the events for the plugins and can be used to setup
 *   the form handler. The event handler typically takes care of reading URL variables, access control
 *   and reading of data from the database.
 *
 * - <b>handleCommand</b>: this event is fired by various plugins on the page. Typically it is done by the
 *   pnFormButton plugin to signal that the user activated a button.
 *
 * @package pnForm
 * @subpackage Base
 * @author       Michael Ueberschaer
 */
class MUTransport_admin_modul_editHandler extends pnFormHandler
{
    // store modul ID in (persistent) member variable
    var $modulid;
    var $mode;

    /**
     * Initialize form handler
     *
     * This method takes care of all necessary initialisation of our data and form states
     *
     * @return bool False in case of initialization errors, otherwise true
     * @author       Michael Ueberschaer
     */
    function initialize(&$render)
    {
        // retrieve the ID of the object we wish to edit
        // default to 0 (which is a numeric id but an invalid value)
        // no provided id means that we want to create a new object
        $this->modulid = (int) FormUtil::getPassedValue('modulid', 0, 'GET');



        $objectType = 'modul';
    // load the object class corresponding to $objectType
    if (!($class = Loader::loadClassFromModule('MUTransport', $objectType))) {
        pn_exit('Unable to load class [' . DataUtil::formatForDisplay($objectType) . '] ...');
    }

        $this->mode = 'create';
        // if modulid is not 0, we wish to edit an existing modul
        if($this->modulid) {
            $this->mode = 'edit';

            if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_EDIT)) {
                // set an error message and return false
                return $render->pnFormSetErrorMsg(_MUTRANSPORT_NOTAUTHORIZED);
            }

    // intantiate object model and get the object of the specified ID from the database
    $object = new $class('D', $this->modulid);

    // assign object data fetched from the database during object instantiation
    // while the result will be saved within the object, we assign it to a local variable for convenience
    $objectData = $object->get();
            if (count($objectData) == 0) {
                return $render->pnFormSetErrorMsg(_MUTRANSPORT_MODUL_UNKNOWN);
            }

            // try to guarantee that only one person at a time can be editing this modul
            $returnUrl = pnModUrl('MUTransport', 'admin', 'view', array('modulid' => $this->modulid));
            pnModAPIFunc('PageLock', 'user', 'pageLock',
                                 array('lockName' => "MUTransportModul{$this->modulid}",
                                       'returnUrl' => $returnUrl));

            // assign data to template
            $render->assign('modul', $objectData);

            return true;
        }
        else {
            if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADD)) {
                // set an error message and return false
                return $render->pnFormSetErrorMsg(_MUTRANSPORT_NOTAUTHORIZED);
            }


        }



        // assign mode var to referenced render instance
        $render->assign('mode', $this->mode);



        // everything okay, no initialization errors occured
        return true;

    }


    /**
     * Command event handler
     *
     * This event handler is called when a command is issued by the user. Commands are typically something
     * that originates from a {@link pnFormButton} plugin. The passed args contains different properties
     * depending on the command source, but you should at least find a <var>$args['commandName']</var>
     * value indicating the name of the command. The command name is normally specified by the plugin
     * that initiated the command.
     * @see pnFormButton
     * @see pnFormImageButton
     * @author       Michael Ueberschaer
     */
    function handleCommand(&$render, &$args)
    {
        // return url for redirecting
        $returnUrl = null;

        $objectType = 'modul';
    // load the object class corresponding to $objectType
    if (!($class = Loader::loadClassFromModule('MUTransport', $objectType))) {
        pn_exit('Unable to load class [' . DataUtil::formatForDisplay($objectType) . '] ...');
    }

        // instantiate the class we just loaded
        // it will be appropriately initialized but contain no data.
        $modul = new $class();

        if ($args['commandName'] != 'delete') {
            // do forms validation including checking all validators on the page to validate their input
            if (!$render->pnFormIsValid()) {
                return false;
            }
        }

        if ($args['commandName'] == 'create') {
            // event handling if user clicks on create

            // fetch posted data input values as an associative array
            $modulData = $render->pnFormGetValues();
            // usually one would use $modul->getDataFromInput() to get the data, this is the way PNObject works
            // but since we want also use pnForm we simply assign the fetched data and call the post process functionality here
            $modul->setData($modulData);
            $modul->getDataFromInputPostProcess();

            // save modul 
            $modul->save();

            $this->modulid = $modul->getID();
            if ($this->modulid === false) {
                // set an error message and return false
                return $render->pnFormSetErrorMsg(_CREATEFAILED);
            }

            LogUtil::registerStatus(pnML('_CREATEITEMSUCCEDED', array('i' => _MUTRANSPORT_MODUL)));

            // redirect to the detail page of the newly created modul
            $returnUrl = pnModUrl('MUTransport', 'admin', 'display',
                                                             array('ot' => 'modul',
                                                                   'modulid' => $this->modulid));
        }
        elseif ($args['commandName'] == 'update') {
            // event handling if user clicks on update

            // fetch posted data input values as an associative array
            $modulData = $render->pnFormGetValues();

            // add persisted primary key to fetched values
            $modulData['modulid'] = $this->modulid;

            // usually one would use $modul->getDataFromInput() to get the data, this is the way PNObject works
            // but since we want also use pnForm we simply assign the fetched data and call the post process functionality here
            $modul->setData($modulData);
            $modul->getDataFromInputPostProcess();

            // save modul 
            $updateResult = $modul->save();

            if ($updateResult === false) {
                // set an error message and return false
                return $render->pnFormSetErrorMsg(_UPDATEFAILED);
            }

            LogUtil::registerStatus(pnML('_UPDATEITEMSUCCEDED', array('i' => _MUTRANSPORT_MODUL)));

            // redirect to the detail page of the treated modul
            $returnUrl = pnModUrl('MUTransport', 'admin', 'display',
                                                             array('ot' => 'modul',
                                                                   'modulid' => $this->modulid));
        }
        elseif ($args['commandName'] == 'delete') {
            // event handling if user clicks on delete

            // Note: No need to check validation when deleting

            if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_DELETE)) {
                // set an error message and return false
                return $render->pnFormSetErrorMsg(_MUTRANSPORT_NOTAUTHORIZED);
            }

            // fetch posted data input values as an associative array
            $modulData = $render->pnFormGetValues();

            // add persisted primary key to fetched values
            $modulData['modulid'] = $this->modulid;

            // usually one would use $modul->getDataFromInput() to get the data, this is the way PNObject works
            // but since we want also use pnForm we simply assign the fetched data and call the post process functionality here
            $modul->setData($modulData);
            $modul->getDataFromInputPostProcess();

            // add persisted primary key to fetched values
            $modulData['modulid'] = $this->modulid;

            // delete modul
            $modul->delete();

            if ($deleteResult === false) {
                // set an error message and return false
                return $render->pnFormSetErrorMsg(_DELETEFAILED);
            }

            LogUtil::registerStatus(pnML('_DELETEITEMSUCCEDED', array('i' => _MUTRANSPORT_MODUL)));

            // redirect to the list of modules
            $returnUrl = pnModUrl('MUTransport', 'admin', 'view',
                                                                 array('ot' => 'modul'));
        }
        else if ($args['commandName'] == 'cancel') {
            // event handling if user clicks on cancel

            if ($this->mode == 'edit') {
                // redirect to the detail page of the treated modul
                $returnUrl = pnModUrl('MUTransport', 'admin', 'display',
                                                                 array('ot' => 'modul',
                                                                       'modulid' => $this->modulid));
            }
            else {
                // redirect to the list of modules
                $returnUrl = pnModUrl('MUTransport', 'admin', 'view',
                                                                 array('ot' => 'modul'));
            }
        }


        if ($returnUrl != null) {
            if ($this->mode == 'edit') {
                pnModAPIFunc('PageLock', 'user', 'releaseLock',
                                 array('lockName' => "MUTransportModul{$this->modulid}"));
            }

            return $render->pnFormRedirect($returnUrl);
        }

        // We should in principle not end here at all, since the above command handlers should 
        // match all possible commands, but we return "ok" (true) for all cases.
        // You could also return $render->pnFormSetErrorMsg('Unexpected command') or just do a pn_die()
        return true;
    }
}
