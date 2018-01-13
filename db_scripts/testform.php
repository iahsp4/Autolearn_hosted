<?php
  session_start();
  date_default_timezone_set('Asia/Colombo');
  
  //include("../includes/config.php");
  include("../includes/connect_db.php");
  
 
  $nic =$_POST['nic']; 
  $fullname =$_POST['fullname'];
  $surname =$_POST['surname'];
  $gender =$_POST['gender'];
  $p_address =$_POST['p_address'];
  $tel_array = array();
  $tel1 =$_POST['tp1'];
   array_push($tel_array,$tel1);
  if(isset($_POST['tp2']) && $_POST['tp2'] != ""){
   $tel2 =$_POST['tp2'];
   array_push($tel_array,$tel2);
  }
  else{$tel2=NULL;}
  if(isset($_SESSION['curr_reg_stu_img'])){
   $img_id=$_SESSION['curr_reg_stu_img'];
  }
  else {$img_id=NULL;}
  $dob =$_POST['dob'];
  $ad_date =$_POST['ad_date'];
  $hft =$_POST['height_ft'];
  $hin=$_POST['height_in'];
  $height=$hft.".".$hin;
  $div_sec =$_POST['div_sec'];
  $city =$_POST['city'];
  $police =$_POST['police'];
  $district =$_POST['district'];
  $recordDt=date('Y-m-d H:i:s');
  $age;
  
  
  
  
 
  
  
  //Start transaction
  //mysqli_autocommit($db_connection, false);
  try{
	  $DBH->beginTransaction();
	  $flag = true;
	
	  if($img_id!=NULL)
	  {
		//use the temporary image name to get the extension of the file
		$new_img_id=$nic."_".rand(10,1000).".".pathinfo($img_id,PATHINFO_EXTENSION);
		if(!rename("../uploads/".$img_id,"../uploads/".$new_img_id))
		{
			$flag=false;
		}
	  }
	  else
	  {
		$new_img_id=NULL;
	  }
	  
	  $query = "INSERT INTO student
				(nic,full_name,surname,gender,per_address,dob,tp1,tp2,admission_date,height,
				div_sec,city,police,district,img_id,record_datetime)
				VALUES('$nic','$fullname','$surname',$gender,'$p_address','$dob','$tel1','$tel2','$ad_date',$height,
				'$div_sec','$city','$police','$district','$new_img_id','$recordDt')";
	  $values=array($nic,$fullname,$surname,$gender,$p_address,$dob,$tel1,$tel2,$ad_date,$height,$div_sec,$city,$police,$district,$new_img_id,
					$recordDt);
	  
	  $STH=$DBH->prepare("INSERT INTO student
						  (nic,full_name,surname,gender,per_address,dob,tp1,tp2,admission_date,height,
						  div_sec,city,police,district,img_id,record_datetime)
						  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	  $STH->execute($values);
	 
	 
	  
	
	  $new_stu_id =$DBH->lastInsertId();
	  $_SESSION['curr_registering_stu_id']=$new_stu_id;
	  $_SESSION['curr_registering_stu_nic']=$nic;
	
	 
	  if($flag){
		 $DBH->commit();
		 //mysqli_commit($db_connection);
		 $data['status'] = 1;
		 $data['message'] = "success";
		 unset($_SESSION['curr_reg_stu_img']);  
	  }
	  else{
		 $DBH->rollBack();
		 $data['status'] = 0;
		 $data['message'] = "insert failed:possible image error";
		 if(isset($_SESSION['curr_reg_stu_img'])){ 
		   unset($_SESSION['curr_reg_stu_img']);  
		 }
	  }
 
  }
 
  catch(PDOException $e)
  {
     $DBH->rollBack();
	 //mysqli_rollback($db_connection);
     unset($_SESSION['curr_registering_stu_id']);
  
     if(file_exists("uploads/".$img_id)){
	   unlink("uploads/".$img_id);
     }
     elseif(file_exists("uploads/".$new_img_id)){
	   unlink("uploads/".$new_img_id);	  
     }
     else{
     }
  
     unset($_SESSION['curr_reg_stu_img']);
  
     $data['db_err']=$e->getMessage();
	 $data['status'] = 2;
     $data['message'] = "Query failed try again"; 
 }
  
  
  
  $DBH=null;
  echo json_encode($data);
?>