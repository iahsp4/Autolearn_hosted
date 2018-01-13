$(document).ready(function()
{
			
	var date=setdate();
	$('#datxe').html(date);
   
  	function setdate(){
	  var currentDate = new Date();
	  var y=currentDate.getFullYear();
	  var m=currentDate.getMonth()+1;
	  var d=currentDate.getDate();
	  
	  var prints = d+"/"+m+"/"+y;
	  
	  return prints;
	
	}
}
);