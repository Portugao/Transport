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
$dom = ZLanguage::getModuleDomain('MUTransport');
$modversion['name']           = 'MUTransport';
$modversion['displayname']    = __("MUTransport", $dom);
$modversion['description']    = __("Transport of Content from module to module.", $dom);
$modversion['version']        = '1.3.0';
$modversion['url'] = __('mutransport', $dom);
// permission schema
$modversion['securityschema'] = array('MUTransport::' => '::');
// DEBUG: permission schema aspect ends

// file with credit information
//$modversion['credits']        = 'pndocs/credits.txt';
// help file
$modversion['help']           = 'pndocs/manual.pdf';
// changelog file
$modversion['changelog']      = 'pndocs/changelog.txt';
// file with license information
$modversion['license']        = 'pndocs/license.txt';

// this is no official core / system module
$modversion['official']       = 0;
// the module author
$modversion['author']         = 'Michael Ueberschaer';
// module homepage
$modversion['contact']        = 'kontakt@mu-t-beratung.de';

// we do have an admin area
$modversion['admin']          = 1;
// we do not have an user area
$modversion['user']           = 0;

