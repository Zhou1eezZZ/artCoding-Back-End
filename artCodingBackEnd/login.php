<?php
   session_start();
   header("Content-type:text/html;charset=utf-8");
   include 'conn.php';

   $EMAIL = $_POST['email'];
   $password = $_POST['password'];
   $psw = md5($password);

   $sql = "select * from userbasic where 邮箱 = '{$EMAIL}' and 密码 = '{$psw}'";
   $rst = mysql_query($sql);
   $row = mysql_fetch_assoc($rst);

   if($row){
       $_SESSION['email'] = $EMAIL;
       echo "<script>alert('登陆成功！');window.location.href='personalPage.php'</script>";
   }else{
       echo "<script>alert('账号或密码错误！请重新填写！');window.location.href='sign in.html';</script>";
   }
?>