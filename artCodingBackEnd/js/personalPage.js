// JavaScript Document
var isListView = false;
var icon = document.getElementById("listToggle");
var hl = document.getElementById("heartsList");
var iconurl = new Image();
function setListView(){
    if(isListView){
        icon.classList.remove("listView");
        hl.classList.remove("listView");
        isListView = false;
    }else{
        icon.classList.add("listView");
        hl.classList.add("listView");
        isListView = true;
    }
}

var i=1;

function loag() {
    var btn = $("#eiditButton");
    if (i % 2 == 1) {
        btn.val('active');
        i++;
        document.getElementById('editButton').innerHTML = '保存';

        $('#topPanel').addClass('edit');
        $('#fullname').addClass('edit');
        $('#location').addClass('edit');
        document.getElementById("fullname").contentEditable = true;
        document.getElementById("location").contentEditable = true;
        $('#passwordField').addClass('hide');


        $('#additionalFormFields').removeClass('fadeInOnEdit hide');
        $('#changepic').removeClass('row fadeInOnEdit hide');
        $('#content').hide();
        $('#toptabs').hide();
        $('#describeme').hide();

        $('#changePasswordLink').on('click', function (e) {
            $(this).hide();
            $('#changePassword').addClass('active');
            $('#passwordField').removeClass('hide').focus();
            return false;
        });
    }
    else {
        document.getElementById('editButton').innerHTML = '编辑';
        i++;

        $('#topPanel').removeClass('edit');
        $('#fullname').removeClass('edit');
        $('#location').removeClass('edit');
        document.getElementById("fullname").contentEditable = false;
        document.getElementById("location").contentEditable = false;
        $('#passwordField').removeClass('hide');

        $('#additionalFormFields').addClass('fadeInOnEdit hide');
        $('#changepic').addClass('row fadeInOnEdit hide');
        $('#content').show();
        $('#toptabs').show();
        $('#describeme').show();

        btn.button('loading');
        setTimeout(function () {
            btn.val('normal');
        }, 500);
    }


}

<!--更改头像-->
function readFiles(evt){
    var files=evt.target.files;

    if(!files){
        console.log("the file is invaild");
        return;
    }
    for(var i=0, file; file=files[i]; i++){
        var imgele=new Image();
        var thesrc=window.URL.createObjectURL(file);
        imgele.src=thesrc;
        imgele.onload=function(){
            $("#toppic").attr("src",this.src);
        }
    }
}


$(document).ready(function(){
    $("#logoimg").change(function(e){
        readFiles(e)
    });
});

function foo(){
    if(confirm("确定要退出登录吗？")){
        window.location.href="logout.php";
        return true;
    }
    return false;
}
function changePassword(){
    $("#passwordConfirmTips").css("display","block");
    $("#changePassword1").css("display","block");
    $("#changePassword2").css("display","block");
}
function checkPasswordFiled(){
    $("#passwordConfirmTips").css("display","none");
}
function checkPW(){
    var pwd1 = document.getElementById("newPasswordField1").value;
    var pwd2 = document.getElementById("newPasswordField2").value;

    if(pwd1 == pwd2){
        document.getElementById("newPasswordTips").style.display = "none";
    }else{
        document.getElementById("newPasswordTips").style.display = "block";
    }
}

<!--压缩头像-->
function imgChange(e){
    var file = e.target.files[0];
    var img = new Image();
    var imgFile;
    var reader = new FileReader();
    reader.onload = function(e){
        imgFile = e.target.result;
        img.src = imgFile;
    };
    reader.readAsDataURL(file);
    var canvas = document.createElement('canvas');
    canvas.width = img.width;
    canvas.height = img.height;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(img,0,0,canvas.width,canvas.height);
    var url = canvas.toDataURL("image/*",0.4);
    $('#logoimg').src = url;
}

function submit(){
    loag();
    if(document.getElementById('editButton').innerHTML=='编辑'){
        var r = confirm("确认提交资料吗？");
        if (r==true){
            var name = document.getElementById("fullname").innerText;
            var city = document.getElementById("location").innerText;
            var phone = document.getElementById("phone").value;
            var motto = document.getElementById("motto").value;
            var oldpsw = document.getElementById("passwordField").value;
            var newpsw_one = document.getElementById("newPasswordField1").value;
            var newpsw_two = document.getElementById("newPasswordField2").value;
            iconurl = canvas.toDataURL("image/png",0.1);
            $.ajax({
                type:"post",
                url:"savePersonalInformation.php",
                data:{name:name,city:city,phone:phone,motto:motto,oldpsw:oldpsw,newpsw_one:newpsw_one,newpsw_two:newpsw_two},
                dataType:"json",
                success:function (msg) {
                    var data='';
                    if (msg!=''){
                        data = eval("("+msg+")");
                    }
                    if (data.su == 'success'){
                        alert("修改信息成功");
                    }else if(data.su=='psw_short'){
                        alert('新密码至少6位，请重新填写');
                    }else if(data.su == 'psw_different'){
                        alert('两次密码输入不同，请重新填写');
                    }else if(data.su == 'old_psw_different'){
                        alert('原密码不正确，请重新输入密码');
                    }
                }
            });
        }else {
            alert("You pressed Cancel!");
        }
    }
}