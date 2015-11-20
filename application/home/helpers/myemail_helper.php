<?php
/**
 * Created by Tim.
 * User: Tim
 * Date: 2015/9/18
 * Time: 13:11
 */
if ( ! function_exists('myvalidEmail'))
{
    function myvalidEmail($email) {
        return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $email);
    }
}