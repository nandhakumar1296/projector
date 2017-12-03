// JavaScript Document
function updateBookstatus(date,day,hour,type){
	$.ajax({                                      
      url: 'php/block.php',
      data: "date="+date+"&day="+day+"&hour="+hour+"&type="+type,
	  type:"POST",                        
      success: function(data){
		  alert(data);
		  location.reload();
	  }
    });	
	
}
function updateCancelstatus(date,day,hour,type){
	$.ajax({                                      
      url: 'php/unblock.php',
      data: "date="+date+"&day="+day+"&hour="+hour+"&type="+type,
	  type:"POST",                        
      success: function(data){
		  alert(data);
		  location.reload();
	  }
    });	
	
}

function updatePage() {
	location.reload();
}