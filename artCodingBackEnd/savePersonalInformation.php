<?php
session_start();
include 'conn.php';
header("Content-type:text/html;charset=utf-8");
if(!isset($_SESSION['email'])){
    exit('非法登陆');
}
$email = $_SESSION['email'];

//接受页面内容
$name = $_POST['name'];
$city = $_POST['city'];
$phone = $_POST['phone'];
$motto = $_POST['motto'];
$old = $_POST['oldpsw'];
$oldpsw = md5($old);
$new_one = $_POST['newpsw_one'];
$newpsw_one = md5($new_one);
$new_two = $_POST['newpsw_two'];
$newpsw_two = md5($new_two);

$query = mysql_query("select * from userbasic where 邮箱='{$email}' limit 1");
$row = mysql_fetch_array($query);
$checkpsw = $row['密码'];
if($oldpsw==""&&$newpsw_one==""&&$newpsw_two=="") {
    //没有修改密码
    $su = "success";
    $sql="update userbasic set 昵称='$name',手机='$phone',个人简介='$motto',所在地区='$city' where 邮箱 = '$email'";
    mysql_query($sql);
}else{
    if($oldpsw == $checkpsw){
        if($newpsw_one == $newpsw_two){
            if(strlen($newpsw_one)>=6){
                $sql="update userbasic set 密码='$newpsw_one',昵称='$name',手机='$phone',个人简介='$motto',所在地区='$city' where 邮箱 = '$email'";
                mysql_query($sql);
                $su = "success";
            }else{
                //echo "<script>alert('新密码至少6位，请重新填写');window.location.href='personalPage.php'</script>";
                $su="psw_short";
            }
        }else{
            //echo "<script>alert('两次密码输入不同，请重新填写');window.location.href='personalPage.php'</script>";
            $su = "psw_different";
        }
    }else{
        //echo "<script>alert('原密码不正确，请重新输入密码');window.location.href='personalPage.php'</script>";
        $su = "success";
    }
}
$data='{su:"' . $su .'"}';
echo json_encode($data);
?>