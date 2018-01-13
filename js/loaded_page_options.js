/*function add_payment_data(){
		//alert(JSON.stringify( $('#add_payment_frm').serializeArray()));
		
		$.ajax({
			type:  "POST",
			url:   "db_scripts/add_payment_data.php",
			data:  $('#add_payment_frm').serializeArray(),
			success:function(response){
			    $('#myModal2').modal('hide');
				var data = JSON.parse(response);
				if(data.status==1){
				  continue_pay();
				}
				else{	
				 alert('add faild');
			    }
			},
			 error:function(jqXHR, exception) {
			  var msg = '';
			  if (jqXHR.status === 0) {
				  msg = 'Not connect.\n Verify Network.';
			  } else if (jqXHR.status == 404) {
				  msg = 'Requested page not found. [404]';
			  } else if (jqXHR.status == 500) {
				  msg = 'Internal Server Error [500].';
			  } else if (exception === 'parsererror') {
				  msg = 'Requested JSON parse failed.';
			  } else if (exception === 'timeout') {
				  msg = 'Time out error.';
			  } else if (exception === 'abort') {
				  msg = 'Ajax request aborted.';
			  } else {
				  msg = 'Uncaught mbvcor.\n' + jqXHR.responseText;
			  }
		 	alert(msg);
		  }
		 });
		
	}
	
	function continue_pay(){

	 alert("add sucess");
				  load_payment_data();	
	}*/