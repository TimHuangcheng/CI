<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	public function index()
	{
        //$this->load->model("m_test");
        echo "<p>This is Controller</p>";
        $this->load->service("s_test");
        $this->s_test->test();
        $this->assign("hello","Smarty Hello");
		$this->display("welcome.html");
	}
}
