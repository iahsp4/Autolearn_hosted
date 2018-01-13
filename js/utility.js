

/*Loads the registered vehicle classes for the Given NIC
 *Used in:home.php,student_details.php
 */
function loadStudentClasses(nic,elementId){			
	 $.ajax({
		 type:"POST",
		 url:"db_scripts/load_rlvnt_clses.php",
		 data:{chk:nic},
		 success:function(response){
			 //console.log(response);
			  var data=JSON.parse(response);
			  if(data.status==1){
			   elementId.empty(); 
			   for(x in data.clvpairs){
				 var option = '<option value="'+data.clvpairs[x].id+'">'+data.clvpairs[x].value+'</option>';
				 elementId.append(option);   
			   }
			  }
			  else{
				
			  }
		 }
 	});
}