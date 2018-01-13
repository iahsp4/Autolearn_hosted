<?php
session_start();

include("../includes/connect_db.php");

  //get form inputs
 //$stuId=$_SESSION['searched_student_stu_id'];

 $stuId = $_POST['stu_id'];
 $en  = $_POST['e_no'];
 $ed  = $_POST['e_date'];
 $et  = $_POST['e_time'];
 $em  = $_POST['e_marks'];

 
 $st="";
 $de="";
 $me="";
 
 
 
 try{
  $STH=$DBH->prepare("INSERT INTO exam(e_no,`date`,`time`,marks,stu_id)
 		 			  VALUES(?,?,?,?,?)");
  $STH->bindParam(1,$en);
  $STH->bindParam(2,$ed);
  $STH->bindParam(3,$et);
  $STH->bindParam(4,$em);
  $STH->bindParam(5,$stuId);
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