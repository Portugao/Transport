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
 * This simple plugin adds a suitable <div> element around the button row.
 *
 * @param        array       $params       All attributes passed to this function from the template
 * @param        string      $content      The content of the block
 * @param        object      &$render      Reference to the Smarty object
 * @return       string      The output of the plugin
 */
function smarty_block_mutransportButtons($params, $content, &$render)
{
    if ($content) {
        echo "<div class=\"mutransportButtons\">\n";
        echo $content;
        echo "</div>\n";
    }
}
