<?php
/**
 * Add Config Here，use by Constant::UPLOADIMGSIZE
 * Created by Tim.
 * User: Tim
 * Date: 2015/9/28
 * Time: 14:30
 */

class Constant{

    const UPLOADPICTYPE = 'jpg,gif,jpeg,png';               //上传图片格式限制
    const UPLOADIMGSIZE = 10485760;                         //10MB 上传图片文件大小 2mb 1mb=1048576  2mb=2097152
    const SUCCESS = 1;                                      //成功

    const SYS_ERROR = 500;                                  //系统错误
    const SEND_EMAIL_ERROR = 220;                           //发送邮件错误
    const DB_TABLE_FIELED_ERROR = 100;                      //数据库表字段错误

    //配置变量
    const HTML = 2;                                         //
    const ADDRESSLIMIT = 20;                                //用户可新建地址数上限
    public static $order_status_arr = array('pending','cancel','closed','success','verifying');
    public static $template_forget_password_arr = array(
        'email'=>'email/forget_password.html',
        'subject'=>'Password Reset');

}