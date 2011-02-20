<?php
/**
 * Copyright Zikula Foundation 2009 - Zikula Application Framework
 *
 * This work is contributed to the Zikula Foundation under one or more
 * Contributor Agreements and licensed to You under the following license:
 *
 * @license GNU/LGPLv2.1 (or at your option, any later version).
 * @package MUTransport
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */

class MUTransport_Controller_Interactiveinstaller extends Zikula_InteractiveInstaller
{
    /**
     * Initialise the interactive install system for the MUTransport module
     * @author Michael Ueberschaer
     * @return to the welcome screen
     */
    public function install()
    {
        // We start the interactive installation process now.
        // This function is called automatically if present.
        // In this case we simply show a welcome screen.
        // Check permissions
    if (!SecurityUtil::checkPermission('::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError();
    }
    
    return $this->view->fetch('MUTransport_init_interactive.htm');
    }
    
/**
 * interactive installation procedure step 3
 *
 * @author       Michael Ueberschaer
 * @return       pnRender output
 */
public function step3()
{
    if (!SecurityUtil::checkPermission('::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError();
    }
    
    $activate = (bool) FormUtil::getPassedValue('activate', false, 'POST');
    $this->view->assign('authid', SecurityUtil::generateAuthKey('Modules'));
    $this->view->assign('activate', $activate);
    return $this->view->fetch('MUTransport_init_step3.htm');
}
}
