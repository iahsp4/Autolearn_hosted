<?php
session_start();

include("../includes/connect_db.php");

  //get form inputs
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

 $pt = $_POST['pay_type'];
 $pd  = $_POST['pay_date'];
 $am  =$_POST['amount'];
 $bill = $_POST['bill_no'];
 $commx = $_POST['commx'];
 $values=array($am,$pd,$bill,$pt,$commx,$stuId);
 
 $sta="";
 $db_err="";
 $message="";
 
 try{
   $STH=$DBH->prepare("INSERT INTO student_payment(amount,`date`,bill_no,pay_type,`comment`,stu_id)
				  VALUES(?,?,?,?,?,?)");
   $STH->execute($values);
  
   
   if($STH->rowCount()==1){
	  $sta=1;
	  unset($_SESSION['curr_registering_stu_id']); 
   }
   else{
	  $sta=0;
	  $db_err=mysqli_error($db_connection);
	  $message="Query perform error "; 
   }
 
 }
 
 catch(PDOException $e){
	  $sta=0;
	  $db_err=$e->getMessage();
	  $message="Query perform error "; 
 }

 
 
 
 
 
 $DBH=null;
 
 
 /*prepare response array*/
 $data['status']=$sta;
 $data['db_err']=$db_err;
 $data['message']=$message;

 echo json_encode($data);
 
 
?>