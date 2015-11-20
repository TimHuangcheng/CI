<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends MY_Controller {
	public function index()
	{
        //·¢ËÍÓÊ¼þÊ¾Àý
        $info = array(
            "user_name"=>'Tim',
            "data"=>$content,
            "to"=>'name@email.com'
        );
        $this->load->service('s_email');
        $resCode = $this->s_email->sendEmail($info,Constant::$template_forget_password_arr);

        if($resCode){
            return Constant::SUCCESS;
        }
	}
}

