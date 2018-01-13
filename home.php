<?php 
session_start();
if(!isset($_SESSION['username'])){
	  exit();
	}
	else{
	  include('includes/auto_logout.php');
?> 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/sitestyles.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/utility.js"></script>
<script src="js/handle_ajax_error.js"></script>
<script src="js/manipulate_stu_data.js"></script>
<script src="js/home.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.timepicker.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/validations.js"></script>
<title>Home</title>
</head>

<body>
	<!--body--->
    <div class="container-fluid">
         <!--Header-->
            <?php include "includes/header.php"; ?>
         <!--End of Header-->
        
         
         <!--ContentArea-->
         <div class="row content_area">
            <!--Side Navigations-->
            <div class="col-md-2 col-sm-12 col-xs-12 sideNav">
              <?php include "includes/side_nav.php"; ?>
            </div>
            
            <!--MainContent-->
            <div class="col-md-10 col-sm-12 col-xs-12 colMain" style="font-size:12px"   >
             
             <div style="height:100px;padding:10px">
             <h4 style="font-family:Cambria">
             	Date : <span id="datxe"></span>
                	   <br>
                       <span id="clock"></span>
             </h4>	
             </div>
             
             
             <div id="att_tbl_div" style="height:200px;padding:10px;">
              
              
             </div>
            
             
             
             
          
           </div><!--End of MainContent-->
         </div><!--End of ContentArea-->
        
    
    <!--Footer-->
     
    </div><!--End of pagebody-->
    
   <div class="footer_other" >
       
    </div><!--End of Footer-->




	<!--Attendace Modal--->
    <div id="add_home_att_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Add Student Attendance</h4>
      </div>
     
      <div class="modal-body" style="background-color:#D2E4ED">
       <form id="add_home_att_frm" role="form" method="post" action="">
      
       <div class="form-group">
        <label for="nic">NIC</label>
        <input class="form-control" type="text" name="nic" id="nic">
       </div>
       
       <div class="form-group">
        <label for="date">Date</label>
        <input class="form-control" type="text" name="att_date" id="date" readonly>
       </div>
       
      
       <div class="form-group">
        <label for="time">Time:</label><br>
        <input class="form-control"  style="width:65%;display:inline" type="text" id="time" name="att_time" data-error="#der">
        <input type="button" id="setTimex" value="NOW" style="width:10%" class="btn btn-default btn-sm">
        <br>
        <span id="der"></span>
        </div>
       
       <div class="form-group">
        <label for="vclass">Vehicle class:</label>
        <select class="form-control" name="att_vclass" id="vclass">
          <option disabled>--select category--</option>
        </select> 
       </div>

	   <div style="margin-top:40px">
        <button type="submit" id="add_att_frm_btn" class="btn btn-default">Save</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="float:right;">Close</button>
      </div>
      
      </form>
    
    
     </div>
   </div>
  </div><!--End of Modal Dialog-->
</div><!--End of Modal-->   









</body>
</html>



<?php } ?>