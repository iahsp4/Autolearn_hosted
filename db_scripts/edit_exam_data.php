<?php
include("../includes/connect_db.php");

  //get form inputs
 $eid= $_POST['e_id'];
 $en = $_POST['e_no'];
 $ed  = $_POST['e_date'];
 $et  =$_POST['e_time'];
 $em =$_POST['e_marks'];

 $st="";
 $de="";
 $me="";
 
  try{
  $STH=$DBH->prepare("UPDATE exam SET e_no=?,`date`=?,`time`=?,marks=? WHERE exam_id=?");
  $STH->bindParam(1,$en);
  $STH->bindParam(2,$ed);
  $STH->bindParam(3,$et);
  $STH->bindParam(4,$em);
  $STH->bindParam(5,$eid);
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