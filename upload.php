<?php

session_start();
include("includes/config.php");

if(isset($_SESSION['searched_student_stu_id'])){
	$save=1;
}
else{
	$save=0;
}


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$temp_name = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

$message="";
$st=0;
$filename="";

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $message= "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $message= "File is not an image.";
        $uploadOk = 0;
    }
}

//Check if file already exists
if (file_exists($target_file)) {
    $message= "Sorry, file already exists.";
    $uploadOk = 0;
}




// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $message= "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
   $message= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
   $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $message= "File was not uploaded.\n".$message;
	$st=2;
} 

// if everything is ok, try to upload file
else {
    
	//upload file------------------------------------------------------------
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
	{
		 //if changing an existing image add it to the database
		if($save){
			//get the students information
			$nic=$_SESSION['searched_student_nic'];
			$sid=$_SESSION['searched_student_stu_id'];
			//check img file is already there,if exists delete
			$q="SELECT img_id FROM student WHERE stu_id='$sid'";
			$r=mysqli_query($db_connection,$q);
			if($r){
			 $row=mysqli_fetch_assoc($r);
			 if(!$row['img_id']==NULL && file_exists("uploads/".$row['img_id'])){
				unlink("uploads/".$row['img_id']); 
			 }
			}
			//rename the newly uploaded file with relevant nic prefix
			$new_img_id=$nic."_".rand(10,1000).".".pathinfo($temp_name,PATHINFO_EXTENSION);
			if(!rename("uploads/".$temp_name,"uploads/".$new_img_id)){
			  $message= "The image has been successfully changed to ". basename( $_FILES["fileToUpload"]["name"]);
			  $filename=basename($new_img_id);
			  $st=1;
			}
			
			//add new entry
			$q="UPDATE student SET img_id='$new_img_id' WHERE stu_id='$sid'";
			$r=mysqli_query($db_connection,$q);
			if($r){
			  $message= "The image has been successfully changed to ". basename( $_FILES["fileToUpload"]["name"]);
			  $filename=basename($new_img_id);
			  $st=1;
			}
			else{
			  $message= "The image change was not successfull";
			  $st=0;	
			}
	   }
	  //if not trying to change an existing image
	  else{
		  $message= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
       	  $filename=basename( $_FILES["fileToUpload"]["name"]);
		  $st=1;
		  $_SESSION['curr_reg_stu_img']=$temp_name;
	  }
   }//end of upload file------------------------------------------------------------------- 

	//if uploading new file failed
   else {
        $message= "Sorry, there was an error uploading your file.";
    	$st=2;
   }

}






$data['status']=$st;
$data['message']=$message;
$data['fn']=$filename;

echo json_encode($data);

?>
