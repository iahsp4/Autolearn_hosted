<?php 
  include("../includes/connect_db.php");  
  session_start();
  
  //get the form data
  $nic = htmlentities($_POST['nic']);
  
  
  
  //perform database operations
  $sta="";$ms="";
  try{
	$STH2 =$DBH->prepare("SELECT COUNT(*) FROM student WHERE(nic=?)");
	$STH2->bindParam(1,$nic);
	$STH2->execute();
	if(!$STH2->fetchColumn()>0){
		$sta=0;
		$ms="No Records found !\n Please check the NIC number";
	}
	else {
		$sta=1;
		$STH=$DBH->prepare("SELECT * FROM student WHERE(nic=?)");
		$STH->bindParam(1,$nic);
		$STH->execute();
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$row=$STH->fetch();
		$_SESSION['searched_student_nic']=$nic;
	    $_SESSION['searched_student_stu_id']=$row['stu_id'];
	}
  }
  catch(PDOException $e){
	  $sta=0;
	  $ms=$e->getMessage();
  }
  
  
  
  //finalize response
  $data['status']=$sta;
  $data['message']=$ms;
  if(isset($row)){
  		$data['data_array'] = $row;
  }
 
  $DBH=null;
  echo json_encode($data);
  exit();
?>