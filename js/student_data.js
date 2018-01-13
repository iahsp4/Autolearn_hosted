// JavaScript Document
$(document).ready(function(){
	
	$('#student_data_area').hide();
	$('#no_data_mess_div').hide();
	$('#stu_data_cle_btn').hide();
	
	$('#search_stu_form').on('submit',function(e){
		 e.preventDefault();
		 var nic = $('#s_stu_nic').val();
		 search_student(nic);
		 setMainTab();
		 enableTabs();	
	});
	
	$('#add_pay_modal,#add_exm_modal').on('show.bs.modal', function(e) {
		 $('body').addClass('test');
	});
		
	$('#stu_data_cle_btn').on('click',function(e){
		 //USE TOGGLE
		 if($('#student_data_area').is(":visible")){
			$('#student_data_area').hide();
		 }
		 if(!$('#rcnt_reg_tbl_div').is(":visible")){
			$('#rcnt_reg_tbl_div').show();
		 }
		 if($('#no_data_mess_div').is(":visible")){
			$('#no_data_mess_div').hide();
		 }
		 $('#s_stu_nic').val('');
		 $(this).hide();
		 return false;
	});
	
	
	//if student details are loaded by a GET request from another page
	if($('#s_stu_nic').attr('value')){
		 var nic = 	$('#s_stu_nic').val();
		 search_student(nic);
		 setMainTab();
		 enableTabs();
		 
	}
	$('#tabz li').on('click',function(e){
						if($(this).hasClass('disabled')){
						  alert("Please Save or Cancel the Edit Mode");
						  return false;
						 }
						 //e.stopPropagation();
	});
	
	
	
	
	$('#add_exm_frm input[name="e_time"],#add_att_frm input[name="att_time"]').timepicker({
		'minTime': '7:00am',
    	'maxTime': '7:00pm',
		'timeFormat': 'h:i A'
	});
	
	
	
	
	
	
	
	
	
	
	
	
	//MODAL LOAD FUNCTIONS-------------------------------------------------------------------------------------------------
	$('#add_pay_modal').on('show.bs.modal',function(ev){
		 	$('#add_pay_modal textarea,select').prop('disabled',false);
			$('#add_pay_frm_btn').off('click');
			var flag=0;
			var nic=0;
			if(ev.relatedTarget.id=='edit_btn'){
				 $('#add_payment_frm input[type="text"]').val("");
				 $('#add_payment_frm textarea').val("");
				 //alert(ev.relatedTarget.id);
				 var flag=1;
				 var pid  = $(ev.relatedTarget).data('payid');
				 var bn  = $(ev.relatedTarget).data('bn');
				 var ptyp  = $(ev.relatedTarget).data('ptyp');
				 var pd  = $(ev.relatedTarget).data('pd');
				 var am  = $(ev.relatedTarget).data('pam');
				 var commx = $(ev.relatedTarget).data('pc');
				 nic = $(ev.relatedTarget).data('nic');
				 
				 $(ev.currentTarget).find('option[value="'+ptyp+'"]').prop('selected',true);
				 $(ev.currentTarget).find('input[name="pay_date"]').val(pd);
				 $(ev.currentTarget).find('input[name="bill_no"]').val(bn);
				 $(ev.currentTarget).find('input[name="amount"]').val(am);
				 $(ev.currentTarget).find('textarea[name="commx"]').val(commx);
				 if($('#add_payment_frm input[name="pay_id"]').length > 0){
				 	   $('#add_payment_frm input[name="pay_id"]').attr('value',pid);
				 }
				 else{
				 	   $('#add_payment_frm').append('<input type="hidden" name="pay_id" value="'+pid+'">');	
				 }	
			}
			else if(ev.relatedTarget.id=='add_payment_btn'){
				 //alert(ev.relatedTarget.id);
				 var flag=2;
				 nic = $(ev.relatedTarget).data('nic');
				 $('#add_payment_frm input[type="text"]').val("");
				 $('#add_payment_frm textarea').val("");
				 $('option[value="Registration"]').prop('selected',true); 
				 var sid  = $(ev.relatedTarget).data('test');
				 if($('#add_payment_frm input[name="stu_id"]').length > 0){
				 	   $('#add_payment_frm input[name="stu_id"]').attr('value',sid);
				 }
				 else{
				 	   $('#add_payment_frm').append('<input type="hidden" name="stu_id" value="'+sid+'">');	
				 }	
				 
			}
			else{
				return false;
			} 
			
			//Set the action of submit button,according to flag
			$('#add_pay_frm_btn').click(function(e){
				if(flag==1){
				  edit_payment_data(nic);
				  //load_payment_data(nic);
				  return false;	
				}
				else if(flag==2){
					add_payment_data(nic);
					//load_payment_data(nic);
					return false;
				}
				else{
					return false; 
				}
		    });
	
	
		
	// return false;
	});
		  
		  
		  
		  
	$('#add_exm_modal').on('show.bs.modal',function(ev){
		 	$('#add_exm_modal textarea,select').prop('disabled',false);
			$('#add_exm_frm_btn').off('click');
			var flag=0;
			var nic=0;
			if(ev.relatedTarget.id=='exm_edit_btn'){
				 //alert(ev.relatedTarget.id);
				 var flag=1;
				 nic  = $(ev.relatedTarget).data('nic');
				 var eid  = $(ev.relatedTarget).data('e_id');
				 var date  = $(ev.relatedTarget).data('date');
				 var eno  = $(ev.relatedTarget).data('e_no');
				 var time  = $(ev.relatedTarget).data('time');
				 var marks  = $(ev.relatedTarget).data('marks');
			
		 		 $(ev.currentTarget).find('input[name="e_date"]').val(date);
				 $(ev.currentTarget).find('input[name="e_no"]').val(eno);
				 $(ev.currentTarget).find('input[name="e_time"]').val(time);
				 $(ev.currentTarget).find('input[name="e_marks"]').val(marks);
			
				 if($('#add_exm_frm input[name="e_id"]').length > 0){
				 	$('#add_exm_frm input[name="e_id"]').attr('value',eid);
				 }
				 else{
				 	$('#add_exm_frm').append('<input type="hidden" name="e_id" value="'+eid+'">');	
				 }	
			}
			else if(ev.relatedTarget.id=='add_exm_btn'){
				 //alert(ev.relatedTarget.id);
				   $('#add_exm_frm input[type="text"]').val("");
				   var flag=2;
				   nic  = $(ev.relatedTarget).data('nic');
				   var sid=$(ev.relatedTarget).data('test');
				   if($('#add_exm_frm input[name="stu_id"]').length > 0){
				 	$('#add_exm_frm input[name="stu_id"]').attr('value',sid);
				 }
				 else{
				 	$('#add_exm_frm').append('<input type="hidden" name="stu_id" value="'+sid+'">');	
				 }	
				   
				   
			}
			else{
			}
							
			var mst=0;
			$('#add_exm_frm_btn').on('click',function(e){
				if(flag==1){
				    edit_exam_data(nic);
				 // load_exam_data(nic);
				 // return false;	
				}
				else if(flag==2){
					add_exam_data(nic);
					//load_exam_data(nic);
					//return false;
				}
				else{
					//return false; 
				}
		   });
		 //  return false;
	});





	
	$('#add_tr_modal').on('show.bs.modal',function(ev){
		 	$('#add_tr_modal textarea,select').prop('disabled',false);
			$('#add_tr_frm_btn').off('click');
			var flag=0;
			var nic=0;
			if(ev.relatedTarget.id=='tr_edit_btn'){
				 //alert(ev.relatedTarget.id);
				 var flag=1;
				 nic  = $(ev.relatedTarget).data('nic')
				 var tid  = $(ev.relatedTarget).data('t_id');
				 var tdate  = $(ev.relatedTarget).data('t_date');
				 var ts  = $(ev.relatedTarget).data('t_status');
		 		 $(ev.currentTarget).find('input[name="t_date"]').val(tdate);
				 $(ev.currentTarget).find('option[value="'+ts+'"]').prop('selected',true);
				 if($('#add_tr_frm input[name="t_id"]').length > 0){
				 	$('#add_tr_frm input[name="t_id"]').attr('value',tid);
				 }
				 else{
				 	$('#add_tr_frm').append('<input type="hidden" name="t_id" value="'+tid+'">');	
				 }
			}
			else if(ev.relatedTarget.id=='add_tr_btn'){
				 // alert(ev.relatedTarget.id);
				 $('#add_tr_frm input[type="text"]').val("");
				 var flag=2;
				 nic  = $(ev.relatedTarget).data('nic');
				 var sid=$(ev.relatedTarget).data('test');
				 if($('#add_tr_frm input[name="stu_id"]').length > 0){
				 	$('#add_tr_frm input[name="stu_id"]').attr('value',sid);
				 }
				 else{
				 	$('#add_tr_frm').append('<input type="hidden" name="stu_id" value="'+sid+'">');	
				 }
				 
			}
			else{
			}
							
			$('#add_tr_frm_btn').on('click',function(e){
			     if(flag==1){
				    edit_trial_data(nic);
				    //load_exam_data(nic);
				    return false;	
				 }
				 else if(flag==2){
					add_trial_data(nic);
					//load_exam_data(nic);
					return false;
				 }
				else{
					return false; 
				 }
		   });
		//   return false;
	});
	
	
	
	
	
	
	$('#add_att_modal').on('show.bs.modal',function(ev){
		 	$('#add_att_modal textarea,select').prop('disabled',false);
			$('#add_att_frm_btn').off('click');
			var flag=0;
			var nic=0;
			if(ev.relatedTarget.id=='att_edit_btn'){
				 //alert(ev.relatedTarget.id);
				 var flag=1;
				 nic=$(ev.relatedTarget).data('nic');
				 var id  = $(ev.relatedTarget).data('att_id');
				 var date  = $(ev.relatedTarget).data('att_date');
				 var time  = $(ev.relatedTarget).data('att_time');
				 var vclass  = $(ev.relatedTarget).data('att_vclass');
		 		 $(ev.currentTarget).find('input[name="att_date"]').val(date);
				 $(ev.currentTarget).find('input[name="att_time"]').val(time);
				 $(ev.currentTarget).find('input[name="att_vclass"]').val(vclass);
				 loadStudentClasses(nic,$('#att_vclass'));
				 if($('#add_att_frm input[name="att_id"]').length > 0){
				 	$('#add_att_frm input[name="att_id"]').attr('value',id);
				 }
				 else{
				 	$('#add_att_frm').append('<input type="hidden" name="att_id" value="'+id+'">');	
				 }	
			}
			else if(ev.relatedTarget.id=='add_att_btn'){
				   //alert(ev.relatedTarget.id);
				   nic=$(ev.relatedTarget).data('nic');
				   $('#add_att_frm input[type="text"]').val("");
				   var flag=2;
				   var sid  = $(ev.relatedTarget).data('test');
				   if($('#add_att_frm input[name="stu_id"]').length > 0){
				 	$('#add_att_frm input[name="stu_id"]').attr('value',sid);
				   }
				   else{
					  $('#add_att_frm').append('<input type="hidden" name="stu_id" value="'+sid+'">');	
				   }	
					
				  loadStudentClasses(nic,$('#att_vclass'));
					
				 
			}
			else{
			}
							
			$('#add_att_frm_btn').on('click',function(e){
				if(flag==1){
				    edit_attendance_data(nic);
				    //load_attendance_data(nic);
				    return false;	
				}
				else if(flag==2){
					add_attendance_data($('#add_att_modal'),$('#add_att_frm'),nic);
					//load_attendance_data(nic);
					return false;
				}
				else{
					return false; 
				}
		   });
		 //  return false;
	});
	
	
	
	
});//End of Document.Ready()------------------------
	

  /*Set Datepicker for dynamically loaded forms*/
  function setDatepicker(){
  	$( '#pay_date,#e_date,#t_date,#att_date,#ad_date_edit' ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd"
  	});
	
	
	$('#dob_edit').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd",
		yearRange: "1960:+nn"
  	});
	
  }



	function setMainTab(){
	 /*$('#tabz li').each(function(){
		$(this).removeClass('active'); 
	 });
	 $('#tabz a[href="#basic_data"]').parent('li').addClass('active');*/
	 $('#tabz a[href="#basic_data"]').tab('show');	
	}

