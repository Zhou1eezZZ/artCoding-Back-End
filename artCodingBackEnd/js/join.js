$(function(){
	init_city_select($("#sel1"));
});

function generalUser(){
	$("#schoolRow").css("display","none");
	$("#studentIDRow").css("display","none");
	$("#teacherIDRow").css("display","none");
}

function studentUser(){
	$("#schoolRow").css("display","block");
	$("#studentIDRow").css("display","block");
	$("#teacherIDRow").css("display","none");
}

function teacherUser(){
	$("#schoolRow").css("display","block");
	$("#studentIDRow").css("display","none");
	$("#teacherIDRow").css("display","block");
}

function checkPW(){
	var pwd1 = document.getElementById("password").value;
	var pwd2 = document.getElementById("passwordCheck").value;
	
	if(pwd1 == pwd2){
		document.getElementById("passwordTips").style.display = "none";
	}else{
		document.getElementById("passwordTips").style.display = "block";
	}
}