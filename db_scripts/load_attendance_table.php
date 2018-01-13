<?php
include("../includes/config.php");


	 
$q= "SELECT a.*, s.nic,s.surname,v.name 
	 FROM student_attendance a,student s,vclass v 
	 WHERE `date` = '".date("Y-m-d")."'AND a.stu_id=s.stu_id 
	 AND a.v_class_id=v.id" ;
	 
	 
$r=mysqli_query($db_connection,$q);
if($r){ ?>
 <h4>Today's Attendance</h4>
 <div style="width:75%;float:left">
     <div style="overflow-x:hidden;overflow-y:scroll;height:250px;border:1px solid #B5AEAE">
 <?php if(mysqli_num_rows($r)>0){ ?>
	 
       <table id="att_tbl" class="table table-bordered not_highlight">
       <th>NIC</th><th>Name</th><th>Time</th><th width="100px">Category</th>
       
       <?php while($row=mysqli_fetch_assoc($r)){ ?>
          <tr>
            <td><?php echo htmlspecialchars($row['nic']);?></td>
            <td><?php echo htmlspecialchars($row['surname']);?></td>
            <td><?php echo htmlspecialchars($row['time']);?></td> 
            <td><?php echo htmlspecialchars($row['name']);?></td>
          <tr>	
      <?php } ?>
      
      </table>
 	<?php }


 else{
	echo "No recorded attendance for today"; 
 }?>
    </div>
    </div>
 	<div style="width:25%;float:right;padding-left:55px">
     <button class="btn btn-default btn-sm" style="width:100px" data-toggle="modal" data-target="#add_home_att_modal">Add</button>
    </div>
    
 <?php
 
}

else{
	echo "Query Failed"	;
	echo mysqli_error($db_connection);
}
mysqli_close($db_connection);

?>