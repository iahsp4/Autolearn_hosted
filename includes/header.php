<div class="row header">
            <div class="col-md-5 col-sm-12 col-xs-12" style="padding-top:20px;">
              <a href="home.php"><img src="Images/LOGO.png"></a>
            </div>
            <div class="col-md-5 col-sm-12 col-xs-12">
             
            </div>
            <div class="col-md-2 col-sm-12 col-xs-12" style="padding-top:20px;text-align:right;font-family:'Corbel', Arial">
               <span style="color:#7F7C7C;font-size:14px">Logged in As</span>
              <?php if(isset($_SESSION['username'])){
			   			echo '<br><span style="font-size:16px">'.$_SESSION['username'].'</span>';
			  	        echo '<br><br><a href="db_scripts/logout.db.php">logout</a>';
			        }
			  ?>
            </div>
</div>