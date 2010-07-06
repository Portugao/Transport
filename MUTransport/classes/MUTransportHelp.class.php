<?php
/**
 * PostNuke Application Framework
 *
 * @copyright (c) 2010, PostNuke Development Team
 * @link http://www.postnuke.com
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 * @package PostNuke_Generated_Modules
 * @subpackage MUTransport
 * @author Michael Ueberschaer
 * @url mu-t-beratung.de
 */

/**
 * This class is for perform the transport
 */
class MUTransportHelp
{
	
/**
 * This function is for get the state of the needed module
 * 
 *@param $module          the relevant module
 *return $status
 */ 
 
    function getState($module) { 
    	
    $dom = ZLanguage::getModuleDomain('MUTransport');
    	
    // get table infos of the module 'modules'
    pnModDBInfoLoad('modules');
    $pntable = pnDBGetTables();
     
    // get columnname infos of the modules 'modules' and 'MUTransport'
    
    $modulescolumn = $pntable['modules_column'];
    $mutransportcolumn = $pntable['mutransport_modul_column'];
    $mutransportpagecolumn = $pntable['mutransport_page_column'];  
	
    // get data from module modules
    $where = "WHERE $modulescolumn[name] = '" . pnVarPrepForStore($module) . "'";  
    $question = DBUtil::selectObjectArray('modules', $where);
    
    // get state of the needed module
    
    $status = $question[0][state];
        
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
    
    return $status;
    
    }

/**
 * This function is for get the id of the last page in content
 * 
 *@param $field           the relevant field as id
 *return $relation
 */                       
    
    function getIdFromContent($field) {
      $relation = DBUtil::selectFieldMax('content_page', $field);
      return $relation;
    }
    
/**
 * This function is for get the id of the last page in News
 * 
 *@param $field           the relevant field as id
 *return $relation
 */                       
    
    function getIdFromNews($field) {
      $relation = DBUtil::selectFieldMax('news', $field);
      return $relation;
    }
    
/**
 * This function is for get the id of the last page in Pages
 * 
 *@param $field           the relevant field as id
 *return $relation
 */                       
    
    function getIdFromPages($field) {
      $relation = DBUtil::selectFieldMax('pages', $field);
      return $relation;
    }
    
/**
 * This function is for calculate 
 * the number of transports for 
 * modules and update it
 * 
 * @param $column          the column for update
 * @param $id              the id of the transported page  
 */   
      
    function updateTransport($column, $id) {
    
      $where = "WHERE $column = '" . pnVarPrepForStore($id) . "'";
      $old = DBUtil::selectObject('mutransport_page', $where);
      $transport = $old[transport];
      $transport = $transport + 1;
      $obj = array ('transport' => $transport); 
      DBUtil::updateObject ($obj,'mutransport_page', $where);
    }
    
/**
 * This function is for calculate
 * the number of transports for CMS
 * and update it
 * 
 * @param $column          the column for update
 * @param $id              the id of the transported page  
 */   
      
    function updateTransportCms($column, $id) {
    
      $where = "WHERE $column = '" . pnVarPrepForStore($id) . "'";
      $old = DBUtil::selectObject('mutransport_cmscontent', $where);
      $transport = $old[transport];
      $transport = $transport + 1;
      $obj = array ('transport' => $transport); 
      DBUtil::updateObject ($obj,'mutransport_cmscontent', $where);
    }
    
    
/*-------------FUNCTIONS FOR TRANSPORT TO PAGES OF OTHER MODULES OR CMS-----------------*/

/**
 * This function is for build the array
 * for the page and put it into the db
 * 
 * @param $title				the result for the title
 * @param $content				the result for the content
 */ 
    function buildArrayForPagesPage($title, $content) {
    	
      $page = array('title'				=> $title,
      				'content'			=> $content,
      				'language'			=> '',
      				'displaywrapper' 	=> 0,
      				'displaytitle'		=> 1,
      				'displaycreated'	=> 0,
      				'displayupdated'	=> 0,
      				'displaytextinfo'	=> 0,
      				'displayprint'		=> 0
      				);
      
      pnModApiFunc('Pages', 'Admin','create', $page);
      return true;	
    	
    }
    
/*--------------FUNCTIONS FOR TRANSPORT TO CONTENT OF OTHER MODULES THAN CONTENT--------*/
    
/**
 *  This function is for build the array
 *  for the page and put it into the db
 *   
 *  @param $title           the old and new title 
 *
 */
     function buildArrayForContentPage($title) {
 
      $page = array('page'  =>  array('title' => $title,
                                    'urlname' => '',
                                     'layout' => 'column1',
                                 'categoryId' => '',

                                    ),
                      'pageId'  => '',
                      'location' => '',);
    
      pnModAPIFunc('content', 'page', 'newPage',$page);
      return true;
      }   

/**
 *  This function is for build the array
 *  for the content and put it into the db
 *  
 *@param $text              the found text
 *@param $format            the format for transport of text, 'text' or 'html'
 *@param $relation_id       the last id in content
 *@param $type              the input type. 'html' or 'heading'   
 *   
 */
    
    function buildArrayForContent($text, $format, $relation_id, $type ) {
    
        $data = array (
                        'text' => $text,
                        'inputType' => $format,                  
                      );                              
    
        $content = array( 'id' => '',
                          'pageId'  => $relation_id,
                          'contentAreaIndex' => '',
                          'position' => '0',
                          'addVersion' => '',
                          'content'  =>  array('module'  => 'content',
                                               'type' => $type,
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

/*----------------FUNCTIONS FOR NEWS MODULE-------------------------------------*/
    
/**
 * This function is for generate the input to news and put it into db
 * 
 * @param $title                 the correct column for the title
 * @param $action                the action that is wished
 * @param $result                the result of the select
 * @param $count                 the number of the content-items    
 * @return true      
 */
 
   function generateInputForNews($title, $header, $result, $count, $action) {
   
   $args['title'] = $title;
   $args['hometextcontenttype'] = 1;
   $args['bodytextcontenttype'] = 1;
   $args['notes'] = '';
   $args['action'] = $action;
   $args['format_type'] = '';
   $args['hideonindex'] = 0;
   $args['disallowcomments'] = 0;
   $args['hometext'] = '';
   $args['bodytext'] = '';      
       
   $text2 = '';
            
   foreach($result as $wert2 => $value2) {
        
   // ckeck the image path, if not empty check for image
   // else do nothing and take only the text
        
     if(pnModGetVar('MUTransport', 'image_path') != '') {
        
     // if there is an image build the image path and html code
     // and put before the text
     // else do nothing with the existing text        
        
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
        
      if($header != '' && $wert2 == 0) {
        $text = '<h3>'. $header . '</h3>' . $text;
      }
        
      if($value2[subtitle] != '') {
        $text = '<h3>'. $value2[subtitle] . '</h3>' . $text;
      }
              

      if($count == 1) {
        $args['hometext'] = $text;
        $args['bodytext'] = '';
      }

      if($count > 1) {
        if($wert2 == 0) {
          $text2 = $text2 . $text . '<br /><br />';
          $args['hometext'] = $text2;
          $text2 = '';
        }
        if($wert2 > 0) {
          $text2 = $text2 . $text . '<br /><br />';    
          $args['bodytext'] = $text2;
        }               
      }
    }
    // call create method of News modul        
    pnModApiFunc('News', 'user', 'create', $args);        
    return true; 
    }
        
/*----------------FUNCTIONS FOR EZCOMMENTS MODULE-------------------------------------*/

/**
* This function is for generate the input
* to ezcomments and put it into db
* 
* @param $mod					the module for that the comment is
* @param $pageid				the page for that the comment is
* @param $comment				the comment content
* @param $uid					the id of the user, who submitted the comment, optional
* @param $owneruid				unclear, but must be 0
 */
 
   function generateInputForEZComments($mod,$pageid, $comment, $uid, $owneruid ) {
   	
   	$args = array('mod'			=> $mod,
   			      'objectid'	=> $pageid,
   			      'comment'		=> $comment,
   			      'owneruid'	=> $owneruid,
   			      'uid'			=> $uid);
   			      
    // call create method of module EZComments        
    pnModApiFunc('EZComments', 'user', 'create', $args);        
    return true; 
   			      
   }
   
/*----------------------FUNCTIONS FOR OTHER CMS------------------------------*/

/**
 * This function is for get the id of the last User in module Users
 * 
 *@param $field           the relevant field as id
 *return $relation
 */                       
    
    function getIdFromUsers($field) {
      $relation = DBUtil::selectFieldMax('users', $field);
      return $relation;
    }

/**
 *  This function is for generate the input to the user module
 *  and put it into the DB
 * @param $uname			the 
 */ 
 
    function generateInputForUsers($uname, $email, $registered) {
    	
    // get length of the password
    $length = pnModGetVar('Users','minpass' );	
    
    // password generating
    // letters and numbers in an array
    
    $letters_small = array (a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z);
    $letters_big = array (A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,T,U,V,W,X,Y,Z);
    $numbers = array (0,1,2,3,4,5,6,7,8,9);
    $input = '';
    
    // generate password
    for( $i=0; $i < $length; $i++) {
    
    $select = mt_rand(1,3);
    
    switch($select) {
    
      case 1:
        $input = $input . array_rand($letters_small);
        break;        
      case 2:
        $input = $input . array_rand($letters_big);
        break;    
      case 3:
        $input = $input . array_rand($numbers);
        break;
    }
    }
    
    $method = pnModGetVar('Users', 'hash_method');	
    $pass = DataUtil::hash($input, $method);
    
    // if username must be in lowercase
    if(pnModGetVar('Users', 'lowercaseuname') == 1) {
    	
      $uname = strtolower($uname);
    }
    	
    $user = array (
    	
    	  'uid'				=> '',
    	  'uname'			=> $uname,
    	  'email'			=> $email,
    	  'user_regdate'	=> $registered,
    	  'user_vieweamil'	=> 0,
    	  'user_theme'		=> 0,
    	  'pass'			=> $pass,
    	  'storynum'		=> 0,
    	  'ublockon'		=> 0,
    	  'ublock'			=> '',
    	  'theme'			=> '',
    	  'counter'			=> 0,
    	  'activated'		=> 1,
    	  'lastlogin'		=> '',
    	  'validfrom'		=> '',
    	  'validuntil'		=> '',
    	  'hashmethod'		=> $method,    	  
    	  );
    	  
    DBUtil::insertObject($user,'users', 'uid');
    	   	
    }    
}          
