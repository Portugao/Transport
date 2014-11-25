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

/*
 * generated at Sat Dec 12 18:12:57 CET 2009 by ModuleStudio 0.4.3 (http://modulestudio.de)
*/

class MUTransport_Installer extends Zikula_AbstractInstaller
{

	/**
	 * intall the MUTransport module
	 *
	 * This function is only ever called once during the lifetime of a particular
	 * module instance
	 * This function MUST exist in the pninit file for a module
	 *
	 * @author       Michael Ueberschaer
	 * @return       bool       true on success, false otherwise
	 */


	public function install()
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

		$this->setVar('newstocontent', 0);
		$this->setVar('pagestocontent', 0);
		$this->setVar('pagedtocontent', 0);
		$this->setVar('pagedtonews', 0);
		$this->setVar('reviewstocontent', 0);
		$this->setVar('details', 0);
		$this->setVar('contenttocontent', 0);
		$this->setVar('image_path', '');
		$this->setVar('text_format', 'text');
		$this->setVar('news_state', 4);
		$this->setVar('wordpress', 0);
		$this->setVar('wordpress_host', '');
		$this->setVar('wordpress_db', '');
		$this->setVar('wordpress_user', '');
		$this->setVar('wordpress_pw', '');
		$this->setVar('wordpress_prefix', '');
		$this->setVar('image_path2', '');
		$this->setVar('wordpress_ezcomments', 0);
		$this->setVar('wordpress_clearing', 0);

		// create the default data for MUTransport
		//$this->defaultdata(); maybe we can user later

		// jump to interactive installation
		// $this->init_interactiveinit();

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
	public function upgrade($oldversion)
	{

		// Upgrade dependent on old version number
		switch ($oldversion){
			case '1.0':
				// set new modvars
				$this->setVar('newstocontent', 0);
				$this->setVar('pagestocontent', 1);
				$this->setVar('pagedtocontent', 0);
				$this->setVar('contenttocontent', 1);
				$this->setVar('image_path', '');
				$this->setVar('text_format', 'text');


			case '1.2':
				// set new modvar
				$this->setVar('pagedtonews', 0);
				$this->setVar('news_state', 4);

			case '1.2.5':
				// set new modvar
				$this->setVar('wordpress', 0);
				$this->setVar('wordpress_db', '');
				$this->setVar('wordpress_prefix', '');
				$this->setVar('image_path2', '');
				$this->setVar('wordpress_ezcomments', 0);
				$this->setVar('reviewstocontent', 0);
				$this->setVar('details', 0);
				$this->setVar('wordpress_clearing', 0);
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

			case '1.3.0':
				// we need no special upgrade routine
				// the user can uninstall and reinstall the module
				
			case '1.3.1':
				// future upgrade
				 
		}

		// Update successful
		return true;
	}

	/**
	 * delete the MUTransport module
	 * This function is only ever called once during the lifetime of a particular
	 * module instance
	 * This function MUST exist in the installer file for a module
	 *
	 * @author       Michael Ueberschaer
	 * @return       bool       true on success, false otherwise
	 */
	public function uninstall()
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
		$this->delVars();

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
	public function defaultdata()
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
}

