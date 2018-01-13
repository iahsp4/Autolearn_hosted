<?php 
include("../includes/config.php");
  
  session_start();
  //get the form data
  $nic = $_POST['nic'];
  //$nic=$_SESSION['searched_student_nic'];
  
  
  $query="SELECT s.img_id FROM student s WHERE nic='$nic'";
  $result=mysqli_query($db_connection,$query);
  
  $st=0;$me="";$db_err="";$img_n="";
 
  if(!$result){
	 $st=0;
	 $me="Query Failed";
	 $db_err=mysqli_error($db_connection);
	 mysqli_close($db_connection);
	 exit();
  }
	  
  
  else{
	  $row = mysqli_fetch_assoc($result); 
  	  if($row['img_id']==""){
		 $st=0; 
	  }
	  else{
	  	 $img_n=$row['img_id'];
	   	 $st=1;
	  	 $me="Query Failed";
	  }
  }
 
 $data['status']=$st;
 $data['message']=$me;
 $data['image_name']=$img_n;
 $data['db_er']=$db_err;
 
 echo json_encode($data);
 mysqli_close($db_connection);
 
 exit();  
 

?>