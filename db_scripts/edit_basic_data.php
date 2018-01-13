<?php
  //session_start();
 
  
  //$nic =$_POST['nic']; 
  //$stuId=$_SESSION['searched_student_stu_id'];
 
  /* 
  $saved_t1=$_SESSION['searched_stu_t1'];
  if(isset($_SESSION['searched_stu_t2'])){
	$saved_t2=$_SESSION['searched_stu_t2'];  
  }
  */
  
  
  $stuId=$_POST['stu_id'];
  $fullname =$_POST['fullname'];
  $surname =$_POST['surname'];
  $gender =$_POST['gender'];
  $p_address =$_POST['p_address'];
  
  $tel1 =$_POST['tp1'];
   
  if(isset($_POST['tp2']) && $_POST['tp2']!=0){
   $tel2 =$_POST['tp2'];
   }
  else{
	$tel2=0;  
  }
  $dob =$_POST['dob_edit'];
  $ad_date =$_POST['ad_date_edit'];
  $hft =$_POST['height_ft'];
  $hin=$_POST['height_in'];
  $height=$hft.".".$hin;
  $div_sec =$_POST['div_sec'];
  $city =$_POST['city'];
  $police =$_POST['police'];
  $district =$_POST['district'];
  
  $age;
  
  $values=array($fullname,$surname,$gender,$p_address,$dob,$tel1,$tel2,$ad_date,$height,$div_sec,$city,$police,$district,$stuId);
  
  $st="";
  $de="";
  $me="";
 
 
  include("../includes/connect_db.php");
  
  try{
	  //$DBH->beginTransaction();
	  //$flag = true;
	  
	  $STH=$DBH->prepare("UPDATE  student 
	                      SET full_name=?,surname=?,gender=?,per_address=?,dob=?,
						  tp1=?,tp2=?,admission_date=?,height=?,div_sec=?,city=?,
						  police=?,district=? 
	 					  WHERE stu_id=?");
	  $STH->execute($values);
	  
	  if($STH->rowCount()==1){
		 $st = 1;
		 $me = "edit success";
		 $DBH = null;
		 send_response($de,$me,$st);
		 exit(); 
	  }
	  else{
		 $st = 2;
		 $me = "edit failed,number of affected rows not equal to 1";
		 $DBH = null;
		 send_response($de,$me,$st);
		 exit(); 
	  }
	 }
	catch(PDOException $e){
		 $de = $e->getMessage();
		 $st = 2;
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