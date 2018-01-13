<?php
session_start();

include("../includes/connect_db.php");

  //get form inputs
 
 $id =$_POST['record_id'];
 
 $st="";
 $de="";
 $me="";
 
  try{
  $STH=$DBH->prepare("DELETE FROM student_attendance WHERE(id=?)");
  $STH->bindParam(1,$id);
  $STH->execute();
 
  if($STH->rowCount()==1){
	 $st = 1;
	 $me = "remove success";
	 $DBH = null;
	 send_response($de,$me,$st);
	 exit(); 
  }
  else{
	 $st = 0;
	 $me = "remove failed,number of affected rows not equal to 1";
	 $DBH = null;
	 send_response($de,$me,$st);
	 exit(); 
  }
 }
catch(PDOException $e){
	 $de = $e->getMessage();
	 $st = 0;
	 $me = "remove query failed";
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