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

Loader::loadClass('PNMUTransportArray', 'modules/MUTransport/classes');

/**
 * This class provides basic functionality of PNCmsArrayBase
 */
abstract class PNCmsArrayBase extends PNMUTransportArray
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
     * @param where       The where clause to use when retrieving the object array (optional) (default='')
     * @param orderBy     The order-by clause to use when retrieving the object array (optional) (default='')
     * @param assocKey    Key field to use for building an associative array (optional) (default=null)
     */
    function PNCmsArrayBase($init = null, $where = '', $orderBy = '', $assocKey = null)
    {
        // call base class constructor
        $this->PNObjectArray();

        // set the tablename this object maps to
        $this->_objType = 'mutransport_cms';

        // set the ID field for this object
        $this->_objField = 'cmsid';

        // set the access path under which the object's
        // input data can be retrieved upon input
        $this->_objPath = 'cms_array';

        // apply object permission filters
        $this->_objPermissionFilter[] = array('component_left'   => 'MUTransport',
            'component_middle' => 'Cms',
            'component_right'  => '',
            'instance_left'    => 'cmsid',
            'instance_middle'  => '',
            'instance_right'   => '',
            'level'            => ACCESS_READ);

        // call initialization routine
        $this->_init($init, $where, $orderBy, $assocKey);
    }

    /**
     * Interceptor being called if an object is used within a string context.
     *
     * @return string
     */
    public function __toString()
    {
        $string = 'Instance of the class "PNCmsArrayBase' . "\n";
        $string .= 'Managed table: cms' . "\n";
        $string .= 'Table fields:' . "\n";
        $string .= '        cmsid' . "\n";
        $string .= '        name' . "\n";
        $string .= '        state' . "\n";
        $string .= "\n";

        return $string;
    }
}
