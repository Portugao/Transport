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
 
Loader::LoadClass('MUTransportHelp', 'modules/MUTransport/classes/');
 
 class MUTransport_Api_Admin extends Zikula_AbstractApi {

/**
 * This function provides a generic handling of all check requests.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */
 
 
public function check($args)
{
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(ModUtil::url('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

//    $dom = ZLanguage::getModuleDomain('MUTransport');

/*------------------------Modules------------------------------------*/

    // get table infos of the module 'modules'
    ModUtil::dbInfoLoad('modules');
    $pntable = pnDBGetTables();
    
    
    
    // get columnname infos of the modules 'modules' and 'MUTransport'
    
    $modulescolumn = $pntable['modules_column'];
    $mutransportcolumn = $pntable['mutransport_modul_column'];
    $mutransportpagecolumn = $pntable['mutransport_page_column'];
    $mutransportcmscolumn = $pntable['mutransport_cms_column'];
    $mutransportcmscontentcolumn = $pntable['mutransport_cmscontent_column'];
    $mutransportusercolumn = $pntable['mutransport_user_column']; 
    
/* -------- Start of Part for Module News-------------*/

    // get state of the module 'News'
        
    // get data from MUTransport module    
    $where2 = "WHERE $mutransportcolumn[name] = '" . pnVarPrepForStore("News") . "'";
    $question2 = DBUtil::selectObject('mutransport_modul', $where2);
    if(isset($question2)) {
      $id = $question2['modulid'];
    }
    else {
      $id = 0;
    }    

    // call function getState
    $status = MUTransportHelp::getState('News');   

    // if News enabled
    if(ModUtil::getVar('MUTransport', 'newstocontent') == 1) {
        
    if(is_array($question2))  {
    
    // build the Array with the checked field
    $obj = array('state' => $status);

    // submit the UPDATE 
    DBUtil::updateObject ($obj, 'mutransport_modul', $where2);
   
    }    
    if ($question2 == false)
    {
    $obj = array ('modulid'  => '',
                  'name' => 'News',
                  'state'  => $status);
    
    // submit the INSERT
    DBUtil::insertObject ($obj, 'mutransport_modul', 'modulid');
    
    }
    }
    else
    {
    if(is_array($question2)) {
    $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($id) . "'";
    DBUtil::deleteWhere('mutransport_page', $where);    
    $where2 = "WHERE $mutransportcolumn[name] = 'News'";
    DBUtil::deleteWhere('mutransport_modul', $where2);
    }
    
    }
    
/* -------- End of Part for Module News-------------*/

/* -------- Start of Part for Module Pages-------------*/

    // get state of the module 'Pages'
       
    // get data from MUTransport module    
    $where2 = "WHERE $mutransportcolumn[name] = '" . pnVarPrepForStore("Pages") . "'";
    $question2 = DBUtil::selectObject('mutransport_modul', $where2);
    if(isset($question2)) {
      $id = $question2['modulid'];
    }
    else {
      $id = 0;
    }  
    
    // call function getState
    $status = MUTransportHelp::getState('Pages');
        
    // if Pages enabled
    if(ModUtil::getVar('MUTransport', 'pagestocontent') == 1)  {    
    
    if(is_array($question2))  {
    
    // build the Array with the checked field
    $obj = array('state' => $status);

    // submit the UPDATE 
    DBUtil::updateObject ($obj, 'mutransport_modul', $where2);
   
    }    
    if ($question2 == false)
    {
    $obj = array ('modulid'  => '',
                  'name' => 'Pages',
                  'state'  => $status);
    
    // submit the INSERT
    DBUtil::insertObject ($obj, 'mutransport_modul', 'modulid');
    
    }
    }
    else
    {
    if(is_array($question2)) {
    $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($id) . "'";
    DBUtil::deleteWhere('mutransport_page', $where);    
    $where2 = "WHERE $mutransportcolumn[name] = 'Pages'";
    DBUtil::deleteWhere('mutransport_modul', $where2);
    }
    
    }
    
/* -------- End of Part for Module Pages-------------*/

/* -------- Start of Part for Module PagEd -------------*/

    // get state of the module 'PagEd'
    

    // get data from MUTransport module    
    $where2 = "WHERE $mutransportcolumn[name] = '" . pnVarPrepForStore("PagEd") . "'";
    $question2 = DBUtil::selectObject('mutransport_modul', $where2);
    if(isset($question2)) {
      $id = $question2['modulid'];
    }
    else {
      $id = 0;
    }  
   
    // call function getState
    $status = MUTransportHelp::getState('PagEd');

    // if PagEd enabled    
    if(ModUtil::getVar('MUTransport', 'pagedtocontent') == 1 || ModUtil::getVar('MUTransport', 'pagedtonews') == 1) {    
    
    if(is_array($question2))  {
    
    // build the Array with the checked field
    $obj = array('state' => $status);

    // submit the UPDATE 
    DBUtil::updateObject ($obj, 'mutransport_modul', $where2);
   
    }    
    if ($question2 == false)
    {
    $obj = array ('modulid'  => '',
                  'name' => 'PagEd',
                  'state'  => $status);
    
    // submit the INSERT
    DBUtil::insertObject ($obj, 'mutransport_modul', 'modulid');
    
    }
    }
    else
    {
    if(is_array($question2)) {
    $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($id) . "'";
    DBUtil::deleteWhere('mutransport_page', $where);    
    $where2 = "WHERE $mutransportcolumn[name] = 'PagEd'";
    DBUtil::deleteWhere('mutransport_modul', $where2);
    }
    
    }

/* -------- End of Part for Module PagEd-------------*/

/* -------- Start of Part for Module Reviews-------------*/

    // get state of the module 'Reviews'
       
    // get data from MUTransport module    
    $where2 = "WHERE $mutransportcolumn[name] = '" . pnVarPrepForStore("Reviews") . "'";
    $question2 = DBUtil::selectObject('mutransport_modul', $where2);
    if(isset($question2)) {
      $id = $question2['modulid'];
    }
    else {
      $id = 0;
    }     
    
    // call function getState
    $status = MUTransportHelp::getState('Reviews');
        
    // if Pages enabled
    if(ModUtil::getVar('MUTransport', 'reviewstocontent') == 1)  {    
    
    if(is_array($question2))  {
    
    // build the Array with the checked field
    $obj = array('state' => $status);

    // submit the UPDATE 
    DBUtil::updateObject ($obj, 'mutransport_modul', $where2);
   
    }    
    if ($question2 == false)
    {
    $obj = array ('modulid'  => '',
                  'name' => 'Reviews',
                  'state'  => $status);
    
    // submit the INSERT
    DBUtil::insertObject ($obj, 'mutransport_modul', 'modulid');
    
    }
    }
    else
    {
    if(is_array($question2)) {
    $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($id) . "'";
    DBUtil::deleteWhere('mutransport_page', $where);    
    $where2 = "WHERE $mutransportcolumn[name] = 'Reviews'";
    DBUtil::deleteWhere('mutransport_modul', $where2);
    }
    
    }
    
/* -------- End of Part for Module Reviews-------------*/

/* -------- Start of Part for Module Content-------------*/

    // get state of the module 'content'

    // get data from MUTransport modul    
    $where2 = "WHERE $mutransportcolumn[name] = '" . pnVarPrepForStore("content") . "'";
    $question2 = DBUtil::selectObject('mutransport_modul', $where2);
    if(isset($question2)) {
      $id = $question2['modulid'];
    }
    else {
      $id = 0;
    }  
    
    // call function getState
    $status = MUTransportHelp::getState('content');
    
    // if Content enabled    
    if(ModUtil::getVar('MUTransport', 'contenttocontent') == 1) {        
    
    if(is_array($question2))  {
    
    // build the Array with the checked field
    $obj = array('state' => $status);

    // submit the UPDATE 
    DBUtil::updateObject ($obj, 'mutransport_modul', $where2);
   
    }    
    if ($question2 == false)
    {                                 
    $obj = array ('modulid'  => '',
                  'name' => 'content',
                  'state'  => $status);
    
    // submit the INSERT
    DBUtil::insertObject ($obj, 'mutransport_modul', 'modulid');
    
    }
    }
    else
    {
    if(is_array($question2)) {
    $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($id) . "'";
    DBUtil::deleteWhere('mutransport_page', $where);    
    $where2 = "WHERE $mutransportcolumn[name] = 'content'";
    DBUtil::deleteWhere('mutransport_modul', $where2);
    }
    
    }
    
/*------------------------MODULES END------------------------------------*/
    
/*------------------------OTHER CMS------------------------------------*/

/*-----------------------WORDPRESS-------------------------------*/

    // get data from MUTransport cms    
    $where2 = "WHERE $mutransportcolumn[name] = '" . pnVarPrepForStore("wordpress") . "'";
    $question2 = DBUtil::selectObject('mutransport_cms', $where2);
    if(isset($question2)) {
      $id = $question2['cmsid'];
    }
    else {
      $id = 0;
    }

    $wordpress = ModUtil::getVar('MUTransport','wordpress');
    $wordpress_db = ModUtil::getVar('MUTransport','wordpress_db');
    
    // if wordpress enabled in configuration
    if($wordpress == 1) {
      
      
      // if set the name of the config settings
      if($wordpress_db != '') {
      		
      	// connect to the wordpress db    	
      	$connect = MUTransportHelp::checkExtDB();
      	     
        // if connect, the connection to the db is possible
      	if($connect == true) {
      	  $status = $this->__('connection made');  
      	}
      	// the connection is not possible
      	else {
      		$status = $this->__('connection not possible');       		
      	}      	
      	
      } // if($wordpress_db != '')
      else {    	
      	$status = $this->__('not available');  	     	
      }
    
    if(is_array($question2))  {
    
    // build the Array with the checked field
    $obj = array('state' => $status);

    // submit the UPDATE 
    DBUtil::updateObject ($obj, 'mutransport_cms', $where2);
   
    }
    if ($question2 == false)
    {                                 
    $obj = array ('cmsid'  => '',
                  'name' => 'wordpress',
                  'state'  => $status);
    
    // submit the INSERT
    DBUtil::insertObject ($obj, 'mutransport_cms', 'cmsid');
    
    }	
    	
    } // if($wordpress == 1)
    else {
    if(is_array($question2)) {
    $where = "WHERE $mutransportcmscontentcolumn[cmsid] = '" . pnVarPrepForStore($id) . "'";
    DBUtil::deleteWhere('mutransport_cmscontent', $where);
    $where2 = "WHERE $mutransportusercolumn[cmsid] = '" . pnVarPrepForStore($id) . "'";
    DBUtil::deleteWhere('mutransport_user', $where2);    
    $where3 = "WHERE $mutransportcmscolumn[name] = 'wordpress'";
    DBUtil::deleteWhere('mutransport_cms', $where3);   	
    	
    }
    }

}
  
 /**
 * This function provides a generic handling of all read requests.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */
public function read($args) {
	
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(ModUtil::url('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends


/*-------------------Modules---------------------------------------*/

    // get tables of modul News, Pages, PagEd and modul Content
  
    ModUtil::dbInfoLoad('News');
    ModUtil::dbInfoLoad('pages');
    ModUtil::dbInfoLoad('PagEd');
    ModUtil::dbInfoLoad('Reviews');
    ModUtil::dbInfoLoad('Content');
     
    $pntable = pnDBGetTables();
    
    // get the name and id of modul
    
    $name = FormUtil::getPassedValue('name');
    $modulid = FormUtil::getPassedValue('id');
    $cmsid = FormUtil::getPassedValue('cmsid');
    $kind = FormUtil::getPassedValue('kind');
    
//---------------Start of Part for the modul "News" -----------------------
                           
    if ($name == 'News') {
    
    $startnum = 0;
    $itemsperpage = 0;
    $newsscolumn = $pntable['news_column'];
    $mutransportpagecolumn = $pntable['mutransport_page_column'];
    
    // ask the DB for Pages in News
    // call API Func getall of the module News

    $items = ModUtil::apiFunc('News', 'user', 'getall',
                          array('startnum'     => $startnum,
                                'numitems'     => $itemsperpage,
                                'status'       => $args['status'],
                                'hideonindex'  => $args['hideonindex'],
                                'filterbydate' => true,
                                'category'     => isset($catFilter) ? $catFilter : null,
                                'catregistry'  => isset($catregistry) ? $catregistry : null));
                                
    $countquestion = count($items);
    
    // ask the DB for existing Pages of News in MUTransport

    $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";    
    $search = DBUtil::selectObjectArray('mutransport_page' , $where);
    
        
    // put the pageid's of existing Pages in MUTransport in an array
    $search_id = array();
    foreach ($search as $wert => $value) {
    if ($modulid == $value[modulid])
    $search_id[] = $value[pageid];
    }
    
    // put the new existing Pages in News to MUTransport    
    if ($countquestion > 0)  {
 
    // build the array
    $result = array();
    $result2 = array();

      foreach ($items as $item => $value2) {
      
    // put the page into the array, if not existing
    if (!in_array($value2['sid'], $search_id))
    {    
      $count1 = strlen($value2[hometext]);
      $count2 = strlen($value2[bodytext]);
      $count = $count1 + $count2;
      $subtext = substr($value2[hometext],0,50).'.....';
    
      $result[] = array(
                      'id'                => '',
                      'pageid'            =>  $value2['sid'],
                      'title'             =>  $value2['title'],
                      'text'              =>  $subtext,
                      'number_characters' =>  $count,
                      'transport'         =>  '',
                      'modulid'           =>  $modulid,
                       );
    } // if
    else
    {
      $count1 = strlen($value2[hometext]);
      $count2 = strlen($value2[bodytext]);
      $count = $count1 + $count2;
      $subtext = substr($value2[hometext],0,50).'.....';
      $result2[] = (array('pageid' => $value2['sid'],
                        'title' => $value2['title'],
                        'text'  => $subtext,
                        'number_characters' => $count));
    
    } // else
    } // foreach
    
    $countresult1 = count($result);
    $countresult2 = count($result2);


    // submit the INSERT if result existing
    if($countresult1 > 0)  { 
      DBUtil::insertObjectArray ($result, 'mutransport_page');
    }

    // submit the update if result2 existing
    if ($countresult2 > 0) {
      for ($i=0; $i<$countresult2; $i++)  {
      $result2_obj = $result2[$i];
      $id = $result2[$i][pageid];
      $where2 = "WHERE $mutransportpagecolumn[pageid] = '" . pnVarPrepForStore($id) . "' AND $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'"; 
      DBUtil::updateObject ($result2_obj, 'mutransport_page', $where2);      
      }
    }
    if($countresult1 > 0 || $countresult2 > 0)
      return LogUtil::registerStatus($this->__('Done! ') .$countresult1 ._n(' page of Module News add to MUTransport ',' pages of Module News add to MUTransport ',$countresult1). $this->__(' and ') . $countresult2 . _n(' page of Module News in MUTransport updated ',' pages of Module News in MUTransport updated ',$countresult2));         
    } // if ($countquestion > 0)
    else
    { 
      return LogUtil::registerError($this->__('No pages in Module News available !'));
    }
    
    } //if ($name == 'News')
    
//--------------- End of Part for the modul "News" -----------------------   

//---------------Start of Part for the modul "Pages" -----------------------
                           
    if ($name == 'Pages') {
    
    $pagescolumn = $pntable['pages_column'];
    $mutransportpagecolumn = $pntable['mutransport_page_column'];
    
    // ask the DB for Pages in Pages

    $question = DBUtil::selectObjectArray('pages');
    $countquestion = count($question);
    
    // ask the DB for existing Pages of Pages in MUTransport

    $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";    
    $search = DBUtil::selectObjectArray('mutransport_page' , $where);
    
        
    // put the pageid's of existing Pages in MUTransport in an array
    $search_id = array();
    foreach ($search as $wert => $value) {
    if ($modulid == $value[modulid])
    $search_id[] = $value[pageid];
    }
    
    // put  the new existing Pages in Pages to MUTransport    
    if ($countquestion > 0)  {
 
    // build the array
    $result = array();
    $result2 = array();
    foreach ($question as $wert => $value){
    // put the page into the array, if not existing
    if (!in_array($value[pageid], $search_id))
    {    
      $count = strlen($value[content]);
      $subtext = substr($value[content],0,50).'.....';
    
      $result[] = (array(
                      'id'                => '',
                      'pageid'            =>  $value[pageid],
                      'title'             =>  $value[title],
                      'text'              =>  $subtext,
                      'number_characters' =>  $count,
                      'transport'         =>  '',
                      'modulid'           =>  $modulid,
                       ));
    } // if
    else
    {
      $count = strlen($value[content]);
      $subtext = substr($value[content],0,50).'.....';
      $result2[] = (array('pageid' => $value[pageid],
                        'title' => $value[title],
                        'text'  => $subtext,
                        'number_characters' => $count));
    
    } // else
    } // foreach
    
    $countresult1 = count($result);
    $countresult2 = count($result2);


    // submit the INSERT if result existing
    if($countresult1 > 0)  { 
      DBUtil::insertObjectArray ($result, 'mutransport_page');
    }

    // submit the update if result2 existing
    if ($countresult2 > 0) {
      for ($i=0; $i<$countresult2; $i++)  {
      $result2_obj = $result2[$i];
      $id = $result2[$i][pageid];
      $where2 = "WHERE $mutransportpagecolumn[pageid] = '" . pnVarPrepForStore($id) . "' AND $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'"; 
      DBUtil::updateObject ($result2_obj, 'mutransport_page', $where2);      
      }
    }
    if($countresult1 > 0 || $countresult2 > 0)
      return LogUtil::registerStatus($this->__('Done! ') .$countresult1 ._n(' page of Module Pages add to MUTransport ',' pages of Module Pages add to MUTransport ',$countresult1). $this->__(' and ') . $countresult2 . _n(' page of Module Pages in MUTransport updated ',' pages of Module Pages in MUTransport updated ',$countresult2));         
    } // if ($countquestion > 0)
    else
    { 
      return LogUtil::registerError($this->__('No pages in Module Pages available !'));
    }
    
    } //if ($name == 'Pages')
    
//--------------- End of Part for the modul "Pages" -----------------------

//---------------Start of Part for the modul "PagEd" -----------------------

    if ($name == 'PagEd') {

    // get the prefix if one exists    
    $prefix = pnConfigGetVar("prefix");
    if($prefix != '')
    $prefix = $prefix.'_';
    else
    $prefix = '';
    $pagedtitles = $prefix.'paged_titles';
    $pagedcontent = $prefix.'paged_content';
    
    $paged_titles_column = $pntable['paged_titles_column'];
    $paged_content_column = $pntable['paged_content_column'];
    $mutransportpagecolumn = $pntable['mutransport_page_column'];
    
    // ask the DB for Pages in PagEd 
    $sql = "SELECT page_id, title FROM $pagedtitles";
    $columns = array('page_id', 'title');
    $question = DBUtil::executeSQL($sql);
    $obj = DBUtil::marshallObjects($question, $columns);
    $countquestion = count($obj);
    
    // ask the DB for existing Pages of PagEd in MUTransport

    $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'"; 
    $search = DBUtil::selectObjectArray('mutransport_page', $where);
    
    // put the pageid's of existing Pages in MUTransport in an array
    $search_id = array();
    foreach ($search as $wert2 => $value2) {
    if ($modulid == $value2[modulid])
    $search_id[] = $value2[pageid];    
    }
    // work with the existing Pages in PagEd
    if ($countquestion > 0)
    {
 
    // build the array
    $result = array();
    foreach ($obj as $wert => $value)  {
    // put the page into the array, if not existing in MUTransport   
    // get the content of the page in Modul PagEd
    
    $sql2 = "SELECT text FROM $pagedcontent WHERE page_id = '" . pnVarPrepForStore($value['page_id']) . "'";
    $columns2 = array('text');
    $question2 = DBUtil::executeSQL($sql2);
    $obj2 = DBUtil::marshallObjects($question2, $columns2);
        
    // if content is available for this page, build the array for input or update
    if ($obj2){
    $text = '';
    foreach ($obj2 as $wert3 => $value3) {
    
    if ($value3['text'] != '') {
    $text .= $value3['text'];
    }       
    }
    $count = strlen($text);
    $subtext = substr($text,0,50).'.....';
    } // if
    // no content
    else
    {
    $subtext = $this->__('Attention ! There is no content for this page !');
    $count = 0;
    }
    // 
    if (!in_array($value['page_id'], $search_id))
    {
    $result[] = (array(
                    'id'  => '',
                    'pageid'       =>  $value['page_id'],
                    'title'        =>  $value['title'],
                    'text'         =>  $subtext,
                    'number_characters'=>  $count,
                    'transport'        =>  '0',
                    'modulid'      =>  $modulid,
                       ));
    } // if
    else
    {
    $result2[] = (array('pageid' => $value['page_id'],
                      'title' => $value['title'],
                      'text'  => $subtext,
                      'number_characters' => $count
    
                       ));
    }
    } // foreach ($obj as $wert => $value)
    
    $countresult1 = count($result);
    $countresult2 = count($result2);


    // submit the INSERT if result existing
    if($countresult1 > 0) 
    DBUtil::insertObjectArray ($result, 'mutransport_page');
    // submit the UPDATE if result existing
    if($countresult2 > 0)  {
      $count = count($result2);      
      for ($i=0; $i<$count; $i++)  {
      $result2_obj = $result2[$i];
      $id = $result2[$i][pageid];
      $where3 = "WHERE $mutransportpagecolumn[pageid] = '" . pnVarPrepForStore($id) . "' AND $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'"; 
      DBUtil::updateObject ($result2_obj, 'mutransport_page', $where3);

      }    
    } // if($countresult2 > 0)
    
    if($countresult1 > 0 || $countresult2 > 0)
      return LogUtil::registerStatus($this->__('Done! ') .$countresult1 . _n(' page of Module PagEd add to MUTransport ',' pages of Module PagEd add to MUTransport ',$countresult1). $this->__(' and ') . $countresult2 . _n(' page of Module PagEd in MUTransport updated ',' pages of Module PagEd in MUTransport updated ',$countresult2));  
    } // if ($countquestion) > 0
      else
      {
      return LogUtil::registerError($this->__('No pages in modul PagEd available !'));
      }
    } // if ($name == 'PagEd')


//--------------- End of Part for the modul "PagEd" -----------------------

//---------------Start of Part for the modul "Reviews" -----------------------
                           
    if ($name == 'Reviews') {
    
    $reviewscolumn = $pntable['reviews_column'];
    $mutransportpagecolumn = $pntable['mutransport_page_column'];
    
    // ask the DB for Pages in Reviews

    $question = DBUtil::selectObjectArray('reviews');
    $countquestion = count($question);
    
    // ask the DB for existing Pages of Reviews in MUTransport

    $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";    
    $search = DBUtil::selectObjectArray('mutransport_page' , $where);
    
        
    // put the pageid's of existing Pages in MUTransport in an array
    $search_id = array();
    foreach ($search as $wert => $value) {
    if ($modulid == $value[modulid])
    $search_id[] = $value[pageid];
    }
    
    // put  the new existing Pages in Reviews to MUTransport    
    if ($countquestion > 0)  {
 
    // build the array
    $result = array();
    $result2 = array();
    foreach ($question as $wert => $value){
    // put the page into the array, if not existing
    if (!in_array($value[id], $search_id))
    {    
      $count = strlen($value[text]);
      $subtext = substr($value[text],0,50).'.....';
    
      $result[] = (array(
                      'id'                => '',
                      'pageid'            =>  $value[id],
                      'title'             =>  $value[title],
                      'text'              =>  $subtext,
                      'number_characters' =>  $count,
                      'transport'         =>  '',
                      'modulid'           =>  $modulid,
                       ));
    } // if
    else
    {
      $count = strlen($value[text]);
      $subtext = substr($value[text],0,50).'.....';
      $result2[] = (array('pageid' => $value[id],
                        'title' => $value[title],
                        'text'  => $subtext,
                        'number_characters' => $count));
    
    } // else
    } // foreach
    
    $countresult1 = count($result);
    $countresult2 = count($result2);


    // submit the INSERT if result existing
    if($countresult1 > 0)  { 
      DBUtil::insertObjectArray ($result, 'mutransport_page');
    }

    // submit the update if result2 existing
    if ($countresult2 > 0) {
      for ($i=0; $i<$countresult2; $i++)  {
      $result2_obj = $result2[$i];
      $id = $result2[$i][pageid];
      $where2 = "WHERE $mutransportpagecolumn[pageid] = '" . pnVarPrepForStore($id) . "' AND $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'"; 
      DBUtil::updateObject ($result2_obj, 'mutransport_page', $where2);      
      }
    }
    if($countresult1 > 0 || $countresult2 > 0)
      return LogUtil::registerStatus($this->__('Done! ') .$countresult1 ._n(' page of Module Reviews add to MUTransport ',' pages of Module Reviews add to MUTransport ',$countresult1). $this->__(' and ') . $countresult2 . _n(' page of Module Reviews in MUTransport updated ',' pages of Module Reviews in MUTransport updated ',$countresult2));         
    } // if ($countquestion > 0)
    else
    { 
      return LogUtil::registerError($this->__('No pages in Module Reviews available !'));
    }
    
    } //if ($name == 'Reviews)
    
//--------------- End of Part for the modul "Reviews" -----------------------

//--------------- Start of Part for the modul "Content" -----------------------

    if ($name == 'content') {
    
    ModUtil::dbInfoLoad('content');
    $pntable = pnDBGetTables();
    
    $contentcolumn = $pntable['content_content_column'];
    $mutransportpagecolumn = $pntable['mutransport_page_column'];
    
    // ask the DB for Pages in Content

    $question = DBUtil::selectObjectArray('content_page');
    $countquestion = count($question);
    
    // ask the DB for existing Pages of Content in MUTransport

    $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'"; 
    $search = DBUtil::selectObjectArray('mutransport_page', $where);
    
    // put the pageid's of existing Pages in MUTransport in an array
    $search_id = array();
    foreach ($search as $wert => $value) {
    if ($modulid == $value[modulid])
    $search_id[] = $value[pageid];    
    }
    // work with the existing Pages in Content
    if ($countquestion > 0)
    {
    $pntables = pnDBGetTables();
    $column   = $pntables['mutransport_page_column'];
 
    // build the array
    $result = array();
    foreach ($question as $wert => $value)  {
    // put the page into the array, if not existing in MUTransport

    
    // get the content of the page in Modul Content
    
    $where2 = "WHERE $contentcolumn[pageId] = '" . pnVarPrepForStore($value[id]) . "'";
    $question2 = DBUtil::selectObjectArray('content_content', $where2);
    // if content for the page in content is available
    if ($question2){
    $text = '';
    foreach ($question2 as $wert2 => $value2) {
    
    $data = unserialize($value2[data]);
    if ($data[inputType] == 'html' || $data[inputType] == 'text') {
    $text .= $data[text];
    }       
    }
    $count = strlen($text);
    $subtext = substr($text,0,50).'.....';
    } // if
    
    else
    {
    $subtext = $this->__('Attention ! There is no content for this page !');
    $count = 0;
    }
    if (!in_array($value[id], $search_id))
    {
    $result[] = (array(
                    'id'  => '',
                    'pageid'       =>  $value[id],
                    'title'        =>  $value[title],
                    'text'         =>  $subtext,
                    'number_characters'=>  $count,
                    'transport'        =>  '0',
                    'modulid'      =>  $modulid,
                       ));
    } // if
    else
    {
    $result2[] = (array('pageid' => $value[id],
                      'title' => $value[title],
                      'text'  => $subtext,
                      'number_characters' => $count
    
                       ));
    }
    } // foreach ($question as $wert => $value)
    
    $countresult1 = count($result);
    $countresult2 = count($result2);


    // submit the INSERT if result existing
    if($countresult1 > 0) 
    DBUtil::insertObjectArray ($result, 'mutransport_page');

    if($countresult2 > 0)  {
      $count = count($result2);      
      for ($i=0; $i<$count; $i++)  {
      $result2_obj = $result2[$i];
      $id = $result2[$i][pageid];
      $where3 = "WHERE $mutransportpagecolumn[pageid] = '" . pnVarPrepForStore($id) . "' AND $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'"; 
      DBUtil::updateObject ($result2_obj, 'mutransport_page', $where3);

      }    
    } // if($countresult2 > 0)
    
    if($countresult1 > 0 || $countresult2 > 0)
      return LogUtil::registerStatus($this->__('Done! ') .$countresult1 . _n(' page of Module Content add to MUTransport ',' pages of Module Content add to MUTransport ',$countresult1). $this->__(' and ') . $countresult2 . _n(' page of Module Content in MUTransport updated ',' pages of Module Content in MUTransport updated ',$countresult2));  
    } // if ($countquestion) > 0
      else
      {
      return LogUtil::registerError($this->__('No pages in modul Content available !'));
      }
    } // if ($name == 'content')

//--------------- End of Part for the modul "Content" ----------------------- 

/*----------------------Other CMS-------------------------------------*/
	
	if($name == 'wordpress') {
		
	  $mutransportcmscontentcolumn = $pntable['mutransport_cmscontent_column'];
      $mutransportusercolumn = $pntable['mutransport_user_column'];
	  
	  $wordpress = ModUtil::getVar('MUTransport','wordpress');
      $wordpress_db = ModUtil::getVar('MUTransport','wordpress_db');		
	  $wordpress_prefix = ModUtil::getVar('MUTransport', 'wordpress_prefix');
	  
	  // if set a prefix 
      if($wordpress_prefix != '') {
      		$prefix = $wordpress_prefix . '_';
      }
      else {
      		$prefix = '';
      	}
      	
    $tables = $prefix . 'posts';
    $tables2 = $prefix . 'users';
    
    if($kind == 'content') { 
    
    //$ok = DBConnectionStack::init($wordpress_db);
    $query = "SELECT ID, post_title, post_type, post_content, post_status
    	                     FROM $tables
    	                     WHERE post_status = 'publish'
    	                     AND (post_type = 'post' OR post_type = 'page')";
    
    $obj = MUTransportHelp::connectExtDB($query);
    
    // count the items in the array
    $countquestion = count($obj);
    
    if($obj) {   
/*    $sql = "SELECT ID, post_title, post_type, post_content, post_status
    	    FROM $tables
    	    WHERE post_status = 'publish'
    	    AND (post_type = 'post' OR post_type = 'page')";
    	    
    $columns = array('ID', 'post_title', 'post_type','post_content','post_status');
    $question = DBUtil::executeSQL($sql);
    $obj = DBUtil::marshallObjects($question, $columns);
    $countquestion = count($obj);*/
    
    //DBConnectionStack::init();
    
     // ask the DB for existing Content of wordpress in MUTransport

    $where = "WHERE $mutransportcmscontentcolumn[cmsid] = '" . pnVarPrepForStore($cmsid) . "'"; 
    $search = DBUtil::selectObjectArray('mutransport_cmscontent', $where);
    
    // put the contentid's of existing Pages in MUTransport in an array
    $search_id = array();
    foreach ($search as $wert => $value) {
    if ($cmsid == $value[cmsid])
    $search_id[] = $value[contentid];
    }
    
    // put the new existing Content in Pages to MUTransport    
    if ($countquestion > 0)  {
 
    // build the array
    $result = array();
    $result2 = array();
    foreach ($obj as $wert => $value){

    // put the page into the array, if not existing
    if (!in_array($value['ID'], $search_id))
    {    
      $count = strlen($value[post_content]);
      $subtext = substr($value[post_content],0,50).'.....';
    
      $result[] = (array(
                      'id'                => '',
                      'contentid'            =>  $value[ID],
                      'title'             =>  $value[post_title],
                      'text'              =>  $subtext,
                      'number_characters' =>  $count,
                      'transport'         =>  '',
                      'cmsid'           =>  $cmsid,
                       ));
    } // if
    else
    {
      $count = strlen($value[post_content]);
      $subtext = substr($value[post_content],0,50).'.....';
      $result2[] = (array('contentid' => $value[ID],
                        'title' => $value[post_title],
                        'text'  => $subtext,
                        'number_characters' => $count));
    
    } // else
    } // foreach
    
    $countresult1 = count($result);
    $countresult2 = count($result2);


    // submit the INSERT if result existing
    if($countresult1 > 0)  { 
      DBUtil::insertObjectArray ($result, 'mutransport_cmscontent');
    }

    // submit the update if result2 existing
    if ($countresult2 > 0) {
      for ($i=0; $i<$countresult2; $i++)  {
      $result2_obj = $result2[$i];
      $id = $result2[$i][contentid];
      $where2 = "WHERE $mutransportcmscontentcolumn[contentid] = '" . pnVarPrepForStore($id) . "' AND $mutransportcmscontentcolumn[cmsid] = '" . pnVarPrepForStore($cmsid) . "'"; 
      DBUtil::updateObject ($result2_obj, 'mutransport_cmscontent', $where2);      
      }
    }
    if($countresult1 > 0 || $countresult2 > 0)
      return LogUtil::registerStatus($this->__('Done! ') .$countresult1 ._n(' page of CMS wordpress add to MUTransport ',' pages of CMS wordpress add to MUTransport ',$countresult1). $this->__(' and ') . $countresult2 . _n(' page of CMS wordpress in MUTransport updated ',' pages of CMS wordpress in MUTransport updated ',$countresult2));         
    } // if ($countquestion > 0)
    else
    { 
      return LogUtil::registerError($this->__('No pages in CMS wordpress available !'));
    }
    } // if(isset($ok))
    else {
      return LogUtil::registerError($this->__('Sorry ! Connection to database failed !'));
    }
    } // if($kind == 'content')
    
    if($kind == 'user') {
    	
    // DBConnectionStack::init($wordpress_db);
    
    // ask the DB for Users in wordpress    
    $query = "SELECT ID, user_login, user_email
    	    FROM $tables2";
    	    
    $obj2 = MUTransportHelp::connectExtDB($query);    
    
    // count the items in the array
    $countquestion2 = count($obj2);
        
/*    $sql = "SELECT ID, user_login, user_email
    	    FROM $tables2";
    	    
    $columns2 = array('ID', 'user_login', 'user_email');
    $question2 = DBUtil::executeSQL($sql);
    $obj2 = DBUtil::marshallObjects($question2, $columns2);
    $countquestion2 = count($obj2);
    
    DBConnectionStack::init();*/
    
     // ask the DB for existing Users of wordpress in MUTransport

    $where = "WHERE $mutransportusercolumn[cmsid] = '" . pnVarPrepForStore($cmsid) . "'"; 
    $search = DBUtil::selectObjectArray('mutransport_user', $where);
    
    // put the contentid's of existing USers in MUTransport in an array
    $search_id = array();
    foreach ($search as $wert => $value) {
    if ($cmsid == $value[cmsid])
    $search_id[] = $value[userid];
    }
    
    // put the new existing Users in wordpress to MUTransport    
    if ($countquestion2 > 0)  {
 
    // build the array
    $result = array();
    $result2 = array();
    foreach ($obj2 as $wert2 => $value2){

    // put the User into the array, if not existing
    if (!in_array($value2['ID'], $search_id))
    {    
    
      $result[] = (array(
                      'id'              => '',
                      'userid'          =>  $value2[ID],
                      'uname'           =>  $value2[user_login],
                      'email'           =>  $value2[user_email],
                      'cmsid'           =>  $cmsid,
                       ));
    } // if
    else
    {

      $result2[] = (array('userid' => $value2[ID],
                          'uname'  => $value2[user_login],
                          'email'  => $value2[user_email]));
    
    } // else
    } // foreach
    
    $countresult1 = count($result);
    $countresult2 = count($result2);
    
    // submit the INSERT if result existing
    if($countresult1 > 0)  { 
      DBUtil::insertObjectArray ($result, 'mutransport_user');
    }

    // submit the update if result2 existing
    if ($countresult2 > 0) {
      for ($i=0; $i<$countresult2; $i++)  {
      $result2_obj = $result2[$i];
      $id = $result2[$i][userid];
      $where2 = "WHERE $mutransportusercolumn[userid] = '" . pnVarPrepForStore($id) . "' AND $mutransportusercolumn[cmsid] = '" . pnVarPrepForStore($cmsid) . "'"; 
      DBUtil::updateObject ($result2_obj, 'mutransport_user', $where2);      
      }
    }
    if($countresult1 > 0 || $countresult2 > 0)
      return LogUtil::registerStatus($this->__('Done! ') .$countresult1 ._n(' User of CMS wordpress add to MUTransport ',' Users of CMS wordpress add to MUTransport ',$countresult1). $this->__(' and ') . $countresult2 . _n(' User of CMS wordpress in MUTransport updated ',' Users of CMS wordpress in MUTransport updated ',$countresult2));         
    } // if ($countquestion2 > 0)
    else
    { 
      return LogUtil::registerError($this->__('No pages in CMS wordpress available !'));
    }    	
    	
    	
    }
 } // if($kind == 'user')
 }

 /**
 * This function provides a generic handling of all delete requests.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */
public function delete($args) {
	
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(ModUtil::url('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

   // $dom = ZLanguage::getModuleDomain('MUTransport');



    // take tables of modul News, Pages, PagEd and modul Content
    
    ModUtil::dbInfoLoad('News');    
    ModUtil::dbInfoLoad('pages');
    ModUtil::dbInfoLoad('PagEd');
    ModUtil::dbInfoLoad('Reviews');     
    ModUtil::dbInfoLoad('Content');
    $pntable = pnDBGetTables();
    
    // get the name, id of modul, id of cms and kind of TODO
    
    $name = FormUtil::getPassedValue('name');
    $modulid = FormUtil::getPassedValue('id');
    $cmsid = FormUtil::getPassedValue('cmsid');
    $kind = FormUtil::getPassedValue('kind');
    
 //---------------Start of Part for the modul "News" -----------------------

    if ($name == 'News') {    
        $pagescolumn = $pntable['news_column'];
        $mutransportpagecolumn = $pntable['mutransport_page_column'];
    
        // ask the DB for Pages in News

        $question = DBUtil::selectObjectArray('news');
        $countquestion = count($question);
        
        // ask the DB for existing Pages of News in MUTransport
    
        $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";
        $search = DBUtil::selectObjectArray('mutransport_page', $where);
        $countsearch = count($search);
        
        $diff = $countsearch - $countquestion;
        
        // put the pageid's of existing Pages in News in an array
        $question_id = array();
        foreach ($question as $wert => $value)  {
        $question_id[] = $value['sid'];
        }
        
        if($countsearch > 0) {
          if($countquestion < $countsearch)  {  
            // delete Pages from MUTransport not existing in News
            foreach ($search as $wert => $value)  {
                if (!in_array($value[pageid], $question_id)) {
                    $where2 = "WHERE $mutransportpagecolumn[pageid] = '" . pnVarPrepForStore($value[pageid]) . "' AND $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";
                    $ok = DBUtil::deleteWhere ('mutransport_page', $where2);
 
                } // if
            } // foreach
          } // if($countquestion < $countsearch)
          else {
            return LogUtil::registerError($this->__('There is no page to delete !'));
          } 
        } // if($countsearch > 0)
        else  {
          return LogUtil::registerError($this->__('There are no Pages of module News in Modul MUTransport available !'));
        }
    if($diff > 0) 
    return LogUtil::registerStatus($this->__('Done! ') . $diff . _n(' page of News in MUTransport deleted !',' pages of News in MUTransport deleted !',$diff));
    } // if ($name == 'News') 
 
 //--------------- End of Part for the modul "News" -----------------------    
    
 //---------------Start of Part for the modul "Pages" -----------------------
    
    if ($name == 'Pages') {    
        $pagescolumn = $pntable['pages_column'];
        $mutransportpagecolumn = $pntable['mutransport_page_column'];
    
        // ask the DB for Pages in Pages

        $question = DBUtil::selectObjectArray('pages');
        $countquestion = count($question);
        // ask the DB for existing Pages of Pages in MUTransport
    
        $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";
        $search = DBUtil::selectObjectArray('mutransport_page', $where);
        $countsearch = count($search);
        
        $diff = $countsearch - $countquestion;
        
        // put the pageid's of existing Pages in Pages in an array
        $question_id = array();
        foreach ($question as $wert => $value)  {
        $question_id[] = $value[pageid];
        }
        
        if($countsearch > 0) {
          if($countquestion < $countsearch)  {  
            // delete Pages from MUtransport not existing in Pages
            foreach ($search as $wert => $value)  {
                if (!in_array($value[pageid], $question_id)) {
                    $where2 = "WHERE $mutransportpagecolumn[pageid] = '" . pnVarPrepForStore($value[pageid]) . "' AND $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";
                    $ok = DBUtil::deleteWhere ('mutransport_page', $where2);
 
                } // if
            } // foreach
          } // if($countquestion < $countsearch)
          else {
            return LogUtil::registerError($this->__('There is no page to delete !'));
          } 
        } // if($countsearch > 0)
        else  {
          return LogUtil::registerError($this->__('There are no Pages of module Pages in Modul MUTransport available !'));
        }
    if($diff > 0) 
    return LogUtil::registerStatus($this->__('Done! ') . $diff . _n(' page of Pages in MUTransport deleted !',' pages of Pages in MUTransport deleted !',$diff));
    } // if ($name == 'Pages')
//--------------- End of Part for the modul "Pages" -----------------------

 //---------------Start of Part for the modul "PagEd" -----------------------
    
    if ($name == 'PagEd') {    
        $pagescolumn = $pntable['pages_column'];
        $mutransportpagecolumn = $pntable['mutransport_page_column'];
        
        $prefix = pnConfigGetVar("prefix");
        if($prefix != '')
        $prefix = $prefix.'_';
        else
        $prefix = '';
        $pagedtitles = $prefix.'paged_titles';
        $pagedcontent = $prefix.'paged_content';        
    
        // ask the DB for Pages in PagEd
        
        $sql = "SELECT page_id FROM $pagedtitles";
        $columns = array('page_id');
        $question = DBUtil::executeSQL($sql);
        $obj = DBUtil::marshallObjects($question, $columns);
        $countquestion = count($obj);

        // ask the DB for existing Pages of PagEd in MUTransport
    
        $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";
        $search = DBUtil::selectObjectArray('mutransport_page', $where);
        $countsearch = count($search);
        
        $diff = $countsearch - $countquestion;
        
        // put the pageid's of existing Pages in PagEd in an array
        $question_id = array();
        foreach ($obj as $wert => $value)  {
        $question_id[] = $value[page_id];
        }
        
        if($countsearch > 0) {
          if($countquestion < $countsearch)  {  
            // delete Pages from MUtransport not existing in PagEd
            foreach ($search as $wert => $value)  {
                if (!in_array($value[pageid], $question_id)) {
                    $where2 = "WHERE $mutransportpagecolumn[pageid] = '" . pnVarPrepForStore($value[pageid]) . "' AND $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";
                    $ok = DBUtil::deleteWhere ('mutransport_page', $where2);
 
                } // if
            } // foreach
          } // if($countquestion < $countsearch)
          else {
            return LogUtil::registerError($this->__('There is no page to delete !'));
          } 
        } // if($countsearch > 0)
        else  {
          return LogUtil::registerError($this->__('There are no Pages of module PagEd in Modul MUTransport available !'));
        }
    if($diff > 0) 
    return LogUtil::registerStatus($this->__('Done! ') . $diff . _n(' page of PagEd in MUTransport deleted !',' pages of PagEd in MUTransport deleted !',$diff));
    } // if ($name == 'PagEd')
//--------------- End of Part for the modul "PagEd" -----------------------

 //---------------Start of Part for the modul "Reviews" -----------------------
    
    if ($name == 'Reviews') {    
        $reviewscolumn = $pntable['reviews_column'];
        $mutransportpagecolumn = $pntable['mutransport_page_column'];
    
        // ask the DB for Pages in Reviews

        $question = DBUtil::selectObjectArray('reviews');
        $countquestion = count($question);
        // ask the DB for existing Pages of Reviews in MUTransport
    
        $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";
        $search = DBUtil::selectObjectArray('mutransport_page', $where);
        $countsearch = count($search);
        
        $diff = $countsearch - $countquestion;
        
        // put the pageid's of existing Pages in Reviews in an array
        $question_id = array();
        foreach ($question as $wert => $value)  {
        $question_id[] = $value[pageid];
        }
        
        if($countsearch > 0) {
          if($countquestion < $countsearch)  {  
            // delete Pages from MUtransport not existing in Reviews
            foreach ($search as $wert => $value)  {
                if (!in_array($value[pageid], $question_id)) {
                    $where2 = "WHERE $mutransportpagecolumn[pageid] = '" . pnVarPrepForStore($value[pageid]) . "' AND $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";
                    $ok = DBUtil::deleteWhere ('mutransport_page', $where2);
 
                } // if
            } // foreach
          } // if($countquestion < $countsearch)
          else {
            return LogUtil::registerError($this->__('There is no page to delete !'));
          } 
        } // if($countsearch > 0)
        else  {
          return LogUtil::registerError($this->__('There are no pages of module Reviews in Modul MUTransport available !'));
        }
    if($diff > 0) 
    return LogUtil::registerStatus($this->__('Done! ') . $diff . _n(' page of Reviews in MUTransport deleted !',' pages of Reviews in MUTransport deleted !',$diff));
    } // if ($name == 'Reviews')
//--------------- End of Part for the modul "Reviews" -----------------------


//--------------- Start of Part for the modul "Content" -----------------------

    if ($name == 'content') {    
        $contentpagecolumn = $pntable['content_page_column'];
        $mutransportpagecolumn = $pntable['mutransport_page_column'];
    
        // ask the DB for Pages in Pages
        $question = DBUtil::selectObjectArray('content_page');
        $countquestion = count($question);
        
        // ask the DB for existing Pages of Content in MUTransport
        $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";    
        $search = DBUtil::selectObjectArray('mutransport_page', $where);
        $countsearch = count($search);
        
        $diff = $countsearch - $countquestion;
        
        // put the pageid's of existing Pages in Content in an array
        $question_id = array();
        foreach ($question as $wert => $value)  {
        $question_id[] = $value[id];
        }
            
        if($countsearch > 0) {
          if($countquestion < $countsearch)  {  
            // delete Pages from MUtransport not existing in Content
            foreach ($search as $wert => $value)  {
            if (!in_array($value[pageid], $question_id)) {
                $where2 = "WHERE $mutransportpagecolumn[pageid] = '" . pnVarPrepForStore($value[pageid]) . "' AND $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";
                DBUtil::deleteWhere ('mutransport_page', $where2);
    
            } // if
            } // foreach
          } // if($countquestion < $countsearch)
          else {
            return LogUtil::registerError($this->__('There is no page to delete !'));
          }       
        } // if($countsearch > 0)
        else  {
          return LogUtil::registerError($this->__('There are no Pages of module Content in Modul MUTransport available !'));
        }
    if($diff > 0)
    return LogUtil::registerStatus($this->__('Done! ') . $diff . _n(' page of Content in MUTransport deleted !',' pages of Content in MUTransport deleted !',$diff));
    } // if ($name == 'content')
    
//------------------- End of Part for the modul "Content" ----------------------- 

//--------------------------Other CMS-------------------------------------------------

//--------------------------WORDPRESS----------------------------------------------
  
    if($name == 'wordpress') {
      
    $mutransportcmscontentcolumn = $pntable['mutransport_cmscontent_column'];
  	$mutransportusercolumn = $pntable['mutransport_user_column'];
    
    // ask the DB for Pages in wordpress
        
	  $wordpress = pnModGetVar('MUTransport','wordpress');
      $wordpress_db = pnModGetVar('MUTransport','wordpress_db');		
	  $wordpress_prefix = pnModGetVar('MUTransport', 'wordpress_prefix');
	  
	  // if set a prefix 
      if($wordpress_prefix != '') {
      		$prefix = $wordpress_prefix . '_';
      }
      else {
      		$prefix = '';
      	}
      	
    $tables = $prefix . 'posts';
    $tables2 = $prefix . 'users';
    
    if($kind == 'content') {  
    
    //DBConnectionStack::init($wordpress_db);
    
    $query = "SELECT ID, post_title, post_type, post_content, post_status
    	      FROM $tables
    	      WHERE post_status = 'publish'";
    	    
    $obj = MUTransportHelp::connectExtDB($query);    
    
    // count the items in the array
    $countquestion = count($obj);
    
/*    // ask the DB for Pages in wordpress with state 'publish'        
    $sql = "SELECT ID, post_title, post_type, post_content, post_status
    	    FROM $tables
    	    WHERE post_status = 'publish'";
    	   
    $columns = array('ID', 'post_title', 'post_type','post_content','post_status');
    $question = DBUtil::executeSQL($sql);
    $obj = DBUtil::marshallObjects($question, $columns);
    $countquestion = count($obj);
    
    DBConnectionStack::init();*/
        
    // ask the DB for existing Pages of wordpress in MUTransport
    
    $where = "WHERE $mutransportcmscontentcolumn[cmsid] = '" . pnVarPrepForStore($cmsid) . "'";
    $search = DBUtil::selectObjectArray('mutransport_cmscontent', $where);
    $countsearch = count($search);
        
    $diff = $countsearch - $countquestion;
        
    // put the contentid's of existing Pages in wordpress in an array
    $question_id = array();
    foreach ($obj as $wert => $value)  {
    $question_id[] = $value[ID];
    }
        
    if($countsearch > 0) {
      if($countquestion < $countsearch)  {  
        // delete Pages from MUTransport not existing in wordpress
        foreach ($search as $wert => $value)  {
            if (!in_array($value[contentid], $question_id)) {
                $where2 = "WHERE $mutransportcmscontentcolumn[contentid] = '" . pnVarPrepForStore($value[contentid]) . "' AND $mutransportcmscontentcolumn[cmsid] = '" . pnVarPrepForStore($cmsid) . "'";
                $ok = DBUtil::deleteWhere ('mutransport_cmscontent', $where2);
 
            } // if
        } // foreach
      } // if($countquestion < $countsearch)
      else {
        return LogUtil::registerError($this->__('There is no page to delete !'));
      } 
    } // if($countsearch > 0)
    else  {
      return LogUtil::registerError($this->__('There are no Pages of cms wordpress in Modul MUTransport available !'));
    }
    if($diff > 0) 
      return LogUtil::registerStatus($this->__('Done! ') . $diff . _n(' page of wordpress in MUTransport deleted !',' pages of wordpress in MUTransport deleted !',$diff));	
    } // if($kind == 'content')
    
    if($kind == 'user') {
    	
    // DBConnectionStack::init($wordpress_db);
    
    // ask the DB for Users in wordpress
    $query = "SELECT ID, user_login, user_email
    	    FROM $tables2";
    	    
    $obj2 = MUTransportHelp::connectExtDB($query);
    
    $countquestion2 = count($obj2); 
        
/*
 * TODO    $sql = "SELECT ID, user_login, user_email
    	    FROM $tables2";
    	    
    $columns2 = array('ID', 'user_login', 'user_email');
    $question2 = DBUtil::executeSQL($sql);
    $obj2 = DBUtil::marshallObjects($question2, $columns2);
    $countquestion2 = count($obj2);
    
    DBConnectionStack::init();*/
    
    // ask the DB for existing Users of wordpress in MUTransport
    
    $where2 = "WHERE $mutransportusercolumn[cmsid] = '" . pnVarPrepForStore($cmsid) . "'";
    $search2 = DBUtil::selectObjectArray('mutransport_user', $where2);
    $countsearch2 = count($search2);
        
    $diff2 = $countsearch2 - $countquestion2;
        
    // put the contentid's of existing Pages in wordpress in an array
    $question_id = array();
    foreach ($obj as $wert => $value)  {
    $question_id[] = $value[ID];
    }
    
   // put the contentid's of existing Pages in wordpress in an array
    $question_id = array();
    foreach ($obj as $wert => $value)  {
    $question_id[] = $value[ID];
    }
        
    if($countsearch2 > 0) {
      if($countquestion2 < $countsearch2)  {  
        // delete Pages from MUTransport not existing in wordpress
        foreach ($search2 as $wert2 => $value2)  {
            if (!in_array($value[contentid], $question_id)) {
                $where3 = "WHERE $mutransportusercolumn[userid] = '" . pnVarPrepForStore($value2[userid]) . "' AND $mutransportusercolumn[cmsid] = '" . pnVarPrepForStore($cmsid) . "'";
                $ok2 = DBUtil::deleteWhere ('mutransport_user', $where3);
 
            } // if
        } // foreach
      } // if($countquestion2 < $countsearch2)
      else {
        return LogUtil::registerError($this->__('There is no User to delete !'));
      } 
    } // if($countsearch2 > 0)
    else  {
      return LogUtil::registerError($this->__('There are no Users of cms wordpress in Modul MUTransport available !'));
    }
    if($diff > 0) 
      return LogUtil::registerStatus($this->__('Done! ') . $diff2 . _n(' User of wordpress in MUTransport deleted !',' Users of wordpress in MUTransport deleted !',$diff2));	
    } // if($kind == 'user')
    		
    } // if($name == 'wordpress')

//---------------------END WORDPRESS--------------------------------------------
    

 }
 
 /**
 * This function provides a generic handling of all transport requests.
 *
 * @author       Michael Ueberschaer
 * @param $args
 * @return       Render output
 */

 public function transport($args) {


// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(ModUtil::url('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

  //  $dom = ZLanguage::getModuleDomain('MUTransport'); 

// take tableinfos of the modules

    ModUtil::dbInfoLoad('News');   
    ModUtil::dbInfoLoad('PagEd'); 
    ModUtil::dbInfoLoad('pages');
    ModUtil::dbInfoLoad('Reviews');
    ModUtil::dbInfoLoad('content');
    $pntable = pnDBGetTables();

    // take columns of tables
    $mutransportcolumn = $pntable['mutransport_page_column'];
    $mutransportcmscolumn = $pntable['mutransport_cmscontent_column'];
    $contentpagecolumn = $pntable['content_page_column'];
    $contentcontentcolumn = $pntable['content_content_column'];
    $newscolumn = $pntable['news_column'];    
    $pagescolumn = $pntable['pages_column'];
    $reviewscolumn = $pntable['reviews_column'];
//    $column   = $pntables['mutransport_page_column']; TODO delete

    // get state of modules
    $content_state_result = MUTransportHelp::getStateOfModule('content');
    if(isset($content_state_result[0])) {
      $content_state = $content_state_result[0]['state']; 
    }
    else {
      $content_state = 0;
    }
    $news_state_result = MUTransportHelp::getStateOfModule('News');
    if (isset($news_state_result[0])) {
      $news_state = $news_state_result[0]['state'];
    }
    else {
      $news_state = 0;
    }
     $pages_state_result = MUTransportHelp::getStateOfModule('Pages');
    if (isset($pages_state_result[0])) {
      $pages_state = $pages_state_result[0]['state'];
    }
    else {
      $pages_state = 0;
    }
     $ezcomments_state_result = MUTransportHelp::getStateOfModule('EZComments');
    if (isset($ezcomments_state_result[0])) {
      $ezcomments_state = $ezcomments_state_result[0]['state'];
    }
    else {
      $ezcomments_state = 0;
    }

    // get number of selected copies for module content
    
    $number = FormUtil::getPassedValue('number');
    
    // get kind of content, module or cms
    $kind = FormUtil::getPassedValue('kind');
    
    // get settings for transport for module PagEd

    $tocontent = ModUtil::getVar('MUTransport', 'pagedtocontent');
    $tonews = ModUtil::setVar('MUTransport', 'pagedtonews');
    
    // get format for transport
    $format = ModUtil::getVar('MUTransport', 'text_format'); 
       
    // set counter for modules      
    $counter = 0; // counter for Pages of Pages
    $counter2 = 0; // counter for Pages of Content
    $counter3 = 0; // counter for Pages of News
    $counter4 = 0; // counter for Pages of PagEd
    $counter5 = 0; // counter for Pages of Reviews
    
    // set counter for cms
    $counterA = 0; // counter for Pages of Wordpress
    $countera = 0; // counter for Users of Wordpress
       
    
    if (isset($_POST['yes'])) {
      foreach ($_POST['yes'] as $post => $value)  {
      $yes = explode(".",$value);
      $id = (int) $yes[0];
      $modul = $yes[1]; 
      
      
/*-------------------------------MODUL NEWS-------------------------------*/

/* -------------         Transport to Content      ------------------------*/
    
    if ($modul == 'News') {
      if($content_state == 3) {
    
      // Get page from the DB
      $where = "WHERE $newscolumn[sid] = '" . pnVarPrepForStore($id) . "'";     
      $question_page = DBUtil::selectObject('news', $where);
      $count_question_page = count($question_page);    
        
      // prepare the selected pages from modul news for transport to modul content
      // if there is a page in News

      $where = "WHERE $contentpagecolumn[title] = '" . pnVarPrepForStore($question_page['title']) . "'";
      $check = DBUtil::selectObject('content_page', $where);
    
      // prepare the page
    
      if (!$check)  {
      	if($question_page) {   
    
        // build the page and put it into the db
        $ok1 = MUTransportHelp::buildArrayForContentPage($question_page['title']);
        
        $counter3 = $counter3 + 1;
        // update the state of transport for the original Page
        if ($ok1) {        
        MUTransportHelp::updateTransport($mutransportcolumn[pageid],$id); 
        } 
         
        // prepare the content    
        // get the page_id of the even inserted Page
    
        $relation_id = MUTransportHelp::getIdFromContent('id');

        // build the array for the content for the transport into Content
        
        // first put hometext and bodytext to one text
        // if bodytext not empty
        
        if($question_page[bodytext] != '')
        $newstext = $question_page[hometext] . '<br /><br/>' . $question_page[bodytext];
        else
        $newstext = $question_page[hometext];
        
        MUTransportHelp::buildArrayForContent($newstext, $format, $relation_id, 'Html');
        
      	}
      	else
      	{
      		return LogUtil::registerError($this->__('This page does not exist in News anymore !'));
      	}
    
    } // if (!$check)
    else
    {
      return LogUtil::registerError($this->__('There is still one Page with this Permalink Url!'));                           
    }
      } // if($content_state == 3)
      else {
      	return LogUtil::registerError($this->__('Sorry ! The target module Content is not active!')); 
      }                 
    } //  if ($modul == 'News') 


/*-------------------------------MODUL PAGED-------------------------------*/

/* -------------         Transport of PagEd  ------------------------*/

    if ($modul == 'PagEd') {

      // get the prefix if one exists
      $prefix = pnConfigGetVar("prefix");
      if($prefix != '')
      $prefix = $prefix.'_';
      else
      $prefix = '';
      $pagedtitles = $prefix.'paged_titles';
      $pagedcontent = $prefix.'paged_content';

      // Get page from the DB
      $sql = "SELECT page_id, title, ingress, unix_timestamp, page_author, pageauthor_name FROM $pagedtitles WHERE page_id = '" . pnVarPrepForStore($id) . "'";
      $columns = array('page_id', 'title', 'ingress', 'unix_timestamp', 'page_author', 'pageauthor_name');
      $question = DBUtil::executeSQL($sql);
      $question_page = DBUtil::marshallObjects($question, $columns);
      $count_question_page = count($question_page);
      
      // prepare the selected page from modul paged 
      // if there is a page in PagEd                    
      
      foreach($question_page as $wert => $value) {
      // ckeck content for page with given title
      $where = "WHERE $contentpagecolumn[title] = '" . pnVarPrepForStore($value['title']) . "'";
      $check = DBUtil::selectObject('content_page', $where);
      // ckeck news for page with given title
      $where2 = "WHERE $newscolumn[title] = '" . pnVarPrepForStore($value['title']) . "'";
      $check2 = DBUtil::selectObject('news', $where2);
      
         
      if (!$check || !$check2)  {
      	if($question_page) {
      
//---------------------FOR TRANSPORT TO CONTENT----------------------------------------

        if($tocontent == 1) { 
          if($content_state == 3) {        
        // build the page and put it into the db
        $ok1 = MUTransportHelp::buildArrayForContentPage($value['title']);       
                   
        // update the state of transport for the original Page
        if ($ok1) {
        MUTransportHelp::updateTransport($mutransportcolumn[pageid],$id);  
        }
        
        // prepare the content    
        // get the page_id of the even inserted Page
        
        $relation_id = MUTransportHelp::getIdFromContent('id');
                
        // take the content for the page from PagEd
        
        $sql2 = "SELECT page_id, section, subtitle, image, imagetext, text
        		 FROM $pagedcontent
        		 WHERE page_id = '" . pnVarPrepForStore($id) . "' ORDER BY section DESC";
        		
        $columns2 = array('page_id', 'section', 'subtitle', 'image', 'imagetext', 'text');
        $question2 = DBUtil::executeSQL($sql2);
        $question_content = DBUtil::marshallObjects($question2, $columns2);
        $count_question_content = count($question_content);   
        
        // build the array for the content for the transport into Content 
        
        foreach($question_content as $wert2 => $value2) {
        
        // ckeck the image path, if not empty check for image
        // else do nothing and take only the text
        
        if(Modtil::getVar('MUTransport', 'image_path') != '') {
        
        // if there is an image build the image path and html code
        // and put before the text
        // else do nothing with the existing text        
        
        if($value2[image] != '') {
        $image_path = Modtil::getVar('MUTransport', 'image_path');
        $image = $value2[image];
        $exist = strpos($image,"/");
        if($exist) {
        $image = strrchr($image, "/");
        $image = str_replace("/","",$image);
        }                
        $img = "<img style='float:right' src='$image_path/$image'>";
        $text = $img . $value2[text];
        }
        else
        {
        $text = $value2[text];
        }
        }
        else
        {
        $text = $value2[text];
        }
       
        // for each chapter found in PagEd generate a textblock
        
        MUTransportHelp::buildArrayForContent($text, $format, $relation_id, 'html');
        
        // if subtitle generate a header
        
        if($value2[subtitle] != '') {
        
        MUTransportHelp::buildArrayForContent($value2[subtitle], 'text', $relation_id, 'heading');
   
        }        
        } // foreach($question_content as $wert2 => $value2)

        // if there is a description of the page generate a header         
        
        if($value[ingress] != '') {
        
        MUTransportHelp::buildArrayForContent($value[ingress], 'text', $relation_id, 'heading');
 
        }
          }// if($content_state == 3)
      else {
      	return LogUtil::registerError($this->__('Sorry ! The target module Content is not active!')); 
      }       
      } // if($tocontent)
      
//---------------------FOR TRANSPORT TO NEWS----------------------------------------
      
      // for transport to news
      if($tonews == 1) {
      	if ($news_state == 3) {

        $sql = "SELECT page_id, section, subtitle, image, imagetext, text FROM $pagedcontent WHERE page_id = '" . pnVarPrepForStore($id) . "' ORDER BY section ASC";
        $columns = array('page_id', 'section', 'subtitle', 'image', 'imagetext', 'text');
        $question = DBUtil::executeSQL($sql);
        $question_content = DBUtil::marshallObjects($question, $columns);
        $count_question_content = count($question_content);
        
        $date = DateUtil::getDatetime($value[unix_timestamp]);
        $ok2 = MUTransportHelp::generateInputForNews($value[title],$value[pageauthor_name],$value[page_author] , $value[ingress], $question_content, $count_question_content, $date); 
              
        if($ok2) {
          MUTransportHelp::updateTransport($mutransportcolumn[pageid],$id);
        }
      }// if($news_state == 3)
      else {
      	return LogUtil::registerError($this->__('Sorry ! The target module News is not active!')); 
      }
      
      } // if($tonews)
      
      if($ok1 || $ok2) {
        $counter4 = $counter4 + 1;
      }
      } // if($question_page)
      else
      {
      	return LogUtil::registerError($this->__('This page does not exist in PagEd anymore !'));
      }  
    } // if (!$check)
    
    else
    {
      return LogUtil::registerError($this->__('There is still one Page with this Permalink Url!'));                           
    }
    } // foreach($question_page as $wert => $value)
          
    } // if ($modul == 'PagEd')

         
/*-------------------------------MODUL PAGES-------------------------------*/

/* -------------         Transport to Content      ------------------------*/
    
    if ($modul == 'Pages') {
      if($content_state == 3) {  
    
      // Get page from the DB
      $where = "WHERE $pagescolumn[pageid] = '" . pnVarPrepForStore($id) . "'";     
      $question_page = DBUtil::selectObject('pages', $where);
      $count_question_page = count($question_page);    
        
    // prepare the selected pages from modul pages for transport to modul content
    // if there is a page in Pages

      $where = "WHERE $contentpagecolumn[title] = '" . pnVarPrepForStore($question_page['title']) . "'";
      $check = DBUtil::selectObject('content_page', $where);
    
      // prepare the page
    
      if (!$check)  {
      	if($question_page) {  
        
        $ok1 = MUTransportHelp::buildArrayForContentPage($question_page['title']);      

        $counter = $counter + 1;
        // update the state of transport for the original Page
        if ($ok1) {
        MUTransportHelp::updateTransport($mutransportcolumn[pageid],$id); 
 
        } 
         
        // prepare the content    
        // get the page_id of the even inserted Page
        
        $relation_id = MUTransportHelp::getIdFromContent('id');

        // build the array for the content for the transport into Content
        
        MUTransportHelp::buildArrayForContent($question_page[content], $format, $relation_id, 'html');

      	} // if($question_page)
      	else
      	{
      		LogUtil::registerError($this->__('This page does not exist in Pages anymore !')); 
      	}
    } // if (!$check)
    else
    {
      return LogUtil::registerError($this->__('There is still one Page with this Permalink Url!'));                           
    }
      } // if($content_state == 3)
      else {
      	return LogUtil::registerError($this->__('Sorry ! The target module Content is not active!')); 
      }                
    } //  if($modul == 'Pages')
    
    
/*-------------------------------MODUL REVIEWS-------------------------------*/

/* -------------         Transport to Content      ------------------------*/
    
    if ($modul == 'Reviews') {
      if($content_state == 3) {
    
      // Get page from the DB
      $where = "WHERE $reviewscolumn[id] = '" . pnVarPrepForStore($id) . "'";     
      $question_page = DBUtil::selectObject('reviews', $where);
      $count_question_page = count($question_page);    
        
    // prepare the selected pages from modul reviews for transport to modul content
    // if there is a page in Reviews

      $where = "WHERE $contentpagecolumn[title] = '" . pnVarPrepForStore($question_page['title']) . "'";
      $check = DBUtil::selectObject('content_page', $where);
    
      // prepare the page
    
      if (!$check)  {
      	if($question_page) {  
        
        $ok1 = MUTransportHelp::buildArrayForContentPage($question_page['title']);      

        $counter5 = $counter5 + 1;
        // update the state of transport for the original Page
        if ($ok1) {
        MUTransportHelp::updateTransport($mutransportcolumn[pageid],$id); 
 
        } 
         
        // prepare the content    
        // get the page_id of the even inserted Page
        
        $relation_id = MUTransportHelp::getIdFromContent('id');
        
        // build the array for additional content, if wished
        if(pnModGetVar('MUTransport', 'details') == 1) {
          $date = DateUtil::formatDatetime($question_page[cr_date], 'datebrief');
          $reviewsdetails = ($this->__('published on')) .": ".$date. "<br /><br/>" .
                            ($this->__('reviewer')) . ": " . $question_page[reviewer] . "<br /><br />" . 
                            ($this->__('points')) . ": " . $question_page[score] . "<br /><br />" .
                            ($this->__('hits')). ": " . $question_page[hits];	
          MUTransportHelp::buildArrayForContent($reviewsdetails, $format, $relation_id, 'html');	
        }
        
        // build the array for the content for the transport into Content
                
        MUTransportHelp::buildArrayForContent($question_page[text], $format, $relation_id, 'html');
        


      	} // if($question_page)
      	else
      	{
      		LogUtil::registerError($this->__('This page does not exist in Reviews anymore !')); 
      	}
    } // if (!$check)
    else
    {
      return LogUtil::registerError($this->__('There is still one Page with this Permalink Url!'));                           
    }
      } // if($content_state == 3)
      else {
      	return LogUtil::registerError($this->__('Sorry ! The target module Content is not active!')); 
      }                 
    } //  if ($modul == 'Reviews')    

        
/*-------------------------------COPY Pages in MODUL CONTENT-------------------------------*/
      
    // prepare the selected pages from modul Content for transport to modul Content
    // if there is a page in Content
    if($modul == 'content') {

      $urlname = '';
    
      $where = "WHERE $contentpagecolumn[id] = '" . pnVarPrepForStore($id) . "'";     
      $question_content= DBUtil::selectObject('content_page', $where);
          
      $copy = $this->__(' (A copy)');
      $title = $question_content[title];
      $title = $title . $copy;
    
      $where = "WHERE $contentpagecolumn[title] = '" . pnVarPrepForStore($title) . "'";
      $check = DBUtil::selectObject('content_page', $where);
            
      // start to copy
      if(!$check) {
      	if($question_content) {
      		
          $where = "WHERE $mutransportcolumn[pageid] = '" . pnVarPrepForStore($id) . "'";
          $old = DBUtil::selectObject('mutransport_page', $where);
          $transport = $old[transport];    
          for ($i=1; $i<=$number; $i++) {
              $page = array('page'  =>  array('title'      => $title,
                                    'urlname'    => $urlname,
                                    'layout'     => $question_content['layout'],
                                    'categoryId' => $question_content['categoryId'],
                                    'activeFrom' => $question_content['activeFrom'],
                                    'activeTo'   => $question_content['activeTo'],
                                    ),
                          'pageId'  => '',
                          'location' => '',);
    
              $ok1 = ModUtil::apiFunc('content', 'page', 'newPage',$page);
              $title = $title . $copy;
    
              // count the copies    
              if ($ok1)     
                  $transport = $transport + 1; 

          // take the content for the even copied page    
          // get the page_id of the even inserted Page
    
        $relation_id = MUTransportHelp::getIdFromContent('id');
    
          // take the content for the page
    
          $where2 = "WHERE $contentcontentcolumn[pageId] = '" . pnVarPrepForStore($id) . "'";  
          $page_content = DBUtil::selectObjectArray('content_content', $where2);

          // build the array for the content for the transport into Content
          if(is_array($page_content)) {
              foreach ($page_content as $wert => $value) {
                  $data = unserialize($value[data]);
                  $areaIndex = (int)$value['areaIndex'];
                  $position = (int)$value['position'];
                  
                  $content = array('id' => '',
                                   'pageId'  => $relation_id,
                                   'contentAreaIndex' => $areaIndex,
                                   'position' => $position,
                                   'addVersion' => '',
                                   'content'  =>  array('module'  => $value[module],
                                                        'type' => $value[type],
                                                        'data'  => $data,
                                                        'stylePosition' => $value[stylePosition],
                                                        'styleWidth' => $value[styleWidth],
                                                        'styleClass' => $value[styleClass],
                                                        'obj_status'  => 'A',
                                                        'cr_date'  => '',
                                                        'cr_uid'  =>  '',
                                                        'lu_date' =>  '',
                                                        'lu_uid'  =>  '',
                                                        ));                       
               
              // call newContent method of Content modul                                   
              ModUtil::apiFunc('content', 'content', 'newContent',$content); 

              } // foreach ($page_content as $wert => $value)
          } // if(is_array($page_content))
          } // for ($i=1; $i<=$number; $i++)
          
          $counter2 = $counter2 +1;
          
          // update the state of transport for the original Page
          $obj = array ('transport' => $transport);
          if(is_array($obj))
              DBUtil::updateObject ($obj,'mutransport_page', $where);
              
      	} // if($question_content)
      	else
      	{
      		return LogUtil::registerError($this->__('This page does not exist in Content anymore !')); 
      	}
      } // if (!$check)
      else  {
        return LogUtil::registerError($this->__('There is still one Page with this Permalink Url!'));                           
      }
    } // if($modul == 'content')
    
//-------------------------MODULES END-------------------------------------------------

/*
 * Here begins the new part
 * for other content management sytems
 * Maybe there will be other Systems than
 * wordpress in the future 
 */

//-------------------------START OTHER CMS---------------------------------------------

//-------------------------START WORDPRESS---------------------------------------------

    if($modul == 'wordpress') { // the param should be renamed to $cms TODO
    
        
	  $mutransportcmscontentcolumn = $pntable['mutransport_cmscontent_column'];
      $mutransportusercolumn = $pntable['mutransport_user_column'];
	  
	  $wordpress = ModUtil::getVar('MUTransport','wordpress');
      $wordpress_db = ModUtil::getVar('MUTransport','wordpress_db');		
	  $wordpress_prefix = ModUtil::getVar('MUTransport', 'wordpress_prefix');
	  $wordpress_imagepath = ModUtil::getVar('MUTransport', 'image_path2');

	  $music_delete = 1;
	  
	  // if set a prefix 
      if($wordpress_prefix != '') {
        $prefix = $wordpress_prefix . '_';
      }
      else {
        $prefix = '';
      }
      
      // tables of wordpress with prefix
      	
      $tables = $prefix . 'posts';
      $tables2 = $prefix . 'comments';
      $tables3 = $prefix . 'users';
      $tables4 = $prefix . 'options';
    
      if($wordpress == 1) {

//---------------Part For The Content ------------------------------------------------ 
  
        if($kind == 'content') {
    	 
        // Connection to the db of wordpress
        // get the upload-path in wordpress
        $query = "SELECT option_value
        		     FROM $tables4
        		     WHERE option_name = 'upload_path'";
    	    
        $path = MUTransportHelp::connectExtDB($query);
        
        // DBConnectionStack::init($wordpress_db);
        
/*        $path_sql = "SELECT option_value
        		     FROM $tables4
        		     WHERE option_name = 'upload_path'";
        $column = array('option_value');
        $ask = DBUtil::executeSQL($path_sql);
        $path = DBUtil::marshallObjects($ask, $column);*/
        
        if($path[0][option_value] != '') {
          $path = $path[0];
        }
        else {
          $path = 'wp-content/uploads';
        	
        }
    
        // ask the DB for Pages in wordpress with state 'publish'
        
        $query = "SELECT ID, post_author, post_date, post_title, post_type, post_content, post_status, post_type
    	          FROM $tables
    	          WHERE post_status = 'publish'
    	          AND ID = $id";
    	    
        $obj = MUTransportHelp::connectExtDB($query);
        
 /*       $sql = "SELECT ID, post_author, post_date, post_title, post_type, post_content, post_status, post_type
    	        FROM $tables
    	        WHERE post_status = 'publish'
    	        AND ID = '" . pnVarPrepForStore($id) . "'";
    	    
        $columns = array('ID','post_author', 'post_date', 'post_title', 'post_type','post_content','post_status','post_type');
        $question = DBUtil::executeSQL($sql);
        $obj = DBUtil::marshallObjects($question, $columns);*/
    
        if($obj) {
    
          foreach($obj as $wert => $value) {
          	
          	$content = $value[post_content];
          	
            // clearing of urls if enabled
            
          	if(ModUtil::getVar('MUTransport','wordpress_clearing') == 1) {
         
          	  // search for images
          	  if(preg_match('/<img /', $content)) {
          		
          	    // delete links for images

  			    $pattern = '#<a .*>(<img .*src=").*'.$path.'(.+".*>)</a>#';
  			
  			    // replace with

  			    $replace = '$1'.$wordpress_imagepath.'$2';
  			
  			    // check RegExp and replace

  			    $content = preg_replace($pattern, $replace, $content);
          	  }
          	  
          	  // delete links with 'attachment'
          	
              if(preg_match('/.*attachment.*/', $content)) {
          	
          	    $pattern2 = '#<a .*attachment.*>.*</a>#';            
            	
  			    // replace with

  			    $replace2 = '';
  			
  			    // check RegExp and replace

  			    $content = preg_replace($pattern2, $replace2, $content);
              }
              
              // change path for files
              
              if(preg_match('/<a .*>/', $content)) {
          	
          	    $pattern3 = '#(<a .*href=").*'.$path. '(.+".*>)#';            
            	
  			    // replace with

  			    $replace3 = '$1'.$wordpress_imagepath.'$2';
  			
  			    // check RegExp and replace

  			    $content = preg_replace($pattern3, $replace3, $content);
              }
          	}
            
            // ask wordpress_db for the username
            $query = "SELECT ID, user_login
        		     FROM $tables3
        		     WHERE ID = $value[post_author]";
    	    
            $obj2 = MUTransportHelp::connectExtDB($query);
        
/*            $sql2 = "SELECT ID, user_login
        		     FROM $tables3
        		     WHERE ID = $value[post_author]";
        		  
            $columns2 = array('ID', 'user_login');
            $question2 = DBUtil::executeSQL($sql2);
            $obj2 = DBUtil::marshallObjects($question2, $columns2);*/
            
            $poster = $obj2[0][user_login];
            
            // Connection back to Zikula
            //DBConnectionStack::init();
                        
//----------------------Transport of Pages of wordpress--------------------------------
   
          	// if the unit in wordpress is a page
          	if($value[post_type] == 'page') {
    	
            $ok1 =  MUTransportHelp::buildArrayForPagesPage($value[post_title], $content );
    
              $counterA = $counterA + 1;
              // update the state of transport for the original Page
              if ($ok1) {        
                MUTransportHelp::updateTransportCms($mutransportcmscolumn[contentid],$id);
              }
            } // if($value[post_type] == 'page')

//----------------------Transport of News of wordpress--------------------------------
            
          	// if the unit in wordpress is a post          
            if($value[post_type] == 'post') {
            	
              $ok2 = MUTransportHelp::generateInputForNews($value[post_title],$poster,'Gast' ,'', $content,0,$value[post_date] );
              
              $relation_id = MUTransportHelp::getIdFromNews('sid');
              $counterA = $counterA + 1;
              
              if ($ok2) {        
                MUTransportHelp::updateTransportCms($mutransportcmscolumn[contentid],$id);
              }              
              if((int)ModUtil::getVar('MUTransport','wordpress_ezcomments') == 1) {
              
                if($ezcomments_state == 3) {
    
                // Connection to the db of wordpress            
                // DBConnectionStack::init($wordpress_db);      
                // ask the DB for Comments in wordpress for this page
                $query = "SELECT comment_ID, comment_post_ID, comment_author, comment_date, comment_content
    	                  FROM $tables2
    	                  WHERE comment_post_ID = $value[ID]";
    	    
                $obj3 = MUTransportHelp::connectExtDB($query);              
      
/*            $sql3 = "SELECT comment_ID, comment_post_ID, comment_author, comment_date, comment_content
    	             FROM $tables2
    	             WHERE comment_post_ID = $value[ID]";
    	    
              $columns3 = array('comment_ID', 'comment_post_ID', 'comment_author','comment_date','comment_content');
              $question3 = DBUtil::executeSQL($sql3);
              $obj3 = DBUtil::marshallObjects($question3, $columns3);*/
    
              // Connection back to Zikula
              //DBConnectionStack::init();
    
                if($obj3)  {
      
                  foreach($obj3 as $wert3 => $value3) {
      	 	
      	            MUTransportHelp::generateInputForEZComments('News',$relation_id, $value3[comment_content],0, $value3[comment_author]);     	
      	
                  }
                } // if($obj3)
            }  // if($ezcomments_state == 3)
            else
            {
              return LogUtil::registerError($this->__('No transport of comments! EZComments is not active!'));            	
            }
         } // if(ModUtil::getVar('MUTransport','ezcomments') == 1)
         } //
         } // foreach($obj as $wert => $value)
    } // if($obj)
    else  {
      return LogUtil::registerError($this->__('This page does not exist in wordpress anymore !')); 
    }
      } // if ($kind == 'content')
      
//---------------Part For The Users ------------------------------------------------
      
      if($kind == 'user')  {
       
        //DBConnectionStack::init($wordpress_db);
    
        // ask the DB for Users in wordpress
        $query = "SELECT ID, user_login, user_email, user_registered
    	        FROM $tables3
    	        WHERE ID = $id";
    	    
        $obj2 = MUTransportHelp::connectExtDB($query);            

// TODO        
/*        $sql = "SELECT ID, user_login, user_email, user_registered
    	        FROM $tables3
    	        WHERE ID = '" . pnVarPrepForStore($id) . "'";
    	    
        $columns2 = array('ID', 'user_login', 'user_email', 'user_registered');
        $question2 = DBUtil::executeSQL($sql);
        $obj2 = DBUtil::marshallObjects($question2, $columns2);*/
        
        $countquestion2 = count($obj2);
    
        //DBConnectionStack::init();
        
        // get all users in Zikula
        $items = ModUtil::apiFunc('Users', 'user', 'getall');
        
        if($obj2) {
    
          foreach($obj2 as $wert2 => $value2) {
    	
          $ok1 = MUTransportHelp::generateInputForUsers($value2[user_login], $value2[user_email], $value2[user_registered], 1);
    
          if ($ok1 == true) {        
            $countera = $countera + 1;    
          }
          }
        }	
      	
      } // if($kind == 'user') 
    }// if($wordpress == 1)  
    }
    
    

//-------------------------END WORDPRESS------------------------------------------------


           
    } // foreach ($_POST as $post => $value)
  } //  if (isset($_POST['yes']))
  else  {
    return LogUtil::registerError($this->__('Sorry ! No Page selected!'));
  }
  if($modul == 'wordpress') {
  	if($kind == 'content') {
      return LogUtil::registerStatus($this->__('Done! ') . $counterA . _n(' page of wordpress transported',' pages of wordpress transported', $counterA));	
  	}
  	if($kind == 'user') {
  	  return LogUtil::registerStatus($this->__('Done! ') . $countera . _n(' user of wordpress transported',' users of wordpress transported', $countera));
  	}
  }
  else 
  {
  return LogUtil::registerStatus($this->__('Done! ') . $counter . _n(' page of Pages transported',' pages of Pages transported',$counter) .  $this->__(' and ') . $counter3 . _n(' page of News transported',' pages of News transported',$counter3) . $this->__(' and ') . $counter4 . _n(' page of PagEd transported',' pages of PagEd transported',$counter4). $this->__(' and ') . $counter5 . _n(' page of Reviews transported',' pages of Reviews transported',$counter5) . $this->__(' and ') . $counter2 . _n(' page of Content copied !',' pages of Content copied !',$counter2));
  }
}

//---------------------------------END OTHER CMS-----------------------------------------------

//------------------------------------HOOKS------------------------------------------------------------

public function NewstoContent()
{
	$relation_id = MUTransportHelp::getIdFromNews();
	
}

//------------------------------------END-OF-HOOKS------------------------------------------------------------

/**
 * get available admin panel links
 *
 * @author       Michael Ueberschaer
 * @return       array      array of admin links
 */
public function getlinks()
{
    $links = array();
    
    $dom = ZLanguage::getModuleDomain('MUTransport');

    if (SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_READ)) {
        $links[] = array('url' => ModUtil::url('MUTransport', 'admin', '', array('' => '')),
                         'text' => $this->__('Modules', $dom));
    }
    if (SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_READ)) {
        $links[] = array('url' => ModUtil::url('MUTransport', 'admin', 'view', array('ot' => 'page')),
                         'text' => $this->__('Pages', $dom));
    } 
    if (SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_READ)) {
        $links[] = array('url' => ModUtil::url('MUTransport', 'admin', 'view', array('ot' => 'cms')),
                         'text' => $this->__('CMS', $dom));
    }
    if (SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_READ)) {
        $links[] = array('url' => ModUtil::url('MUTransport', 'admin', 'view', array('ot' => 'cmscontent')),
                         'text' => $this->__('Content', $dom));
    }                    
    if (SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_READ)) {
        $links[] = array('url' => ModUtil::url('MUTransport', 'admin', 'view', array('ot' => 'user')),
                         'text' => $this->__('User', $dom)); 
    }
    if (SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_READ)) {
        $links[] = array('url' => ModUtil::url('MUTransport', 'admin', 'modifyconfig'),
                         'text' => $this->__('Settings', $dom)); 
    }  
    return $links;
}
}

