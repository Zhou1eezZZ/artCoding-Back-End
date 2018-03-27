<?php
    include 'conn.php';
    header("Content-type:text/html;charset=utf-8");
    $codeID = $_GET['codeID'];
    //$codeID = 15;
    //利用项目ID查询url
    $sql = "select * from project where 项目ID = '$codeID'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $codeUrl = $row['项目内容地址'];
    $userID = $row['发布者ID'];
    if (!$codeUrl){
        exit('此作品已删除');
    }
    //标题
    $title = $row['标题'];
    //描述
    $description = $row['描述'];
    //操作方法
    $instructions = $row['操作方法'];
    //分类
    $tags = $row['分类'];
    //查询userbasic表，通过userID查询到昵称
    $sql2 = "select * from userbasic where ID = '$userID'";
    $result2 = mysql_query($sql2);
    $row2 = mysql_fetch_array($result2);
    $name = $row2['昵称'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>codeReading</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0, target-densitydpi=device-dpi">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="CodeMirror/lib/codemirror.css">
    <link rel="stylesheet" href="CodeMirror/theme/eclipse.css">
    <link rel="stylesheet" href="CodeMirror/theme/pastel-on-dark.css">
    <link rel="stylesheet" href="CodeMirror/theme/seti.css">
    <link rel="stylesheet" href="CodeMirror/addon/fold/foldgutter.css">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/sketch_view.css">

    <link rel="stylesheet" href="css/codeWriting.css">
    <link rel="stylesheet" href="css/codeReading.css">

    <script src="CodeMirror/lib/codemirror.js"></script>
    <script src="CodeMirror/mode/javascript/javascript.js"></script>
    <script src="CodeMirror/mode/clike/clike.js"></script>
    <script src="CodeMirror/addon/fold/brace-fold.js"></script>
    <script src="CodeMirror/addon/fold/comment-fold.js"></script>
    <script src="CodeMirror/addon/fold/foldcode.js"></script>
    <script src="CodeMirror/addon/fold/foldgutter.js"></script>
    <script src="CodeMirror/addon/fold/indent-fold.js"></script>
    <script src="CodeMirror/addon/comment/comment.js"></script>
    <script src="CodeMirror/addon/comment/continuecomment.js"></script>
    <script src="CodeMirror/keymap/sublime.js"></script>
    <script> var codeUrl = "<?php echo $codeUrl?>";  </script>
</head>

<body class="codeMode codeOptionsActive" style="background-color: rgb(100,100,100);" onload="startcode(codeUrl)">
    <div class="alertContent" id="alertContent">
        <h1 id="alertTitle" style="margin-bottom: 20px;">Test</h1>
        <p id="alertP">test<br>test</p>
        <div class="alertButton" onClick="alertConfirm()">知道了</div>
    </div>
</div>
<div class="modal" id="mymodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">提示</h4>
            </div>
            <div class="modal-body"><p>您已切换语言，相应的库将会改变！</p></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>

            </div>
        </div>
    </div>
</div>
<div class="navbar navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="row iconsRow">
            <div id="websiteControls">
                <div class="OPlogo icon">
                    <a href="index.php" id="logoLight">
                        <img alt="logo" src="image/logo.png" width="50" height="40">
                    </a>
                    <a href="index.php" onClick="return goIndex();" id="logoDark">
                        <img src="image/logoHover.png" width="50" height="40">
                    </a>
                </div>
                <ul id="navPath"></ul>
                <div class="icons">

                </div>
            </div>

            <div class="col-xs-3  col-sm-5">

                <div class="code_title">
                    <ul>
                        <li class="first">文件
                            <ul class="sub-menu">
                                <li onclick="addPage()">新建</li>
                                <li>保存</li>
                                <li>另存为</li>
                            </ul>
                        </li>

                        <li class="first">编辑
                            <ul class="sub-menu">
                                <li>排版</li>
                                <li>查找</li>

                            </ul>
                        </li>
                        <li class="first">库
                            <ul class="sub-menu sub-last">
                                <li>
                                    <div class="col-xs-6  col-sm-6"  id="java1">
                                        p5.dom
                                    </div>
                                    <div class="col-xs-6  col-sm-6">
                                        <div class="switchtab">
                                            <div class="btn_fathtab clearfix on" onclick="toogle2(this)">
                                                <div class="movetab" data-state="on"></div>
                                                <div class="btnSwitchtab btn1">开</div>
                                                <div class="btnSwitchtab btn2 ">关</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="col-xs-6  col-sm-6" id="java2">p5.sound</div>
                                    <div class="col-xs-6  col-sm-6">
                                        <div class="switchtab">
                                            <div class="btn_fathtab clearfix on" onclick="toogle2(this)">
                                                <div class="movetab" data-state="on"></div>
                                                <div class="btnSwitchtab btn1">开</div>
                                                <div class="btnSwitchtab btn2 ">关</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-xs-6  col-sm-6"  id="java3">p5.collide2d</div>
                                    <div class="col-xs-6  col-sm-6">
                                        <div class="switchtab">
                                            <div class="btn_fathtab clearfix on" onclick="toogle2(this)">
                                                <div class="movetab" data-state="on"></div>
                                                <div class="btnSwitchtab btn1">开</div>
                                                <div class="btnSwitchtab btn2 ">关</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li class="first">
                            <div class="switch">
                                <div class="btn_fath clearfix on" onclick="toogle(this)">
                                    <div class="move" id="move" data-state="on"></div>
                                    <div class="btnSwitch btn1">JS</div>
                                    <div class="btnSwitch2 btn2 ">JAVA</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div id="mainControls" class="col-xs-6  col-sm-2 text-center">
                <div class="icon icon_play" id="codePlay" data-target="#sketch" onclick="beforeCodePlay()"></div>
                <div class="icon icon_code selected" id="codeWrite" data-target="#codePanel"></div>
            </div>

            <div id="sideWrapper" class="col-xs-3 col-sm-5">
                <div id="sideButtons" class="text-right pull-right">
                    <button id="editSketchButton" class="btn btn-primary" onclick="save()">保存</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="sketch" class="inactive" style="background-color:rgb(100,100,100);">
    <iframe id="iframe" name="ifr"></iframe>

</div>

<div id="editSketchPanel" class="panel OPLiveForm edit inactive">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div id="screenshot" class="sketchThumb hideUntilLoaded" style="background-image: url();"></div>
                <input name="sketchThumb" type="hidden" value="">
                <input name="codeObjects" type="hidden" value="">
                <input name="mode" type="hidden" value="2">
                <input type="hidden" name="visualID" value="-1000">
                <input type="hidden" name="saveAsNew" value="true">
                <input type="hidden" name="parentID" value="">
                <input type="hidden" name="imports" value="">
                <input type="hidden" name="customLibraries" value="[]">
                <input type="hidden" name="engineID" value="24">
            </div>
        </div>
        <div class="row">
            <formitem class="col-xs-12 col-md-push-2 col-md-8 ">
                <label>标题</label>
                <h1 class="sketchTitle editable bariol edit toTextarea" spellcheck="false" id="title" name="title" contenteditable="true">我的草图</h1>
            </formitem>
        </div>
        <div class="row">
            <formitem class="col-xs-12 col-sm-8 col-md-push-2 col-md-6">
                <label>描述</label>
                <input class="editable edit toTextarea" id="description" name="description" contenteditable="true" style="color:#f5f5f5"></input>
            </formitem>
        </div>
        <div class="row">
            <formitem class="col-xs-12 col-sm-8 col-md-push-2 col-md-6">
                <label>如何<br>操作</label>
                <input class="editable edit toTextarea" id="instructions" name="instructions" contenteditable="true" style="color:#f5f5f5"></input>
                <div class="description">鼠标，键盘或其他</div>
            </formitem>
        </div>

        <div class="row">
            <formitem class="col-xs-12 col-sm-8 col-md-offset-2 col-md-6">
                <label>标签</label>
                <input type="text" class="tags field" id="tags" name="tags" label="tags" description="use commas" value="" style="color:#f5f5f5"></input>
                <div class="description">可视化，不规则，鼠标..</div>

            </formitem>
            <formitem class="col-xs-6  col-sm-4 col-md-2">
                <div class="private toggleable edit" name="private" label="私有"></div>

            </formitem>

        </div>
        <div class="row">
            <div class=" col-xs-12 col-md-offset-2 col-md-4">
                <p>
                    <br><a id="deleteSketchLink" href="#">删除草图?</a>
                </p>
            </div>
        </div>
    </div>
</div>



    <div id="codePanel" class="panel container codeOptionsActive active">
    <div class="row">
        <div id="codeTabs" class="show">
            <ul id="toptab">

                <li class="selected" id="hh" onClick="tabSelect(this)">我的草图<div class="icon icon_x_small_dark tabCloseButton"  id="tabCloseButton0"></div></li>

            </ul>

        </div>
        <div class="codeContainer col-xs-12 tabPadding fontSize">

            <div class="codePane selected">
                <textarea class="col-md-12 code" id="code0" autocorrect="off" autocapitalize="off" spellcheck="false" style="display: none;"></textarea>
            </div>

            <div class="codeOptions hidden-xs active" id="codeOptions">
                <div class="icon icon_edit_dark"  id="sidecode" onclick="asidecode()" ></div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">

                    <li role="presentation" class="active"><a href="#codeSettings" aria-controls="codeSettings" role="tab" data-toggle="tab">作品介绍</a></li>

                    <li role="presentation" class><a id="filesLink" href="#sketchFiles" aria-controls="sketchFiles" role="tab" data-toggle="tab">相关评论</a></li>

                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="codeSettings">
                        <div id="DescribeModeOptions" class="radioGroup row">
                            <settinglabel class="col-xs-12">
                                <div id="screenshot" class="sketchThumb hideUntilLoaded" style="background-image: url();"></div>
                            </settinglabel>

                            <!--根据作品ID进行检索，得到相应的作评介绍-->
                            <settinglabel class="col-xs-12">
                                <div class="row">
                                    <formitem class="col-xs-12  col-md-12 ">
                                        <label>标题</label>
                                        <div class="sketchTitle editable bariol edit toTextarea" spellcheck="false" name="title" contenteditable="false"><?php echo $title; ?></div>
                                    </formitem>
                                </div>
                                <div class="row">
                                    <formitem class="col-xs-12 col-sm-12  col-md-12">
                                        <label>描述</label>
                                        <div class="editable edit toTextarea" name="description" contenteditable="false"><?php echo $description; ?></div>
                                    </formitem>
                                </div>
                                <div class="row">
                                    <formitem class="col-xs-12 col-sm-12  col-md-12">
                                        <label>如何
                                            <br>操作</label>
                                        <div class="editable edit toTextarea" name="instructions" contenteditable="false"><?php echo $instructions;?></div>
                                        <!-- <div class="description">鼠标，键盘或其他</div> -->
                                    </formitem>
                                </div>

                                <div class="row">
                                    <formitem class="col-xs-12 col-sm-12  col-md-12">
                                        <label>标签</label>
                                        <div class="editable edit toTextarea" name="instructions" contenteditable="false"><?php echo $tags?></div>
                                        <!-- <div class="description">可视化，不规则，鼠标..</div> -->
                                    </formitem>
                                </div>

                                <div class="row">
                                    <formitem class="col-xs-12 col-sm-12  col-md-12">
                                        <label>素材</label>
                                        <div class="editable edit toTextarea" name="instructions" contenteditable="false"></div>
                                    </formitem>
                                </div>
                            </settinglabel>
                        </div>
                    </div>

                    <!--通过作评ID，得到相关评论-->
                    <div role="tabpanel" class="tab-pane" id="sketchFiles">
                        <div id="comentOptions" class="radioGroup row">
                            <settinglabel class="col-xs-12">
                                <div class="comments row">
                                    <div class="comment col-sm-12">
                                        <h3 class="commentName bariol">
                                            <!--此处根据作品用户的id搜寻进入用户个人页面-->
                                            <a href="#"><?php echo $name;?></a>
                                            <hr>
                                        </h3>
                                        <div class="commentBody">go!</div>
                                        <div class="commentMeta">
                                            <hr>
                                            <div class="row">
                                                <div class="commentDate col-sm-8">Just now</div>
                                                <div class="col-sm-4 text-right">
                                                    <div class="icon icon_flag" data-toggle="modal" data-target="#flagCommentModal"></div>
                                                    <div class="icon icon_delete" data-toggle="modal" data-target="#deleteCommentModal"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="newCommentContainer row">
                                    <div class="newComment">
                                        <div class="textarea toTextarea toTextarea-placeholder empty" contenteditable="true" data-placeholder="来踩一脚？" id="comment_post"></div>
                                        <div class="buttonContainer">
                                            <button type="button" class="btn btn-primary red " onclick="post()">发布</button>
                                            <button type="button" class="btn btn-secondary ">取消</button>
                                        </div>
                                    </div>
                                </div>
                            </settinglabel>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/codeWriting.js"></script>
    <script src="js/codeReading.js"></script>

</body>
</html>