<?php
    session_start();
    header('Content-type:text/html;charset=utf-8');
    if (isset($_SESSION['email'])){
        session_unset();
        session_destroy();
        setcookie(session_name(),'',time()-3600);
        //header("location:index.html");
        echo "<script>alert('注销成功');window.location.href=\"index.html\";</script>";
    }else{
        echo "注销失败";
    }