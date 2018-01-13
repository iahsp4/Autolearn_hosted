$(function(){
	 //Student_reg.php
	 $('#loadimg').click(function(){
		$('#img_upload_modal').modal('show'); 
		return false;
	 });
	 
	 
	 //Student Details.php
	 $('#changeimg').click(function(){
		$('#img_change_modal').modal('show'); 
		return false;
	 });
	 
	 
	 $('#img_ch_frm').submit(function(e){
		$.ajax({
			type: "POST",
			url:  "./upload.php",
			data: new FormData(this),
      		processData: false,
      		contentType: false,
			success:function(response){
			  console.log(response);
			  var data=JSON.parse(response);
			  if(data.status==1){
	 				$('#img_change_modal').modal('hide');
				    $('#stu_img').attr('src','uploads/'+data.fn);
			  }
			  else{
				  	$('#img_change_modal').modal('hide');
					alert(data.message);
				  }
			},
			error:function(jqXHR, exception) {
			  handle_ajax_err(jqXHR, exception);
		    }
		});
		return false;
	});
	
	


});	//End of Document.Ready()
	 
	 
	 
	 
	 
	 /*
	 *Load Student Image to-----Student_details.php
	 */ 
	 function load_stu_img(snic){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/load_stu_img.php",
			data:  {nic:snic},
			success:function(response){
				 var data=JSON.parse(response);
				 if(data.status==1){
					$('#stu_img').attr('src','uploads/'+data.image_name); 
				 }
				 else if(data.status==0){
					$('#stu_img').attr('src','Images/facebook-default-no-profile-pic.jpg'); 
				 }
				else{}
			},
			error:function(jqXHR, exception) {
			   handle_ajax_error(jqXHR, exception);
		    },
		 });
	}
	
	
	
	
