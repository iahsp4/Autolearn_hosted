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
         <div class="row header">
            <div class="col-md-4 col-sm-12 col-xs-12" style="padding-top:20px;">
             
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
               <img src="Images/LOGO.png">
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12" style="padding-top:20px;text-align:right">
             
            </div>
         </div><!--End of Header-->
        
         
         <!--ContentArea-->
         <div class="row ">
           
            <div class="col-md-12 " style="padding:60px 0 60px 0">
              <div style="height:250px;width:500px;margin-left:auto;margin-right:auto;padding:20px 20px 20px 20px;
              border:1px solid #D1D0D0;">
              	 <div style="width:400px;margin-left:auto;margin-right:auto" >
                 <form role="form" method="post" action="db_scripts\login.db.php">
                  <div class="form-group">
                    <label for="username">username:</label>
                    <input type="text" class="form-control" id="uname" name="uname">
                  </div>
                  <div class="form-group" style="display:inline">
                    <label for="pwd" >Password:</label>
                    <input type="password" class="form-control"  id="pwd" name="pwd">
                  </div>
                  <button type="submit" class="btn btn-default" style="margin-top:30px">Login</button>
                </form>
              	</div>
              </div>
            </div>
            
             
         </div><!--End of MainContent-->
    </div><!--End of ContentArea-->
        
    
    </div><!--End of pagebody-->
    
   
    <!--Footer-->
     <div class="footer" >
        <div >
         
        </div>
     </div><!--End of Footer-->


</body>
</html>