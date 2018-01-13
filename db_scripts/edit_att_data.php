<?php

include("../includes/connect_db.php");

  //get form inputs
 $ai = $_POST['att_id'];
 $ad  = $_POST['att_date'];
 $at =$_POST['att_time'];
 $av =$_POST['att_vclass'];
 
 $st="";
 $de="";
 $me="";
 
 try{
  $STH=$DBH->prepare("UPDATE student_attendance SET `date`=?, `time`=?, v_class_id=? WHERE `id`=?");
  $STH->bindParam(1,$ad);
  $STH->bindParam(2,$at);
  $STH->bindParam(3,$av);
  $STH->bindParam(4,$ai);
  $STH->execute();
 
  if($STH->rowCount()==1){
	 $st = 1;
	 $me = "update success";
	 $DBH = null;
	 send_response($de,$me,$st);
	 exit(); 
  }
  else{
	 $st = 0;
	 $me = "update failed,number of affected rows not equal to 1";
	 $DBH = null;
	 send_response($de,$me,$st);
	 exit(); 
  }
 }
catch(PDOException $e){
	 $de = $e->getMessage();
	 $st = 0;
	 $me = "update query failed";
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