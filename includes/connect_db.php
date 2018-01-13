<?php
	$host   = "localhost";	 //"pdb3.awardspace.net";
    $dbuser = "root"; 		 //"1981124_avian";
    $dbpass = "";     		 //"zE!SSFIRE1993";
    $dbname = "autolearn";				 //"1981124_avian";
	
	try{
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass);
		$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch(PDOException $e) {
    	echo $e->getMessage();	
	}
?>