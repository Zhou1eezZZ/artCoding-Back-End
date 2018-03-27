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