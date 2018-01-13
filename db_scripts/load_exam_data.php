<?php 
include("../includes/config.php");
include("../includes/connect_db.php"); 
 
  
  //get the form data
  $nic = $_POST['nic'];
  //$nic=$_SESSION['searched_student_nic'];
  
  //get student id for nic
  try{ 
	$STH=$DBH->prepare("SELECT stu_id FROM student WHERE (nic=?)");
	$STH->bindParam(1,$nic,PDO::PARAM_STR);
	$STH->execute();
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	$row=$STH->fetch();
	$stu_id=$row['stu_id'];
  }
  catch(PDOException $e){
	echo "NIC Query failed";
	$DBH=null;
	exit();  
  }
  
  $DBH=null;
 
  
  
  //get course data
  $query="SELECT e.* FROM exam e WHERE stu_id='$stu_id'";
  $result=mysqli_query($db_connection,$query);
  
  $query_trial="SELECT * FROM trial WHERE stu_id=$stu_id";
  $result_trial=mysqli_query($db_connection,$query_trial);
  
  
  if(!($result || $result_trial)){
	  echo "<h2>Query Failed</h2>";
	  mysqli_close($db_connection);
	  exit();
  }
	  
  
  else{ 
       //if no exam records were found 
  
  	  //Exam information Section ?>
      <div style="width:60%;float:left;min-height:200px">	
	   <h4>Exam Info</h4>
	   <?php if(mysqli_num_rows($result)<1){ 
       echo "No Records of exams have been entered!";
	   }
	   else{?>
	   <table class="table  table-bordered" >
      <th>Exam no</th><th>Exam date</th><th>Time</th><th>Marks</th><th>Actions</th>
	  <?php while($row = mysqli_fetch_assoc($result)){ ?>
      <tr>
       <?php ?>
       <td><?php echo $row['e_no'];?></td>
       <td><?php echo $row['date'];?></td>
       <td><?php echo $row['time'];?></td>
       
       <td><?php if($row['marks']==0)echo "Scheduled";else echo $row['marks'];?></td>
       <td>
       
       <button type="button" id="exm_edit_btn" class="btn btn-default btn-sm" data-toggle="modal" data-target="#add_exm_modal"
       data-e_no="<?php echo $row['e_no'];?>" data-date="<?php echo $row['date'];?>" data-time="<?php echo $row['time'];?>" 
       data-marks="<?php echo $row['marks'];?>" data-e_id="<?php echo $row['exam_id'];?>" data-nic="<?php echo $nic;?>" >Edit</button>
       
       
       <button class="btn btn-default btn-sm rm_exm" id="<?php echo $row['exam_id'];?>" name="" data-nic="<?php echo $nic;?>">Remove</button></td>
      </tr>
      <?php }?>
      </table>
	   <?php } ?>
      </div>
      
      <div style="width:15%;float:left;padding:20px">
      </div>
      
      <div style="width:25%;float:left;padding:20px">
       <button class="btn btn-default btn-sm" id="add_exm_btn" data-toggle="modal" data-target="#add_exm_modal" style="width:80px"
        data-test="<?php echo $stu_id;?>"  data-nic="<?php echo $nic;?>">Add</button>
      </div>
      
      <div style="clear:left"></div>
      <hr style="color:#821214"> 
      
      

      
	  <?php //Trial Information Section ?>
      <div style="width:60%;float:left;min-height:200px">	
	   <h4>Trial Info</h4>
	   <?php if(mysqli_num_rows($result_trial)<1){ 
	   echo mysqli_error($db_connection);
       echo "No Records of trial have been entered!";
	   }
	   else{?>
	   <table class="table table-bordered" >
      <th>Trial Date</th><th>Status</th><th>Actions</th>
	  <?php while($row = mysqli_fetch_assoc($result_trial)){ ?>
      <tr>
       <td><?php echo $row['date'];?></td>
       <td><?php if($row['status']==1){
		   			echo 'Passed';
				 }
				 elseif($row['status']==0){
					 echo 'Failed';
				}
				 elseif($row['status']==2){
					 echo 'Scheduled';
				}		
	   			 else{}
			?>
       </td>
       <td><button type="button" id="tr_edit_btn" class="btn btn-default btn-sm" data-toggle="modal" data-target="#add_tr_modal"
       data-t_id="<?php echo $row['trial_id'];?>" data-t_date="<?php echo $row['date'];?>"  data-nic="<?php echo $nic;?>"
       data-t_status="<?php echo $row['status'];?>" >Edit</button>
       <button class="btn btn-default btn-sm rm_tr" id="<?php echo $row['trial_id'];?>" name=""   data-nic="<?php echo $nic;?>">Remove</button></td>
      </tr>
      <?php }?>
      </table>
	   <?php
       }
	   ?>
      </div>
      
      <div style="width:15%;float:left;padding:20px">
      </div>
      
      <div style="width:25%;float:left;padding:20px">
       <button class="btn btn-default btn-sm" id="add_tr_btn" data-toggle="modal" data-target="#add_tr_modal" style="width:80px"
        data-test="<?php echo $stu_id;?>"  data-nic="<?php echo $nic;?>">Add</button>
      </div>
      
      <br style="clear:left;"> 
	  
	  
<?php } ?>
	   

 
 
  <?php 

  
  
  
  exit();
?>