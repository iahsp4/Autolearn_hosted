<?php 
include("../includes/config.php");
include("../includes/connect_db.php"); 

  session_start();
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
  $query="SELECT s.*, v.name as 'vclass' FROM student_attendance s,vclass v WHERE stu_id='$stu_id' 
  		  AND s.v_class_id=v.id";
  $result=mysqli_query($db_connection,$query);
  
  if(!$result){
	  echo "<h2>Query Failed</h2>";
	  mysqli_close($db_connection);
	  exit();
  }
	  
  
  
 
  else{
	 
	  
    ?>
    <div style="width:60%;float:left">	
    <h4>Attendance Info</h4>
  		
        <?php
        if(mysqli_num_rows($result)<1){
   echo "No Records of attendance have been entered!";
  }	   else{                  ?>
  		
  
  
      <table class="table table-striped table-bordered" >
      <th>Date</th><th>Time</th><th>Vehicle class</th><th>Actions</th><th></th>
	  <?php while($row = mysqli_fetch_assoc($result)){ ?>
      <tr>
       <td><?php echo $row['date']?></td>
       <td><?php echo $row['time']?></td>
       <td><?php echo $row['vclass']?></td>
       <td><button type="button" id="att_edit_btn" class="btn btn-default btn-sm" data-toggle="modal" data-target="#add_att_modal"
       data-att_id="<?php echo $row['id']?>" data-att_date="<?php echo $row['date']?>"  data-att_time="<?php echo $row['time']?>"
       data-att_vclass="<?php echo $row['vclass']?>" data-nic="<?php echo $nic?>">Edit</button>
       <button class="btn btn-default btn-sm rm_att" id="<?php echo $row['id']?>" name="" data-nic="<?php echo $nic?>">Remove</button></td>
      <tr>
      <?php }?>
      </table>
      <?php } ?>
  	</div>
    <div style="width:15%;float:left;padding:20px">
    
    </div>
    <div style="width:25%;float:left;padding:20px">
     <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#add_att_modal" id="add_att_btn" style="width:80px"
     data-nic="<?php echo $nic?>" data-test="<?php echo $stu_id?>">Add</button>
    </div>
 <div style="clear:left"></div> 
 
 
 
  <?php 
  mysqli_close($db_connection);
  exit();
  
  }
?>