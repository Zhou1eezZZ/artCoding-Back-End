<?php
    session_start();
    header("Content-type:text/html;charset=utf-8");
    include 'conn.php';
    mysql_query("set name 'utf8'");
    date_default_timezone_set('Asia/Shanghai');//设置时区
    $time = date("Y-m-d H:i:s");
    $email = ($_SESSION['email']);
    //$email = "1624954751@qq.com";
    if(!isset($email)){
        exit('非法登陆');
    }
    //查找对应用户
    $query = mysql_query("select * from userbasic where 邮箱='{$email}' limit 1");
    $row = mysql_fetch_array($query);
    $user = $row['ID'];

    //接受界面传输内容
    $code = $_POST['code'];
    $img = $_POST['img'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $instructions = $_POST['instructions'];
    $tags = $_POST['tags'];
    $judge = "否";

    //创建代码文件夹
    $codeFile = "codeFile/".$email;
    if (!is_dir($codeurl)){
        mkdir($codeFile);
    }

    //创建图片文件夹
    $imgFile = "codeImg/".$email;
    if (!is_dir($imgurl)){
        mkdir($imgFile);
    }
    //插入数据库
    $sql = "insert into project(项目ID,发布者ID,标题,描述,操作方法,分类,项目内容地址,项目图片地址,最新发布时间,是否私人项目,是否屏蔽,备注信息) values (NULL,'$user','$title','$description','$instructions','$tags',NULL,NULL,'$time','$judge','$judge',NULL)";
    mysql_query($sql);
    $codeId = mysql_insert_id();

    //写入图片文件
    //$imgname = $imgFile."/".$codeId.".txt";
    //$imgfile = fopen($imgname,"w");
    //fwrite($imgfile,$img);
    //fclose($imgfile);
    $imgname = $imgFile."/".$codeId;
    //将base64转化为jpeg $img是图片base64
    if (preg_match('/^(data:\s*image\/(\w+);base64,)/',$img, $result)){
        $type = $result[2];
        //$new_file = $new_file.time().".{$type}";
        $imgname = $imgFile."/".$codeId.".{$type}";
        if (file_put_contents($imgname, base64_decode(str_replace($result[1], '', $img)))){
            //echo '新文件保存成功：', $imgname;
        }else{
            //echo '新文件保存失败';
        }
    }

    //写入代码文件
    $codename = $codeFile."/".$codeId.".txt";
    $codefile = fopen($codename,"w");
    fwrite($codefile,$code);
    fclose($codefile);

    //插入数据库
    $update_sql = "UPDATE project SET 项目内容地址='$codename',项目图片地址='$imgname' WHERE 项目ID = '$codeId'";
    mysql_query($update_sql);
    echo "保存成功！";