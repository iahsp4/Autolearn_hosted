<?php
  session_start();
  //include("../includes/config.php");
  include("../includes/connect_db.php");


 
  if(isset($_SESSION['curr_registering_stu_id'])){
	  $stuId  = $_SESSION['curr_registering_stu_id'];
  }
  else{
		$data['status']=0;
		$data['db_err']="Query perform error";
		$data['message']="STUDENT ID IS NOT SET";
		echo json_encode($data);
		exit();
  }
  
  
  //get form inputs
 if(isset($_POST['day'])){
  $days = $_POST['day'];
 }
  $category = $_POST['category'];
  $values  = $_POST['checkedvals'];

 //create an array from the checked vehicle class
 $valArray =explode(",",$values);
 $reg_date=date("Y-m-d");
 
 
 
 $sta=""; $de=""; $me="";
 
 
 
 
 

 try{
	   $DBH->beginTransaction();
	  
	   $flag=true;
		   
	   //If a beginner category student is registering 
	   if($category==1){
		   $STH=$DBH->prepare("CALL add_student_v_class(?,?)");
		  
		   foreach($valArray as &$val){
			  $STH->bindParam(1,$val,PDO::PARAM_STR);
			  $STH->bindParam(2,$stuId,PDO::PARAM_INT);
			  if($STH->execute()){
				$sta = "1";
			  }
			  else{
				$sta="0";
				$me = "Query failed at entering: Please try again";
				$flag=false;
				break;
			  }
		   }
	   }
	   
	   
	   //Trained student is registering
	   else if($category==2){
		 $STH=$DBH->prepare("CALL add_trained_student_v_class(?,?,?)");
		 foreach($valArray as &$val){
			  $STH->bindParam(1,$val,PDO::PARAM_STR);
			  $STH->bindParam(2,$stuId,PDO::PARAM_INT);
			  $STH->bindParam(3,$days,PDO::PARAM_INT);
			  if($STH->execute()){
				 $sta = "1";
			  }
		   
			  else{
				 $sta="0";
				 $me = "Query failed at entering: Please try again";
				 $flag=false;
				 break;
			  }
		 }
	   }
	   
	
	   if($flag){
		  $DBH->commit();
		  $data["status"]=$sta;
	   }
	   
	   else{
		  $DBH->rollback(); 
		  $data["status"]=$sta;
		  $data["db_err"]=$de;
		  $data["message"]=$me;
	   }
 }
 catch(PDOException $e){
	$DBH->rollBack();
	$data["status"]=0;
 	$data["db_err"]=$e->getMessage();
 	$data["message"]="Insert Failed"; 
 }
 
 
 $DBH=null;
 
 echo json_encode($data);
 

?>