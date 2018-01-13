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
  $query="SELECT * FROM student_payment WHERE stu_id='$stu_id'";
  $result=mysqli_query($db_connection,$query);
  
  if(!$result){
	  echo "<h2>Query Failed</h2>";
	  mysqli_close($db_connection);
	  exit();
  }
	  
  
 
 
  else{
	 
	  
    ?>
    <div style="width:60%;float:left">	
   	  <h4>Payment Info</h4>
      
  		
  <?php if(mysqli_num_rows($result)<1){
   				echo  "No Records of payments have been entered!";
 			 }
  		else{?>
        
      <table class="table table-striped table-bordered" >
      <th>Bill no</th><th>Payment Type</th><th>Date</th><th>Amount</th><th>Comments</th><th>Actions</th>
	  <?php while($row = mysqli_fetch_assoc($result)){ ?>
      <tr>
       <?php $pid= $row['pay_id'];?>
       <td><?php echo $row['bill_no'];?></td>
       <td><?php echo $row['pay_type'];?></td>
       <td><?php echo $row['date'];?></td>
       <td><?php echo $row['amount'];?></td>
       <td><?php echo $row['comment'];?></td>
       <td><button type="button" data-toggle="modal" data-target="#add_pay_modal" id="edit_btn" 
            class="btn btn-default btn-sm edit_pay_btn" data-payid="<?php echo $pid;?>"
            data-bn="<?php echo $row['bill_no'];?>" data-ptyp="<?php echo $row['pay_type'];?>" data-pd="<?php echo $row['date'];?>"
            data-pam="<?php echo $row['amount'];?>" data-pc="<?php echo $row['comment'];?>" data-nic="<?php echo $nic;?>">
            Edit
            </button>
            
            <button class="btn btn-default btn-sm rm_pay" id="<?php echo $pid;?>" name="" 
             data-nic="<?php echo $nic;?>">
             Remove
             </button>
      </td>
      
      
      <tr>
      <?php }?>
      </table>
     <?php }?>
  	</div>
    <div style="width:15%;float:left;padding:20px">
    
    </div>
    <div style="width:25%;float:left;padding:20px">
     <button class="btn btn-default btn-sm" id="add_payment_btn" data-toggle="modal" data-target="#add_pay_modal" 
     data-test="<?php echo $stu_id;?>"  data-nic="<?php echo $nic;?>" style="width:80px">Add</button>
    </div>
    
 <br style="clear:left;">
 
 
 
 
 <!--MODAL---------------------------------------------------------------->













 
 
 
  <?php 
  
  exit();
  
  }
?>