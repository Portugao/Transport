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
 * This function is for calculate the number of transports and update it
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
    
    
/*--------------FUNCTIONS FOR TRANSPORT TO CONTENT OF OTHER MODULES THAN CONTENT--------*/    
/**
 *  This function is for build the array
 *  for the page and put it into the db
 *   
 *  @param $title           the old and new title 
 *
 */
     function buildArrayForPage($title) {
 
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
 * @param $title                 the right column for the title
 * @param $action                the action that is wished
 * @param $result                the sesult of the select
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
}          
