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
 * initialise the MUTransport module
 *
 * This function is only ever called once during the lifetime of a particular
 * module instance
 * This function MUST exist in the pninit file for a module
 *
 * @author       Michael Ueberschaer
 * @return       bool       true on success, false otherwise
 */
function MUTransport_init()
{
    // create the modul table
    if (!DBUtil::createTable('mutransport_modul')) {
        return false;
    }
    // create the page table
    if (!DBUtil::createTable('mutransport_page')) {
        return false;
    }



    // set up all our module vars with initial values

    // create the default data for MUTransport
    MUTransport_defaultdata();

    // Initialisation successful
    return true;
}

/**
 * upgrade the MUTransport module from an old version
 *
 * This function can be called multiple times
 * This function MUST exist in the pninit file for a module
 *
 * @author       Michael Ueberschaer
 * @param       int        $oldversion version to upgrade from
 * @return      bool       true on success, false otherwise
 */
function MUTransport_upgrade($oldversion)
{
/*
    // Upgrade dependent on old version number
    switch ($oldversion){
    case '1.00':
            MUTransport_createTables_101();
        break;
    }
*/

    // Update successful
    return true;
}

/**
 * delete the MUTransport module
 * This function is only ever called once during the lifetime of a particular
 * module instance
 * This function MUST exist in the pninit file for a module
 *
 * @author       Michael Ueberschaer
 * @return       bool       true on success, false otherwise
 */
function MUTransport_delete()
{
    if (!DBUtil::dropTable('mutransport_modul')) {
        return false;
    }
    if (!DBUtil::dropTable('mutransport_page')) {
        return false;
    }



    // remove all module vars
    pnModDelVar('MUTransport');

    // Deletion successful
    return true;
}

/**
 * create the default data for MUTransport
 *
 * This function is only ever called once during the lifetime of a particular
 * module instance
 *
 * @author       Michael Ueberschaer
 * @return       bool       true on success, false otherwise
 */
function MUTransport_defaultdata()
{
    // ensure that tables are cleared
    if (
        !DBUtil::deleteWhere('mutransport_modul', '1=1') || 
        !DBUtil::deleteWhere('mutransport_page', '1=1')) {
        return false;
    }


    // insertion successful
    return true;
}

/**
 * interactive installation procedure
 *
 * @author       Michael Ueberschaer
 * @return       pnRender output
 */
function MUTransport_init_interactiveinit()
{
    if (!SecurityUtil::checkPermission('::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError();
    }
    
    $dom = ZLanguage::getModuleDomain('MUTransport');

    $render = pnRender::getInstance('MUTransport', false);
    return $render->fetch('MUTransport_init_interactive.htm');
} 


/**
 * interactive installation procedure step 3
 *
 * @author       Michael Ueberschaer
 * @return       pnRender output
 */
function MUTransport_init_interactiveinitstep3()
{
    if (!SecurityUtil::checkPermission('::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError();
    }
    
    $dom = ZLanguage::getModuleDomain('MUTransport');
    
    $activate = (bool) FormUtil::getPassedValue('activate', false, 'POST');

    $render = pnRender::getInstance('MUTransport', false);
    $render->assign('authid', SecurityUtil::generateAuthKey('Modules'));
    $render->assign('activate', $activate);
    return $render->fetch('MUTransport_init_step3.htm');
}

/**
 * interactive update procedure
 *
 * @author       Michael Ueberschaer
 * @return       pnRender output
 */
function MUTransport_init_interactiveupdate()
{
    if (!SecurityUtil::checkPermission('::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError();
    }

    $dom = ZLanguage::getModuleDomain('MUTransport');

    // TODO

    return true;
}

/**
 * interactive delete
 *
 * @author       Michael Ueberschaer
 * @return       pnRender output
 */
function MUTransport_init_interactivedelete()
{
    if (!SecurityUtil::checkPermission('::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError();
    }
    
    $dom = ZLanguage::getModuleDomain('MUTransport');

    $render = pnRender::getInstance('MUTransport');
    $render->assign('authid', SecurityUtil::generateAuthKey('Modules'));
    return $render->fetch('MUTransport_init_delete.htm');
}

