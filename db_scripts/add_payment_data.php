<?php
session_start();

include("../includes/connect_db.php");

  //get form inputs
 $stuId=$_POST['stu_id'];

 $pt = $_POST['pay_type'];
 $pd  = $_POST['pay_date'];
 $am  =$_POST['amount'];
 $bill =$_POST['bill_no'];
 $commx =$_POST['commx'];
 
 $st="";
 $de="";
 $me="";
 
try{
  $STH=$DBH->prepare("INSERT INTO student_payment(amount,`date`,bill_no,pay_type,`comment`,stu_id)
 		 			  VALUES(?,?,?,?,?,?)");
  $STH->bindParam(1,$am);
  $STH->bindParam(2,$pd);
  $STH->bindParam(3,$bill);
  $STH->bindParam(4,$pt);
  $STH->bindParam(5,$commx);
  $STH->bindParam(6,$stuId);
  $STH->execute();
 
  if($STH->rowCount()==1){
	 $st = 1;
	 $me = "Insert success";
	 $DBH = null;
	 send_response($de,$me,$st);
	 exit(); 
  }
  else{
	 $st = 0;
	 $me = "Insert failed,number of affected rows not equal to 1";
	 $DBH = null;
	 send_response($de,$me,$st);
	 exit(); 
  }
 }
catch(PDOException $e){
	 $de = $e->getMessage();
	 $st = 0;
	 $me = "Insert query failed";
	 $DBH = null;
	 send_response($de,$me,$st);
	 exit();
 }
 

 
function send_response($d,$m,$s){
	$data['db_err']=$d;
	$data['message']=$m;
	$data['status']=$s;
	echo json_encode($data);  
}

 
?>