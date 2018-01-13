<?php 
//include("../includes/config.php");
include("../includes/connect_db.php");
  
  session_start();
  //get the form data
  $nic =htmlentities($_POST['nic']);
   $nicCopy=$nic;
  
try{ 
  $STcheck=$DBH->prepare("SELECT COUNT(*) FROM student WHERE(nic=?)");
  $STcheck->bindParam(1,$nic,PDO::PARAM_STR);
  $STcheck->execute();
  
  if($STcheck->fetchColumn()>0){
	  $STH=$DBH->prepare("SELECT * FROM student  WHERE(nic=?)");
      $STH->bindParam(1,$nic,PDO::PARAM_STR);
	  $STH->execute();
	  
	  $STH->setFetchMode(PDO::FETCH_ASSOC);
	  $row=$STH->fetch();

?>
  		
		<form role="form" method="post" action="" id="ld_basic_data" >

		<div style="width:40%;float:left;font-size:12px;padding:10px;" >
            <h4>Personal Details</h4>
            
                <div class="form-group">
                  <label for="nic">NIC:</label>
                  <input type="text" class="form-control"  name="nic" id="lbd_nic" value="<?php echo $row['nic'] ?>">
                </div>
                <div class="form-group">
                  <label for="username">Fullname:</label>
                  <input type="text" class="form-control"  name="fullname" value="<?php echo $row['full_name'] ?>">
                </div>
               
                <div class="form-group">
                  <label for="surname" >Surname:</label>
                  <input type="text" class="form-control"  name="surname" value="<?php echo $row['surname'] ?>">
                </div>
               
                <div class="form-group">
                  <label for="gender">Gender:</label><br>
                  <div class="radio-inline">
                    <label><input type="radio" name="gender" value="1" data-error="#err" <?php if($row['gender']=="1"){ 
																						echo ' checked';}?>>Male
                                                                                        </label>
                  </div>
                  
                  <div class="radio-inline">
                    <label><input type="radio" name="gender" value="0" <?php if($row['gender']=="0"){ 
																				 echo ' checked';
																				 } ?> >Female
                                                                                 </label>
                  </div>
                  
                  <br>
                  <span id="err"></span>
               
               </div>
               
                <div class="form-group">
                  <label for="p_address">Permanant Address:</label>
                  <textarea class="form-control" name="p_address" ><?php echo $row['per_address'] ?></textarea>
                </div>
               
                <div class="form-group">
                  <label for="username">Telephone:</label>
                   <input type="text" class="form-control"  name="tp1" value="<?php echo $row['tp1']?>">
                   <input type="text" class="form-control"  name="tp2" value="<?php if($row['tp2']!=0)
				   																		echo $row['tp2'];
																					else
																						echo "";?>">
                </div>
		</div>
                                                           
                
                
                                                           
		<div style="width:40%;float:left;font-size:12px;font-weight:lighter;padding:45px 0 0 10px;">
                
                <div class="form-group">
                  <label for="dob">Date of Birth:</label>
                  <input type="text" class="form-control"  name="dob_edit" id="dob_edit" value="<?php echo $row['dob'] ?>">
                </div>
                
                <div class="form-group">
                  <label for="username">Admission date:</label>
                  <input type="text" class="form-control"  name="ad_date_edit" id="ad_date_edit" value="<?php echo $row['admission_date'] ?>">
                </div>
               
               
                <div class="form-group">
                  <label for="username">Height:</label><br>
                  <?php  $h=explode(".",$row['height']); ?>
				  
                
                  <select class="form-control date_select height_grp" style="width:100px"  name="height_ft" data-error="#height_err">
                   <option disabled >.ft</option>
                    <?php for($i=4;$i<7;$i++){
					       echo '<option value="'.$i.'"';if($h[0]==$i) {echo' selected="selected"';} echo '>'.$i.'</option>';
				      }?>
                  </select>
                  
                  <select class="form-control date_select height_grp"  name="height_in" >
                   <option disabled >.in</option>
                   <?php for($i=0;$i<12;$i++){
					       echo '<option value="'.$i.'"';if($h[1]==$i) {echo' selected="selected"';} echo '>'.$i.'</option>';
				     }?>
                  </select>
                  <br><span id="height_err"></span>
                </div>
                
                
                
                <div class="form-group">
                  <label for="username">Div.Secretariat:</label>
                  <input type="text" class="form-control"  name="div_sec" value="<?php echo $row['div_sec'] ?>">
                </div>
                
                <div class="form-group">
                  <label for="username">City:</label>
                  <input type="text" class="form-control"  name="city" value="<?php echo $row['city'] ?>">
                </div>
                
                <div class="form-group">
                  <label for="username">Police:</label>
                  <input type="text" class="form-control"  name="police" value="<?php echo $row['police'] ?>">
                </div>
                
                <div class="form-group">
                  <label for="username">District:</label>
                  <input type="text" class="form-control"  name="district" value="<?php echo $row['district'] ?>">
                </div>
                <input type="hidden" class="form-control"  name="stu_id" value="<?php echo $row['stu_id'] ?>">
                
		</div>
        
        <div style="float:left;width:20%;">
          <button type="button"  id="b_dta_edit_btn" class="btn btn-sm btn-default" style="margin-top:30px;display:block;width:80px ">Edit</button>
          <button type="button"  id="b_dta_save_btn" class="btn btn-sm btn-default" style="margin-top:60px;display:none;width:80px"
          >Save</button><br>
          <button type="button"  id="lbd_edit_cancel_btn" class="btn btn-sm btn-default" style="display:none;margin-top:10px;width:80px" >Cancel</button>
        </div>
        
        
		</form>
<?php }
  
  
  
  else{
		echo "No results found!";  
  }
  
  
}
  
  
  
  
catch(PDOException $e){
      echo "<h2>Query Failed</h2>";
	  echo $e->getMessage();	  
}
  
 
$DBH=null;
exit();  
 

?>