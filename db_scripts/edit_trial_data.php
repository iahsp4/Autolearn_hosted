<?php

include("../includes/connect_db.php");

  //get form inputs
 $tid = $_POST['t_id'];
 $td  = $_POST['t_date'];
 $ts =$_POST['t_status'];

 
 $st="";
 $de="";
 $me="";
 
  try{
  $STH=$DBH->prepare("UPDATE trial SET `date`=?,`status`=? WHERE trial_id=?");
  $STH->bindParam(1,$td);
  $STH->bindParam(2,$ts);
  $STH->bindParam(3,$tid);
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