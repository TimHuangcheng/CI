<?php
/**
 * Created by Tim.
 * User: Tim
 * Date: 2015/9/18
 * Time: 13:11
 */
if ( ! function_exists('mysetcookie'))
{
    function mysetcookie($array, $life=0, $path = '/', $domain = '') {
        //$domain = $domain ? $domain : $this->config->item('domain');
        $_cookName_ary = array_keys($array);
        for ($i = 0; $i < count($array); $i++) {
            //echo $_cookName_ary[$i],$domain,"<br>";
            setcookie($_cookName_ary[$i], $array[$_cookName_ary[$i]], $life ? (time() + $life) : 0, $path,$domain);
        }
    }
}