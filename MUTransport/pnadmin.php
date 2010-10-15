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
 * Even though we're handling objects for multiple tables, we only have one function for any use case.
 * The specific functionality for each object is encapsulated in the actual class implementation within the
 * module's classes directory while the handling code can remain identical for any number of entities.
 * This component-based approach allows you to have generic handler code which relies on the functionality
 * implemented in the object's class in order to achieve it's goals.
 */

// preload common used classes
Loader::requireOnce('modules/MUTransport/common.php');
// include pnForm in order to be able to inherit from pnFormHandler
Loader::requireOnce('includes/pnForm.php');

/**
 * This function is the default function, and is called whenever the
 * module's Admin area is called without defining arguments.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */
function MUTransport_admin_main($args)
{
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(pnModURL('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

    $dom = ZLanguage::getModuleDomain('MUTransport');
    
    // call check method
    return pnModAPIFunc('MUTransport', 'admin', 'check');

}

/**
 * This function provides a generic item list overview.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */
function MUTransport_admin_view($args)
{
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(pnModURL('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

    $dom = ZLanguage::getModuleDomain('MUTransport');

    // parameter specifying which type of objects we are treating
    $objectType = FormUtil::getPassedValue('ot', 'modul', 'GET');

    if (!in_array($objectType, MUTransport_getObjectTypes())) {
        $objectType = 'modul';
    }
    // load the object array class corresponding to $objectType
    if (!($class = Loader::loadArrayClassFromModule('MUTransport', $objectType))) {
        pn_exit('Unable to load array class [' . DataUtil::formatForDisplay($objectType) . '] ...');
    }

    // instantiate the object-array
    $objectArray = new $class();

    // parameter for used sorting field, will be further checked later
    $sort = FormUtil::getPassedValue('sort', '', 'GET');
    if (empty($sort)) {
        switch($objectType) {
            case 'modul': $sort = 'name'; break;
            case 'page': $sort = 'pageId'; break;
            case 'cms': $sort = 'name'; break;
            case 'cmscontent': $sort = 'contentId'; break;
            case 'user': $sort = 'userid'; break;
            default: $sort = 'name';
        }
    }

    // parameter for used sort order
    $sdir = FormUtil::getPassedValue('sdir', '', 'GET');
    if ($sdir != 'asc' && $sdir != 'desc') $sdir = 'asc';


    // startnum is the current offset which is used to calculate the pagination
    $startnum = (int) FormUtil::getPassedValue('startnum', 1, 'GET');

    // pagesize is the number of items displayed on a page for pagination
    $pagesize = pnModGetVar('Admin_Messages', 'pagesize', 20);


    // convenience vars to make code clearer
    $where = '';
    $sortParam = $sort . ' ' . $sdir;

    // use FilterUtil to support generic filtering based on an object-oriented approach
    Loader::LoadClass('FilterUtil', 'modules/MUTransport/classes/FilterUtil/');
    $fu =& new FilterUtil(array('table' => $objectArray->_objType));

    // you could set explicit filters at this point, something like
    // $fu->setFilter('type:eq:' . $args['type'] . ',id:eq:' . $args['id']);
    // supported operators: eq, ne, like, lt, le, gt, ge, null, notnull 

    // process request input filters and get result for DBUtil
    $ret = $fu->GetSQL();
    $where = $ret['where'];

    // get() returns the cached object fetched from the DB during object instantiation
    // get() with parameters always performs a new select
    // while the result will be saved in the object, we assign in to a local variable for convenience.
    $objectData = $objectArray->get($where, $sortParam, $startnum-1, $pagesize);

    // get total number of records for building the pagination by method call
    $objcount = $objectArray->getCount($where);

    // get pnRender instance for this module
    $render = pnRender::getInstance('MUTransport', false);

    // assign the object-array we loaded above
    $render->assign('objectArray', $objectData);

    // assign current sorting information
    $render->assign('sort', $sort);
    $render->assign('sdir', ($sdir == 'asc') ? 'desc' : 'asc'); // reverted for links

    // assign the information required to create the pager
    $render->assign('pager', array('numitems'     => $objcount,
                                   'itemsperpage' => $pagesize));
                                   
    // check the state of the target modul Content
    
    pnModDBInfoLoad('modules');
    $pntable = pnDBGetTables();
    
    $modulescolumn = $pntable['modules_column'];
    $mutransportcolumn = $pntable['mutransport_modul_column'];
    // get data from module content
    $where = "WHERE $modulescolumn[name] = '" . pnVarPrepForStore("content") . "'";  
    $question = DBUtil::selectObjectArray('modules', $where);
    $status = $question[0]['state'];
    
    $where2 = "WHERE $modulescolumn[name] = '" . pnVarPrepForStore("News") . "'";  
    $question2 = DBUtil::selectObjectArray('modules', $where2);
    $status2 = $question2[0]['state'];
    
    // assign the state of content to rule the page view
    $render->assign('statuscontent', $status);
    $render->assign('statusnews', $status2);
    
    $render->clear_cache('MUTransport_admin_modul_view.htm');                          

    // fetch and return the appropriate template
    return $render->fetch('MUTransport_admin_' . $objectType . '_view.htm');
}
/**
 * This function provides a generic item detail view.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */
function MUTransport_admin_display($args)
{
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(pnModURL('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

    $dom = ZLanguage::getModuleDomain('MuTransport');

    // parameter specifying which type of objects we are treating
    $objectType = FormUtil::getPassedValue('ot', 'modul', 'GET');

    if (!in_array($objectType, MUTransport_getObjectTypes())) {
        $objectType = 'modul';
    }
    // load the object class corresponding to $objectType
    if (!($class = Loader::loadClassFromModule('MUTransport', $objectType))) {
        pn_exit('Unable to load class [' . DataUtil::formatForDisplay($objectType) . '] ...');
    }
    // intantiate object model
    $object = new $class();
    $idField = $object->getIDField();

    // retrieve the ID of the object we wish to view
    $id = (int) FormUtil::getPassedValue($idField, isset($args[$idField]) && is_numeric($args[$idField]) ? $args[$idField] : 0, 'GET');
    if (!$id) {
        pn_exit('Invalid ' . $idField . ' [' . DataUtil::formatForDisplay($id) . '] received ...');
    }

    // assign object data
    // this performs a new database select operation
    // while the result will be saved within the object, we assign it to a local variable for convenience
    $objectData = $object->get($id, $idField);

    // get pnRender instance for this module
    $render = pnRender::getInstance('MUTransport', false);

    // assign the object we loaded above.
    // since the same code is used the handle the entry of the new object,
    // we need to check wether we have a valid object.
    // If not, we just pass in an empty data-array.
    $render->assign($objectType, $objectData);
    
    // check 
    
    // fetch and return the appropriate template
    return $render->fetch('MUTransport_admin_' . $objectType . '_display.htm');
}

/**
 * This function provides a generic handling of all edit requests.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */
function MUTransport_admin_edit($args)
{
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(pnModURL('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

    // parameter specifying which type of objects we are treating
    $objectType = FormUtil::getPassedValue('ot', 'modul', 'GET');

    if (!in_array($objectType, MUTransport_getObjectTypes())) {
        $objectType = 'modul';
    }

    // create new pnForm reference
    $render = FormUtil::newpnForm('MUTransport');

    // include event handler class
    Loader::requireOnce('modules/MUTransport/classes/FormHandler/MUTransport_admin_' . $objectType . '_edithandler.class.php');

    // build form handler class name
    $handlerClass = 'MUTransport_admin_' . $objectType . '_editHandler';

    // Execute form using supplied template and page event handler
    return $render->pnFormExecute('MUTransport_admin_' . $objectType . '_edit.htm', new $handlerClass());
}

 
 /**
 * This function provides a generic handling of all read requests.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */
function MUTransport_admin_read($args)
{
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(pnModURL('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

    $dom = ZLanguage::getModuleDomain('MUTransport');
    
    //call adminapi_read
    
    pnModAPIFunc('MUTransport', 'admin', 'read');
    
    return pnRedirect(pnModURL('mutransport', 'admin', 'view'));

}

 /**
 * This function provides a generic handling of all read requests.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */
function MUTransport_admin_pagedelete($args)
{
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(pnModURL('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

    $dom = ZLanguage::getModuleDomain('MUTransport');
    
    //call adminapi_delete
    
    pnModAPIFunc('MUTransport', 'admin', 'delete');
    
    return pnRedirect(pnModURL('mutransport', 'admin', 'view'));

}
 /**
 * This function provides a generic handling of all transport requests.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */

 function MUTransport_admin_transport($args)
{
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(pnModURL('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

    $dom = ZLanguage::getModuleDomain('MUTransport');
    $modul = '';
    
    //call adminapi_transport    
    pnModAPIFunc('MUTransport', 'admin', 'transport');
    if($modul == 'wordpress') {   	
    	$obj = array('ot'	=> 'cmscontent');
    }
    else  {
    $obj = array ('ot'  => 'page');
    }
    return pnRedirect(pnModURL('mutransport', 'admin', 'view', $obj));

}

/**
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */
function MUTransport_admin_delete($args)
{
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(pnModURL('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

    $dom = ZLanguage::getModuleDomain('MUTransport');

    // parameter specifying which type of objects we are treating
    $objectType = FormUtil::getPassedValue('ot', 'modul', 'GET');

    if (!in_array($objectType, MUTransport_getObjectTypes())) {
        $objectType = 'modul';
    }
}

/**
 * Any config options would likely go here in the future
 * @author Jim McDonald
 * @return string HTML output string
 */
function MUTransport_admin_modifyconfig()
{
    // Security check
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError();
    }

    // Create output object
    $pnRender = & pnRender::getInstance('MUTransport', false);

    // assign all the module vars
    $pnRender->assign(pnModGetVar('MUTransport'));

    // Return the output that has been generated by this function
    return $pnRender->fetch('MUTransport_admin_modifyconfig.htm');
}

function MUTransport_admin_updateconfig()
{
    // Security check
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError();
    }


    $dom = ZLanguage::getModuleDomain('MUTransport');    
    
    $newstocontent = (int)FormUtil::getPassedValue('newstocontent');
    $pagestocontent = (int)FormUtil::getPassedValue('pagestocontent');
    $pagedtocontent = (int)FormUtil::getPassedValue('pagedtocontent');
    $pagedtonews = (int)FormUtil::getPassedValue('pagedtonews');
    $reviewstocontent = (int)FormUtil::getPassedValue('reviewstocontent');
    $contenttocontent = (int)FormUtil::getPassedValue('contenttocontent');
    $image_path = (string)FormUtil::getPassedValue('image_path');
    $text_format = (string)FormUtil::getPassedValue('text_format');
    $news_state = (string)FormUtil::getPassedValue('news_state');
    $details = (string)FormUtil::getPassedValue('details');
    $wordpress = (int)FormUtil::getPassedValue('wordpress');
    $wordpress_db = (string)FormUtil::getPassedValue('wordpress_db');
    $wordpress_prefix = (string)FormUtil::getPassedValue('wordpress_prefix');
    $wordpress_ezcomments = (int)FormUtil::getPassedValue('wordpress_ezcomments');
    $image_path2 = (string)FormUtil::getPassedValue('image_path2');    
    
    if (!isset($newstocontent) || !is_numeric($newstocontent)) {
        $newstocontent = 0;
    }
    
    if (!isset($pagestocontent) || !is_numeric($pagestocontent)) {
        $pagestocontent = 0;
    }
    
    if (!isset($pagedtocontent) || !is_numeric($pagedtocontent)) {
        $pagedtocontent = 0;
    }
    
    if (!isset($pagedtonews) || !is_numeric($pagedtonews)) {
        $pagedtonews = 0;
    }
    
    if (!isset($reviewstocontent) || !is_numeric($reviewstocontent)) {
        $reviewstocontent = 0;
    } 
    
    if (!isset($contenttocontent) || !is_numeric($contenttocontent)) {
        $contenttocontent = 0;
    } 
    
    if (!isset($image_path) || !is_string($image_path)) {
        $image_path = '';
    }    
    if (!isset($text_format) || !is_string($text_format)) {
        $text_format = 'text';       
    }
    if (!isset($news_state) || !is_numeric($news_state)) {
        $news_state = 4;       
    }
    
    if (!isset($details) || !is_numeric($details)) {
        $details = 0;
    } 
    if (!isset($wordpress) || !is_numeric($wordpress)) {
        $wordpress = 0;       
    }
    if (!isset($wordpress_db) || !is_string($wordpress_db)) {
        $wordpress_db = '';       
    }  
    if (!isset($wordpress_prefix) || !is_string($wordpress_prefix)) {
        $wordpress_prefix = '';       
    }
    if (!isset($wordpress_ezcomments) || !is_numeric($wordpress_ezcomments)) {
        $wordpress_ezcomments = 0;       
    }
    if (!isset($image_path2) || !is_string($image_path2)) {
        $image_path2 = '';
    }        
          
    pnModSetVar('MUTransport', 'newstocontent', $newstocontent);
    pnModSetVar('MUTransport', 'pagestocontent', $pagestocontent);
    pnModSetVar('MUTransport', 'pagedtocontent', $pagedtocontent);
    pnModSetVar('MUTransport', 'pagedtonews', $pagedtonews);
    pnModSetVar('MUTransport', 'reviewstocontent', $reviewstocontent);
    pnModSetVar('MUTransport', 'contenttocontent', $contenttocontent);
    pnModSetVar('MUTransport', 'image_path', $image_path);
    pnModSetVar('MUTransport', 'text_format', $text_format);
    pnModSetVar('MUTransport', 'news_state', $news_state);
    pnModSetVar('MUTransport', 'details', $details);
    pnModSetVar('MUTransport', 'wordpress', $wordpress);
    pnModSetVar('MUTransport', 'wordpress_db', $wordpress_db);
    pnModSetVar('MUTransport', 'wordpress_prefix', $wordpress_prefix);
    pnModSetVar('MUTransport', 'wordpress_ezcomments', $wordpress_ezcomments);
    pnModSetVar('MUTransport', 'image_path2', $image_path2);


    // Let any other modules know that the modules configuration has been updated
    // pnModCallHooks('module','updateconfig','MUTransport', array('module' => 'MUTransport'));  neu 29.12.2009
    // the module configuration has been updated successfuly
    LogUtil::registerStatus(__('Done! Saved module configuration.'));

    return pnRedirect(pnModURL('MUTransport', 'admin', 'main'));
}
