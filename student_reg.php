<?php 
	session_start();
	if(!isset($_SESSION['username'])){
	  header("Location:index.php");
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
<link rel="stylesheet" type="text/css" href="css/cropimg.css">
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/validations.js"></script>
<script src="js/student_reg.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/cropimg.jquery.min.js"></script>
<script src="js/image_handle.js"></script>
<title>AL:Student Registration</title>
</head>

<body>
	<!--body--->
    <div class="container-fluid" >
         
         <?php if(isset($_SESSION['curr_registering_stu_id'])){
			 		unset($_SESSION['curr_registering_stu_id']); 
				}
				if(isset($_SESSION['curr_registering_stu_nic'])){
			 		unset($_SESSION['curr_registering_stu_nic']); 
				}
					
				if(isset($_SESSION['searched_student_nic'])){
					unset($_SESSION['searched_student_nic']);
				}
					
				if(isset($_SESSION['searched_student_stu_id'])){
			 		unset($_SESSION['searched_student_stu_id']); 
				}
				
				if(isset($_SESSION['curr_reg_stu_img'])){
			 		unset($_SESSION['curr_reg_stu_img']); 
				}
					?> 
         
         
         <!--Header-------------------------------------------------------------------------------------------------------------->
         <?php include "includes/header.php"; ?>
         <!--Header-------------------------------------------------------------------------------------------------------------->
         
         
         
         
         <!--ContentArea-------------------------------------------------------------------------------------------------------->
         <div class="row content_area" >
            			  <!--Side Navigations--------------------------------------------------------------------------->
                          <div class="col-md-2 sideNav">
                             <?php include "includes/side_nav.php"; ?>
                          </div>
            			  <!--Side Navigations--------------------------------------------------------------------------->
            
      
      
             			  <!--MainContent-------------------------------------------------------------------------------->
                            <div class="col-md-10  "  >
                                    
                                   <!--StudentDataArea---------------------------------------->
                                   <div class="row" style="padding-top:20px">
                                      <!--profilepicture-->
                                      <div class="col-md-2" style="padding-top:60px">
                                        <div style="margin-left:auto;margin-right:auto;width:120px;height:130px">
                                         <img id="stu_img" src="Images/facebook-default-no-profile-pic.jpg" 
                                          style="border:1px solid #AFAAAB;height:100%;width:100%">
                                        </div>
                                        <div style="text-align:center;margin-top:20px">
                                         <button id="loadimg"class="btn btn-default btn-sm" value="Add picture" data-toggle="modal" 
                                         data-target"#img_upload_modal" >Add picture</button>
                                         <button id="edit_img_btn"class="btn btn-default btn-sm" value="Edit picture" 
                                         data-toggle="modal" data-target"#edit_img_modal" style="display:none;margin-top:10px">
                                         Edit picture</button>
                                        </div> 
                                      </div>
                                      
                                      <!--OtherData-->
                                      <div class="col-md-10 colTabs">
                                        <!--Tabs-->
                                        <div class="row">
                                          <div class="col-md-12">
                                          	 <?php include "includes/student_reg_tabs.php"; ?>
                                          </div>
                                        </div>
                                       
                                        <!--TabContents-->
                                        <div class="row" >
                                            <div class="col-md-12" style="border-bottom:1px solid #ACACAC;min-height:520px">
                                              <div class="tab-content">
                                                  
                                                  <div id="reg_form" class="tab-pane fade in active" style="background-color:#806E6E">
                                                     <?php include "includes/reg_form.php"; ?>
                                                  </div>
                                                  
                                                  <div id="course_form" class="tab-pane fade in">
                                                     <?php include "includes/course_data_form.php"; ?>
                                                  </div>
                                                  
                                                  <div id="payment_form" class="tab-pane fade">
                                                 	 <?php include "includes/pay_form.php"; ?>
                                                  </div>

		                                     </div><!--div class=tab-content-->
                                           </div>
                                       </div>
                                      </div>
                                    </div>
                                    <!--StudentDataArea--------------------------------------------------> 
                                     
                                </div>
                           <!--MainContent-------------------------------------------------------------------------------->
                       
                </div>
            <!--ContentArea-------------------------------------------------------------------------------------------------------->   
               
     </div>
     <!--body--->    
    
     
     
     <div class="footer_other" >
        <div class="col-md-12 col-sm-12 col-xs-12">
        </div>
     </div>

	
    
    
    <!--Loading Image---> 
    <div id="myModal" class="modal fade " role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body" style="text-align:center">
           <img src="Images/ajax-loader.gif" width="18px">
          </div>
        </div>
      </div>
    </div>
    
    
    
    <div id="img_upload_modal" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        	<div class="modal-header">
       			<button type="button" class="close" data-dismiss="modal">&times;</button>
       			<h4 class="modal-title">Upload Student Image</h4>
      		</div>
          	<div class="modal-body">
             <form id="img_up_frm"  method="post" enctype="multipart/form-data">
    			Select image to upload:<br>
   				<input type="file"   name="fileToUpload" id="fileToUpload">
    			<input type="submit" class="btn btn-default" value="Upload Image" name="submit" style="margin-top:30px">
             </form>
         	 </div>
        </div>
      </div>
    </div>
    
    
    
   <!--Img Edit-----> 
    <div id="edit_img_modal" class="modal fade" role="dialog" >
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        	<div class="modal-header">
       			<button type="button" class="close" data-dismiss="modal">&times;</button>
       			<h4 class="modal-title">Edit Student Image</h4>
      		</div>
          	
            <div style="height:260px;width:240px">
             <img id="editing_img" src="Images/b.jpg"/>
            </div>
           
        </div>
      </div>
    </div>
    
    

</body>
</html>
<?php } ?>