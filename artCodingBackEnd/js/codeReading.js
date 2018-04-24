var i=1;
function heartarrow(){
	if(i%2==1){
         i++;
	$('.icon_arrowToHeart').addClass('shoot');
	var x=document.getElementById("heartnum").innerHTML;
	x=parseInt(x)+1;
	
	document.getElementById("heartnum").innerHTML=x;
}
else{
	i++;
	$('.icon_arrowToHeart').removeClass('shoot');
	var x=document.getElementById("heartnum").innerHTML;
	x=parseInt(x)-1;
	document.getElementById("heartnum").innerHTML=x;
}
}
function post(){
	var tr=$('#comment_post').html();
	$('.comment').append(tr);
}
function startcode(URL) {
    var codeUrl = URL;
    //alert(codeUrl);
    if (window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    }
    else{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function () {
        if (xmlhttp.readyState==4 && xmlhttp.status ==200){
            var code = xmlhttp.responseText;
            editor[0].setValue(code);
        }
    }
    xmlhttp.open("GET","readCode.php?q="+codeUrl,false);
    xmlhttp.send();
}

//以下是codewriting代码
var numOfTabs = 1;
var myTextarea = document.getElementById('code0');
var editor = new Array();
	editor[0]=CodeMirror.fromTextArea(myTextarea,{
        lineNumbers: true,
        mode: "javascript",
        theme: 'eclipse',
        toggleComment: true,
        keyMap: 'sublime',
        indentWithTabs: true,
        tabSize: 2,
        foldGutter: true,
        fixedGutter: false,
		readOnly:true,
		scrollbarStyle:"null",
        gutters: ['CodeMirror-foldgutter']
      });

$(document).ready(function() { 
$('.code_title li').hover(function() { 
$(this).find('.sub-menu').css('display', 'block'); 
}, function() { 
$(this).find('.sub-menu').css('display', 'none'); 
}); 

}); 


function toogle(th){  
  var ele = $(th).children(".move");  

  var tree1=document.getElementById("java1");
  var tree2=document.getElementById("java2");
  var tree3=document.getElementById("java3");

  if(ele.attr("data-state") == "on"){  
    ele.animate({left: "2px"}, 300, function(){  
        $("#mymodal").modal("toggle");
      ele.attr("data-state", "off"); 
         tree1.innerText ="java.applet";
         tree2.innerText ="java.awt ";
         tree3.innerText ="java.awt.image";
		 for(var i=0;i<editor.length;i++){
			editor[i].setOption("mode","text/x-java");
		 }
         $(".sub-menu").addClass("sub-menu2");

         
     
    });  
    $(th).removeClass("on").addClass("off");  
  }else if(ele.attr("data-state") == "off"){  
    ele.animate({left: '52px'}, 300, function(){  
      $(this).attr("data-state", "on");  
       $("#mymodal").modal("toggle");
      tree1.innerText ="p5.dom";
         tree2.innerText ="p5.sound ";
         tree3.innerText ="p5.collide2d";
		for(var i=0;i<editor.length;i++){
			editor[i].setOption("mode","javascript");
		 }
          $(".sub-menu").removeClass("sub-menu2");
         
    
    });  
    $(th).removeClass("off").addClass("on");  
  }  
}  

function toogle2(th){ 
var ele = $(th).children(".movetab"); 
if(ele.attr("data-state") == "on"){ 
ele.animate({left: "0"}, 300, function(){ 
ele.attr("data-state", "off"); 
}); 
$(th).removeClass("on").addClass("off"); 
}else if(ele.attr("data-state") == "off"){ 
ele.animate({left: '20px'}, 300, function(){ 
$(this).attr("data-state", "on"); 
}); 
$(th).removeClass("off").addClass("on"); 
} 
}  




var i=1;

function asidecode(){
     if(i%2==1){
         i++;
     	 $('.codeOptions').removeClass('active');
		 $('#codePanel').removeClass('codeOptionsActive');
 }
 else{
     i++;
     $('.codeOptions').addClass('active');
	 $('#codePanel').addClass('codeOptionsActive');
 }
}

var panel = $('div.codeContainer');
var codeOptions = $('#codeOptions');


var themeLight = $('#lightTheme');
var themeDark = $('#darkTheme');
var themeHighContrast = $('#highContrastTheme');
var isLight = true;
var isDark = false;
var isHighContrast = false;
function removeClass(){
//	$('#codeTabs ul').removeClass('lightThemeUlColor');
//	$('#codeTabs ul').find('li').removeClass('lightThemeLiBorderColor');
	$('#codeTabs ul').removeClass('darkThemeUlColor');
	$('#codeTabs ul').find('li').removeClass('darkThemeLiBorderColor');
	$('#codeTabs ul').removeClass('highContrastThemeUlColor');
	$('#codeTabs ul').find('li').removeClass('highContrastThemeLiBorderColor');
}
themeLight.click(function(){
	themeLight.removeClass('labelInactive');
	themeDark.addClass('labelInactive');
	themeHighContrast.addClass('labelInactive');
	for(var i=0;i<editor.length;i++){
		editor[i].setOption("theme","eclipse");
	}
	panel.css("background-color","#f7f7f7");
	removeClass();
	isLight = true;
	isDark = false;
	isHighContrast = false;
//	$('#codeTabs ul').addClass('lightThemeUlColor');
//	$('#codeTabs ul').find('li').addClass('lightThemeLiBorderColor');
})
themeDark.click(function(){
	themeLight.addClass('labelInactive');
	themeDark.removeClass('labelInactive');
	themeHighContrast.addClass('labelInactive');
	for(var i=0;i<editor.length;i++){
		editor[i].setOption("theme","pastel-on-dark");
	}
	panel.css("background-color","#34302f");
	removeClass();
	$('#codeTabs ul').addClass('darkThemeUlColor');
	$('#codeTabs ul').find('li').addClass('darkThemeLiBorderColor');
	isLight = false;
	isDark = true;
	isHighContrast = false;
})
themeHighContrast.click(function(){
	themeLight.addClass('labelInactive');
	themeDark.addClass('labelInactive');
	themeHighContrast.removeClass('labelInactive');
	for(var i=0;i<editor.length;i++){
		editor[i].setOption("theme","seti");
	}
	panel.css("background-color","#0e1112");
	removeClass();
	$('#codeTabs ul').addClass('highContrastThemeUlColor');
	$('#codeTabs ul').find('li').addClass('highContrastThemeLiBorderColor');
	isLight = false;
	isDark = false;
	isHighContrast = true;
})

//console.log(editor.getValue());

var codePlay = $('#codePlay');
var codeWrite = $('#codeWrite');
var value = "";
function beforeCodePlay(){
	$('#editSketchButton').text('保存');
	$(window).resize(); 
	codePlay.addClass('selected');
	codeWrite.removeClass('selected');
	$('#codePanel').removeClass('active');
    $('#codePanel').addClass('inactive');
	$('#sketch').removeClass('inactive');
    $('#sketch').addClass('active');
	$('#editSketchPanel').removeClass('active');
	$('#editSketchPanel').addClass('inactive');
	var iframe = document.getElementById('iframe');
	var iframedocument;
	var iframeWindow;
	var javaCanRun = true;
	var jsCanRun = true;
	value = "";
	for(var i=0;i<editor.length;i++){
		if(i!=0){
			value+=" \n ";
		}
		value+=editor[i].getValue();
	}
	if(value.indexOf("draw()")==-1||value.indexOf("setup()")==-1||value.indexOf("void")==-1){
		javaCanRun = false;
	}
	if(value.indexOf("setup()")==-1||value.indexOf("draw()")==-1||value.indexOf("function")==-1){
		jsCanRun = false;
	}
	iframedocument =  iframe.contentDocument;//contentWindow.document;
	iframeWindow = iframe.contentWindow;
	iframedocument.open();
	if($(".move").attr("data-state") == "on"&&jsCanRun){
		iframedocument.write('<html><head><script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.5.16/p5.js"></script><script src="js/error.js"></script> </head><body style="margin:0;"><script>'+value+'</script></body></html>');
	}else if($(".move").attr("data-state") == "on"&&!jsCanRun){
		$("#alertContent h1").html("提示：");
		$("#alertContent p").html("确认编写的是否为JS代码<br>或代码内缺少setup和draw两个核心函数");
		$(window).resize();
		$(".floatAlert").css("display","block");
	}
	if($(".move").attr("data-state") == "off"&&javaCanRun){
		iframedocument.write('<html><head><script src="js/processing.js"></script><script src="js/error.js"></script> </head><body style="margin:0;"><script type="application/processing" target="processing-canvas">'+value+'</script><canvas id="processing-canvas"> </canvas></body></html>');
	}else if($(".move").attr("data-state") == "off"&&!javaCanRun){
		$("#alertContent h1").html("提示：");
		$("#alertContent p").html("确认编写的是否为Java代码<br>或代码内缺少setup和draw两个核心函数");
		$(window).resize();
		$(".floatAlert").css("display","block");
	}
	iframedocument.close();
}
document.getElementById("iframe").onload=function(){
	var canvas;
	if($("#move").attr("data-state") == "on"){
		canvas = window.frames['ifr'].document.getElementById("defaultCanvas0");
	}else if($("#move").attr("data-state") == "off"){
		canvas = window.frames['ifr'].document.getElementById("processing-canvas");
	}
	if(canvas!=null){
		var iframe = document.getElementById('iframe');
		iframe.style.width = canvas.width + "px";
		iframe.style.height = canvas.height + "px";
	}
};
codeWrite.click(function(){
	$('#editSketchButton').text('保存');
	codeWrite.addClass('selected');
	codePlay.removeClass('selected');
	$('#codePanel').removeClass('inactive');
    $('#codePanel').addClass('active');
	$('#sketch').removeClass('active');
    $('#sketch').addClass('inactive');
	$('#editSketchPanel').addClass('inactive');
})




function addPage(){

	//console.log("add");
	document.getElementById("toptab").innerHTML+="<li class=\"selected\" contenteditable=\"false\" onClick=\"tabSelect(this)\"  ondblclick=\"changename(this)\" onblur=\"returnname(this)\">新草图<div contenteditable=\"false\" class=\"icon icon_x_small_dark tabCloseButton\" id=\"tabCloseButton"+ numOfTabs+"\" onclick=\"remove(this)\"></div></li>";
	for(var i=0;i<editor.length;i++){
		$("#tabCloseButton"+i).parent().removeClass("selected");
	}
	$("#codeOptions").before("<div class=\"codePane selected\"><textarea class=\"col-md-12 code\" id=\"code" + numOfTabs + "\" autocorrect=\"off\" autocapitalize=\"off\" spellcheck=\"false\" style=\"display: none;\"></textarea>");
	var addTextarea = document.getElementById('code'+numOfTabs);
		editor[numOfTabs] = CodeMirror.fromTextArea(addTextarea,{
			lineNumbers: true,
			mode: "javascript",
			//theme: 'eclipse',
			toggleComment: true,
			keyMap: 'sublime',
			indentWithTabs: true,
			tabSize: 2,
			foldGutter: true,
			fixedGutter: false,
			readOnly:true,
			gutters: ['CodeMirror-foldgutter']
		  });
	if(isLight){
		editor[numOfTabs].setOption("theme","eclipse");
	}else if(isDark){
		editor[numOfTabs].setOption("theme","pastel-on-dark");
		$("#tabCloseButton"+numOfTabs).parent().addClass("darkThemeLiBorderColor");
	}else if(isHighContrast){
		editor[numOfTabs].setOption("theme","seti");
		$("#tabCloseButton"+numOfTabs).parent().addClass("highContrastThemeLiBorderColor");
	}
	for(var i=0;i<editor.length-1;i++){
		$("#code"+i).parent().removeClass("selected");
	}
	numOfTabs++;
}
function tabSelect(e){
	var str = $(e).children('div').attr('id');
	var num = parseInt(str.replace(/[^0-9]/ig,""));
	for(var i=0;i<editor.length;i++){
		$("#tabCloseButton"+i).parent().removeClass("selected");
	}
	for(var i=0;i<editor.length;i++){
		$("#code"+i).parent().removeClass("selected");
	}
	$(e).addClass("selected");
	$("#code"+num).parent().addClass("selected");
}

$(window).resize(function(){
	$("#alertContent").css({
		position:"absolute",
		left: ($(window).width() - $("#alertContent").outerWidth())/2, 
        top: ($(window).height() - $("#alertContent").outerHeight())/2 
	});
});

//4.23
function doClose(){
    $('.newCommentContainer ').removeClass('active');
    $('.comments ').removeClass('active');
    $("#comtextarea").empty();
}

function comtextarea(event){
	 if(window.event) event.cancelBubble = true;
    else evt.stopPropagation();
	$('.newCommentContainer ').addClass('active');
	$('.comments ').addClass('active');
	return false;
}
function sendCancel(){
	$('.newCommentContainer ').removeClass('active');
    $('.comments ').removeClass('active');
}
function sendcom(){
	if($("#comtextarea").text()=="")
	{
		console.log("send");
		$('.newCommentContainer ').removeClass('active');
    $('.comments ').removeClass('active');
    return false;
	}else{


	var oBox = document.createElement("div");
	
    oBox.className = "box";
    var oDiv = document.createElement("div");

   oDiv.className = "nicheng";
   oDiv.innerHTML = "lynn";

   oBox.appendChild(oDiv);

var oDiv = document.createElement("div");
oDiv.className = "pinglun";
oDiv.innerHTML = $("#comtextarea").text();
$("#comtextarea").text("");
oBox.appendChild(oDiv);

var oDiv = document.createElement("div");
oDiv.className = "shijian";
var oDate = new Date();
oDiv.innerHTML =oDate.getFullYear()+"年"+(oDate.getMonth()+1)+"月"+oDate.getDate()+"日      "+"<a href='javascript:;'>删除</a> <hr>";

oBox.appendChild(oDiv);

	var oUl1 = document.getElementById("ul1");
	oUl1.appendChild(oBox);
	
var aA = oDiv.getElementsByTagName("a");
 
for(var i = 0;i<aA.length;i++)
{
aA[i].onclick=function(){
	console.log("delete");
   //oUl1.removeChild(this.parentNode);
  oDiv.parentNode.remove();

}
}
 
}
}
