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
 * This function provides a generic handling of all check requests.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */
function MUTransport_adminapi_check($args)
{
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(pnModURL('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

    $dom = ZLanguage::getModuleDomain('MUTransport');

/*------------------------Modules------------------------------------*/

    // get table infos of the modul 'modules'
    pnModDBInfoLoad('modules');
    $pntable = pnDBGetTables();
    
    
    
    // get columnname infos of the modules 'modules' and 'MUTransport'
    
    $modulescolumn = $pntable['modules_column'];
    $mutransportcolumn = $pntable['mutransport_modul_column'];
    $mutransportpagecolumn = $pntable['mutransport_page_column']; 
    
/* -------- Start of Part for Modul News-------------*/

    
    // get data from modul modul
    $where = "WHERE $modulescolumn[name] = '" . pnVarPrepForStore("News") . "'";  
    $question = DBUtil::selectObjectArray('modules', $where);
    // get data from MUTransport modul    
    $where2 = "WHERE $mutransportcolumn[name] = '" . pnVarPrepForStore("News") . "'";
    $question2 = DBUtil::selectObjectArray('mutransport_modul', $where2);
    
    // get state of the modul 'News'
    
    $status = $question[0][state];
    $id = $question2[0][modulid];
        
    if ($status == 1)
    $status = __('not installed',$dom);
    
    if($status == 2)
    $status = __('inactive',$dom);
    
    if($status == 3)
    $status = __('active',$dom);
    
    if($status == 4)
    $status = __('files failed',$dom);
    
    if($status == 5)
    $status = __('update available',$dom);
    
    if(!$status)
    $status = __('not available',$dom);    

    // if News enabled
    if(pnModGetVar('MUTransport', 'newstocontent') == 1) {
        
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
    
/* -------- End of Part for Modul News-------------*/

/* -------- Start of Part for Modul Pages-------------*/

    
    // get data from modul modul
    $where = "WHERE $modulescolumn[name] = '" . pnVarPrepForStore("Pages") . "'";  
    $question = DBUtil::selectObjectArray('modules', $where);
    // get data from MUTransport modul    
    $where2 = "WHERE $mutransportcolumn[name] = '" . pnVarPrepForStore("Pages") . "'";
    $question2 = DBUtil::selectObjectArray('mutransport_modul', $where2);
    
    // get state of the modul 'Pages'
    
    $status = $question[0][state];
    $id = $question2[0][modulid];
        
    if ($status == 1)
    $status = __('not installed',$dom);
    
    if($status == 2)
    $status = __('inactive',$dom);
    
    if($status == 3)
    $status = __('active',$dom);
    
    if($status == 4)
    $status = __('files failed',$dom);
    
    if($status == 5)
    $status = __('update available',$dom);
    
    if(!$status)
    $status = __('not available',$dom);
    
    // if Pages enabled
    if(pnModGetVar('MUTransport', 'pagestocontent') == 1) {    
    
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
    
/* -------- End of Part for Modul Pages-------------*/

/* -------- Start of Part for Modul PagEd -------------*/

    // get data from modul modul
    $where = "WHERE $modulescolumn[name] = '" . pnVarPrepForStore("PagEd") . "'";  
    $question = DBUtil::selectObjectArray('modules', $where);
    // get data from MUTransport modul    
    $where2 = "WHERE $mutransportcolumn[name] = '" . pnVarPrepForStore("PagEd") . "'";
    $question2 = DBUtil::selectObjectArray('mutransport_modul', $where2);
    
    // get state of the modul 'PagEd'
    
    $status = $question[0][state];
    $id = $question2[0][modulid];
        
    if ($status == 1)
    $status = __('not installed',$dom);
    
    if($status == 2)
    $status = __('inactive',$dom);
    
    if($status == 3)
    $status = __('active',$dom);
    
    if($status == 4)
    $status = __('files failed',$dom);
    
    if($status == 5)
    $status = __('update available',$dom);
    
    if(!$status)
    $status = __('not available',$dom);

    // if PagEd enabled    
    if(pnModGetVar('MUTransport', 'pagedtocontent') == 1) {    
    
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

/* -------- End of Part for Modul PagEd-------------*/

/* -------- Start of Part for Modul Content-------------*/


    
    // get data from modul modul
    $where = "WHERE $modulescolumn[name] = '" . pnVarPrepForStore("content") . "'";  
    $question = DBUtil::selectObjectArray('modules', $where);
    // get data from MUTransport modul    
    $where2 = "WHERE $mutransportcolumn[name] = '" . pnVarPrepForStore("content") . "'";
    $question2 = DBUtil::selectObjectArray('mutransport_modul', $where2);

    // get state of the modul 'content'
    
    $status = $question[0][state];
    $id = $question2[0][modulid];
            
    if ($status == 1)
    $status = __('not installed',$dom);
    
    if($status == 2)
    $status = __('inactive',$dom);
    
    if($status == 3)
    $status = __('active',$dom);
    
    if($status == 4)
    $status = __('files failed',$dom);
    
    if($status == 5)
    $status = __('update available',$dom);
    
    if(!$status)
    $status = __('not available',$dom);
    
    // if Content enabled    
    if(pnModGetVar('MUTransport', 'contenttocontent') == 1) {        
    
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
    

    // call view method

      return MUTransport_admin_view();

}
  
 /**
 * This function provides a generic handling of all read requests.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */
function MUTransport_adminapi_read($args)
{
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(pnModURL('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

    $dom = ZLanguage::getModuleDomain('MUTransport');

/*-------------------Modules---------------------------------------*/

    // get tables of modul News, Pages, PagEd and modul Content
  
    pnModDBInfoLoad('News');
    pnModDBInfoLoad('pages');
    pnModDBInfoLoad('PagEd');
    pnModDBInfoLoad('Content');
     
    $pntable = pnDBGetTables();
    
    // get the name and id of modul
    
    $name = FormUtil::getPassedValue('name');
    $modulid = FormUtil::getPassedValue('id');
    
//---------------Start of Part for the modul "News" -----------------------
                           
    if ($name == 'News') {
    
    $newsscolumn = $pntable['news_column'];
    $mutransportpagecolumn = $pntable['mutransport_page_column'];
    
    // ask the DB for Pages in News
    // call API Func getall of the modul News

    $items = pnModAPIFunc('News', 'user', 'getall',
                          array('startnum'     => $startnum,
                                'numitems'     => $itemsperpage,
                                'status'       => 0,
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
      return LogUtil::registerStatus(__('Done! ',$dom) .$countresult1 ._n(' page of Module News add to MUTransport ',' pages of Module News add to MUTransport ',$countresult1,$dom). __(' and ', $dom) . $countresult2 . _n(' page of Module News in MUTransport updated ',' pages of Module News in MUTransport updated ',$countresult2,$dom));         
    } // if ($countquestion > 0)
    else
    { 
      return LogUtil::registerError(__('No pages in Module News available !',$dom));
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
      return LogUtil::registerStatus(__('Done! ',$dom) .$countresult1 ._n(' page of Module Pages add to MUTransport ',' pages of Module Pages add to MUTransport ',$countresult1,$dom). __(' and ', $dom) . $countresult2 . _n(' page of Module Pages in MUTransport updated ',' pages of Module Pages in MUTransport updated ',$countresult2,$dom));         
    } // if ($countquestion > 0)
    else
    { 
      return LogUtil::registerError(__('No pages in Module Pages available !',$dom));
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
    $subtext = __('Attention ! There is no content for this page !',$dom);
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
      return LogUtil::registerStatus(__('Done! ',$dom) .$countresult1 . _n(' page of Module PagEd add to MUTransport ',' pages of Module PagEd add to MUTransport ',$countresult1,$dom). __(' and ', $dom) . $countresult2 . _n(' page of Module PagEd in MUTransport updated ',' pages of Module PagEd in MUTransport updated ',$countresult2,$dom));  
    } // if ($countquestion) > 0
      else
      {
      return LogUtil::registerError(__('No pages in modul PagEd available !',$dom));
      }
    } // if ($name == 'PagEd')


//--------------- End of Part for the modul "PagEd" -----------------------

//--------------- Start of Part for the modul "Content" -----------------------

    if ($name == 'content') {
    
    pnModDBInfoLoad('content');
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
    $subtext = __('Attention ! There is no content for this page !',$dom);
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
      return LogUtil::registerStatus(__('Done! ',$dom) .$countresult1 . _n(' page of Module Content add to MUTransport ',' pages of Module Content add to MUTransport ',$countresult1,$dom). __(' and ', $dom) . $countresult2 . _n(' page of Module Content in MUTransport updated ',' pages of Module Content in MUTransport updated ',$countresult2,$dom));  
    } // if ($countquestion) > 0
      else
      {
      return LogUtil::registerError(__('No pages in modul Content available !',$dom));
      }
    } // if ($name == 'content')

//--------------- End of Part for the modul "Content" ----------------------- 

/*----------------------Other CMS-------------------------------------*/
    if ($wordpress == 1)  {    
    
    DBConnectionStack::init('wordpress');
    $tablename = getLimitedTablename($tablename);
    
    $result = DBUtil::selectObjectCount($tablename);    
    
    DBConnectionStack::init();
 }
 }

 /**
 * This function provides a generic handling of all delete requests.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */
function MUTransport_adminapi_delete($args)
{
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(pnModURL('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

    $dom = ZLanguage::getModuleDomain('MUTransport');



    // take tables of modul Pages and modul Content
    
    pnModDBInfoLoad('News');    
    pnModDBInfoLoad('pages');
    pnModDBInfoLoad('PagEd');    
    pnModDBInfoLoad('Content');
    $pntable = pnDBGetTables();
    
    // get the name and id of modul
    
    $name = FormUtil::getPassedValue('name');
    $modulid = FormUtil::getPassedValue('id');
    
 //---------------Start of Part for the modul "News" -----------------------

    if ($name == 'News') {    
        $pagescolumn = $pntable['news_column'];
        $mutransportpagecolumn = $pntable['mutransport_page_column'];
    
        // ask the DB for Pages in Pages

        $question = DBUtil::selectObjectArray('news');
        $countquestion = count($question);
        // ask the DB for existing Pages of Pages in MUTransport
    
        $where = "WHERE $mutransportpagecolumn[modulid] = '" . pnVarPrepForStore($modulid) . "'";
        $search = DBUtil::selectObjectArray('mutransport_page', $where);
        $countsearch = count($search);
        
        $diff = $countsearch - $countquestion;
        
        // put the pageid's of existing Pages in Pages in an array
        $question_id = array();
        foreach ($question as $wert => $value)  {
        $question_id[] = $value['sid'];
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
            return LogUtil::registerError(__('There is no page to delete !',$dom));
          } 
        } // if($countsearch > 0)
        else  {
          return LogUtil::registerError(__('There are no Pages of module News in Modul MUTransport available !',$dom));
        }
    if($diff > 0) 
    return LogUtil::registerStatus(__('Done! ',$dom) . $diff . _n(' page of News in MUTransport deleted !',' pages of News in MUTransport deleted !',$diff, $dom));
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
            return LogUtil::registerError(__('There is no page to delete !',$dom));
          } 
        } // if($countsearch > 0)
        else  {
          return LogUtil::registerError(__('There are no Pages of module Pages in Modul MUTransport available !',$dom));
        }
    if($diff > 0) 
    return LogUtil::registerStatus(__('Done! ',$dom) . $diff . _n(' page of Pages in MUTransport deleted !',' pages of Pages in MUTransport deleted !',$diff, $dom));
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
            return LogUtil::registerError(__('There is no page to delete !',$dom));
          } 
        } // if($countsearch > 0)
        else  {
          return LogUtil::registerError(__('There are no Pages of module PagEd in Modul MUTransport available !',$dom));
        }
    if($diff > 0) 
    return LogUtil::registerStatus(__('Done! ',$dom) . $diff . _n(' page of PagEd in MUTransport deleted !',' pages of PagEd in MUTransport deleted !',$diff, $dom));
    } // if ($name == 'PagEd')
//--------------- End of Part for the modul "PagEd" -----------------------

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
            return LogUtil::registerError(__('There is no page to delete !',$dom));
          }       
        } // if($countsearch > 0)
        else  {
          return LogUtil::registerError(__('There are no Pages of module Content in Modul MUTransport available !',$dom));
        }
    if($diff > 0)
    return LogUtil::registerStatus(__('Done! ',$dom) . $diff . _n(' page of Content in MUTransport deleted !',' pages of Content in MUTransport deleted !',$diff, $dom));
    } // if ($name == 'content')
    
//--------------- End of Part for the modul "Content" ----------------------- 
    

 }
 
 /**
 * This function provides a generic handling of all transport requests.
 *
 * @author       Michael Ueberschaer
 * @params       TODO
 * @return       Render output
 */

 function MUTransport_adminapi_transport($args)
{
// DEBUG: permission check aspect starts
    if (!SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError(pnModURL('MUTransport', 'user', 'main'));
    }
// DEBUG: permission check aspect ends

    $dom = ZLanguage::getModuleDomain('MUTransport'); 

// take tableinfos of the modules News, PagEd, Pages and Content

    pnModDBInfoLoad('News');   
    pnModDBInfoLoad('PagEd'); 
    pnModDBInfoLoad('pages');
    pnModDBInfoLoad('content');
    $pntable = pnDBGetTables();

    // take columns of tables
    $mutransportcolumn = $pntable['mutransport_page_column'];
    $contentpagecolumn = $pntable['content_page_column'];
    $contentcontentcolumn = $pntable['content_content_column'];
    $newscolumn = $pntable['news_column'];    
    $pagescolumn = $pntable['pages_column'];
    $column   = $pntables['mutransport_page_column'];
    
    $number = FormUtil::getPassedValue('number');
    
    // set counter
      
    $counter = 0; // counter for Pages of Pages
    $counter2 = 0; // counter for Pages of Content
    $counter3 = 0; // counter for Pages of News
    $counter4 = 0; // counter for Pages of PagEd
    
    // get format for transport
    $format = pnModGetVar('MUTransport', 'text_format');
     
    
    if (isset($_POST['yes'])) {
      foreach ($_POST['yes'] as $post => $value)  {
      $yes = explode(".",$value);
      $id = $yes[0];
      $modul = $yes[1]; 
      
      
/*-------------------------------MODUL NEWS-------------------------------*/

/* -------------         Transport to Content      ------------------------*/
    
    if ($modul == 'News') {
    
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
        /*    $controlstring = '<table>';
        $contentcontrol = stripos ($value['content'], $controlstring );
        if ($contentcontrol === false)  { */ 
           
        $page = array('page'  =>  array('title' => $question_page['title'],
                                    'urlname' => '',
                                    'layout' => 'column1',
                                    'categoryId' => '',

                                    ),
                      'pageId'  => '',
                      'location' => '',);
    
        $ok1 = pnModAPIFunc('content', 'page', 'newPage',$page);
        $counter3 = $counter3 + 1;
        // update the state of transport for the original Page
        if ($ok1) {
        $where = "WHERE $mutransportcolumn[pageid] = '" . pnVarPrepForStore($id) . "'";
        $old = DBUtil::selectObject('mutransport_page', $where);
        $transport = $old[transport];
        $transport = $transport + 1;
        $obj = array ('transport' => $transport);
        DBUtil::updateObject ($obj,'mutransport_page', $where);
 
        } 
         
        // prepare the content    
        // get the page_id of the even inserted Page
    
        $field = 'page_id';
        $relation_id = DBUtil::getInsertID('content_page', $field);

        // build the array for the content for the transport into Content
        
        // first put hometext and bodytext to one text
        // if bodytext not empty
        
        if($question_page[bodytext] != '')
        $newstext = $question_page[hometext] . '<br /><br/>' . $question_page[bodytext];
        else
        $newstext = $question_page[hometext];
                                             
        $data = array (
                        'text' => $newstext,
                        'inputType' => $format,                  
                      );                              
    
        $content = array( 'id' => '',
                          'pageId'  => $relation_id,
                          'contentAreaIndex' => '',
                          'position' => '',
                          'addVersion' => '',
                          'content'  =>  array('module'  => 'content',
                                               'type' => 'html',
                                               'data'  => $data,
                                               'stylePosition' => 'none',
                                               'styleWidth' => 'wauto',
                                               'styleClass' => '',
                                               'obj_status'  => 'A',
                                               'cr_date'  => '',
                                               'cr_uid'  =>  '',
                                               'lu_date' =>  '',
                                               'lu_uid'  =>  '',
                                              )); 
                                    
        // call newContent method of Content modul                                   
        pnModAPIFunc('content', 'content', 'newContent',$content);
       
        /*      }
        else if ($contentcontrol !== false and $_POST['parts'] > 1) 
       {
        $warning  = __('Attention! The Content of this Page contains a html Table. It is not partable !', $dom);
        return $warning;
       }  */

    } // if (!$check)
    else
    {
      return LogUtil::registerError(__('There is still one Page with this Permalink Url!', $dom));                           
    }                
    } //  if ($modul == 'News') 


/*-------------------------------MODUL PAGED-------------------------------*/

/* -------------         Transport to Content      ------------------------*/

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
      $sql = "SELECT page_id, title, ingress FROM $pagedtitles WHERE page_id = '" . pnVarPrepForStore($id) . "'";
      $columns = array('page_id', 'title', 'ingress');
      $question = DBUtil::executeSQL($sql);
      $question_page = DBUtil::marshallObjects($question, $columns);
      $count_question_page = count($question_page);
      
      // prepare the selected page from modul paged for transport to modul content
      // if there is a page in PagEd
      
      foreach($question_page as $wert => $value) {
      $where = "WHERE $contentpagecolumn[title] = '" . pnVarPrepForStore($value['title']) . "'";
      $check = DBUtil::selectObject('content_page', $where);
      
      // prepare the page
    
      if (!$check)  {  
        /*    $controlstring = '<table>';
        $contentcontrol = stripos ($value['content'], $controlstring );
        if ($contentcontrol === false)  { */ 
           
        $page = array('page'  =>  array('title' => $value['title'],
                                    'urlname' => '',
                                    'layout' => 'column1',
                                    'categoryId' => '',

                                    ),
                      'pageId'  => '',
                      'location' => '',);
    
        $ok1 = pnModAPIFunc('content', 'page', 'newPage',$page);
        $counter4 = $counter4 + 1;
        // update the state of transport for the original Page
        if ($ok1) {
        $where = "WHERE $mutransportcolumn[pageid] = '" . pnVarPrepForStore($id) . "'";
        $old = DBUtil::selectObject('mutransport_page', $where);
        $transport = $old[transport];
        $transport = $transport + 1;
        $obj = array ('transport' => $transport);
        DBUtil::updateObject ($obj,'mutransport_page', $where);
 
        }
        
        // prepare the content    
        // get the page_id of the even inserted Page
    
        $field = 'page_id';
        $relation_id = DBUtil::getInsertID('content_page', $field);
        

        
        // take the content for the page
        
        $sql2 = "SELECT page_id, section, subtitle, image, imagetext, text FROM $pagedcontent WHERE page_id = '" . pnVarPrepForStore($id) . "' ORDER BY section DESC";
        $columns2 = array('page_id', 'section', 'subtitle', 'image', 'imagetext', 'text');
        $question2 = DBUtil::executeSQL($sql2);
        $question_content = DBUtil::marshallObjects($question2, $columns2);
        
        // build the array for the content for the transport into Content
        // 
        
        
        foreach($question_content as $wert2 => $value2) {
        
        if(pnModGetVar('MUTransport', 'image_path') != '') {
        if($value2[image] != '') {
        $image_path = pnModGetVar('MUTransport', 'image_path');
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
                                                       
        $data = array (
                        'text' => $text,
                        'inputType' => $format,                  
                      );                              
    
        $content = array( 'id' => '',
                          'pageId'  => $relation_id,
                          'contentAreaIndex' => '',
                          'position' => '',
                          'addVersion' => '',
                          'content'  =>  array('module'  => 'content',
                                               'type' => 'html',
                                               'data'  => $data,
                                               'stylePosition' => 'none',
                                               'styleWidth' => 'wauto',
                                               'styleClass' => '',
                                               'obj_status'  => 'A',
                                               'cr_date'  => '',
                                               'cr_uid'  =>  '',
                                               'lu_date' =>  '',
                                               'lu_uid'  =>  '',
                                              )); 
                                    
        // call newContent method of Content modul                                   
        pnModAPIFunc('content', 'content', 'newContent',$content);
        
        if($value2[subtitle] != '') {
        $data = array (
                        'text' => $value2[subtitle],
                        'inputType' => 'text',                  
                      );                              
    
        $content = array( 'id' => '',
                          'pageId'  => $relation_id,
                          'contentAreaIndex' => '',
                          'position' => '0',
                          'addVersion' => '',
                          'content'  =>  array('module'  => 'content',
                                               'type' => 'heading',
                                               'data'  => $data,
                                               'stylePosition' => 'none',
                                               'styleWidth' => 'wauto',
                                               'styleClass' => '',
                                               'obj_status'  => 'A',
                                               'cr_date'  => '',
                                               'cr_uid'  =>  '',
                                               'lu_date' =>  '',
                                               'lu_uid'  =>  '',
                                              ));           
          // call newContent method of Content modul                                   
          pnModAPIFunc('content', 'content', 'newContent',$content);        
        }
        
        }

        //         
        
        if($value[ingress] != '') {
        $data = array (
                        'text' => $value[ingress],
                        'inputType' => 'text',                  
                      );                              
    
        $content = array( 'id' => '',
                          'pageId'  => $relation_id,
                          'contentAreaIndex' => '',
                          'position' => '0',
                          'addVersion' => '',
                          'content'  =>  array('module'  => 'content',
                                               'type' => 'heading',
                                               'data'  => $data,
                                               'stylePosition' => 'none',
                                               'styleWidth' => 'wauto',
                                               'styleClass' => '',
                                               'obj_status'  => 'A',
                                               'cr_date'  => '',
                                               'cr_uid'  =>  '',
                                               'lu_date' =>  '',
                                               'lu_uid'  =>  '',
                                              ));           
          // call newContent method of Content modul                                   
          pnModAPIFunc('content', 'content', 'newContent',$content);        
        }
        
        /*      }
        else if ($contentcontrol !== false and $_POST['parts'] > 1) 
       {
        $warning  = __('Attention! The Content of this Page contains a html Table. It is not partable !', $dom);
        return $warning;
       }  */

    } // if (!$check)
    
    else
    {
      return LogUtil::registerError(__('There is still one Page with this Permalink Url!', $dom));                           
    }
    }      
    } // if ($modul == 'PagEd')

         
/*-------------------------------MODUL PAGES-------------------------------*/

/* -------------         Transport to Content      ------------------------*/
    
    if ($modul == 'Pages') {
    
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
        /*    $controlstring = '<table>';
        $contentcontrol = stripos ($value['content'], $controlstring );
        if ($contentcontrol === false)  { */ 
           
        $page = array('page'  =>  array('title' => $question_page['title'],
                                    'urlname' => '',
                                    'layout' => 'column1',
                                    'categoryId' => '',

                                    ),
                      'pageId'  => '',
                      'location' => '',);
    
        $ok1 = pnModAPIFunc('content', 'page', 'newPage',$page);
        $counter = $counter + 1;
        // update the state of transport for the original Page
        if ($ok1) {
        $where = "WHERE $mutransportcolumn[pageid] = '" . pnVarPrepForStore($id) . "'";
        $old = DBUtil::selectObject('mutransport_page', $where);
        $transport = $old[transport];
        $transport = $transport + 1;
        $obj = array ('transport' => $transport);
        DBUtil::updateObject ($obj,'mutransport_page', $where);
 
        } 
         
        // prepare the content    
        // get the page_id of the even inserted Page
    
        $field = 'page_id';
        $relation_id = DBUtil::getInsertID('content_page', $field);

        // build the array for the content for the transport into Content
                                               
        $data = array (
                        'text' => $question_page[content],
                        'inputType' => $format,                  
                      );                              
    
        $content = array( 'id' => '',
                          'pageId'  => $relation_id,
                          'contentAreaIndex' => '',
                          'position' => '',
                          'addVersion' => '',
                          'content'  =>  array('module'  => 'content',
                                               'type' => 'html',
                                               'data'  => $data,
                                               'stylePosition' => 'none',
                                               'styleWidth' => 'wauto',
                                               'styleClass' => '',
                                               'obj_status'  => 'A',
                                               'cr_date'  => '',
                                               'cr_uid'  =>  '',
                                               'lu_date' =>  '',
                                               'lu_uid'  =>  '',
                                              )); 
                                    
        // call newContent method of Content modul                                   
        pnModAPIFunc('content', 'content', 'newContent',$content);
       
        /*      }
        else if ($contentcontrol !== false and $_POST['parts'] > 1) 
       {
        $warning  = __('Attention! The Content of this Page contains a html Table. It is not partable !', $dom);
        return $warning;
       }  */

    } // if if (!$check)
    else
    {
      return LogUtil::registerError(__('There is still one Page with this Permalink Url!', $dom));                           
    }                
    } //  if ($modul == 'Pages')
        
/*-------------------------------COPY Pages in MODUL CONTENT-------------------------------*/
      
    // prepare the selected pages from modul Content for transport to modul Content
    // if there is a page in Content
    if($modul == 'content') {

    
      $where = "WHERE $contentpagecolumn[id] = '" . pnVarPrepForStore($id) . "'";     
      $question_content= DBUtil::selectObject('content_page', $where);
          
      $copy = __(' (A copy)',$dom);
      $title = $question_content[title];
      $title = $title . $copy;
    
      $where = "WHERE $contentpagecolumn[title] = '" . pnVarPrepForStore($title) . "'";
      $check = DBUtil::selectObject('content_page', $where);
            
      // start to copy
      if(!$check) {
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
    
              $ok1 = pnModAPIFunc('content', 'page', 'newPage',$page);
              $title = $title . $copy;
    
              // count the copies    
              if ($ok1)     
                  $transport = $transport + 1; 

          // take the content for the even copied page    
          // get the page_id of the even inserted Page
    
          $field = 'page_id';
          $relation_id = DBUtil::getInsertID('content_page', $field);
    
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
              pnModAPIFunc('content', 'content', 'newContent',$content); 

              } // foreach ($page_content as $wert => $value)
          } // if(is_array($page_content))
          } // for ($i=1; $i<=$number; $i++)
          
          $counter2 = $counter2 +1;
          
          // update the state of transport for the original Page
          $obj = array ('transport' => $transport);
          if(is_array($obj))
              DBUtil::updateObject ($obj,'mutransport_page', $where);
  
      } // if (!$check)
      else  {
        return LogUtil::registerError(__('There is still one Page with this Permalink Url!', $dom));                           
      }
    } // if($modul == 'content')
           
    } // foreach ($_POST as $post => $value)
  } //  if (isset($_POST['yes']))
  else  {
    return LogUtil::registerError(__('Sorry ! No Page selected!', $dom));
  } 
  return LogUtil::registerStatus(__('Done! ', $dom) . $counter . _n(' page of Pages transported',' pages of Pages transported',$counter, $dom) .  __(' and ', $dom) . $counter3 . _n(' page of News transported',' pages of News transported',$counter3, $dom) . __(' and ', $dom) . $counter4 . _n(' page of PagEd transported',' pages of PagEd transported',$counter4, $dom) . __(' and ', $dom) . $counter2 . _n(' page of Content copied !',' pages of Content copied !',$counter2, $dom) );
}


/**
 * get available admin panel links
 *
 * @author       Michael Ueberschaer
 * @return       array      array of admin links
 */
function MUTransport_adminapi_getlinks()
{
    $links = array();
    
    $dom = ZLanguage::getModuleDomain('MUTransport');

    if (SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_READ)) {
        $links[] = array('url' => pnModURL('MUTransport', 'admin', '', array('' => '')),
                         'text' => __('Modules', $dom));
    }
    if (SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_READ)) {
        $links[] = array('url' => pnModURL('MUTransport', 'admin', 'view', array('ot' => 'page')),
                         'text' => __('Pages', $dom));
    } 
/*    if (SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_READ)) {
        $links[] = array('url' => pnModURL('MUTransport', 'admin', 'view', array('ot' => 'cms')),
                         'text' => __('CMS', $dom));
    }  will use later*/                   
  if (SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_READ)) {
        $links[] = array('url' => pnModURL('MUTransport', 'admin', 'modifyconfig'),
                         'text' => __('Settings', $dom)); 
    } 
    return $links;
}


