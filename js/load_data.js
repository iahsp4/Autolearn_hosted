	
	/*This method will search whether the NIC is registered in the system 
	 *and if it's available load show the data area.
	 *Other methods are called to load each category of data to the data area.
	 */
	function search_student(stu_nic){
		 var snic=stu_nic;
		 $('#s_stu_nic').val(snic);
		 $('#myModal').modal('show');
		 $.ajax({
			type:  "POST",
			url:   "db_scripts/check_student_presence.php",
			data:  {nic:snic},
			success:function(response){
				  //console.log(response);
				  var data = JSON.parse(response);
				   
				   if(data.status==1){
						/*If NIC is avaialable in the system---
						 *--hide the 'no search results' message,if it is visible
						 *--make visible the student data tab format
						 *--load data for each tab
						 */ 
						$('#myModal').modal('hide');
				   		
						if($('#no_data_mess_div').is(":visible")){
							$('#no_data_mess_div').hide();
						}
						if($('#rcnt_reg_tbl_div').is(":visible")){
							$('#rcnt_reg_tbl_div').hide();
						}
						if(!$('#stu_data_cle_btn').is(":visible")){
							$('#stu_data_cle_btn').show();
						}
						$('#student_data_area').show();
						load_basic_data(snic);
						load_course_data(snic);
						load_stu_img(snic)
						load_payment_data(snic);
						load_exam_data(snic);
						load_attendance_data(snic);
						
				   }
				  
				   else{
					   /*If NIC is NOT available in the system---
						 *--hide the the student data tab format,if it is visible
						 *--make visible 'no search results' message
						 */ 
						$('#myModal').modal('hide');
					    
						if($('#student_data_area').is(":visible")){
							$('#student_data_area').hide();
						}
						if(!$('#stu_data_cle_btn').is(":visible")){
							$('#stu_data_cle_btn').show();
						}
						$('#no_data_mess_div').show();
				   }
			},
			error:function(jqXHR, exception) {
			      handle_ajax_error(jqXHR, exception);
		    },
			complete: function(){
			      setDatepicker(); 
			}
		 });
	
	}

	
	
	
	
	
	
	
//LOAD DATA FUNCTIONS----------------------------------------------------------------------------------------------------------
	
	
	
	
	function load_basic_data(snic){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/load_basic_data.php",
			data:  {nic:snic},
			success:function(response){
				  $('#basic_data').html(response);
				  $('#ld_basic_data input,textarea,select').prop("disabled",true).addClass('dis_textfield');				  		   
			},
			error:function(jqXHR, exception) {
			   handle_ajax_error(jqXHR, exception);
		    },
			complete: function(){
					setDatepicker();
					validateLdBasicData();
					$('#b_dta_edit_btn').click(function()
				  {
					disableTabs();
					$('#ld_basic_data input:not(#lbd_nic),textarea,select').addClass('edit_textfield').prop("disabled",false);
					$(this).hide();
					 
					$('#b_dta_save_btn').show();
					$('#b_dta_save_btn').click(function(){
						if($('#ld_basic_data').valid()){
						   edit_basic_data(snic);
						   // load_basic_data(snic);
						   enableTabs();
						   return false;
					}
						  
					});
					$('#lbd_edit_cancel_btn').show();
					$('#lbd_edit_cancel_btn').click(function(){
							$('#myModal').modal('show');
							load_basic_data(snic);
							$('#myModal').modal('hide');
							enableTabs();
							return false;
					});
				  });
			}
		 });
	}
	
	
	
	
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
	
	
	
	

	
	function load_course_data(snic){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/load_course_data.php",
			data:  {nic:snic},
			success:function(response){
				  //console.log(response);
				  var data=JSON.parse(response);
				  $('#course_data').html(data.html);
					 //set student type	
					  if(data.s_type==1){
						 $('#s_type option[value="1"]').prop('selected',true); 
					  	 $('#s_days_div').hide();
					  }
					  else if(data.s_type==2) {
						 $('#s_type option[value="2"]').prop('selected',true);
						 $('#s_days_div').show();
						 $('#s_days_div option').each(function(){
						  if($(this).val()==data.days){
							$(this).prop('selected',true);	
						  }
					     });
					  }
					  else
					  {}  
				 
					  //set vehicle classes
					  for(x in data.clsArr){
						 $('#edit_course_data_form input[type="checkbox"]').each(function(){
							if($(this).val()==data.clsArr[x])
							 {
							 $(this).prop('checked',true);
							 }
						 });
					  }
					  //highlight selected vehicle class checkbox
					  highlight_vclass();
			},
			complete: function(){
				setCourseDataEvents(snic);
			},
			error:function(jqXHR, exception) {
			    handle_ajax_error(jqXHR, exception);
		    }
		 });
	}
	
	
	function setCourseDataEvents(snic){
		 			  $('#edit_course_data_form input[type="checkbox"]').prop('disabled',true);
				  	  $('#s_type').prop('disabled',true);
					 
					 $('.tabs a[href="#course_data"]').on('shown.bs.tab',function(){
						 $('#s_type').prop('disabled',true);
						 return false;
					 });
					  
					  
					  
					  $("#s_type").on('change click',function(e){
					   change_days_div();
					   return false;
					  }); 
						
					  $('#edit_course_btn').click(function(){
							  $(this).hide();
							  $('#edit_course_data_form input[type="checkbox"],select').prop('disabled',false);
							  $('#save_edit_course_btn').show();
							  $('#cancel_edit_course_btn').show();
					  		  highlight_onclick();
							  change_days_div();
							  disableTabs();
							  return false;
					  });
					  
					  $('#save_edit_course_btn').click(function(){
							  edit_course_data(snic);
							  //load_course_data(snic);
							   enableTabs();
							  return false;
					  });
	
			
					  $('#cancel_edit_course_btn').click(function(){
							  load_course_data(snic);
							  enableTabs();
					  		  return false;
					  });
					  
					  			checkboxe();
					  
	}
	
	
	function highlight_vclass(){
	   $('#edit_course_data_form input[type="checkbox"]').each(function(){
		if($(this).is(':checked'))
		 {
			$(this).parentsUntil('#edit_course_data_form','.checkbox').removeClass('not_highlighted').addClass('highlighted');
		 }
		else{
			$(this).parentsUntil('#edit_course_data_form','.checkbox').removeClass('highlighted').addClass('not_highlighted');
		 }
	   });
	}
	
	function highlight_onclick(){
	   $('#edit_course_data_form input[type="checkbox"]').click(function(){
		if($(this).is(':checked'))
		 {
			$(this).parentsUntil('#edit_course_data_form','.checkbox').removeClass('not_highlighted').addClass('highlighted');
		 }
		else{
			$(this).parentsUntil('#edit_course_data_form','.checkbox').removeClass('highlighted').addClass('not_highlighted');
		 }
	   });
	}
	
	function change_days_div(){
		if($('#s_type').val()=="2")
		{
		  //$('.not_for_trained').prop('disabled',true); 
		  //$('.not_for_trained').prop('checked',false); 
		  $('#s_days_div').show();
		}
		else
		{
		  //$('.not_for_trained').prop('disabled',false); 
		  $('#s_days_div').hide();
		}
      	highlight_vclass();
	  }
	
	
	function checkboxe(){
	  var tagArr=["BB1A","BB1","BA","B1A","DA","B","A","B1"];
	  for(i = 0; i < tagArr.length; i++){
		var selector='#edit_course_data_form input:checkbox[value="'+tagArr[i]+'"]';
		var selec2 = '#edit_course_data_form input:checkbox.'+tagArr[i];
		sethandler(selector,selec2);
	  }
}

function sethandler(selector,selec2){
	$(selector).on('change',function(){
		if($(this).is(':checked')){
		 	$(selec2).prop('disabled',true);
			$(selec2).prop('checked',false);
			$(selec2).parentsUntil('#course_data_form','.checkbox').removeClass('highlighted').addClass('not_highlighted');
		}
		else{
			$(selec2).prop('disabled',false);
		}
	  });
	  
	
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function disableTabs(){
	  $('#tabz li').each(function() {
		if(!$(this).hasClass('active')){
		  $(this).addClass('disabled');
		}
	  });
	}
	
	function enableTabs(){
	   $('#tabz li').each(function() {
			$(this).removeClass('disabled');
	  });
	}
	
	
	
	
	
	
	function load_payment_data(snic){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/load_payment_data.php",
			data: {nic:snic},
			success:function(response){
				$('#payment_data').empty();
				$('#payment_data').html(response);
			},
			error:function(jqXHR, exception) {
			    handle_ajax_error(jqXHR, exception);
		    },
			complete:function(){
			 	remove_pay();	
			}
	    });
	}
	
	
	
	function load_exam_data(snic){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/load_exam_data.php",
			data:  {nic:snic},
			success:function(response){
				  $('#exam_data').empty();
				  $('#exam_data').html(response);
			},
			error:function(jqXHR, exception) {
			  	  handle_ajax_error(jqXHR, exception);
			},
			complete:function(){
			  	  remove_exm();
			  	  remove_tr();
			}
		 });
	}
	
	
	
	
	function load_attendance_data(snic){
		$.ajax({
			type:  "POST",
			url:   "db_scripts/load_attendance_data.php",
			data:  {nic:snic},
			success:function(response){
				  $('#attendance_data').empty();
				  $('#attendance_data').html(response);
			},
			error:function(jqXHR, exception) {
			   	  handle_ajax_error(jqXHR, exception);
		    },
		    complete:function(){
			 	  remove_att();
				 
			}
		 });
	}
	
	
	