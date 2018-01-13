<?php


require '../PHPmailer/PHPMailerAutoload.php';
	
				 $query3 =  "SELECT email FROM student WHERE username='$uname'";
  	             $result3 = mysqli_query($db_connection,$query3);
				 $row=mysqli_fetch_assoc($result3); 
				 
				 $query4 =  "SELECT ename,sdate FROM event WHERE eid='$eid'";
  	             $result4 = mysqli_query($db_connection,$query4);
				 $row2=mysqli_fetch_assoc($result4); 
				 
				 
				$email = $row['email'];
				$title="Event Approval -University EDU";
				
				$message = "
							<html>
							<head>
							<title>HTML email</title>
							</head>
							<body> 
							 <p>You request to attend the event ".$row2['ename'] ." on ".$row2['sdate']. "has been appoved.Hope your presence at the event.
							 <BR>
							 Thank you.
							 </p>
							 
							
							</body>
							</html>
							";

			  $mail = new PHPMailer;
			
			  $mail->isSMTP();                                    
			  $mail->Host = 'smtp.gmail.com';  
			  $mail->SMTPAuth = true;                              
			  $mail->Username = 'hasanthatest@gmail.com';                 // Email address
			  $mail->Password = 'hasanthatest123';                 // password
			  $mail->SMTPSecure = 'tls';                           
			  $mail->Port = 587;                                   
			  $mail->From = 'no-reply@edu.com';
			  $mail->FromName = 'University EDU';
			  $mail->addAddress($email);     
			  //$mail->AddEmbeddedImage($image_path);
			 
			  
			  
			  $mail->isHTML(true);                                 
			  
			  $mail->Subject = $title;
			  $mail->Body    = $message;
			
			  
			  if(!$mail->send()) {
				  echo 'Message could not be sent.';
				  echo 'Mailer Error: ' . $mail->ErrorInfo;
			  } else {
				  //echo 'Message has been sent';
			  }
		 
		 
		 
		 
		 
		 // }

?>