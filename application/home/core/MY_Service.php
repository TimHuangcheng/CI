<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by Tim.
 * User: Tim
 * Date: 2015/9/17
 * Time: 17:39
 */

class MY_Service extends CI_Service

{

    public function __construct()

    {

        log_message('debug', "Service Class Initialized");

    }

    function __get($key)

    {

        return get_instance()->$key;

    }

}

