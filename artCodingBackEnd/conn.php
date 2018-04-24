<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','');

define('DB_NAME','artcoding');
error_reporting(0);
//数据库与PHP的连接
$_conn = mysql_connect(DB_HOST,DB_USER,DB_PWD) or die('数据库连接失败');

//设置活动的MySQL数据库，前面已经define('DB_NAME','campusServ');
mysql_select_db(DB_NAME) or die('数据库不存在');

//mysql_query() 函数执行一条 MySQL 查询。
mysql_query('SET NAMES UTF8') or die('编码错误');
//连接数据库
function _alert_back($_info) {
    echo "<script type='text/javascript'>
                alert('$_info');
	            history.back();
            </script>";
    exit();
    //提示，实现转跳回原页面
}
function _alert_location($_info,$_url){
    echo "<script type='text/javascript'>
                alert('$_info');
	            window.location.href='{$_url}';
            </script>";
    exit();
    //提示，实现转跳到新页面
}
function _check_username($_string,$_min_num,$_max_num){
    $_string = trim($_string);//去掉字符串首尾空格
    //mb_strlen — 获取字符串的长度
    if (mb_strlen($_string,'utf-8')<$_min_num || mb_strlen($_string,'utf-8')>$_max_num)
        _alert_back('昵称不得小于'.$_min_num.'位，或者大于'.$_max_num);
    return $_string;
    //用户名check，限制用户名的长度
}
function _check_password($_password,$_repassword,$_min_num){
    if (mb_strlen($_password)<$_min_num)
        _alert_back('密码位数不得小于'.$_min_num);

    if ($_password !=$_repassword)
        _alert_back('两次输入密码不同');
    return $_password;
    //密码check，限制密码长度，保证密码输入正确
}
?>