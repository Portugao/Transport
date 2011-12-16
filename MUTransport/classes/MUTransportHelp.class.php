<?php
/**
 * Zikula Application Framework
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
 * This class is a helper class for recoming jobs for performing the transport
 */
class MUTransportHelp
{

    /*----------------------FUNCTIONS FOR MODULES IN ZIKULA-----------------------------*/

    // For performing transports only if the needed module are active is for avoid faults in the DB

    /**
     * This function will check the module when the user  has started a transport
     * Return the state of a module which is necessary as target module
     *
     * @param module    The module to check
     *
     * @return The resulting state
     */
    public function getStateOfModule($module)
    {
        $pntables = DBUtil::getTables();
        $moduletable = $pntables['modules'];
        $modulecolumn = $pntables['modules_column'];

        $columns = array('state');
        $where = "$modulecolumn[name] = '" . DataUtil::formatForStore($module) . "'";
        $state = DBUtil::selectObjectArray('modules', $where);
        return $state;
    }

    /**
     * This function is reading in the states of modules for the module view
     * This function is for get the state of the needed module
     *
     *@param module $module          the relevant module
     *@param kind   $kind			 kind of result, 1 result of state as string
     *												 2 result of stae as number 	
     *return $status
     */

    public function getState($module, $kind = 1)
    {

        $dom = ZLanguage::getModuleDomain('MUTransport');

        // get table infos of the module 'modules'
        ModUtil::dbInfoLoad('modules');
        $pntable = DBUtil::getTables();

        // get columnname infos of the modules 'modules' and 'MUTransport'

        $modulescolumn = $pntable['modules_column'];
        $mutransportcolumn = $pntable['mutransport_modul_column'];
        $mutransportpagecolumn = $pntable['mutransport_page_column'];

        // get data from module modules
        $where = "WHERE $modulescolumn[name] = '" . DataUtil::formatForStore($module) . "'";
        $question = DBUtil::selectObjectArray('modules', $where);

        // get state of the needed module
        if (isset($question[0])) {
            $status = $question[0]['state'];
        } 
        else {
        	if ($kind == 1)
            	$status = $this->__('not available');
            else {
            	$status = '';
            }
        }
        
        if ($kind == 1) {

        if ($status == 1)
            $status = $this->__('not installed');

        if ($status == 2)
            $status = $this->__('inactive');

        if ($status == 3)
            $status = $this->__('active');

        if ($status == 4)
            $status = $this->__('files failed');

        if ($status == 5)
            $status = $this->__('update available');
        }

        return $status;

    }

    /*----------------THE FOLLOWING METHODS ARE FOR GETTING THE LAST ID IN A MODULE------------*/

    /**
     * This function is for get the id of the last page in content
     *
     *@param $field           the relevant field as id
     *return $relation
     */

    function getIdFromContent($field)
    {
        $relation = DBUtil::selectFieldMax('content_page', $field);
        return $relation;
    }

    /**
     * This function is for get the id of the last page in News
     *
     *@param $field           the relevant field as id
     *return $relation
     */

    function getIdFromNews($field)
    {
        $relation = DBUtil::selectFieldMax('news', $field);
        return $relation;
    }

    /**
     * This function is for get the id of the last page in Pages
     *
     *@param $field           the relevant field as id
     *return $relation
     */

    function getIdFromPages($field)
    {
        $relation = DBUtil::selectFieldMax('pages', $field);
        return $relation;
    }

    /**
     * This function is for get the id of the last page in Reviews
     *
     *@param $field           the relevant field as id
     *return $relation
     */

    function getIdFromReviews($field)
    {
        $relation = DBUtil::selectFieldMax('reviews', $field);
        return $relation;
    }

    /*-------------------FOR UPDATING THE COUNTERS IN THE VIEW OF PAGES, CONTENT
     * ------------------ OR USERS IN ZIKULA OR OTHER CMS-----------------------*/

    /**
     * This function is for calculate
     * the number of transports for
     * modules in Zikula and update it
     *
     * @param $column          the column for update
     * @param $id              the id of the transported page
     */

    function updateTransport($column, $id)
    {

        $where = "WHERE $column = '" . pnVarPrepForStore($id) . "'";
        $old = DBUtil::selectObject('mutransport_page', $where);
        $transport = $old[transport];
        $transport = $transport + 1;
        $obj = array('transport' => $transport);
        DBUtil::updateObject($obj, 'mutransport_page', $where);
    }

    /**
     * This function is for calculate
     * the number of transports for CMS
     * and update it
     *
     * @param $column          the column for update
     * @param $id              the id of the transported page
     */

    function updateTransportCms($column, $id)
    {

        $where = "WHERE $column = '" . pnVarPrepForStore($id) . "'";
        $old = DBUtil::selectObject('mutransport_cmscontent', $where);
        $transport = $old[transport];
        $transport = $transport + 1;
        $obj = array('transport' => $transport);
        DBUtil::updateObject($obj, 'mutransport_cmscontent', $where);
    }

    /*-------------FUNCTIONS FOR TRANSPORT TO PAGES OF OTHER MODULES OR CMS-----------------*/

    /**
     * This function is for build the array
     * for the page and put it into the db
     *
     * @param $title				the result for the title
     * @param $content				the result for the content
     */
    function buildArrayForPagesPage($title, $content)
    {

        /*     $content = str_replace("\n", "<br />", $content);* this line contains a problem TODO; if the line is without comment, the page will not be transported	*/

        $args = array('pageid'          => '',
            'title'           => $title,
            'content'         => $content,
            'language'        => '',
            'displaywrapper'  => 0,
            'displaytitle'    => 1,
            'displaycreated'  => 0,
            'displayupdated'  => 0,
            'displaytextinfo' => 0,
            'displayprint'    => 0
        );

        ModUtil::apiFunc('Pages', 'admin', 'create', $args);

    }

    /*--------------FUNCTIONS FOR TRANSPORT TO CONTENT OTHER MODULES THAN CONTENT--------*/

    /**
     *  This function is for build the array
     *  for the page and put it into the db
     *
     *  @param $title           the old and new title
     *
     */
    function buildArrayForContentPage($title)
    {

        /*    Now we build the array for the API*/

        $page = array('page'     => array('title'      => $title,
            'urlname'    => '',
            'layout'     => 'column1',
            'categoryId' => '',

        ),
            'pageId'   => '',
            'location' => '', );

        /*    call the API function of Pages to greate the news page    */

        ModUtil::apiFunc('content', 'page', 'newPage', $page);
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

    function buildArrayForContent($text, $format, $relation_id, $type)
    {

        /*      build the array $data    */

        $data = array(
            'text'      => $text,
            'inputType' => $format,
        );

        /*      build the array $content  */

        $content = array('id'               => '',
            'pageId'           => $relation_id,
            'contentAreaIndex' => '',
            'position'         => '0',
            'addVersion'       => '',
            'content'          => array('module'        => 'Content',
                'type'          => $type,
                'data'          => $data,
                'stylePosition' => 'none',
                'styleWidth'    => 'wauto',
                'styleClass'    => '',
                'obj_status'    => 'A',
                'cr_date'       => '',
                'cr_uid'        => '',
                'lu_date'       => '',
                'lu_uid'        => '',
            ));
        // call newContent method of Content modul

        ModUtil::apiFunc('content', 'content', 'newContent', $content);
    }

    /*--------------END OF FUNCTIONS FOR TRANSPORT TO CONTENT OTHER MODULES THAN CONTENT--------*/

    /*----------------FUNCTIONS FOR NEWS MODULE-------------------------------------*/

    /**
     * This function is for generate the input to news and put it into db
     *
     * @param $title                 the correct column for the title
     * @param $author				 first field for author
     * @param $author2   			 second field for author, if $author empty
     * @param $header				 the header of an chapter, this field will taken
     * @param $result                the result of the select, may be an array or an normal var
     * @param $count                 the number of the content-items, 0 if result is no array
     * @param $from					 the date of the posting
     * @return true
     */

    function generateInputForNews($title, $author, $author2, $header, $result, $count, $from)
    {

        $pntable = DBUtil::DBGetTables();
        $newscolumn = $pntable['news_column'];

        /* First we check the Module Var 'news_state' of MUTransport:
         *     witch state will a generated news have?
         */

        $action = ModUtil::getVar('MUTransport', 'news_state');

        /* Now we fill the necessary $args*/

        $args['title'] = $title;
        $args['hometextcontenttype'] = 1;
        $args['bodytextcontenttype'] = 1;
        $args['notes'] = '';
        $args['action'] = $action;
        $args['format_type'] = 0;
        $args['hideonindex'] = 1;
        $args['disallowcomments'] = 1;
        $args['hometext'] = '';
        $args['bodytext'] = '';

        $text2 = '';

        /*----------- the module we wish to tranport has several content,
         --------------the module 'Content' for example----*/

        if (is_array($result)) {
            foreach ($result as $wert2 => $value2) {

                // ckeck the image path, if not empty check for image

                if (ModUtil::getVar('MUTransport', 'image_path') != '') {

                    // if there is an image build the image path and html code
                    // and put before the text

                    if ($value2[image] != '') {
                        $image_path = ModUtil::getVar('MUTransport', 'image_path');
                        $image = $value2[image];
                        $exist = strpos($image, "/");
                        if ($exist) {
                            $image = strrchr($image, "/");
                            $image = str_replace("/", "", $image);
                        }
                        $img = "<img style='float:right' src='$image_path/$image' />";
                        $text = $img . $value2[text];

                    } // else do nothing with the existing text

                    else {
                        $text = $value2[text];
                    }
                } else // else do nothing and take only the text

                    {
                    $text = $value2[text];
                }

                // if the module, for example PagEd, contains headers, put it before the text

                if ($header != '' && $wert2 == 0) {
                    $text = '<h3>' . $header . '</h3>' . $text;
                }

                // if the module, for example PagEd, contains subtitles, put it before the text

                if ($value2[subtitle] != '') {
                    $text = '<h3>' . $value2[subtitle] . '</h3>' . $text;
                }

                /*-----Now we handle the text of the module to transport and generate
                 * ----hometext, bodytext or only hometext
                 */

                // bodytext will be empty, if only 1 content unit was found

                if ($count == 1) {
                    $args['hometext'] = $text;
                    $args['bodytext'] = '';
                }

                // more than 1 content unit

                if ($count > 1) {

                    // the first content we put into the hometext

                    if ($wert2 == 0) {
                        $text2 = $text2 . $text . '<br /><br />';
                        $args['hometext'] = $text2;
                        $text2 = '';
                    }

                    // all other content we put into the bodytext

                    if ($wert2 > 0) {
                        $text2 = $text2 . $text . '<br /><br />';
                        $args['bodytext'] = $text2;
                    }
                }
            }
        } // if(is_array($result))
        // the module witch we want to transport has no several contents, tranport from wordpress
        else {

            // We clean up the code

            $result = str_replace("\n", "<br>", $result);

            // if the text content is longer than 400 characters, we split

            if ((strlen($result) > 400)) {

                $args['hometext'] = substr($result, 0, 200);
                $args['bodytext'] = substr($result, 200);
            } else // nothing to do
            {
                $args['hometext'] = $result;
            }
        }
        // call create method of News modul
        $relation_id = ModUtil::apiFunc('News', 'user', 'create', $args);

        //   if($relation_id) {
        // get the correct format of posting time for putting in news
        // take the first author field, if it's not empty
        if ($author != '') {
            $obj = array('from'        => $from,
                'contributor' => $author);
        }
        // else the second author field
        else {
            $obj = array('from'        => $from,
                'contributor' => $author2);
        }
        // get the last id of News
        $relation_id = MUTransportHelp::getIdFromNews('sid');
        $where = "WHERE $newscolumn[sid] = '" . pnVarPrepForStore($relation_id) . "'";
        DBUtil::updateObject($obj, 'news', $where);
        //      }

        return true;
    }

    /*----------------FUNCTIONS FOR EZCOMMENTS MODULE-------------------------------------*/

    /**
     * This function is for generate the input
     * to ezcomments and put it into the db
     *
     * @param $mod					the module for that the comment is
     * @param $pageid				the page for that the comment is
     * @param $comment				the comment content
     * @param $owneruid				unclear, but must be, 0 TODO
     * @param $anonname				the username of the wordpress user, who posted the comment
     */

    function generateInputForEZComments($mod, $pageid, $comment, $owneruid, $anonname)
    {

        // We build the array for the API of EZComments

        $args = array('mod'      => $mod,
            'objectid' => $pageid,
            'comment'  => $comment,
            'owneruid' => $owneruid,
            'uid'      => 0,
            'anonname' => $anonname);

        // call create method of module EZComments

        ModUtil::apiFunc('EZComments', 'user', 'create', $args);
        return true;

    }

    /*----------------------FUNCTIONS FOR OTHER CMS------------------------------*/

    /**
     * This function is for make a check to another database
     */
     
     public function checkExtDB($host,$dbname,$dbuser, $dbpassword) {
     	
     	try {
            $connect = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
        } catch (PDOException $e) {
            return false;
        }
        if($connect) {
          $is_connected = true;
        }
        
        $connect = null;
        
        return $is_connected; 
     }
     
    /**
     * This function is for make a connect to another database
     * and execute a query and return the result as an aray
     */
     
     public function connectExtDB($query,$host,$dbname,$dbuser, $dbpassword) {
     	
     	try {
            $connect = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
        } catch (PDOException $e) {
            return false;
        }
        
        if($connect) {
    
        // ask the DB for Pages in wordpress with state 'publish'
    
        try {

        // prepare the sql query
        $sql = $connect->prepare($query);
    	    
        // execute the query
        $sql ->execute();

        // work with the result rows    
        while ($row = $sql->fetch()) {
        $obj[] = $row;
        }

       // clear the result rows
       $sql = NULL;
       }

       catch (PDOException $e) {
       $this->__('Connection to database failed');
       }
    
       $connect = null;
        
       return $obj; 
     }
     }

    /**
     * This function is for get the id of the last User in module Users
     *
     *@param $field           the relevant field as id
     *return $relation
     */

    public function getIdFromUsers($field)
    {
        $relation = DBUtil::selectFieldMax('users', $field);
        return $relation;
    }

    /**
     *  This function is for generate the input to the user module
     *  and put it into the DB
     * @param $uname			the
     */

    function generateInputForUsers($uname, $email, $registered, $group)
    {

        // get the length of the password, that is necessary

        $length = ModUtil::getVar('Users', 'minpass');

        // password generating
        // letters and numbers in an array

        $letters_small = array(a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z);
        $letters_big = array(A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, T, U, V, W, X, Y, Z);
        $numbers = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        $input = '';

        // generate password
        for ($i = 0; $i < $length; $i++) {

            $select = mt_rand(1, 3);

            switch ($select) {

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

        $method = ModUtil::getVar('Users', 'hash_method');
        $pass = DataUtil::hash($input, $method);

        // if username must be in lowercase
        if (ModUtil::getVar('Users', 'lowercaseuname') == 1) {

            $uname = strtolower($uname);
        }

        // we build the array for the API of module Users

        $user = array(

            'uid'            => '',
            'uname'          => $uname,
            'email'          => $email,
            'user_regdate'   => $registered,
            'user_viewemail' => 0,
            'user_theme'     => 0,
            'pass'           => $pass,
            'storynum'       => 0,
            'ublockon'       => 0,
            'ublock'         => '',
            'theme'          => '',
            'counter'        => 0,
            'activated'      => 1,
            'lastlogin'      => '',
            'validfrom'      => '',
            'validuntil'     => '',
            'hashmethod'     => $method,
        );

        // We insert the user into the DB

        $ok = DBUtil::insertObject($user, 'users', 'uid');
        if ($ok == true) {

            // we get the last user id

            $relation_id = MUTransportHelp::getIdFromUsers('uid');

            /* we build the array for putting the user into the group,
             that is selected by calling this function   */

            $object = array('gid' => $group,
                'uid' => $relation_id);
            $ok2 = DBUtil::insertObject($object, 'group_membership');

            if ($ok2) {
                return true;
            }
        }
    }
}
