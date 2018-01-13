<?php session_start();
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
<script src="js/jquery.js"></script>

<script src="js/bootstrap.js"></script>
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
             
              <div class="col-md-10 col-sm-12 col-xs-12 colMain" >
               <h4>Generate reports</h4>
             </div><!--End of MainContent-->
         </div><!--End of ContentArea-->
        
    
    </div><!--End of pagebody-->
    
   
    <!--Footer-->
     <div class="footer_other" >
        <div class="col-md-12 col-sm-12 col-xs-12">
         
        </div>
     </div><!--End of Footer-->


</body>
</html>
<?php } ?>