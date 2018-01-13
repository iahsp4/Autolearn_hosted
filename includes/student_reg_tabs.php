
<ul class="nav nav-tabs tabs" style="font-family:'Gill Sans', 'Gill Sans MT', 'Myriad Pro', 'DejaVu Sans Condensed', Helvetica, Arial, sans-serif">
      <li class="active"><a data-toggle="tab" href="#reg_form">Basic Info.</a></li>
      <li ><a data-toggle="tab" href="#course_form">Course Data</a></li>
      <li ><a data-toggle="tab" href="#payment_form">Payment Details</a></li>
   
</ul>


<script>

 $(document).ready(function(){
	
	function handle_tabs(){
	$('.tabs li').each(function() {
		$(this).addClass('disabled');
	});
	
	$('.tabs li').click(function(e){
		 if($(this).hasClass('disabled')){
	    	e.preventDefault();
			alert("Please complete the current form!")
			return false;
		 }
     });

	}
 
 	handle_tabs();
 
 
 });



</script>
     
