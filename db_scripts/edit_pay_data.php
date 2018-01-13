<?php


include("../includes/connect_db.php");

  //get form inputs
 

 $pid=$_POST['pay_id'];
 $pt = $_POST['pay_type'];
 $pd  = $_POST['pay_date'];
 $am  =$_POST['amount'];
 $bill =$_POST['bill_no'];
 $commx =$_POST['commx'];
 
 $st="";
 $de="";
 $me="";
 
  try{
  $STH=$DBH->prepare("UPDATE student_payment SET amount=?,`date`=?,bill_no=?,pay_type=?,`comment`=?
		 			  WHERE pay_id=?");
  $STH->bindParam(1,$am);
  $STH->bindParam(2,$pd);
  $STH->bindParam(3,$bill);
  $STH->bindParam(4,$pt);
  $STH->bindParam(5,$commx);
  $STH->bindParam(6,$pid);
  $STH->execute();
 
  if($STH->rowCount()==1){
	 $st = 1;
	 $me = "edit success";
	 $DBH = null;
	 send_response($de,$me,$st);
	 exit(); 
  }
  else{
	 $st = 0;
	 $me = "edit failed,number of affected rows not equal to 1";
	 $DBH = null;
	 send_response($de,$me,$st);
	 exit(); 
  }
 }
catch(PDOException $e){
	 $de = $e->getMessage();
	 $st = 0;
	 $me = "edit query failed";
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