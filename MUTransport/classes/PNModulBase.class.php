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



Loader::loadClass('PNMUTransport', 'modules/MUTransport/classes');

/**
 * This class provides basic functionality of PNModulBase
 */
abstract class PNModulBase extends PNMUTransport
{
    /**
     * Constructor, init everything to sane defaults and handle parameters.
     * It only needs to set the fields which are used to configure
     * the object's specific properties and actions.
     *
     * @param init        Initialization value (can be an object or a string directive) (optional) (default=null)
     *                    If it is an array it is set, otherwise it is interpreted as a string
     *                    specifying the source from where the data should be retrieved from.
     *                    Possible values:
     *                        D (DB), G ($_GET), P ($_POST), R ($_REQUEST), S ($_SESSION), V (failed validation)
     *
     * @param key         The DB key to use to retrieve the object (optional) (default=null)
     * @param field       The field containing the key value (optional) (default=null)
     */
    function PNModulBase($init = null, $key = 0, $field = null)
    {
        // ensure the language file is available
        pnModLangLoad('MUTransport', 'common');

        // call base class constructor
        $this->PNObject();

        // set the tablename this object maps to

        $this->_objType       = 'mutransport_modul';

        // set the ID field for this object

        $this->_objField      = 'modulid';

        // set the access path under which the object's
        // input data can be retrieved upon input

        $this->_objPath       = 'modul';


        // apply object permission filters
        $this->_objPermissionFilter[] = array('component_left'   => 'MUTransport',
                                              'component_middle' => 'Modul',
                                              'component_right'  => '',
                                              'instance_left'    => 'modulid',
                                              'instance_middle'  => '',
                                              'instance_right'   => '',
                                              'level'            => ACCESS_READ);




        // call initialisation routine
        $this->_init($init, $key, $this->_objField);
    }



    /**
     * Interceptor being called if an object is used within a string context.
     * 
     * @return string
     */
    public function __toString() {
        $string  = 'Instance of the class "PNModulBase' . "\n";
        $string .= 'Managed table: modul' . "\n";
        $string .= 'Table fields:' . "\n";
        $string .= '        modulid' . "\n";
        $string .= '        name' . "\n";
        $string .= '        state' . "\n";
        $string .= "\n";

        return $string;
    }
}
