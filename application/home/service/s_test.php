<?php
/**
 * Created by Tim.
 * User: Tim
 * Date: 2015/9/17
 * Time: 17:43
 */

class s_test extends CI_Service{
    public function __construct(){
        $this->load->model('m_test');
    }

    public function test() {
        $this->m_test->test();
        echo "<p>This is Service</p>";
    }
}