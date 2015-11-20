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
function smarty_function_rating($params, $template)
{
    $score = (isset($params['score'])) ? $params['score'] : '0';
	switch ($score) 
	{
	    case $score>=1500:
		   $level="21+";
		   break;
		case $score>=1100&&$score<1500:
		   $level=20;
		   break;
		case $score>=960&&$score<1100:
		   $level=19;
		   break;
		case $score>=840&&$score<960:
		   $level=18;
		   break;
		case $score>=740&&$score<840:
		   $level=17;
		   break;
		case $score>=640&&$score<740:
		   $level=16;
		   break;
		case $score>=560&&$score<640:
		   $level=15;
		   break;
		case $score>=480&&$score<560:
		   $level=14;
		   break;
		case $score>=420&&$score<480:
		   $level=13;
		   break;
		case $score>=360&&$score<420:
		   $level=12;
		   break;
		case $score>=300&&$score<360:
		   $level=11;
		   break;
		case $score>=240&&$score<300:
		   $level=10;
		   break;
   		case $score>=200&&$score<240:
   		   $level=9;
   		   break;
   		case $score>=160&&$score<200:
   	       $level=8;
   		   break;
   		case $score>=120&&$score<160:
   		   $level=7;
   		   break;
   		case $score>=80&&$score<120:
   		   $level=6;
   		   break;
   		case $score>=40&&$score<80:
   		   $level=5;
   		   break;
   		case $score>=20&&$score<40:
   		   $level=4;
   		   break;
   		case $score>=10&&$score<20:
   		   $level=3;
   		   break;
   		case $score>=5&&$score<10:
   		   $level=2;
   		   break;
   		case $score>1&&$score<5:
   		   $level=1;
   		   break;
		default:
		   $level=0;
	}
    return $level;
}
