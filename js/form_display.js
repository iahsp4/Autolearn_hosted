/*$(document).ready(function(){
  
  			//Student_reg.php------------------------------------------------------------------------------------
  			$('.tabs a[href="#menu2"]').on('shown.bs.tab',function(){
				//load_course_data_form();
			});
  			$('.tabs a[href="#menu2"]').on('shown.bs.tab',function(){
				//load_pay_data_form();
			});
  
  
			

});

function load_course_data_form(){
			  $.ajax({
				  type : "POST",
				  url  : "includes/course_data_form.php",
				  success:function(response){
					  console.log(response);
					  $('#menu2').html(response);	
				  },
				  error:function(jqXHR, exception) {
					  handle_ajax_error(jqXHR, exception);
				  },
				  complete:function()
				  {
					 set_course_data_form_actions();
					 checkboxe();
				  }
	   		 });		
}
			
			
			
function load_pay_data_form(){
			  $.ajax({
				  type : "POST",
				  url  : "includes/pay_form.php",
				  success:function(response){
					  console.log(response);
					  $('#menu1').html(response);	
				  },
				  error:function(jqXHR, exception) {
					  handle_ajax_error(jqXHR, exception);
				  },
				  complete:function()
				  {
					 set_pay_form_actions();
				  }
	   		 });		
}
			
			
			
			



















	 //-----------------------------------------------------------------------------------------------
*/