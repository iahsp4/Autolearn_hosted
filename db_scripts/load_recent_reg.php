 <?php
include("./includes/config.php");


	 
$q= "SELECT s.*
	 FROM student s
	 WHERE `record_datetime` >= '".date("Y-m-d",mktime(0,0,0,date("m"),date("d")-8,date("Y")))."'
	 ORDER BY `record_datetime` DESC" ;
	 
	 
	 
$r=mysqli_query($db_connection,$q);
if($r){
 if(mysqli_num_rows($r)>0){ ?>
	 <div style="width:75%;float:left">
     <div style="overflow-x:hidden;overflow-y:scroll;height:200px;border:1px solid #B5AEAE;font-size:12px">
     <table id="rcnt_reg_tbl" class="table table-striped table-bordered not_highlight">
     <th>NIC</th><th>Name</th><th width="50px">Admission date</th><th width="50px">Recorded Date/Time</th>
     
     <?php while($row=mysqli_fetch_assoc($r)){ ?>
		<tr>
          <td width="20%"><?php echo $row['nic'];?></td>
          <td width="40%"><?php echo $row['surname'];?></td>
      	  <td><?php echo $row['admission_date'];?></td>
          <td><?php echo $row['record_datetime'];?></td>
        <tr>	
    <?php } ?>
 	
    </table>
 	</div>
    </div>
 	
    <div style="width:25%;float:right;padding-left:45px">
     <button id="reg_tbl_view_pro_btn" class="btn btn-default btn-sm" style="width:100px" disabled>View Profile</button> 
    </div>
  <div style="clear:both"></div>
 <?php
 }


 else{
	echo "No registrations in the past week"; 
 }
	

}

else{
	echo "Query Failed"	;
	echo mysqli_error($db_connection);
}
mysqli_close($db_connection);

?>