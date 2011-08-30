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
 * @url webdesign-in-bremen.com
 */
 
class MUTransport_Version extends Zikula_AbstractVersion 
{

	public function getMetaData() 
	{
		$meta = array();
		$meta['name']			= $this->__('MUTransport');
		$meta['displayname']    = $this->__('MUTransport');
		$meta['description']    = $this->__('Transport of Content from module to module.');
		//! module url in lowercase and different to displayname
		$meta['url']            = $this->__('mutransport');
		$meta['version']          = '1.3.1';
		$meta['securityschema']   = array('MUTransport::' => '::');
		return $meta;
	}
}

