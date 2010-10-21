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
    // create the cms table
    if (!DBUtil::createTable('mutransport_cms')) {
        return false;
    }
    // create the cmscontent table
    if (!DBUtil::createTable('mutransport_cmscontent')) {
        return false;
    }
    // create the user table
    if (!DBUtil::createTable('mutransport_user')) {
        return false;
    }      
 



    // set up all our module vars with initial values
    
    pnModSetVar('MUTransport', 'newstocontent', 0);
    pnModSetVar('MUTransport', 'pagestocontent', 0);
    pnModSetVar('MUTransport', 'pagedtocontent', 0);
    pnModSetVar('MUTransport', 'pagedtonews', 0);
    pnModSetVar('MUTransport', 'reviewstocontent', 0);
    pnModSetVar('MUTransport', 'details', 0);    
    pnModSetVar('MUTransport', 'contenttocontent', 0);
    pnModSetVar('MUTransport', 'image_path', '');
    pnModSetVar('MUTransport', 'text_format', 'text');
    pnModSetVar('MUTransport', 'news_state', 4);
    pnModSetVar('MUTransport', 'wordpress', 0);
    pnModSetVar('MUTransport', 'wordpress_db', '');
    pnModSetVar('MUTransport', 'wordpress_prefix', '');
    pnModSetVar('MUTransport', 'image_path2', '');
    pnModSetVar('MUTransport', 'wordpress_ezcomments', 0);
    pnModSetVar('MUTransport', 'wordpress_clearing', 0);

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

    // Upgrade dependent on old version number
    switch ($oldversion){
    case '1.0':
    // set new modvars
    pnModSetVar('MUTransport', 'newstocontent', 0);
    pnModSetVar('MUTransport', 'pagestocontent', 1);
    pnModSetVar('MUTransport', 'pagedtocontent', 0);   
    pnModSetVar('MUTransport', 'contenttocontent', 1);
    pnModSetVar('MUTransport', 'image_path', '');
    pnModSetVar('MUTransport', 'text_format', 'text');

    
    case '1.2':
    // set new modvar
    pnModSetVar('MUTransport', 'pagedtonews', 0);   
    pnModSetVar('MUTransport', 'news_state', 4);
    
    case '1.2.5':
    // set new modvar
    pnModSetVar('MUTransport', 'wordpress', 0);
    pnModSetVar('MUTransport', 'wordpress_db', '');
    pnModSetVar('MUTransport', 'wordpress_prefix', '');
    pnModSetVar('MUTransport', 'image_path2', '');
    pnModSetVar('MUTransport', 'wordpress_ezcomments', 0);
    pnModSetVar('MUTransport', 'reviewstocontent', 0);
    pnModSetVar('MUTransport', 'details', 0);
    pnModSetVar('MUTransport', 'wordpress_clearing', 0);
    // create the cms table
    if (!DBUtil::createTable('mutransport_cms')) {
        return false;
    }
    // create the cmscontent table
    if (!DBUtil::createTable('mutransport_cmscontent')) {
        return false;
    }
    // create the user table
    if (!DBUtil::createTable('mutransport_user')) {
        return false;
    }             
    }


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

    if (!DBUtil::dropTable('mutransport_cms')) {
        return false;
    }
    
    if (!DBUtil::dropTable('mutransport_cmscontent')) {
        return false;
    }
    
    if (!DBUtil::dropTable('mutransport_user')) {
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
        !DBUtil::deleteWhere('mutransport_page', '1=1') ||
        !DBUtil::deleteWhere('mutransport_cms', '1=1')||
        !DBUtil::deleteWhere('mutransport_cmscontent', '1=1')||
        !DBUtil::deleteWhere('mutransport_user', '1=1')) {
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

