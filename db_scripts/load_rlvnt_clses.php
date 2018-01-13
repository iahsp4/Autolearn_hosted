<?php
 include("../includes/config.php");
 
 $nic=$_POST['chk'];
 
 $de="";$me="";$st=0;$clvpairs=array();
 //GET ID FROM NIC
 $q="SELECT stu_id FROM student WHERE nic='$nic'";
 $r=mysqli_query($db_connection,$q);
 if($r){
	 if(mysqli_num_rows($r)>0){
	   $idrow=mysqli_fetch_row($r);
	   $stu_id=$idrow[0]; 	 
	 }
	 else{
	   $de = mysqli_error($db_connection);
	   $st = 3;
	   $me = "NIC not registered";
	   mysqli_close($db_connection);
	   send_response($de,$me,$st,$clvpairs);
	   exit();
    }
 }
 else{
	 $de = mysqli_error($db_connection);
	 $st = 0;
	 $me = "NIC query failed";
	 mysqli_close($db_connection);
	 send_response($de,$me,$st,$clvpairs);
	 exit();
 }
 
 
 
 //CHECK VCLASS TABLES
 $qt="SELECT v.name as 'cname',sv.class_id 
 	  FROM student_v_class sv,vclass v 
 	  WHERE sv.stu_id='$stu_id' 
	  AND sv.class_id=v.id";
 $qtr=mysqli_query($db_connection,$qt);
 if($qtr){
	 if(mysqli_num_rows($qtr)>0){
		 while($row=mysqli_fetch_assoc($qtr)){
			 
			$clvpairs=performSwitch($row['class_id'],$row['cname'],$clvpairs);
		 }
		 $st = 1;
		 $me = "success";
		 mysqli_close($db_connection);
		 send_response($de,$me,$st,$clvpairs);
		 exit(); 
	 }
	 else{
	 	 $qs="SELECT v.name as 'cname',tv.class_id 
 	  		  FROM trained_stu_v_class tv,vclass v 
 	 		  WHERE tv.stu_id='$stu_id' 
	  		  AND tv.class_id=v.id";
 		 $qsr=mysqli_query($db_connection,$qs);
	 	 if($qsr){
			 if(mysqli_num_rows($qsr)>0){
			   while($row=mysqli_fetch_assoc($qsr)){
				   $clvpairs=performSwitch($row['class_id'],$row['cname'],$clvpairs);
			   }
			   $st = 1;
			   $me = "success";
			   mysqli_close($db_connection);
			   send_response($de,$me,$st,$clvpairs);
			   exit(); 
			 }
	     	 else{
			   $st = 2;
			   $me = "No vehicle_class has been registered";
			   mysqli_close($db_connection);
			   send_response($de,$me,$st,$clvpairs);
			   exit();
			 }
		 
		 }
		 
		 else{
			   $de = mysqli_error($db_connection);
			   $st = 0;
			   $me = "select query failed";
			   mysqli_close($db_connection);
			   send_response($de,$me,$st,$clvpairs);
			   exit(); 
		 }
	 }
 }
 
 
 else{
	 $de = mysqli_error($db_connection);
	 $st = 0;
	 $me = "Insert query failed";
	 mysqli_close($db_connection);
	 send_response($de,$me,$st,$clvpairs);
	 exit();
 }
 
 
 
 
 //function used to send the response to ajax
 
 function send_response($d,$m,$s,$a){
	$data['db_err']=$d;
	$data['message']=$m;
	$data['status']=$s;
	$data['clvpairs']=$a;
	echo json_encode($data); 
 }
 
 function performSwitch($cid,$cname,$clvpairs){
	 switch ($cname) {
				 case "BA":
				 	  $pair=array("id"=>"1","value"=>"B");
					  array_push($clvpairs,$pair);
					  $pair=array("id"=>"8","value"=>"A");
					  array_push($clvpairs,$pair);
					  break;
			 	 
				 case "BB1":
				 	  $pair=array("id"=>"1","value"=>"B");
					  array_push($clvpairs,$pair);
					  $pair=array("id"=>"3","value"=>"B1");
					  array_push($clvpairs,$pair);
					  break;
				
			     case "B1A":
				      $pair=array("id"=>"3","value"=>"B1");
					  array_push($clvpairs,$pair);
					  $pair=array("id"=>"8","value"=>"A");
					  array_push($clvpairs,$pair);
					  break;
				
			 	 case "BB1A":
				 	  $pair=array("id"=>"1","value"=>"B");
					  array_push($clvpairs,$pair);
					  $pair=array("id"=>"3","value"=>"B1");
					  array_push($clvpairs,$pair);
					  $pair=array("id"=>"8","value"=>"A");
					  array_push($clvpairs,$pair);
					  break;
				 case "DA":
				 	  $pair=array("id"=>"7","value"=>"D");
					  array_push($clvpairs,$pair);
					  $pair=array("id"=>"8","value"=>"A");
					  array_push($clvpairs,$pair);
			
				default:
			 		  $pair=array("id"=>$cid,"value"=>$cname);
			 		  array_push($clvpairs,$pair);
					 
			 	
			 }
			 
			 return $clvpairs;
	 
 }
?>