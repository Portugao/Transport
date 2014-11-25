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

/**
 * Populate dbtables array for MUTransport module
 *
 * This function is called internally by the core whenever the module is
 * loaded. It delivers the table information to the core.
 * It can be loaded explicitly using the pnModDBInfoLoad() API function.
 *
 * @author       Michael Ueberschaer
 * @return       array       The table information.
 */
function MUTransport_tables()
{
    // Initialise table array
    $dbtable = array();

//    $dbdriver = DBConnectionStack::getConnectionDBDriver(); 


    /*
     * definitions for modul table
     */

    // set the table name combined with prefix
    $dbtable['mutransport_modul'] = DBUtil::getLimitedTablename('mutransport_modul');

    // set the column names
    $columns = array(
        'modulid' => 'modulid',
        'name' => 'name',
        'state' => 'state');
    $dbtable['mutransport_modul_column'] = $columns;

    // set the data dictionary for the table columns
    $columnDef = array(
        'modulid' => "I AUTO PRIMARY",
        'name' => "C(50) NOTNULL DEFAULT ''",
        'state' => "C(40) NOTNULL DEFAULT ''");
    $dbtable['mutransport_modul_column_def'] = $columnDef;

    // DEBUG: object extension aspect starts


    $dbtable['mutransport_modul_primary_key_column'] = 'modulid';
    // disable categorization services
    $dbtable['mutransport_modul_db_extra_enable_categorization'] = false;

    // enable attribution services
    $dbtable['mutransport_modul_db_extra_enable_attribution'] = true;

    // disable meta data
    $dbtable['mutransport_modul_db_extra_enable_meta'] = false;

    // disable logging services
    $dbtable['mutransport_modul_db_extra_enable_logging'] = false;

    // DEBUG: object extension aspect ends

    /*
     * definitions for page table
     */

    // set the table name combined with prefix
    $dbtable['mutransport_page'] = DBUtil::getLimitedTablename('mutransport_page');

    // set the column names
    $columns = array(
        'id'  => 'id',
        'pageid' => 'pageid',
        'title' => 'title',
        'text' => 'text',
        'number_characters' => 'number_characters',
        'transport' => 'transport',
        'modulid' => 'modulid');
    $dbtable['mutransport_page_column'] = $columns;

    // set the data dictionary for the table columns

    $pathType = 'X';
    $dbType = strtolower(Doctrine_Manager::getInstance()->getCurrentConnection()->getDriverName());
        
   // mssql can't sort on fields of type text
    if ($dbType == 'mssql') {
        $pathType = 'C(8000)';
    }


    $columnDef = array(
        'id'  => "I AUTO PRIMARY",
        'pageid' => "I (4)NOTNULL DEFAULT '0'",
        'title' => "C(50) NOTNULL DEFAULT ''",
        'text' => "$pathType NOTNULL DEFAULT ''",
        'number_characters' => "I(4) NOTNULL DEFAULT '0'",
        'transport' => "I(3) NOTNULL DEFAULT '0'",
        'modulid' => "I(4) NOTNULL DEFAULT '0'");
    $dbtable['mutransport_page_column_def'] = $columnDef;

    // DEBUG: object extension aspect starts


    $dbtable['mutransport_page_primary_key_column'] = 'id';
    // disable categorization services
    $dbtable['mutransport_page_db_extra_enable_categorization'] = false;

    // enable attribution services
    $dbtable['mutransport_page_db_extra_enable_attribution'] = true;

    // disable meta data
    $dbtable['mutransport_page_db_extra_enable_meta'] = false;

    // disable logging services
    $dbtable['mutransport_page_db_extra_enable_logging'] = false;

    // DEBUG: object extension aspect ends
    
// tables for other cms    
    /*
     * definitions for cms table
     */    
    
// set the table name combined with prefix
    $dbtable['mutransport_cms'] = DBUtil::getLimitedTablename('mutransport_cms');

    // set the column names
    $columns = array(
        'cmsid' => 'cmsid',
        'name' => 'name',
        'state' => 'state');
    $dbtable['mutransport_cms_column'] = $columns;

    // set the data dictionary for the table columns
    $columnDef = array(
        'cmsid' => "I AUTO PRIMARY",
        'name' => "C(50) NOTNULL DEFAULT ''",
        'state' => "C(40) NOTNULL DEFAULT ''");
    $dbtable['mutransport_cms_column_def'] = $columnDef;

    // DEBUG: object extension aspect starts


    $dbtable['mutransport_cms_primary_key_column'] = 'cmsid';
    // disable categorization services
    $dbtable['mutransport_cms_db_extra_enable_categorization'] = false;

    // enable attribution services
    $dbtable['mutransport_cms_db_extra_enable_attribution'] = true;

    // disable meta data
    $dbtable['mutransport_cms_db_extra_enable_meta'] = false;

    // disable logging services
    $dbtable['mutransport_cms_db_extra_enable_logging'] = false;
    
    /*
     * definitions for cmscontent table
     */

    // set the table name combined with prefix
    $dbtable['mutransport_cmscontent'] = DBUtil::getLimitedTablename('mutransport_cmscontent');

    // set the column names
    $columns = array(
        'id'  => 'id',
        'contentid' => 'contentid',
        'title' => 'title',
        'text' => 'text',
        'number_characters' => 'number_characters',
        'transport' => 'transport',
        'cmsid' => 'cmsid');
    $dbtable['mutransport_cmscontent_column'] = $columns;

    // set the data dictionary for the table columns

    $pathType = 'X';
    $dbType = strtolower(Doctrine_Manager::getInstance()->getCurrentConnection()->getDriverName());
        
   // mssql can't sort on fields of type text
    if ($dbType == 'mssql') {
        $pathType = 'C(8000)';
    }

    $columnDef = array(
        'id'  => "I AUTO PRIMARY",
        'contentid' => "I (4)NOTNULL DEFAULT '0'",
        'title' => "C(50) NOTNULL DEFAULT ''",
        'text' => "$pathType NOTNULL DEFAULT ''",
        'number_characters' => "I(4) NOTNULL DEFAULT '0'",
        'transport' => "I(3) NOTNULL DEFAULT '0'",
        'cmsid' => "I(4) NOTNULL DEFAULT '0'");
    $dbtable['mutransport_cmscontent_column_def'] = $columnDef;

    // DEBUG: object extension aspect starts


    $dbtable['mutransport_cmscontent_primary_key_column'] = 'id';
    // disable categorization services
    $dbtable['mutransport_cmscontent_db_extra_enable_categorization'] = false;

    // enable attribution services
    $dbtable['mutransport_cmscontent_db_extra_enable_attribution'] = true;

    // disable meta data
    $dbtable['mutransport_cmscontent_db_extra_enable_meta'] = false;

    // disable logging services
    $dbtable['mutransport_cmscontent_db_extra_enable_logging'] = false;
    
    /*
     * definitions for user table
     */

    // set the table name combined with prefix
    $dbtable['mutransport_user'] = DBUtil::getLimitedTablename('mutransport_user');

    // set the column names
    $columns = array(
        'id' => 'id',
        'userid' => 'userid',
        'uname' => 'uname',
        'email' => 'email',
        'cmsid' => 'cmsid');
    $dbtable['mutransport_user_column'] = $columns;

    // set the data dictionary for the table columns
    $columnDef = array(
        'id' => "I AUTO PRIMARY",
        'userid' => "I (4)NOTNULL DEFAULT '0'",
        'uname' => "C(50) NOTNULL DEFAULT ''",
        'email' => "C(50) NOTNULL DEFAULT ''",
        'cmsid' => "I(4) NOTNULL DEFAULT '0'");
    $dbtable['mutransport_user_column_def'] = $columnDef;

    // DEBUG: object extension aspect starts


    $dbtable['mutransport_user_primary_key_column'] = 'id';
    // disable categorization services
    $dbtable['mutransport_user_db_extra_enable_categorization'] = false;

    // enable attribution services
    $dbtable['mutransport_user_db_extra_enable_attribution'] = true;

    // disable meta data
    $dbtable['mutransport_user_db_extra_enable_meta'] = false;

    // disable logging services
    $dbtable['mutransport_user_db_extra_enable_logging'] = false;

    // DEBUG: object extension aspect ends



    // return table data
    return $dbtable;
}
