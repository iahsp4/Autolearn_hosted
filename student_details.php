<?php 
session_start();
if(!isset($_SESSION['username'])){
	  header('Location:index.php');
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
<script src="js/jquery.validate.js"></script>
<script src="js/student_data.js"></script>
<script src="js/validations.js"></script>
<script src="js/load_data.js"></script>
<script src="js/manipulate_stu_data.js"></script>

<script src="js/loaded_page_options.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.timepicker.min.js"></script>
<script src="js/utility.js"></script>
<script src="js/handle_ajax_error.js"></script>
<script src="js/table_handle.js"></script>
<script src="js/image_handle.js"></script>	

<title>Home</title>
</head>

<body>
	<!--body--->
    <div class="container-fluid" >
        
         
         
         
         <!--Header-------------------------------------------------------------------------------------------------------------->
            <?php include "includes/header.php"; ?>
         <!--Header-------------------------------------------------------------------------------------------------------------->
         
         
         
         
         <!--ContentArea-------------------------------------------------------------------------------------------------------->
         <div class="row content_area">
            			  <!--Side Navigations--------------------------------------------------------------------------->
                          <div class="col-md-2 sideNav">
                             <?php include "includes/side_nav.php"; ?>
                          </div>
            			  <!--Side Navigations--------------------------------------------------------------------------->
            
      
      
             			  <!--MainContent-------------------------------------------------------------------------------->
                            <div class="col-md-10  " >
                                    <!--Searchbar--------------------------------------------->
                                    <div class="row" style="margin-bottom:20px;margin-top:10px;">
                                        <div class="col-md-12" style="padding:5px;background-color:#A3B9C9" >
                                          <form id="search_stu_form" method="post">
                                           <label style="display:inline">Student NIC:</label>
                                           <input id="s_stu_nic" name="nic" type="text" style="display:inline" 
											   <?php if(isset($_GET['nic'])){
                                                      echo 'value="'.htmlspecialchars($_GET['nic']).'"';
                                                      } ?>	
												  
											>
                                           <input id="search_student_btn" type="submit"  class="btn btn-sm btn-default" value="Search">                                          <input type="button" class="btn btn-sm btn-default" value="Advanced search">
                                         <input type="button" id="stu_data_cle_btn" class="btn btn-sm btn-default " value="Clear" >
                                          </form>
                                           
                                        </div>
                                    </div>
                                   <!--Searchbar--------------------------------------------->
                                   
                                   
                                   <!--StudentDataArea---------------------------------------->
                                   <div id="student_data_area" class="row">
                                     
                                        <!--profilepicture-->
                                        <div class="col-md-2" style="padding-top:60px">
                                           <div class="img_container_div">
                                            <img id="stu_img" src="Images/facebook-default-no-profile-pic.jpg" class="stuImg">
                                           </div>
                                           <div style="text-align:center;margin-top:20px">
                                            <button id="changeimg"class="btn btn-default btn-sm" value="Change">
                                            Change</button>
                                          </div> 
                                        </div>
                                        
                                        
                                        
                                        <!--OtherData-->
                                        <div class="col-md-10 colTabs">
                                          
                                          <!--Tabs-->
                                          <div class="row" >
                                            <div class="col-md-12" >
                                               <?php include "includes/student_tabs.php"; ?>
                                            </div>
                                          </div>
                                         
                                          <!--TabContents-->
                                          <div class="row" class="stu_tabs_container_div">
                                              <div class="col-md-12">
                                                <div class="tab-content">
                                                    <div id="basic_data" class="tab-pane fade in active" style="overflow:auto">
                                                    </div>
                                                    <div id="course_data" class="tab-pane fade stu_data_tab" >
                                                    </div>
                                                    <div id="payment_data" class="tab-pane fade stu_data_tab" >
                                                    </div>
                                                    <div id="exam_data" class="tab-pane fade stu_data_tab" >
                                                    </div>
                                                    <div id="attendance_data" class="tab-pane fade stu_data_tab" >                                                    </div>
                                                </div>
                                               </div>
                                          </div>
                                         
                                         
                                         </div>
                                        <hr>
                                        
                                        
                                   </div>
                                   
                                   
                                   
                                   <!--Error message Displaying in the student data area-->
                                   <div id="no_data_mess_div" class="col-md-12" style="margin-bottom:45px">
                                     <h4>No Records Found</h4>
                                     <p style="font-size:12px">Please check the NIC and search again.</p>
                                   	 <hr>
                                   </div>
                                   
                                   
                                   <div  id="rcnt_reg_tbl_div" style="height:200px;padding:10px;">
             						 <h4>Recent Registrations</h4>
             						 <?php include("db_scripts/load_recent_reg.php"); ?>
             					   </div>
                                   
                                   
                                   
                                   
                                   </div>
                                   <!--StudentDataArea--------------------------------------------------> 
                                     
                                    
                                
                                
                                </div>
                           <!--MainContent-------------------------------------------------------------------------------->
                       
                       
                </div>
            <!--ContentArea-------------------------------------------------------------------------------------------------------->   
               
               
               
               
               
  <div id="add_pay_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Add Student Payment</h4>
      </div>
     
      <div class="modal-body" style="background-color:#D2E4ED;">
       <form id="add_payment_frm" role="form" method="post" action="">
      
       <div class="form-group">
        <label for="pay_type">Payment Type:</label>
        <select class="form-control" name="pay_type">
          <option value="Registration">Registration</option>
          <option value="Course Fee">Course Fee</option>
          <option value="Exam Fee">Exam Fee</option>
          <option value="Other">Other</option>
        </select> 
       </div>
     
       <div class="form-group">
       <label for="amount">Amount </label>
       <input  class="form-control" type="text" name="amount">
       </div>
       
       <div class="form-group">
        <label for="pay_date">Date</label>
        <input class="form-control" type="text" name="pay_date" id="pay_date">
       </div>
       
       <div class="form-group">
        <label for="bill_no">Bill NO:</label>
        <input class="form-control" type="text" name="bill_no">
       </div>
    
       <div class="form-group">
        <label for="commx">Comments:</label>
        <textarea class="form-control" name="commx"></textarea>
       </div>

	   <div style="margin-top:40px;">
        <button type="button" id="add_pay_frm_btn" class="btn btn-default" >Save</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="float:right;">Close</button>
       </div>
      </form>
     </div>
   </div>
  </div><!--End of Modal Dialog-->
</div><!--End of Modal-->
  
     
     
     
     
     
     
  <!---Required Modals to Display------------------------------------>



<div id="add_exm_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Add Student Exam</h4>
      </div>
     
      <div class="modal-body" style="background-color:#D2E4ED">
       <form id="add_exm_frm" role="form" method="post" action="">
      
       <div class="form-group">
       <label for="e_no">Exam No </label>
       <input  class="form-control" type="text" name="e_no">
       </div>
       
       <div class="form-group">
        <label for="e_date">Date</label>
        <input class="form-control" type="text" name="e_date" id="e_date">
       </div>
       
       <div class="form-group">
        <label for="e_time">Time:</label>
        <input class="form-control" type="text" name="e_time">
       </div>
    
       <div class="form-group">
        <label for="e_marks">Marks:</label>
        <input class="form-control" type="text" name="e_marks">
       </div>
       
       

	   <div style="margin-top:40px">
        <button type="button" id="add_exm_frm_btn" class="btn btn-default">Save</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="float:right;">Close</button>
       </div>
      
      </form>
    
    
     </div>
   </div>
  </div><!--End of Modal Dialog-->
</div><!--End of Modal-->   
     
     
   
 <div id="add_tr_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Add Student Trial</h4>
      </div>
     
      <div class="modal-body" style="background-color:#D2E4ED">
       <form id="add_tr_frm" role="form" method="post" action="">
      
       
       <div class="form-group">
        <label for="t_date">Date</label>
        <input class="form-control" type="text" name="t_date" id="t_date">
       </div>
       
      
       <div class="form-group">
        <label for="t_status">Status:</label>
        <select class="form-control"  name="t_status">
         <option value="1">Passed</option>
         <option value="0">Failed</option>
         <option value="2" selected>Scheduled</option>
        </select>
      
       </div>
       
       

	   <div style="margin-top:40px">
        <button type="button" id="add_tr_frm_btn" class="btn btn-default">Save</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="float:right;">Close</button>
       </div>
      
      </form>
    
    
     </div>
   </div> 
  </div><!--End of Modal Dialog-->
</div><!--End of Modal-->     
     
 <div id="add_att_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
       <h4 class="modal-title">Add Student Attendance</h4>
      </div>
     
      <div class="modal-body" style="background-color:#D2E4ED">
       <form id="add_att_frm" role="form" method="post" action="">
      
       
       <div class="form-group">
        <label for="att_date">Date</label>
        <input class="form-control" type="text" name="att_date" id="att_date">
       </div>
       
      
       <div class="form-group">
        <label for="att_time">Time:</label>
        <input class="form-control" type="text" name="att_time">
       </div>
      
       <div class="form-group">
        <label for="att_vclass">Vehicle class:</label>
        <select class="form-control" name="att_vclass" id="att_vclass">
          <option value="--select vehicle class--" disabled >--select vehicle class--</option>
        </select> 
       </div>

	   <div style="margin-top:40px">
        <button type="button" id="add_att_frm_btn" class="btn btn-default">Save</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="float:right;">Close</button>
       </div>
      
      </form>
    
     </div>
   </div>
  </div><!--End of Modal Dialog-->
</div><!--End of Modal-->    
     
    
    
    
    <div id="img_change_modal" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        	<div class="modal-header">
       			<button type="button" class="close" data-dismiss="modal">&times;</button>
       			<h4 class="modal-title">Upload Student Image</h4>
      		</div>
          	<div class="modal-body">
             <form id="img_ch_frm"  method="post" enctype="multipart/form-data">
    			Select image to upload:<br>
   				<input type="file"   name="fileToUpload" id="fileToUpload">
    			<input type="submit" class="btn btn-default" value="Upload Image" name="submit" style="margin-top:30px">
             </form>
         	 </div>
        </div>
      </div>
    </div> 
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
               
   </div>
   <!--body--->    
    
     
     
     <div class="footer_other" >
        <div class="col-md-12 col-sm-12 col-xs-12">
         
        </div>
     </div><!--End of Footer-->

<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog1">
        <!-- Modal content-->
        <div class="modal-content mymodelcn">
          <div class="modal-body" style="text-align:center;">
           <img src="Images/loading.gif" height="80px" width="80px" >
          </div>
        </div>
      </div>
</div>

















</body>
</html>
<?php } ?>  