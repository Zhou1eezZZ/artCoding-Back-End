<?php
    session_start();
    header("Content-type:text/html;charset=utf-8");
    include 'conn.php';
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['passwordCheck'];
    $city = $_POST['city'];
    $school = $_POST['schoolName'];
    $studentID = $_POST['studentID'];
    $teacherID = $_POST['teacherID'];

    //判断是用户状态是老师还是学生或者普通用户
   if(empty($teacherID)&&!empty($studentID)){
        $type = '学生';
        $ID = $studentID;
        $sql = "SELECT * FROM userbasic WHERE 所在学校 LIKE '$school' AND ID=$ID AND 邮箱 LIKE '$email'";
    }else{
        $type = '老师';
        $ID = $teacherID;
        $sql = "SELECT * FROM userbasic WHERE 所在学校 LIKE '$school' AND ID=$ID AND 邮箱 LIKE '$email'";
    }
    $query=mysql_query($sql);
    $rows=mysql_num_rows($query);

    //检测信息是否填写正确
    if (strlen($password) < 6){
        //判断密码长度
        echo "<script>alert('密码至少6位！重新填写');window.location.href='join.html'</script>";
    } elseif ($password != $password2){
        //判断两次密码是否相同
        echo "<script>alert('两次密码不相同！重新填写');window.location.href='join.html'</script>";
    }elseif (!preg_match('/^[\w\.]+@\w+\.\w+$/i', $email)){
        //判断邮箱格式
        echo "<script>alert('邮箱不合法！重新填写');window.location.href='join.html'</script>";
    }elseif ($rows > 0 ){
        echo "<script>alert('学号或工号已存在');window.location.href='join.html'</script>";
    }else{
        $psw = md5($password);
        $insertsql = "insert into userbasic(ID,密码,昵称,邮箱,头像地址,个人简介,所在地区,所在学校,用户类型)values('$ID','$psw','$fullname','$email',NULL,NULL,'$city','$school','$type')";
        if(!(mysql_query($insertsql))){
            echo mysql_errno();
        }else{
            $_SESSION['email'] = $email;
            echo "<script>alert('注册成功！去登陆吧！');window.location.href='personalPage.php';</script>";
        }
    }
?>