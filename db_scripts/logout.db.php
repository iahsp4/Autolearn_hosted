<?php 

 session_start();
 
 $_SESSION = array();
 
 if(isset($_SESSION[session_name()])){
	setcookie(session_name(),'',time()-4200,'/');
 }
 
 session_destroy();
 
 header('Location:../index.php' );
 
 
 ?>