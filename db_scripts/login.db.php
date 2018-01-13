<?php  

  include("../includes/connect_db.php");
  
  session_start();
  //get the form data
  $uid = $_POST['uname'];
  $pass = $_POST['pwd'];
  
  //
  try{
 
  
  
  //if user is a student--------------------------------------  
 	  $STH=$DBH->prepare(" SELECT COUNT(*) FROM users WHERE (username=?) AND (password=?)");
      $STH->bindParam(1,$uid);
	  $STH->bindParam(2,$pass);
	  $STH->execute();
	  if($STH->fetchColumn()>0){
	  	$STH=$DBH->prepare("SELECT * FROM users WHERE  (username=?) AND (password=?)");
      	$STH->bindParam(1,$uid);
	  	$STH->bindParam(2,$pass);
	  	$STH->execute();
	    $STH->setFetchMode(PDO::FETCH_ASSOC);
		$row=$STH->fetch();
			  $username=$row['username'];
			  $_SESSION['username'] = $row['username'] ;
			  //$_SESSION['acctype'] = 3;
			  header("Location:../home.php");
			  $DBH=null;
			  exit();
	   }
	   
	  else{
		$e=1;
		header("Location:../index.php?error=$e");		
		$DBH=null;
		exit();
		}

  }
  
  catch(PDOException $e){
		$ER=$e->getMessage();
		header("Location:../index.php?error=$e");
		$DBH=null;
		exit();		
  } 
	  
	  
	  
	  

 
 
?>	  