
<div id="course_data_form_div" style="width:50%;font-size:12px;padding:10px">

  <form id="course_data_form" role="form" method="post" action="">
      
         <div class="form-group" id="s_type_div">
         <label for="s_type">Student Category </label>
         <select class="form-control" name="s_type" id="s_type">
          <option  value="1">Beginner</option>
          <option value="2">Trained</option>
         </select>
         </div>
       
     
        <div style="margin-top:40px;margin-bottom:40px; width:75%;overflow:auto">
        	
            <div>
            <label>Vehicle classes</label>
             <br><span id="vclass_valid_err_box"></span>
            </div>
           
            
            <div style="width:50%;float:left;">
                
                <div class="checkbox">
                  <label ><input type="checkbox" value="B" name="test" class="A BA B1 BB1 B1A BB1A" >B</label>
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
      
      
    <div style=" margin-top:40px">
	<button id="course_data_form_submit" type="button" class="btn btn-default" >Save</button>
    <button type="button" class="btn btn-default" style="margin-left:20px" id="proceed_to_payment">Proceed</button>
	</div>
    <hr>
	<div id="course_data_options" style="margin-top:20px;margin-bottom:20px">
    <a href="" id="" class="btn btn-default view_profile" style="margin-left:10px">View Student Profile</a>
    <a href="student_reg.php" id="add_new_student" class="btn btn-default" style="margin-left:10px">Add New Student</a>
    </div>

</form>


</div>

