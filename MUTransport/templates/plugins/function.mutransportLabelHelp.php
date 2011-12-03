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
 * This plugin helps creating and styling some extra help text for each input.
 *
 * Available parameters:
 *   - assign:   If set, the results are assigned to the corresponding variable instead of printed out
 *
 * @param        array       $params      All attributes passed to this function from the template
 * @param        object      &$render     Reference to the Smarty object
 * @return       string      The output of the plugin
 */
function smarty_function_mutransportLabelHelp($params, &$render)
{
    $text = $params['text'];
    $text = DataUtil::formatForDisplayHTML(strlen($text)>0 && $text[0]=='_' ? constant($text) : $text);
    $result = "<div class=\"mutransportLabelHelp\">$text</div>";

    if (array_key_exists('assign', $params)) {
        $render->assign($params['assign'], $result);
    }
    else {
        return $result;
    }
}
