<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {counter} function plugin
 * Type:     function<br>
 * Name:     counter<br>
 * Purpose:  print out a counter value
 *
 * @author Monte Ohrt <monte at ohrt dot com>
 * @link   http://www.smarty.net/manual/en/language.function.counter.php {counter}
 *         (Smarty online manual)
 *
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 *
 * @return string|null
 */
function smarty_function_seourl($params, $template)
{
	$str = strip_tags($params['str']);
    $str=str_truncate($str,50);
	$str=preg_replace("/[,\s]/","-",$str);
    $str=preg_replace("/[^-\w]/","",$str);
    $str=preg_replace('/[-]{2,}/','-',$str);
    $str=preg_replace('/[^\w]$/','',$str);
    if($str=="")
    {
    	$str="reviews";
    }
    return $str;
}
