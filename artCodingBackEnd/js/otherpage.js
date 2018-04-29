function follow() {
              if($('#followButton').text()=="关注TA"){
                     var msg = "您要关注此人吗?"; 
 					if (confirm(msg)==true){ 
  					$('#followButton').text('已关注');
 					}else{ 
  					$('#followButton').text("关注TA");
                 } 
              	 i++;
              }
              else{
              	
              		var msg2 = "您要取消关注此人吗?"; 
              	if (confirm(msg2)==true){ 
  					$('#followButton').text('关注TA');
 					}else{ 
  					$('#followButton').text("已关注");
                 } 
              	  i++;              	
              }
            
          }