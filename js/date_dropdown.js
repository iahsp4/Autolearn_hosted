//load date select----------------------------
var init_yr = 1960;
while(init_yr<=new Date().getFullYear()){
$('#year_drpdwn').append('<option value="'+init_yr+'">'+init_yr+'</option>');			 
   init_yr++;
}
 
for(var i=1;i<=12;i++){
	$('#month_drpdwn').append('<option value="'+i+'">'+i+'</option>');	
}



$('#year_drpdwn,#month_drpdwn').change(function(){
	load_days();
});



function load_days(){
		$('#day_drpdwn').empty();
		$('#day_drpdwn').html('<option disabled selected>--day--</option>');

		var yr = $('#year_drpdwn').val();
		var mn = $('#month_drpdwn').val();
		var leap=false;
		
		if((yr % 4 == 0) && (yr % 100 != 0) || (yr % 400 == 0)){
		  leap=true;	
		}
		 
		//Fill each month
		var dy;
		if(leap && (mn==2)){
		 dy = 29;	
		}
		
		else if((mn==2) && (!leap)){
		 dy = 28;
		}
		
		else if((mn<=7)&&(mn%2==0)){
		 dy = 30;	
		}
		
		else if((mn>=8)&&(mn%2==0)){
			dy = 31;
		}
		
		else if(mn>=8&&(mn%2==1)){dy=30;}
		
		else{dy=31};	
				
		for(var d=1;d<=dy;d++){
			$('#day_drpdwn').append('<option value="'+d+'">'+d+'</option>');  
		}
}