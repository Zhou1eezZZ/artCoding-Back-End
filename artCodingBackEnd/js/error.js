onerror=handleErr
var txt=""

function getTabName(l){
	var editorNum = parent.editor.length;
	for(var i = 0;i < editorNum;i++){
		if(l<=parent.editor[i].lineCount()){
			var tabName = $("#toptab",parent.document).children().eq(i).text();
			return tabName;
		}else{
			l = l - parent.editor[i].lineCount();
		}
	}
}

function getLine(l){
	var editorNum = parent.editor.length;
	for(var i = 0;i < editorNum;i++){
		if(l<=parent.editor[i].lineCount()){
			return l;
		}else{
			l = l - parent.editor[i].lineCount();
		}
	}
}


function handleErr(msg,url,l)
{
	txt+="出错TAB: " + getTabName(l) + "<br><br>"
	txt+="出错url: " + url + "<br><br>"
	txt+="出错行数:第 " + getLine(l) + " 行<br><br>"
	txt+="错误类型: " + msg + "<br><br>"
	var floatAlert = window.parent.document.getElementById("floatAlert");
	var alertTitle = window.parent.document.getElementById("alertTitle");
	var alertP = window.parent.document.getElementById("alertP");
	alertTitle.innerHTML = "控制台提示：";
	alertP.innerHTML = txt;
	floatAlert.style.display = "block";
	return false;
}
