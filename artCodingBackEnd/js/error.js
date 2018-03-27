onerror=handleErr
var txt=""

function handleErr(msg,url,l)
{
	txt+="错误类型: " + msg + "<br><br>"
	txt+="出错行数:第 " + l + " 行<br><br>"
	txt+="点击下方按钮继续<br><br>"
	var floatAlert = window.parent.document.getElementById("floatAlert");
	var alertTitle = window.parent.document.getElementById("alertTitle");
	var alertP = window.parent.document.getElementById("alertP");
	alertTitle.innerHTML = "控制台提示：";
	alertP.innerHTML = txt;
	floatAlert.style.display = "block";
	return true
}