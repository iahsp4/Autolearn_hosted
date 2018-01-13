<?php
 //database details
$host = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $dbname = "autolearn";
 
 //connect to the database
 $db_connection = mysqli_connect($host,$dbuser,$dbpass,$dbname);
 
 //if connect not successful
if(mysqli_connect_errno()){
    die("Database Connection Failed :".mysqli_connect_error()."(".mysqli_connect_errno().")");
}
 
 
 ?>