<?php
 session_start();
 header("Content-type:text/html;charset=utf-8");
 include 'conn.php';
 $email = ($_SESSION['email']);
if(!isset($email)){
    header("location:sign in.html");
}
 $query = mysql_query("select * from userbasic where 邮箱='{$email}' limit 1");
 $row = mysql_fetch_array($query);
 //数据库调用用户信息
 $ID = $row['ID'];
 $name = $row['昵称'];
 $phone = $row['手机'];
 $img= $row['头像地址'];
 $motto = $row['个人简介'];
 $city = $row['所在地区'];
 $icon = $row['头像地址'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0, target-densitydpi=device-dpi">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <title>PersonalPage</title>
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/user_view.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/personalpage.css">
</head>

<body>

<div class="navbar navbar-fixed-top" role="navigation">
    <div class="row iconsRow">
        <div id="websiteControls">
            <div class="OPlogo icon">
                <a href="index.html" id="logoLight">
                    <img alt="logo" src="image/logo.png" width="50" height="40">
                </a>
                <a href="index.html" id="logoDark">
                    <img src="image/logoHover.png" width="50" height="40">
                </a>
            </div>
        </div>
        <p class="navbarHover"><a href="index.html" onClick="return foo();">退出登录</a></p>
        <div id="userTabs" class="text-center"></div>
        <div id="userControls" class="text-right">
            <div id="editButton"  class="editButton" data-loading-text="保存中.." data-active-text="保存" data-normal-text="编辑" autocomplete="off" onclick="submit();" id="eiditButton">编辑</div>
        </div>
    </div>
</div>




<div id="topPanel" class="panel active color-light" style="min-height: 226px; max-height:2200px;">
    <form id="editForm" class="container" autocomplete="off" autocorrect="off">
        <div class="row meta">
            <div class="by portrait">
                <div class="col-xs-offset-5 col-xs-2 col-sm-offset-5.5 col-sm-4.5 userSetup  text-center">
                    <a href="#" class="userThumbContainer noLink  ">
                        <img src="image/blank.png" class="ratioKeeper"><img src="<?php echo $icon?>" data-src="107357/thumbnail" class="userThumb noThumbnail" id="toppic">
                    </a>
                    <div class="col-xs-offset-5 userSetup  text-center">
                        <div class="addpic row fadeInOnEdit hide" id="changepic">
                            <button>改头像</button>
                            <input id="logoimg" class="addlogo" type="file" multiple accept="image/*" name="logo" onchange="imgChange(event)">
                        </div>
                    </div>
                    <div class="fadeInOnEdit uploadUserImage">
                        <img src="image/blank.png" class="cropit-gradient ratioKeeper">
                        <input type="file" class="cropit-image-input hide" accept="image/*">
                        <div class="cropit-image-preview" style="background-repeat: no-repeat;"><img src="image/blank.png" class="ratioKeeper"></div>
                        <input type="range" class="cropit-image-zoom-input" min="0" max="1" step="0.01">
                        <div class="buttons">
                            <a href="javascript:;" id="confirmUserImage" class="icon_followed"></a>
                            <a href="javascript:;" id="cancelUserImage" class="icon_cancel"></a>
                        </div>
                        <input type="hidden" name="userImageData" class="hidden-image-data">
                        <div class="icon_camera"></div>
                    </div>
                </div>

                <div class="byText col-xs-12 col-sm-offset-2 col-sm-8">
                    <div class="row">
                        <div class="fullnameContainer">
                            <div  id="fullname" class="fullname bariol editable col-xs-12  text-center " name="fullname" label="昵称" contenteditable="false"><?php echo $name ?></div>
                        </div>
                        <div class="byLocation col-xs-12 text-center">
                            <em id="locationLabel" class="hideOnEdit">来自:</em>
                            <div id="location" class="location editable text-center" label="位置" name="location" contenteditable="false"><em><?php echo $city ?></em></div>
                        </div>
                        <div  id="describeme" class="describeme bariol editable text-center col-xs-12 " name="describeme" label="name" contenteditable="false">个性签名：<?php echo $motto?></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="additionalFormFields" class="row fadeInOnEdit OPLiveForm hide">
            <input type="text" style="display:none">
            <input type="password" style="display:none">
            <formitem class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-2">
                <label for="email">邮箱</label>
                <input type="email" required="" autocorrect="false" autocomplete="off" class="field" name="email" label="email" value="<?php echo $email?>">
            </formitem>
            <formitem class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-2">
                <label for="phoneNumber">手机</label>
                <input type="tel" required="" autocorrect="false" autocomplete="off" class="field" name="email" label="phone" id="phone" value="<?php echo $phone?>">
            </formitem>
            <formitem class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-2">
                <label for="motto">个性签名</label>
                <input type="text" required="" autocorrect="false" autocomplete="off" class="field" name="motto" id="motto" label="motto" value="<?php echo $motto?>">
            </formitem>
            <formitem id="confirmPassword" class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-2" style="float:left;">
                <label>密码</label>
                <a href="#" class="labelLink" id="changePasswordLink" onClick="changePassword()">点击更改密码</a>
                <input id="passwordField" class="field hide" type="password" name="passwordField" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" autofill="false" placeholder="" onBlur="checkPasswordFiled()">
            </formitem>
            <p id="passwordConfirmTips" class="col-sm-4 col-md-6 col-sm-offset-2 col-md-offset-2" style="color: #facc2e;display: none;float:left">请输入现在的密码</p>
            <formitem id="changePassword1" class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-2" style="display:none;">
                <label>输入新密码</label>
                <input id="newPasswordField1" maxlength="16" minlength="6" class="field" type="password" name="newPasswordField1" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" autofill="false" placeholder="请输入6-16位的密码">
            </formitem>
            <formitem id="changePassword2" class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-2" style="display:none;">
                <label>确认新密码</label>
                <input id="newPasswordField2" maxlength="16" minlength="6" class="field" type="password" name="newPasswordField2" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" autofill="false" placeholder="" onBlur="checkPW()">
            </formitem>
            <p id="newPasswordTips" class="col-sm-4 col-md-6 col-sm-offset-2 col-md-offset-2" style="color: #facc2e;display: none;">两次密码输入不同</p>
        </div>
        <div class="row tabs" id="toptabs">
            <div class="col-md-12 tabContainer">
                <ul id="top-tabs" class="nav nav-tabs " role="tablist">
                    <li role="presentation" class="active"><a name="sketches" href="#" data-target="#sketchesContainer" role="tab" data-toggle="tab"><span class="count" id="numberOfSketches"></span>我的作品</a></li>
                    <li role="presentation" class=""><a name="hearts" href="#" data-target="#heartsContainer" role="tab" data-toggle="tab"><span class="count" id="numberOfHearts"></span> 我的收藏</a></li>
                    <li role="presentation" class=""><a name="follower" href="#" data-target="#followerContainer" role="tab" data-toggle="tab"><span class="count" id="numberOfFollowers"></span> 我的关注</a></li>
                    <li role="presentation" class=""><a name="follower" href="#" data-target="#followingContainer" role="tab" data-toggle="tab"><span class="count" id="numberOfFollowing"></span> 关注我的</a></li>
                </ul>
            </div>
        </div>
    </form>
</div>

<div id="content" class="tab-content">
    <div id="sketchesContainer" role="tabpanel" class="tab-pane jumbotron active">
        <div class="container">
            <div class="mainSketches container">
                <div class="col-md-8">
                    <p class="bariol">开始创作作品吧</p>
                    <hr>
                    <ul class="row text-center sketchList">
                        <!--创作界面按钮-->
                        <li class="newSketchLi hideOnGuest sketchLi col-xs-3 col-sm-3 col-md-3"><a class="sketchThumbContainer newSketch " href="codeWriting.html"><img src="image/blank.png" class="ratioKeeper"><div class="sketchLabel"></div></a></li>
                        <!--我的作品-->
                        <?php
                            $result = mysql_query("SELECT * FROM project where 发布者ID='$ID'");
                            while ($row = mysql_fetch_array($result)){
                                $id = $row['项目ID'];
                                $name = $row['标题'];
                                $img = $row['项目图片地址'];
                                echo "<li class=\"col-xs-3 col-sm-3 col-md-3 sketchLi\"><a class=\"sketchThumbContainer\" href=\"codeReading.php?codeID=$id\"><img src=$img data-src=$img class=\"sketchThumb\"><img src=\"image/blank.png\" class=\"ratioKeeper\"><div class=\"sketchLabel\"><p><span class=\"sketchTitle\"><?php echo $name;?></span></p></div></a></li>";
                            }
                        ?>
                    </ul>
                </div>

                <div id="heartsFeedContainer" class="hidden-xs col-md-offset-1 col-md-3">
                    <div id="rightpart">
                        <p class="bariol">作品推荐</p>
                        <hr>
                        <ul id="heartsFeed" class="row sketchList">

                            <?php
                            $result = mysql_query("SELECT * FROM project where 发布者ID='150207143'");
                            while ($row = mysql_fetch_array($result)){
                                $id = $row['项目ID'];
                                $name = $row['标题'];
                                $img = $row['项目图片地址'];
                                echo "<li class=\"col-xs-3 col-sm-3 col-md-3 sketchLi\"><a class=\"sketchThumbContainer\" href=\"codeReading.php?codeID=$id\"><img src=$img data-src=$img class=\"sketchThumb\"><img src=\"image/blank.png\" class=\"ratioKeeper\"><div class=\"sketchLabel\"><p><span class=\"sketchTitle\"><?php echo $name;?></span></p></div></a></li>";
                            }
                            ?>

                        </ul>
                        <div class="pull-right"><a class="btn btn-large btn-web" >查看更多</a></div>
                    </div>
                    <div id="rightpart" style="margin-top: 50px;">
                        <p class="bariol">足迹</p>
                        <hr>
                        <ul id="heartsFeed" class="row sketchList">
                            <li class="col-xs-3 sketchLi"><a class="sketchThumbContainer" href="/sktch/486307"><img src="image/work.jpg" data-src="image/work.jpg" class="sketchThumb"><img src="image/blank.png" class="ratioKeeper"><div class="sketchLabel"><p><span class="sketchTitle">Messy Curve Draw</span><br><span>by</span> 郑越升Sen</p></div></a></li>
                            <li class="col-xs-3 sketchLi"><a class="sketchThumbContainer" href="/sketch/95408"><img src="image/work.jpg" data-src="image/work.jpg" class="sketchThumb"><img src="image/blank.png" class="ratioKeeper"><div class="sketchLabel"><p><span class="sketchTitle">MSA Fluid back in js</span><br><span>by</span> qdiiibp</p></div></a></li>
                            <li class="col-xs-3 sketchLi"><a class="sketchThumbContainer" href="/sketch/376645"><img src="image/work.jpg" data-src="image/work.jpg" class="sketchThumb"><img src="image/blank.png" class="ratioKeeper"><div class="sketchLabel"><p><span class="sketchTitle">Deformed lines</span><br><span>by</span> Bárbara Almeida</p></div></a></li>
                            <li class="col-xs-3 sketchLi"><a class="sketchThumbContainer" href="/sketch/472966"><img src="image/work.jpg" data-src="image/work.jpg" class="sketchThumb"><img src="image/blank.png" class="ratioKeeper"><div class="sketchLabel"><p><span class="sketchTitle">Noise flow field painter</span><br><span>by</span> Jason Labbe</p></div></a></li>
                            <li class="col-xs-3 sketchLi"><a class="sketchThumbContainer" href="/sketch/467262"><img src="image/work.jpg" data-src="image/work.jpg" class="sketchThumb"><img src="image/blank.png" class="ratioKeeper"><div class="sketchLabel"><p><span class="sketchTitle">171027</span><br><span>by</span> Saskia Freeke</p></div></a></li>
                        </ul>
                        <div class="pull-right">
                            <a class="btn btn-large btn-web" >查看更多</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="collection archive hide">
                <div class="container collectionHeader">
                    <div class="row">
                        <div class="collectionTitle col-sm-offset-2 col-md-offset-2 col-sm-8 col-md-8">
                            <div class="collectionCounter">&nbsp;</div>
                            <h2 class="bariol editable" name="title" label="Title">Archive</h2>
                        </div>
                        <div class="collectionIcons col-sm-2 col-md-2 text-right"></div>
                    </div>
                </div>

                <hr class="collectionBorder">
                <div class="container">
                    <div class="row content">
                        <div class="description col-md-offset-2 col-md-4">
                            These are legacy sketches using Java Applets that don’t work on browsers. Provided for code-sharing purposes only.
                        </div>
                        <div class="col-md-6">
                            <div class="container-fluid">
                                <ul class="row sketchList"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="heartsContainer" role="tabpanel" class="tab-pane jumbotron ">
        <div class="container">
            <div id="listToggle" onclick="setListView()" class="icon" ></div>
            <ul id="heartsList" class="row sketchList">
                <li class="sketch col-xs-4 col-sm-2 sketchLi"><a class="sketchThumbContainer" href="/sketch/472966"><img src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail472966.jpg" data-src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail472966.jpg" class="sketchThumb"><img src="image/blank.png" class="ratioKeeper"><div class="sketchLabel"><p><span class="sketchTitle">Noise flow field painter</span></p></div></a></li>
                <li class="sketch col-xs-4 col-sm-2 sketchLi"><a class="sketchThumbContainer" href="/sketch/472966"><img src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail472966.jpg" data-src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail472966.jpg" class="sketchThumb"><img src="image/blank.png" class="ratioKeeper"><div class="sketchLabel"><p><span class="sketchTitle">Noise flow field painter</span></p></div></a></li>
                <li class="sketch col-xs-4 col-sm-2 sketchLi"><a class="sketchThumbContainer" href="/sketch/472966"><img src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail472966.jpg" data-src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail472966.jpg" class="sketchThumb"><img src="image/blank.png" class="ratioKeeper"><div class="sketchLabel"><p><span class="sketchTitle">Noise flow field painter</span></p></div></a></li>
                <li class="sketch col-xs-4 col-sm-2 sketchLi"><a class="sketchThumbContainer" href="/sketch/472966"><img src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail472966.jpg" data-src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail472966.jpg" class="sketchThumb"><img src="image/blank.png" class="ratioKeeper"><div class="sketchLabel"><p><span class="sketchTitle">Noise flow field painter</span></p></div></a></li>
                <li class="sketch col-xs-4 col-sm-2 sketchLi"><a class="sketchThumbContainer" href="/sketch/472966"><img src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail472966.jpg" data-src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail472966.jpg" class="sketchThumb"><img src="image/blank.png" class="ratioKeeper"><div class="sketchLabel"><p><span class="sketchTitle">Noise flow field painter</span></p></div></a></li>
                <li class="sketch col-xs-4 col-sm-2 sketchLi"><a class="sketchThumbContainer" href="/sketch/472966"><img src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail472966.jpg" data-src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail472966.jpg" class="sketchThumb"><img src="image/blank.png" class="ratioKeeper"><div class="sketchLabel"><p><span class="sketchTitle">Noise flow field painter</span></p></div></a></li>
                <li class="sketch col-xs-4 col-sm-2 sketchLi"><a class="sketchThumbContainer" href="/sketch/477716"><img src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail477716.jpg" data-src="https://s3.amazonaws.com/openprocessing-usercontent/thumbnails/visualThumbnail477716.jpg" class="sketchThumb"><img src="image/blank.png" class="ratioKeeper"><div class="sketchLabel"><p><span class="sketchTitle">Tetris 2017<br></span></p></div></a></li>
            </ul>
        </div>
    </div>

    <div id="followerContainer" role="tabpanel" class="tab-pane jumbotron">
        <div class="container">
            <div class="row" id="follow-row">
                <div class="col-xs-2">
                    <div class="product-container followerCard">
                        <div class="img text-center">  <img src="image/icon_follower.png" class="followerCardImg"> </div>
                        <div class="followerCardName text-center">王小明</div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="product-container followerCard">
                        <div class="img text-center">  <img src="image/icon_follower.png" class="followerCardImg"> </div>
                        <div class="followerCardName text-center">王小明</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="followingContainer" role="tabpanel" class="tab-pane jumbotron">
        <div class="container">
            <div class="row" id="follow-row">
                <div class="col-xs-2">
                    <div class="product-container followerCard">
                        <div class="img text-center">  <img src="image/icon_follower.png" class="followerCardImg"> </div>
                        <div class="followerCardName text-center">周小垂</div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="product-container followerCard">
                        <div class="img text-center">  <img src="image/icon_follower.png" class="followerCardImg"> </div>
                        <div class="followerCardName text-center">周小垂</div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="product-container followerCard">
                        <div class="img text-center">  <img src="image/icon_follower.png" class="followerCardImg"> </div>
                        <div class="followerCardName text-center">周小垂</div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="product-container followerCard">
                        <div class="img text-center">  <img src="image/icon_follower.png" class="followerCardImg"> </div>
                        <div class="followerCardName text-center">周小垂</div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="product-container followerCard">
                        <div class="img text-center">  <img src="image/icon_follower.png" class="followerCardImg"> </div>
                        <div class="followerCardName text-center">周小垂</div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="product-container followerCard">
                        <div class="img text-center">  <img src="image/icon_follower.png" class="followerCardImg"> </div>
                        <div class="followerCardName text-center">周小垂</div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="product-container followerCard">
                        <div class="img text-center">  <img src="image/icon_follower.png" class="followerCardImg"> </div>
                        <div class="followerCardName text-center">周小垂</div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="product-container followerCard">
                        <div class="img text-center">  <img src="image/icon_follower.png" class="followerCardImg"> </div>
                        <div class="followerCardName text-center">周小垂</div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="product-container followerCard">
                        <div class="img text-center">  <img src="image/icon_follower.png" class="followerCardImg"> </div>
                        <div class="followerCardName text-center">周小垂</div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <div class="product-container followerCard">
                        <div class="img text-center">  <img src="image/icon_follower.png" class="followerCardImg"> </div>
                        <div class="followerCardName text-center">周小垂</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/personalPage.js"></script>
<script type="text/javascript">
    $(function(){
        var nav=$(".tabContainer"); //得到导航对象
        var content=$(".tab-content");
        var topPanel=$("#topPanel");
        var navBar=$(".navbar");
        var win=$(window); //得到窗口对象
        var sc=$(document);//得到document文档对象。
        win.scroll(function(){
            if(sc.scrollTop()>=topPanel.height()-50){
                nav.addClass("fix");
                content.addClass("fixContent");
                navBar.addClass("fixNavBar");
            }else{
                nav.removeClass("fix");
                content.removeClass("fixContent");
                navBar.removeClass("fixNavBar");
            }
        })
    })
</script>
</body>
</html>