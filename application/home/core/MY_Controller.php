<?php if (!defined('BASEPATH')) exit('No direct access allowed.');
/**
 * Created by Tim.
 * User: Tim
 * Date: 2015/9/17
 * Time: 17:39
 */
include_once(APPPATH.'core/Constant.php');
class MY_Controller extends CI_Controller {
	
	protected $_base_url;			//网站基地址
	protected $_front_url;			//网站前端地址
    protected $_pic_url;			//网站图形服务器地址
    protected $_domain;			    //网站主域名
    protected $_inpath;			    //uri
    protected $cvar;                //全局assign变量
    protected $APP;                 //seajs 设置

    public function __construct() {
        parent::__construct();
        $this->load->helper('mycookie');
        $this->_time = time();
        $this->setApp();
    }
    public function setApp($app = 'main'){
        $this->APP = explode(',',$app);
        $this->assign('APP',$this->APP);
    }

    public function loadSEO($title='',$keywords='',$content=''){
        $seo['title'] = 'Etekcitizen | '.$title;
        $seo['keywords'] = $keywords;
        $seo['content'] = $content;
        $this->assign('seo',$seo);
    }

    /*
    * 分页插件
    */
    public function pageBar($count,$limit,$page,$paramstr=''){
        $pagenum = ceil($count / $limit);
        $page = min($pagenum, $page);
        $prepg = max(1,$page - 1);
        $nextpg = $page+1 > $pagenum ? $pagenum : $page + 1;

        $params['totalSize'] = $count;
        $params['nextpg'] = $nextpg;
        $params['prepg'] = $prepg;
        $params['currpage'] = $page;
        $params['pagenum'] = $pagenum;

        $startpage = 1;
        if($pagenum <= 5){
            $endpage = $pagenum;
        }elseif($page-2<=0) {
            $endpage = 5;
            $startpage = 1;
        }elseif($page+2>$pagenum){
            $endpage = $pagenum;
            $startpage = $endpage-5;
        }else{
            $endpage = $page+2;
            $startpage = $endpage-5+1;
        }
        
        while($startpage<=$endpage){
            $params['pages'][] = $startpage;
            $startpage++;
        }
        $this->assign('_inpath',$this->_inpath);
        $this->assign('_paramstr',$paramstr);
        $this->assign('_page',$params);
    }

    /*
     * 载入用户登陆信息
     */
    public function loadUserLogin(){
        if( isset($_COOKIE['username'],$_COOKIE['userid'],$_COOKIE['userkey'],$_COOKIE['usertype']) ){
            $_username = $_COOKIE['username'];
            $_userid = (int)$_COOKIE['userid'];
            $_userkey = $_COOKIE['userkey'];
            $_usertype = $_COOKIE['usertype'];
            $_first_name = $_COOKIE['firstname'];
            $_last_name = $_COOKIE['lastname'];
            $_action_time = $_COOKIE['action_time'];
            if($_action_time + 60 *60 *24 < $this->_time){
                $this->logout();
            }else{

                }else {
                    $array = array('username' => '', 'userid' => '', 'userkey' => '', 'usertype'=>'');
                    mysetcookie($array, -1, '/', $this->_domain);
                }
            }
        }
    }

    /*
     * 登陆检查
     */
    public function isLogin($redirect=false) {
        if(!$this->_userid || !$this->_username){
            if($redirect){
                $url = $_SERVER['REQUEST_URI'] ? 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] : '';
                header("Content-type: text/html; charset=utf-8");
                header("Location:".$this->_base_url."/login.html?url=".urlencode($url));
                exit;
            }
            return false;
        }
        return true;
    }
    
    public function logout(){
        $array = array('username' => '', 'userid' => '', 'userkey' => '', 'usertype'=>'');
        $domain = $this->config->item('domain');
        mysetcookie($array, -1, '/' ,$domain);
        $url = $this->input->get('url');
        $_fromurl = $url ? $url : $_SERVER["HTTP_REFERER"];
        if(empty($_fromurl)){
            header("Location:/");exit();
        }else{
            header("Location:$_fromurl");exit();
        }
    }

    /*
     * 获取网站设置
     */
    public function loadSiteConf(){
        $this->assign('settings', $settings);
    }

    /**
     * @param $msgCode
     * @param bool $isecho
     * @return array
     */
    public function showAjaxMsg($msgCode,$isecho=true){
        $msgArr = array(
            'status'=>$msgCode,
            'msg'=>'',
        );
        switch($msgCode){
            case Constant::SUCCESS:
                $msgArr['msg'] = 'success';
                break;
            default:
                $msgArr['msg'] = 'code error';
        }
        if($isecho){
            echo json_encode($msgArr);die();
        }
        return $msgArr;
    }

    public function assign($key,$val) {
        $this->cismarty->assign($key,$val);
    }
    public function display($html,$cacheId=null) {
        $this->cismarty->display($html,$cacheId);
    }
    public function displayfetch($html,$cacheId=null) {
        return $this->cismarty->display2($html,$cacheId);
    }
    public function view($html,$cacheId=null) {
    	$this->cismarty->display($html,$cacheId);
    }
    public function fetch($html,$cacheId=null) {
    	$this->cismarty->fetch($html,$cacheId);
    }
    public function getUploadFilePath($_file, $dirname='../upload', $sizelimit = '', $allowtype=Constant::UPLOADPICTYPE) {
        if (!empty($_file['name'])) {
            $_file['name'] = strtolower($_file['name']);
            $ext = strtolower(@end(explode(".", $_file['name'])));
            $ary = explode(',', $allowtype);
            if (!in_array($ext, $ary))
                return array('status' => 0, 'error' => 1, 'msg' => "不允许上传的文件类型,上传文件类型只能为：" . $allowtype . "!");
    
            if (!$sizelimit)
                $sizelimit = Constant::UPLOADIMGSIZE;
            if ($_file['size'] > $sizelimit) {
                $fallowsize = round($sizelimit / 1024, 2) . 'kb' . ' 实际上传文件大小为：' . round($_file['size'] / 1024, 2) . 'kb';
                return array('status' => 0, 'error' => 1, 'msg' => "文件大小超出规定限制：{$fallowsize},请重新上传!");
            }
            $dirname = $dirname?(trim($dirname, '/').'/'):'';
            $query['path']= $dirname . date('Ym/d', time()) . '/' ;
    
            if (!file_exists($query['path'])){
                if (!mkdir($query['path'],0777,true)){
                    return array('error' => 1 ,'status'=>0, 'msg' => '创建文件夹失败');
                }
            }
            $query['name'] = md5(time().rand(1,100000000).uniqid()) . '.' . $ext;
            $fullName = $query['path'].$query['name'];
            if (!move_uploaded_file($_file['tmp_name'],$fullName)) {
                return array('error' => 1 ,'status'=>0, 'msg' => '上传错误');
            }
            //$imgurl = substr($fullName,2);
            $imgurl = ltrim($fullName,"\.\.");
            $imgurl = str_replace("/upload","",$imgurl);
            return array('error' => 0, 'url' => $imgurl, 'size' => $_file['size'], 'type' => $ext);
        } else {
            return array('error' => 1, 'url' => '', 'msg' => "请选择要上传的文件!");
        }
    }
} 