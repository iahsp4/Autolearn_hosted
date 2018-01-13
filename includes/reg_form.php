<form role="form" method="post" action="" id="basic_reg_form" >

<div style="width:50%;float:left;font-size:12px;padding:10px" >
                <div class="form-group">
                  <label for="nic">NIC:</label>
                  <input type="text" class="form-control"  id="nic" name="nic">
                </div>
                <div class="form-group">
                  <label for="username">Fullname:</label>
                  <input type="text" class="form-control"  name="fullname">
                </div>
               
                <div class="form-group">
                  <label for="surname" >Surname:</label>
                  <input type="text" class="form-control"  name="surname">
                </div>
               
                <div class="form-group">
                  <label for="gender">Gender:</label><br>
                  <div class="radio-inline">
                    <label><input type="radio" name="gender" value="1" data-error="#err">Male</label>
                  </div>
                  <div class="radio-inline">
                    <label><input type="radio" name="gender" value="0">Female</label>
                  </div>
                  <br>
                  <span id="err"></span>
                </div>
               
                <div class="form-group">
                  <label for="p_address">Permanant Address:</label>
                  <textarea class="form-control" name="p_address"></textarea>
                </div>
               
                <div class="form-group">
                  <label for="username">Telephone:</label>
                   <input type="text" class="form-control"  name="tp1">
                   <input type="text" class="form-control"  name="tp2">
                </div>
</div>
                                                           
                                                           
<div style="width:50%;float:right;font-size:12px;font-weight:lighter;padding:10px">
                
                <div class="form-group">
                  <label for="dob">Date of Birth:</label>
					<input type="text" class="form-control"  name="dob" id="dob">
                    <!--
                    <div style="display:block">
                    <select class="form-control date_select" id="day_drpdwn" name="day_drpdwn" data-error="#der">
                     <option disabled selected>--day--</option>
                    </select>
                    <select class="form-control date_select" id="month_drpdwn" name="month_drpdwn" data-error="#der">
                     <option disabled selected>--month--</option>
                    </select>
                    <select class="form-control date_select" id="year_drpdwn" name="year_drpdwn" data-error="#der">
                     <option disabled selected>--year--</option> 
                    </select>
                    </div>
                    -->
                  <span id="der"></span>
                </div>
                
                <div class="form-group">
                  <label for="username">Admission date:</label>
                  <input type="text" class="form-control"  name="ad_date" id="reg_ad_date">
                </div>
               
                <div class="form-group">
                  <label for="username">Height:</label><br>
                
                  <select class="form-control date_select height_grp" style="width:100px"  name="height_ft" data-error="#height_err">
                   <option disabled selected>.ft</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                  </select>
                  
                  <select class="form-control date_select height_grp"  name="height_in" >
                   <option disabled selected >.in</option>
                   <option>0</option>
                   <option>1</option>
                   <option>2</option>
                   <option>3</option>
                   <option>4</option>
                   <option>5</option>
                   <option>6</option>
                   <option>7</option>
                   <option>8</option>
                   <option>9</option>
                   <option>10</option>
                   <option>11</option>
                  </select>
                  <br><span id="height_err"></span>
                </div>
                     
               
                <div class="form-group">
                  <label for="username">Div.Secretariat:</label>
                  <input type="text" class="form-control"  name="div_sec">
                </div>
                
                <div class="form-group">
                  <label for="username">City:</label>
                  <input type="text" class="form-control"  name="city">
                </div>
                
                <div class="form-group">
                  <label for="username">Police:</label>
                  <input type="text" class="form-control"  name="police">
                </div>
                
                <div class="form-group">
                  <label for="username">District:</label>
                  <input type="text" class="form-control"  name="district">
                </div>
                
                <button  id="reg_form_submit" type="button" class="btn btn-default" style="margin-top:30px" value="Save">Save</button>
                <button type="button" class="btn btn-default"  style="margin-top:30px;margin-left:20px" id="proceed">Proceed</button>
               
             
</div>
</form>
