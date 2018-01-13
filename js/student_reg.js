$(document).ready(function(){
	  // A : 1  --reg_form tab-------------------------------------------------
	  $('#proceed').hide();
	  $('#proceed').click(function(e){
		$('.tabs a[href="#course_form"]').tab('show');
	  });
	  
	  $('#reg_form_submit').prop('disabled',false);
	  $('#basic_reg_form input[type="text"],textarea').val("");
	  $('#basic_reg_form input[type="radio"]').prop("checked",false);
	  
	  $("#reg_ad_date").datepicker({
		  changeMonth: true,
		  changeYear: true,
		  dateFormat: "yy-mm-dd"
	  });
		
	  $("#dob").datepicker({
		  changeMonth: true,
		  changeYear: true,
		  dateFormat: "yy-mm-dd",
		  yearRange: "1960:+nn"
	  });
	
      // B : 1  Submit function of Basic info reg_Form------------------------------------------------
	  $('#reg_form_submit').click(function(event){
		if($('#basic_reg_form').valid())  
		{ 
		 $('#myModal').modal('show');
		 $.ajax({
			type:  "POST",
			url:   "db_scripts/testform.php",
			data:  $('#basic_reg_form').serializeArray(),
			success:function(response){
				   //console.log(response);
				   var data = $.parseJSON(response);
				   if(data.status==1){
					 $('#proceed').show();
					 $('#reg_form_submit').removeClass('btn-default').addClass('btn-success').prop('disabled',true).css('cursor','default').text('Saved');
					 
				   	
					 var nic=encodeURIComponent($('#basic_reg_form #nic').val());
					 $('.view_profile').attr('href','student_details.php?nic='+nic);
				   	 $('#myModal').modal('hide');
				   }
				   else{
					  $('#myModal').modal('hide');
					  alert(data.db_err);
				   }
			},
			 error:function(jqXHR, exception) {
			   $('#myModal').modal('hide');
			   handle_ajax_error(jqXHR, exception);
		    }
		 });
		}
	  });
    //------------------------------------------------------------------------------------------------
	
	
	
	
	
	//----------------------------------------------------------------------------------------------
	$('#img_up_frm').submit(function(e){
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
	 				$('#img_upload_modal').modal('hide');
				    $('#stu_img').attr('src','uploads/'+data.fn);
				   }
			  else{
				  	$('#img_upload_modal').modal('hide');
					alert(data.message);
				  }
			},
			error:function(jqXHR, exception) {
			  handle_ajax_error(jqXHR, exception);
		    }
		});
		return false;
	});
	//----------------------------------------------------------------------------------------------
 
 
 
 
 	
	
	
	
	//----------------------------------------------------------------------------------------------
	set_course_data_form_actions()
	checkboxe();
	function set_course_data_form_actions(){  
	  // A : 2  --course_data_form tab---------------------
	  $('#proceed_to_payment').hide();
	  $('#proceed_to_payment').click(function(e){
		 $('.tabs a[href="#payment_form"]').tab('show');			  
		 });
	  
	  //set default student category to beginner------
	  $('#s_type option[value="1"]').prop('selected',true);
	  $('.not_for_trained').prop('disabled',false); 
	  $('#course_data_form input:checkbox').prop('checked',false);
	  $('#course_data_form_submit').prop('disabled',false);
	  
	  //Load and Unload the  'Trained' options--------
	  $("#s_type").on('load change click',function(e){
		  e.preventDefault();
		  if($('#s_type').val()=="2")
		  {
			if($('#s_days_div').length==0)
			{
			  $('#s_type_div').append('<div class="form-group" id="s_days_div" style="margin-top:20px;"><label for="s_days">No. of Days </label><select class="form-control" name="day" id="s_days"><option value="2">2 days</option><option value="5">5 days</option><option value="10">10 days</option></select></div>');
			}
		  }
		  else
		  {
			$('.not_for_trained').prop('disabled',false); 
			if($('#s_days_div').length>0)
			{
			  $('#s_days_div').remove();
			}
		  }
	  });
	  //options bar hiiden untill data is succefully stored
	  $('#course_data_options').hide();
	  
	  //Highlight the selected vehicle classes
	   $('#course_data_form input:checkbox').on('change',function(){
		 if($(this).is(':checked'))
		 {
			 $(this).parentsUntil('#course_data_form','.checkbox').removeClass('not_highlighted').addClass('highlighted');
		 }
		 else{
			 $(this).parentsUntil('#course_data_form','.checkbox').removeClass('highlighted').addClass('not_highlighted');
		 }
	  });
	 
			
	 // B: 2  Submit function of Basic info course_data_Form-----
	 $('#course_data_form_submit').click(function(event){
		  if($('#course_data_form').valid()){  
		  //create a string to be converted to a JSON String
		  var data_String = "";
		  var checkedvalues='';
		  $('#course_data_form input:checked').each(function(i){
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
			data_String = {category:cat,day:days,checkedvals:checkedvalues};
		  }
		  else{
			  data_String = {category:cat,checkedvals:checkedvalues};
		  }
		  
		  //send ajax request
		  $('#myModal').modal('show');
		  $.ajax({
			  type: "POST",
			  url:  "db_scripts/testcheck.php",
			  data: data_String,
			  success:function(response){
					//console.log(response);
					var data = JSON.parse(response);
					   if(data.status=="1"){
						$('#proceed_to_payment').show();
						$('#course_data_options').show();
						$('#course_data_form_submit').removeClass('btn-default').addClass('btn-success').prop('disabled',true).css('cursor','default').text('Saved');
						 $('#myModal').modal('hide');
					   }
					   else{
						  $('#myModal').modal('hide');
						  alert(data.message.db_err);
					   }
			  }
			  ,
			  error:function(jqXHR, exception) {
				  $('#myModal').modal('hide');
				  handle_ajax_error(jqXHR, exception);
			  }
		   });
		}
	});
    //------------------------------------------
}

function checkboxe(){
	  var tagArr=["BB1A","BB1","BA","B1A","DA","B","A","B1"];
	  for(i = 0; i < tagArr.length; i++){
		var selector='#course_data_form input:checkbox[value="'+tagArr[i]+'"]';
		var selec2 = '#course_data_form input:checkbox.'+tagArr[i];
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
 
//---------------------------------------------------------------------------------------------- 
 
 
 
 
 
 
 
 
 
 //---------------------------------------------------------------------------------------------- 
 set_pay_form_actions();
 function set_pay_form_actions(){
	  // A : 3  --pay_form_tab-----------------------------
	  $('#reg_options').hide();
	  $('#pay_form_y input[type="text"]').val("");
	  
	  
	  $( "#pay_date" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd"
	  });
				
	  
	  // B : 3  Submit function of Payment info pay_form---------------------
	  $('#pay_form_submit-Y').prop('disabled',false).click(function(){
	    if($('#pay_form_y').valid()){
		$('#myModal').modal('show');
		$.ajax({
			type: "POST",
			url:  "db_scripts/payform.php",
			data: $('#pay_form_y').serializeArray(),
			success:function(response){
				//console.log(response);
			  var data=JSON.parse(response);
			  if(data.status==1){
	 				$('#reg_options').show();
					$('#pay_form_submit-Y').removeClass('btn-default').addClass('btn-success').prop('disabled',true).css('cursor','default').text('Saved');
					$('#myModal').modal('hide');
				   }
			  else{
					$('#myModal').modal('hide');
					alert(data.message);
				  }
		    },
			error:function(jqXHR, exception) {
			  $('#myModal').modal('hide');
			  handle_ajax_error(jqXHR, exception);
		    }
		});
		}
	});
 }
 //---------------------------------------------------------------------------------------------- 
 
 
 
 
 
 
 
 
 
 
 
 
 
 });
 
 
 
 
 
 
 
 
 
 
 
							