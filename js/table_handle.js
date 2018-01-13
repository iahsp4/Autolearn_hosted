$(document).ready(function(){
 
  //on click on a row
  $('#rcnt_reg_tbl td').on('click',function(){
	  $('#rcnt_reg_tbl tr').removeClass('tr_selec');
	  $(this).parent('tr').addClass('tr_selec');
	  $('#reg_tbl_view_pro_btn').prop('disabled',false);
	  return false;
  });
	

 //on double click on a row
 $('#rcnt_reg_tbl td').on('dblclick',function(e){
	 //$(this).addClass('tr_selec');
	 var nic = $('#rcnt_reg_tbl tr.tr_selec td:first').text();
	 $('#s_stu_nic').val(nic);
	 search_student(nic);
	 setMainTab();
	 enableTabs();	
	 return false;
 });
	

 //on click on the view_profile button
 $('#reg_tbl_view_pro_btn').on('click',function(e){
	 e.preventDefault();
	 var nic = $('#rcnt_reg_tbl tr.tr_selec td:first').text();
	 search_student(nic);
	 setMainTab();
	  enableTabs();		
	 return false;
 });	
	
	
 //on click on elsewhere in the document	
 $(document).on('click' ,':not(#rcnt_reg_tbl)',function(e){
	 $('#rcnt_reg_tbl tr').removeClass('tr_selec');
	 $('#reg_tbl_view_pro_btn').prop('disabled',true);
	 e.stopPropagation();
 });	
	
	
});


