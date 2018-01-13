<div id="pay_form" style="width:50%;font-size:12px;padding:10px">
<form id="pay_form_y" role="form" method="post" action="">
      
      <div class="form-group">
       <label for="pay_type">Payment Type:</label>
       <select class="form-control" name="pay_type">
          <option>Registration</option>
          <option>Course Fee</option>
          <option>Exam Fee</option>
          <option>Other</option>
       </select> 
      </div>
     
       <div class="form-group">
       <label for="amount">Amount </label>
       <input  class="form-control" type="text" name="amount">
       </div>
       
       <div class="form-group">
        <label for="pay_date">Date</label>
        <input class="form-control" type="text" name="pay_date" id="pay_date">
       </div>
       
      <div class="form-group">
        <label for="bill_no">Bill NO:</label>
        <input class="form-control" type="text" name="bill_no">
      </div>
    
      <div class="form-group">
        <label for="commx">Comments:</label>
        <textarea class="form-control" name="commx"></textarea>
      </div>

	<div style="margin-top:40px">
    <button type="button" id="pay_form_submit-Y" class="btn btn-default">Save</button>
    </div>
     
     <hr>
     
    <div id="reg_options" style="margin-top:40px">
    <a href="" id="" class="btn btn-default view_profile" style="margin-left:10px">View Student Profile</a>
    <a href="student_reg.php" id="add_new_student" class="btn btn-default" style="margin-left:10px">Add New Student</a>
    </div>
    
</form>
</div>


