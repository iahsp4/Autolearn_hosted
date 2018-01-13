<?php
session_start();
include("../includes/connect_db.php");

 
 
 //get form inputs
 if(isset($_POST['day'])){
   $days = $_POST['day'];
 }
   $category = $_POST['category'];
   $values  = $_POST['checkedvals'];
   $stuId=$_POST['stu_id'];
   $valArray =explode(",",$values);//create an array from the checked vehicle class
   $reg_date=date("Y-m-d");
 
 
 
 $sta=""; $de=""; $me="";
 
 try{
     //Add each vehicle class to the relevant student_v_class table
	 $DBH->beginTransaction();
	 $flag=true;
	 
	 
	 
	 //Beginner student
	 if($category==1){
	  $STH=$DBH->prepare("CALL delete_stu_course_data(?)");
	  $STH->bindParam(1,$stuId);
	  if($STH->execute()){
	  
	   $STHt=$DBH->prepare("CALL add_student_v_class(?,?)");
	   foreach($valArray as &$val){
		$STHt->bindParam(1,$val,PDO::PARAM_STR);
		$STHt->bindParam(2,$stuId,PDO::PARAM_INT);
		
		if($STHt->execute()){
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
	  else{
		 $sta="0";
		 $me = "Query failed ";
		 $flag=false;
		} 
	 }
	 
	 
	 
	 
	 
	 
	 
	 //Trained Student
	 else if($category==2){
	  $STH=$DBH->prepare("CALL delete_stu_course_data(?)");
	  $STH->bindParam(1,$stuId);
	  if($STH->execute()){
	  
	   $STHt=$DBH->prepare("CALL add_trained_student_v_class(?,?,?)");
	   foreach($valArray as &$val){
		$STHt->bindParam(1,$val,PDO::PARAM_STR);
		$STHt->bindParam(2,$stuId,PDO::PARAM_INT);
		$STHt->bindParam(3,$days,PDO::PARAM_INT);
		
		if($STHt->execute()){
		 $sta = "1";
		}
		else{
		 $sta="0";
		 $me = "Query failed at entering: Please try agai";
		 $flag=false;
		 break;
		}
	   }
	   
	  }
	 
	  else{
		 $sta="0";
		 $me = "Query failed";
		 $flag=false;
		}
	 
	 
	 }
	 

	 //create return data array
	 if($flag){
		$DBH->commit(); 
		$data["status"]=$sta;
	 }
 
 }
 
catch(PDOException $e){
	  $DBH->rollBack(); 
	  $data["status"]=$sta;
	  $data["db_err"]=$e->getMessage();
	  $data["message"]=$me;
	  $DBH=null;
	  echo json_encode($data);
	  exit();
}
 
$DBH=null;
$data["message"]=$me;
echo json_encode($data);
 

?>