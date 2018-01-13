$(document).ready(function(){
	 
	 //Add new validator method to validate using regular expressions
	 $.validator.addMethod("pattern", function(value, element, regexpr){          
       return regexpr.test(value);
     }, 
    "Please enter a valid format.");
	jQuery.validator.addMethod("letters_S_only", function(value, element) {
  return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
}, "Letters only please");
	
	//Student Registration   -   basic data form
	$('#basic_reg_form').validate({
		   errorClass: "my-error-class",
		   rules: {
					nic: {
						 required: true,
						 remote :{
								url:"db_scripts/checkNic.php",
								type:"post"
								},
						 maxlength:10,
						 pattern:/^([0-9]{9})(v|V)$/
					     },
					
					fullname: {
						required:true,
						letters_S_only:true
					},
					surname: {
						required:true,
						letters_S_only:true
					},
					gender: "required",
					p_address:"required",
					
					tp1:{
						required:true,
						digits:true,
						minlength:10,
						maxlength:10
					    },
					
					tp2:{
						digits:true,
						minlength:10,
						maxlength:10
						},
						
					dob:"required",
					ad_date:"required",
					height:"required",
					div_sec:{
						required:true,
						letters_S_only:true
					},
					city:{
						required:true,
						letters_S_only:true
					},
					police:{
						required:true,
						letters_S_only:true
					},
					district:{
						required:true,
						letters_S_only:true
					}
		         },
		  
		  
		   messages:{
				   nic:{
						required: "Please Enter Student NIC number",
						remote: "This NIC is already registered!"
					   },
				   
				   tp1:{
						minlength:"Please Enter valid tel.number",
						maxlength:"Please Enter valid tel.number"
					   },
				   
				   tp2:{
						minlength:"Please Enter valid tel.number",
						maxlength:"Please Enter valid tel.number"
					   },
					
				   height:{
						required:"Fill the height"	
					   }
		          }, 
		   
		   
		  groupes:{
				   height:"height_ft height_in"
		          },
		   
		   
		  errorPlacement: function(error, element) 
		  		  {
					var placement = $(element).data('error');
					if((placement)||(element.attr("name") == "height_ft" || element.attr("name") == "height_in"))  {
					  $(placement).append(error);
					} else {
					  error.insertAfter(element);
					}
		         }
		   
	});

	//add validation rule to a class of elements
	jQuery.validator.addClassRules('height_grp', {
 		 required: true
	});

	//----------------------------------------------------------




	//Validate basic data editng form
	

	//Student_reg.php/Student_details.php
	$('#course_data_form,#edit_course_data_form').validate({
		   errorClass: "my-error-class",
		   rules: {
					s_type: "required",
					test: "required",
				   },
		   errorElement : 'span',
		   errorLabelContainer: '#vclass_valid_err_box',
		   messages: {
					   test: {
							   required:"Vehicle class must be selected!"
						  }
					 }
	});


	
	
	//Validate payment information page in registering and adding/editing
	$('#pay_form_y,#add_payment_frm').validate({
			   errorClass: "my-error-class",
			   rules: {
						pay_type: "required",
						amount:{ required:true,digits:true},
						pay_date: "required",
						bill_no: "required",
					},
				
	});

	//Validate Exam info adding/editng form
	$('#add_exm_frm').validate({
			   errorClass: "my-error-class",
			   rules: {
						e_no: "required",
						e_date: "required",
						e_time: "required",
					},
				
	});

	//Validate Trial info adding/editng form
	$('#add_tr_frm').validate({
			   errorClass: "my-error-class",
			   rules: {
						
						t_date: "required"
						
					},
				
	});
   
   //Validate Attendance info adding/editng form
	$('#add_att_frm').validate({
			   errorClass: "my-error-class",
			   rules: {
						
						att_date: "required",
						att_time: "required",
						att_vclass: "required"
					},
				
	});
   
   
 	

  
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   //Add Today's Attendance form
   $('#add_home_att_frm').validate({
	 errorClass: "my-error-class",
	 rules:{
			 nic: {
				   required: true,
				   remote :{
						  url:"db_scripts/check_nic_validity.php",
						  type:"post"
						  }
				  },
			 
			 att_time:"required",
			 att_vclass:"required"

	       },
     messages:{
		        nic:{
						required: "Please Enter Student NIC number",
						remote: "This nic is not registered in the system!"
					}
	 		  },
	 errorPlacement: function(error, element) 
		  		  {
					var placement = $(element).data('error');
					if(placement)  {
					  $(placement).append(error);
					} else {
					  error.insertAfter(element);
					}
		          }
   });
   
   
});

function validateLdBasicData(){
	
	$('#ld_basic_data').validate({
	   errorClass: "my-error-class",
	   rules: {
				nic: {
					required: true,
					remote :{
							url:"db_scripts/checkNic.php",
							type:"post"
							}
				},
				fullname: "required",
				surname: "required",
				gender: "required",
				p_address:"required",
				tp1:{
						required:true,
						digits:true,
						minlength:10,
						maxlength:10
					    },
					
					tp2:{
						digits:true,
						minlength:10,
						maxlength:10
						},
				dob_edit:"required",
				ad_date_edit:"required",
				height:"required",
				div_sec:"required",
				city:"required",
				police:"required",
				district:"required"
			},
	   messages:{
			   nic: {
						required: "Please Enter Student NIC number",
						remote: "This NIC is already registered!"
					},
					tp1:{
						minlength:"Please Enter valid tel.number",
						maxlength:"Please Enter valid tel.number"
					   },
				   
				   tp2:{
						minlength:"Please Enter valid tel.number",
						maxlength:"Please Enter valid tel.number"
					   },
			   fullname: {
						required: "Please Enter a Username"
				   }
	   },
	   errorPlacement: function(error, element) {
			  var placement = $(element).data('error');
			  if (placement) {
				$(placement).append(error)
			  } else {
				error.insertAfter(element);
			  }
		}
   });

	}
