<?php 
include("../includes/config.php");
include("../includes/connect_db.php");  
  session_start();
  //get the form data
  $nic = $_POST['nic'];
  //$nic=$_SESSION['searched_student_nic'];
  
  //get student id from the nic
  try{ 
	$STH=$DBH->prepare("SELECT stu_id FROM student WHERE (nic=?)");
	$STH->bindParam(1,$nic,PDO::PARAM_STR);
	$STH->execute();
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	$row=$STH->fetch();
	$stu_id=$row['stu_id'];
  }
  catch(PDOException $e){
	echo "NIC Query failed";
	$DBH=null;
	exit();  
  }
  
  $DBH=null;
  
  
  
  
  
  
 
 
 
 //Prepare html to send
  $html='';
  ob_start();
   echo '
   <h4>Course Data</h4>
   <div style="width:60%;float:left;min-height:200px">	
   <form id="edit_course_data_form" role="form" method="post" action="">
      
         <div class="form-group" id="s_type_div">
         <label for="s_type">Student Category </label>
         <select class="form-control " name="s_type" id="s_type" >
          <option  value="1">Beginner</option>
          <option value="2">Trained</option>
         </select>
         </div>
       
	    <div class="form-group" id="s_days_div">
         <label for="s_days">Days </label>
         <select class="form-control" name="s_days" id="s_days" >
          <option  value="2">2 Days</option>
          <option value="5">5 Days</option>
		  <option value="10">10 Days</option>
         </select>
         </div>
     
        <div style="margin-top:40px;margin-bottom:40px; width:75%;overflow:auto">
        	
            <div>
            <label>Vehicle classes</label>
             <br><span id="vclass_valid_err_box"></span>
            </div>
           
            
            <div style="width:50%;float:left;">
                
                <div class="checkbox">
                  <label ><input type="checkbox" value="B" name="test" class="A BA B1 BB1 B1A BB1A">B</label>
                </div>
               
                <div class="checkbox" >
                 <label><input type="checkbox"  value="A" class="B BA B1 DA BB1 B1A BB1A" name="test" >A</label>
                </div>
                
                <div class="checkbox">
                  <label><input type="checkbox" value="BA" name="test" class="B1 DA BB1 B1A BB1A">BA</label>
                </div>
                
                <div class="checkbox">
                  <label><input type="checkbox" value="BB1" name="test" class="A BA B1A BB1A">BB1</label>
                </div>
                
                <div class="checkbox">
                 <label><input type="checkbox" value="B1" class="A B BA B1A BB1 BB1A" name="test" >B1</label>
                </div>
                
                <div class="checkbox">
                 <label><input type="checkbox" value="B1A" class="BB1A BA DA BB1" name="test" >B1A</label>
                </div>
           
            </div>
            
            
            <div style="width:50%;float:right;">
                
                <div class="checkbox">
                 <label><input type="checkbox" value="BB1A" name="test">BB1A</label>
                </div>
                
                <div class="checkbox">
                  <label><input type="checkbox" value="Bauto" class="BB1A" name="test" >B:Auto Car</label>
                </div>
                
                <div class="checkbox">
                 <label><input type="checkbox" value="D" class="DA A" name="test" >D</label>
                </div>
                
                <div class="checkbox">
                 <label><input type="checkbox" value="DA" class="" name="test">DA</label>
                </div>
                
                <div class="checkbox">
                 <label><input type="checkbox" value="Db" class="" name="test" >D:begining</label>
                </div>
            
            </div>
     
      
      </div>
      
      <input type="hidden" name="stu_id" value="'.$stu_id.'" >
    
  </form>
</div>
	
	<!--SECOND DIV-------------------------->
	<div style="width:15%;float:left;padding:20px">
      </div>
      
      
	
	
	<!--THIRD DIV--------------------------->
	
	<div style="width:25%;float:left;padding:20px">
       <button class="btn btn-default btn-sm" id="edit_course_btn" style="width:80px">Edit</button>
	   <button class="btn btn-default btn-sm" id="save_edit_course_btn" style="width:80px;display:none;">Save</button>
	   <button class="btn btn-default btn-sm" id="cancel_edit_course_btn" style="width:80px;display:none;">Cancel</button>
      </div>
      
      <br style="clear:left">
	
';
 
 $html=ob_get_clean();
 ob_end_clean();
 
	
  //response variables
  $data=array();
  $classesArr=array();
 
  
  
  //get course data from the database
  $query="SELECT v.name as 'cls' 
  		  FROM vclass v,student_v_class sv 
  		  WHERE sv.stu_id='$stu_id' 
		  AND sv.class_id=v.id";
  $result=mysqli_query($db_connection,$query);
  
  if(!$result){
	  echo "<h2>Query Failed</h2>";
	  mysqli_close($db_connection);
	  exit();
  }
  else{
	  
	   
	   //Rettrieve data from the student_v_cls table related to Beginner
   	  if(mysqli_num_rows($result)>0){
		  
		$_SESSION['cur_student_type']=1; 
		
		while($row = mysqli_fetch_assoc($result)){
		 array_push($classesArr,$row['cls']);
		}; 
			  
	  	$data['clsArr']=$classesArr;
	  	$data['s_type']=1;
	  }
	  
	  
	  else{
		//Rettrieve data from the trained student table related to Trained 
		$query2="SELECT v.name as 'cls',tsv.days 
  		  		FROM vclass v,trained_stu_v_class tsv 
  		  		WHERE tsv.stu_id='$stu_id' 
		  		AND tsv.class_id=v.id";
  		$result2=mysqli_query($db_connection,$query2);
  
  		if(!$result2){
	  		echo "<h2>Query Failed</h2>";
	  		echo mysqli_error($db_connection);
			mysqli_close($db_connection);
	  		exit();
	  	}
  
  		else{
			 if(mysqli_num_rows($result2)>0){
				
				$_SESSION['cur_student_type']=2;
				
				while($row = mysqli_fetch_assoc($result2)){
				 array_push($classesArr,$row['cls']);
				 $days=$row['days'];
			 }; 
			  
	  		$data['clsArr']=$classesArr;
	  		$data['s_type']=2;
			$data['days']=$days;
	  		}
  		}	  
	  
	  }
 
 
  }

  
  
  
  
  $data['html']=$html;
  
  echo json_encode($data);
      
  mysqli_close($db_connection);
  

  exit();
  
  
?>