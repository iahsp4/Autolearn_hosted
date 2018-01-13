/*
 *Functions related to Student_details.php
 *Student_details ADD,EDIT and REMOVE
 *
 */








//ADD DATA FUNCTIONS-----------------------------------------------------------------------------------------------------------
function add_payment_data(nic){
	if($('#add_payment_frm').valid()){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/add_payment_data.php",
			data:  $('#add_payment_frm').serializeArray(),
			success:function(response){
				//console.log(response);
				var data = JSON.parse(response);
				if(data.status==1){
				   $('#add_pay_modal').modal('hide');
				}
				else{	
				   $('#add_pay_modal').modal('hide'); 
				   //alert('add faild');
				}
			},
		    error:function(jqXHR, exception) {
			    $('#add_pay_modal').modal('hide');
			    handle_ajax_error(jqXHR, exception);
			},
			complete:function(){
			 load_payment_data(nic);	
			}
	   });
	}
}
	
	
	
	
function add_exam_data(nic){
	if($('#add_exm_frm').valid()){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/add_exam_data.php",
			data:  $('#add_exm_frm').serializeArray(),
			success:function(response){
			    //console.log(response);
				var data = JSON.parse(response);
				if(data.status==1){
				   $('#add_exm_modal').modal('hide');
				}
				else{	
				   $('#add_exm_modal').modal('hide'); 
				}
			},
		    error:function(jqXHR, exception) {
			    $('#add_exm_modal').modal('hide');
			    handle_ajax_error(jqXHR, exception);
			},
			complete:function(){
				load_exam_data(nic);
			}
	    });
	}
}
	
	

function add_trial_data(nic){
	if($('#add_tr_frm').valid()){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/add_trial_data.php",
			data:  $('#add_tr_frm').serializeArray(),
			success:function(response){
			    //console.log(response);
				var data = JSON.parse(response);
				if(data.status==1){
				   $('#add_tr_modal').modal('hide');
				}
				else{	
				   $('#add_tr_modal').modal('hide'); 
				}
			},
		    error:function(jqXHR, exception) {
			    $('#add_tr_modal').modal('hide');
			    handle_ajax_error(jqXHR, exception);
			},
			complete:function(){
			 load_exam_data(nic);	
			}
	    });
	}
}
	
	

function add_attendance(modalId,formId){
	//console.log(modalId+" "+formId);
	if(formId.valid()){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/add_attendance.php",
			data:  formId.serializeArray(),
			success:function(response){
				console.log(response);
				var data = JSON.parse(response);
				if(data.status==1){
				   modalId.modal('hide');
				}
				else{	
				   modalId.modal('hide'); 
				}
			},
		    error:function(jqXHR, exception) {
			    modalId.modal('hide');
			    handle_ajax_error(jqXHR, exception);
			}
	    });
	}
}
function add_attendance_data(modalId,formId,nic){
	//console.log(modalId+" "+formId);
	if(formId.valid()){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/add_attendance.php",
			data:  formId.serializeArray(),
			success:function(response){
				//console.log(response);
				var data = JSON.parse(response);
				if(data.status==1){
				   modalId.modal('hide');
				}
				else{	
				   modalId.modal('hide'); 
				}
			},
		    error:function(jqXHR, exception) {
			    modalId.modal('hide');
			    handle_ajax_error(jqXHR, exception);
			},
			complete:function(){
				load_attendance_data(nic);
			}
	    });
	}
}
	

	



//EDIT DATA FUNCTIONS-----------------------------------------------------------------------------------------------------------
function edit_basic_data(snic)
{
	$.ajax({
			type:  "POST",
			url:   "db_scripts/edit_basic_data.php",
			data:  $('#ld_basic_data').serializeArray(),
			success:function(response){
				var data = JSON.parse(response);
				if(data.status==1){
				   alert("edit done");
				}
				else{	
				   alert("edit failed");
				}
			},
			error:function(jqXHR, exception) {
			    handle_ajax_error(jqXHR, exception);
			},
			complete:function(){
			  load_basic_data(snic)	
			}
		  });
}



function edit_course_data(nic)
{
	  //create a string to be converted to a JSON String
	  var data_String = "";
	  var checkedvalues='';
	  var sid=$('#edit_course_data_form input[name="stu_id"]').val();
	  $('#edit_course_data_form input:checked').each(function(i){
		  if(checkedvalues==""){
		  	checkedvalues=($(this).attr('value'));
		  }
		  else{
		    checkedvalues=checkedvalues+","+($(this).attr('value'));
		  }
	  });
	 
	  var cat = $('#s_type').val();
	  if(cat=="2"){
		var days=$('#s_days').val();
		data_String = {category:cat,day:days,checkedvals:checkedvalues,stu_id:sid};
	  }
	  else{
		data_String = {category:cat,checkedvals:checkedvalues,stu_id:sid};
	  }
	 
	  $.ajax({
			type:  "POST",
			url:   "db_scripts/edit_course_data.php",
			data:  data_String,
			success:function(response){
				//console.log(response);
				var data = JSON.parse(response);
				if(data.status==1){
				   alert("edit done");
				}
				else{	
				   alert("edit failed");
				}
			},
			error:function(jqXHR, exception) {
			    handle_ajax_error(jqXHR, exception);
			},
			complete:function(){
			 load_course_data(nic);	
			}
		});
}



function edit_payment_data(nic){
	if($('#add_payment_frm').valid()){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/edit_pay_data.php",
			data:  $('#add_payment_frm').serializeArray(),
			success:function(response){
				var data = JSON.parse(response);
				if(data.status==1){
				   $('#add_pay_modal').modal('hide');
				}
				else{	
				   $('#add_pay_modal').modal('hide'); 
				   alert('add faild');
				}
			},
		    error:function(jqXHR, exception) {
			    $('#add_pay_modal').modal('hide');
			    handle_ajax_error(jqXHR, exception);
			},
			complete:function(){
			 load_payment_data(nic);	
			}
	    });
    }
}




function edit_exam_data(nic){
 	if($('#add_exm_frm').valid()){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/edit_exam_data.php",
			data:  $('#add_exm_frm').serializeArray(),
			success:function(response){
			    //console.log(response);
				var data = JSON.parse(response);
				if(data.status==1){
				   $('#add_exm_modal').modal('hide');
				}
				else{	
				   $('#add_exm_modal').modal('hide'); 
				   alert('add faild');
				}
			},
		    error:function(jqXHR, exception) {
			   $('add_exm_modal').modal('hide');
			   handle_ajax_error(jqXHR, exception);
			},
			complete:function(){
			 load_exam_data(nic);	
			}
	    });
	}
}




function edit_trial_data(nic){
	if($('#add_tr_frm').valid()){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/edit_trial_data.php",
			data:  $('#add_tr_frm').serializeArray(),
			success:function(response){
			    //console.log(response);
				var data = JSON.parse(response);
				if(data.status==1){
				   $('#add_tr_modal').modal('hide');
				}
				else{	
				   $('#add_tr_modal').modal('hide'); 
				   alert('add faild');
				}
			},
		    error:function(jqXHR, exception) {
			   $('add_tr_modal').modal('hide');
			   handle_ajax_error(jqXHR, exception);
			},
			complete:function(){
			 load_exam_data(nic);	
			}
	    });
	}
}




function edit_attendance_data(nic){
	if($('#add_att_frm').valid()){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/edit_att_data.php",
			data:  $('#add_att_frm').serializeArray(),
			success:function(response){
			    //console.log(response);
				var data = JSON.parse(response);
				if(data.status==1){
				   $('#add_att_modal').modal('hide');
				}
				else{	
				   $('#add_att_modal').modal('hide'); 
				   alert('add failed');
				}
			},
		    error:function(jqXHR, exception) {
			    $('add_att_modal').modal('hide');
			    handle_ajax_error(jqXHR, exception);
			},
			complete:function(){
			    load_attendance_data(nic);	
			}
	    });
	}
}



//REMOVR DATA FUNCTIONS-------------------------------------------------------------------------------------------------------
function remove_pay(){
	$('button.rm_pay').on('click',function(){
		var id=$(this).attr('id');
		var nic=$(this).data('nic');
		if(confirm("Are you sure to delete this?") == true)
		{
		 	$.ajax({
			  type:  "POST",
			  url:   "db_scripts/delete_pay_data.php",
			  data:  {record_id:id},
			  success:function(response){
				  //console.log(response);
				  var data = JSON.parse(response);
				  if(data.status==1){
					 alert('Done');
					 load_payment_data(nic);
				  }
				  else{	
					 alert('add failed');
					 load_payment_data(nic);
				  }
			  },
			  error:function(jqXHR, exception) {
				  handle_ajax_error(jqXHR, exception);
			  },
	       });
	   }
	   return false;
   });
}


function remove_exm(){
	$('button.rm_exm').on('click',function(){
		var id=$(this).attr('id');
		var nic=$(this).data('nic');
		if(confirm("Are you sure to delete this?") == true)
		{
		 	$.ajax({
			  type:  "POST",
			  url:   "db_scripts/delete_exm_data.php",
			  data:  {record_id:id},
			  success:function(response){
				  //console.log(response);
				  var data = JSON.parse(response);
				  if(data.status==1){
					 alert('Done');
					 load_exam_data(nic);
				  }
				  else{	
					 alert('add failed');
					 load_exam_data(nic);
				  }
			  },			 
			  error:function(jqXHR, exception) {
				  handle_ajax_error(jqXHR, exception);
			  },
	    	});
		}
		return false;
	});
}





function remove_tr(){
	$('button.rm_tr').on('click',function(){
		 var id=$(this).attr('id');
		 var nic=$(this).data('nic');
		 if(confirm("Are you sure to delete this?") == true)
		 {
		 	$.ajax({
			  type:  "POST",
			  url:   "db_scripts/delete_tr_data.php",
			  data:  {record_id:id},
			  success:function(response){
				  //console.log(response);
				  var data = JSON.parse(response);
				  if(data.status==1){
					alert('Done');
					load_exam_data(nic);
				  }
				  else{	
					 alert('add failed');
					 load_exam_data(nic);
				  }
			  },
			  error:function(jqXHR, exception) {
				  handle_ajax_error(jqXHR, exception);
			  },
	        });
		}
		return false;
	});
}



function remove_att(){
	$('button.rm_att').on('click',function(){
		 var id=$(this).attr('id');
		 var nic=$(this).data('nic');
		 if(confirm("Are you sure to delete this?") == true)
		 {
		 	$.ajax({
			  type:  "POST",
			  url:   "db_scripts/delete_att_data.php",
			  data:  {record_id:id},
			  success:function(response){
				 // console.log(response);
				  var data = JSON.parse(response);
				  if(data.status==1){
					 alert('Done');
					 load_attendance_data(nic);
				  }
				  else{	
					 alert('add failed');
					 load_attendance_data(nic);
				  }
			  },
			  error:function(jqXHR, exception) {
				  handle_ajax_error(jqXHR, exception);
			  }
	        });
		}
		return false;
	});
}