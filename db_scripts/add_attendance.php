<?php
  session_start();
  
  if(!isset($_SESSION['username'])){
	header("Location:../index.php");
	exit();
  }
		
 include('../includes/auto_logout.php');
 
 include("../includes/connect_db.php");
 
 /*If data comes from the home attendance form*/
 if(isset($_POST['nic'])){
	$nic=$_POST['nic'];
	//$date=date("Y-m-d");
	$mode=2; 
 }
 /*data coming from the students' attendance form*/
 else if(isset($_POST['stu_id'])){
  	$stu_id=$_POST['stu_id'];
	//$date=$_POST['att_date'];
	$mode=1;
 }
 
 $date=$_POST['att_date'];
 $time=$_POST['att_time'];
 $vclass=$_POST['att_vclass'];
 
 
 $de="";$me="";$st=0;
 //$stu_id="";



 if($mode==2){
	  try{ 
	   $STH = $DBH->prepare("SELECT stu_id FROM student WHERE(nic=?)");
	   $STH->bindParam(1, $nic);
	   $STH->execute();
	   $STH->setFetchMode(PDO::FETCH_ASSOC);
	   while($row = $STH->fetch()) {
		$stu_id=$row['stu_id']; 
	   }
	  }
	  catch(PDOException $e){
		   $de=$e->getMessage();
		   $st = 0;
		   $me = "NIC query failed";
		   $DBH = null;
		   send_response($de,$me,$st);
		   exit();
	  } 
 }
 
 
 
 
 try{
  $STH=$DBH->prepare("INSERT INTO student_attendance(date,time,v_class_id,stu_id)
 	  VALUES(?,?,?,?)");
  $STH->bindParam(1,$date);
  $STH->bindParam(2,$time);
  $STH->bindParam(3,$vclass);
  $STH->bindParam(4,$stu_id);
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