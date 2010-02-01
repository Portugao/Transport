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

    // get table infos of the modul 'modules'
    pnModDBInfoLoad('modules');
    $pntable = pnDBGetTables();
    
    // get columnname infos of the modules 'modules' and 'MUTransport'
    
    $modulescolumn = $pntable['modules_column'];
    $mutransportcolumn = $pntable['mutransport_modul_column'];

/* -------- Start of Part for Modul Pages-------------*/

    
    // get data from modul modul
    $where = "WHERE $modulescolumn[name] = '" . pnVarPrepForStore("Pages") . "'";  
    $question = DBUtil::selectObjectArray('modules', $where);
    // get data from MUTransport modul    
    $where2 = "WHERE $mutransportcolumn[name] = '" . pnVarPrepForStore("Pages") . "'";
    $question2 = DBUtil::selectObjectArray('mutransport_modul', $where2);
    
    // get state of the modul 'Pages'
    
    $status = $question[0][state];
        
    if ($status == 1)
    $status = __('not installed',$dom);
    
    if($status == 2)
    $status = __('inactive',$dom);
    
    if($status == 3)
    $status = __('active',$dom);
    
    if($status == 5)
    $status = __('update available',$dom);
    
    if(!$status)
    $status = __('not available',$dom);    
    
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
    
/* -------- End of Part for Modul Pages-------------*/
/* -------- Start of Part for Modul Content-------------*/


    
    // get data from modul modul
    $where = "WHERE $modulescolumn[name] = '" . pnVarPrepForStore("content") . "'";  
    $question = DBUtil::selectObjectArray('modules', $where);
    // get data from MUTransport modul    
    $where2 = "WHERE $mutransportcolumn[name] = '" . pnVarPrepForStore("content") . "'";
    $question2 = DBUtil::selectObjectArray('mutransport_modul', $where2);

    // get state of the modul 'content'
    
    $status = $question[0][state];
        
    if ($status == 1)
    $status = __('not installed',$dom);
    
    if($status == 2)
    $status = __('inactive',$dom);
    
    if($status == 3)
    $status = __('active',$dom);
    
    if($status == 5)
    $status = __('update available',$dom);
    
    if(!$status)
    $status = __('not available',$dom);       
    
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



    // get tables of modul Pages and modul Content
    
    pnModDBInfoLoad('pages');
    pnModDBInfoLoad('Content');
    $pntable = pnDBGetTables();
    
    // get the name and id of modul
    
    $name = FormUtil::getPassedValue('name');
    $modulid = FormUtil::getPassedValue('id');
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
    } // if ($question)
      else
      {
      return LogUtil::registerError(__('No pages in modul Content available !',$dom));
      }
    } // if ($name == 'content')

//--------------- End of Part for the modul "Content" ----------------------- 

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
    
    pnModDBInfoLoad('pages');
    pnModDBInfoLoad('Content');
    $pntable = pnDBGetTables();
    
    // get the name and id of modul
    
    $name = FormUtil::getPassedValue('name');
    $modulid = FormUtil::getPassedValue('id');
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

// take tableinfos of the modules Pages and Content
   
    pnModDBInfoLoad('content');
    pnModDBInfoLoad('pages');
    $pntable = pnDBGetTables();

    // take columns of tables
    $mutransportcolumn = $pntable['mutransport_page_column'];
    $contentpagecolumn = $pntable['content_page_column'];
    $contentcontentcolumn = $pntable['content_content_column'];    
    $pagescolumn = $pntable['pages_column'];
    $column   = $pntables['mutransport_page_column'];
    
    $number = FormUtil::getPassedValue('number');
    
    // set counter
      
    $counter = 0;
    $counter2 = 0;
     
    
    if (isset($_POST['yes'])) {
      foreach ($_POST['yes'] as $post => $value)  {
      $yes = explode(".",$value);
      $id = $yes[0];
      $modul = $yes[1];  
         
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
                        'inputType' => 'text',                  
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
  return LogUtil::registerStatus(__('Done! ', $dom) . $counter . _n(' page of Pages transported',' pages of Pages transported',$counter, $dom) . __(' and ', $dom) . $counter2 . _n(' page of Content copied !',' pages of Content copied !',$counter2, $dom));
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
/*  if (SecurityUtil::checkPermission('MUTransport::', '::', ACCESS_READ)) {
        $links[] = array('url' => pnModURL('MUTransport', 'admin', 'modifyconfig'),
                         'text' => __('Settings', $dom)); 
    } will use later*/
    return $links;
}


