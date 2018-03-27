// JavaScript Document
var isListView = false;
var icon = document.getElementById("allWorksPageIcon");
var sr = document.getElementById("searchResults");

function setListView(){
	if(isListView){
		icon.classList.remove("listView");
		sr.classList.remove("listView");
		isListView = false;
		console.log("list");
		 $('#sketchLabel01').addClass('row fadeInOnEdit hide');
		 $('#sketchLabel02').addClass('row fadeInOnEdit hide');
		 $('#sketchLabel03').addClass('row fadeInOnEdit hide');
		  $('#sketchLabel04').addClass('row fadeInOnEdit hide');
		 $('#sketchLabel05').addClass('row fadeInOnEdit hide');

	}else{
		icon.classList.add("listView");
		sr.classList.add("listView");
		isListView = true;
		 $('#sketchLabel01').removeClass('row fadeInOnEdit hide');
		 $('#sketchLabel02').removeClass('row fadeInOnEdit hide');
		 $('#sketchLabel03').removeClass('row fadeInOnEdit hide');
		  $('#sketchLabel04').removeClass('row fadeInOnEdit hide');
		 $('#sketchLabel05').removeClass('row fadeInOnEdit hide');


	}
}