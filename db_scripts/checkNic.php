<?php
session_start();
include("../includes/connect_db.php");

$requestednic  = $_REQUEST['nic'];

	//PERFORM QUERY
	try{	
	$STH=$DBH->prepare("SELECT COUNT(*) FROM student WHERE(nic=?)");
	$STH->bindParam(1,$requestednic,PDO::PARAM_INT);
	$STH->execute();
	if($STH->fetchColumn()>0){
		echo 'false';
	}
	
	else{
		echo 'true';
	}
	
 }
 catch(PDOException $e){
	echo $e->getMessage(); 
 }

	

 
?>