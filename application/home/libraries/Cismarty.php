<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
require(APPPATH.'libraries/Smarty/Smarty.class.php');
date_default_timezone_set("Etc/GMT+7");
class Cismarty extends Smarty
{
    protected $ci;
    public    $BASEURL;
    public    $FRONTURL;
    public    $BACKURL;
    public function __construct()
    {
        parent::__construct();
       
        $this->ci = & get_instance();
        $this->ci->load->config('smarty');//加载smarty的配置文件
//         $third_dir=ROOT.DS.APPPATH."third_party".DS."allyes_Bar".DS."smarty_dir".DS; // this is three direction
//         $this->template_dir=   ROOT.DS.APPPATH.'views'.DS;//smarty模板文件指向ci的views文件夹
//         获取相关的配置项
//		   $this->cache_lifetime  = $this->ci->config->item('cache_lifetime');
//		   $this->caching         = $this->ci->config->item('caching');
//         $this->template_dir    = $this->ci->config->item('template_dir');
//         $this->compile_dir     = $this->ci->config->item('compile_dir');
//         $this->cache_dir       = $this->ci->config->item('cache_dir');
//         $this->use_sub_dirs    = $this->ci->config->item('use_sub_dirs');
//         $this->left_delimiter  = $this->ci->config->item('left_delimiter');
//         $this->right_delimiter = $this->ci->config->item('right_delimiter');

        // $this->smarty = new Smarty;
		
        // smarty 配置
        //$this->cache_lifetime  = $this->ci->config->item('cache_lifetime');
        //$this->caching         = $this->ci->config->item('caching');
        //$this->debugging = true;
        //$this->compile_check=false;
        //$this->force_compile = false;
        $this->template_dir=   APPPATH.'views'.DS;//smarty模板文件指向ci的views文件夹
        $this->compile_dir  =   $this->ci->config->item('compile_dir');
        $this->cache_dir     =  $this->ci->config->item('cache_dir');
        $this->left_delimiter = '<{';
        $this->right_delimiter = '}>';
        
        $this->BASEURL         = $this->ci->config->item('base_url');
        $this->FRONTURL        = $this->ci->config->item('static_url');
        $this->BACKURL         = $this->ci->config->item('back_url');
        
		$BASEURL=$this->ci->config->item('base_url');
		$FRONTURL=$this->ci->config->item('static_url');
		$BACKURL=$this->ci->config->item('back_url');
		$PICURL=$this->ci->config->item('pic_url');
        $this->assign('BASEURL',$BASEURL);
		$this->assign('STATICURL',$FRONTURL);
		$this->assign('BACKURL',$BACKURL);		
		$this->assign('PICURL',$PICURL);
    }
}