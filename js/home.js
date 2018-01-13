$(document).ready(function(){
	
	
	$('#datxe').html(setdate());
	load_home_attendance();
	
	
	
	/*add student attendance modal */
	$('#add_home_att_frm').on('submit',function(e){
	  add_attendance($('#add_home_att_modal'),$('#add_home_att_frm'));
	  load_home_attendance();
	  return false;  
	});
	
	
	$('#add_home_att_frm #date').datepicker({
		 dateFormat: "yy-mm-dd",
		 beforeShow: function(i) { 
		 				if ($(i).attr('readonly')) { 
							return false; 
						} 
					 }
	});
	
	
	$('#add_home_att_frm #date').datepicker('setDate', new Date());
	
	
	$('#add_home_att_frm #time').timepicker({
		 'minTime': '7:00am',
    	 'maxTime': '7:00pm',
		 'timeFormat': 'h:i A'
	});
	
	
	$('#setTimex').on('click', function (){
    	 $('#time').timepicker('setTime', new Date());
		 return false;
	});
	

	$('#add_home_att_frm #nic').on('keyup',function(){
		 var nic=$(this).val(); 
		 loadStudentClasses(nic,$('#vclass'));
		 return false;
	});

	$('#add_home_att_modal').on('show.bs.modal',function(){
		$('#add_home_att_modal input[type="text"]:not(#date)').val('');
	});

});






function load_home_attendance(){
	   $.ajax({
		  type : "POST",
		  url  : "db_scripts/load_attendance_table.php",
		  success:function(response){
			  $('#att_tbl_div').html(response);
			   bindTblEvents();	
		  },
		  error:function(jqXHR, exception) {
			  handle_ajax_error(jqXHR, exception);
		  }
		 
	   });	
}


function bindTblEvents(){
	         $('#att_tbl td').on('click',function(){
				$('#att_tbl tr').removeClass('tr_selec');
				$(this).parent('tr').addClass('tr_selec');
				return false;
		     });
			  
			 $('#att_tbl td').on('dblclick',function(e){
			    var nic = $('#att_tbl tr.tr_selec td:first').text();
			    window.location.href="http://avian.dx.am/student_details.php?nic="+nic;
			    return false;
			 }); 
}

function setdate(){
	  var currentDate = new Date();
	  var y=currentDate.getFullYear();
	  var m=currentDate.getMonth()+1;
	  var d=currentDate.getDate();
	  var prints = d+"/"+m+"/"+y;
	  return prints;
}

