

<!--Content Area Starts-->
    <div class="container">
    	
       <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Please Register Here</h3>
                    </div>
           
    <div class="panel-body">
       
       
         	

        <form action="" method="post" class="form2">
         
        <center><h2>Sign Up Here</h2> </center>
        

           <div class="form-group">	
           <label for="name" class="col-sm-3 control-label">Name:</label>
           	  
             <div class="col-sm-8">
              	<input type="text" name="u_name" placeholder="Enter Your Name" class="form-control" required="required">
         </div>

         </div>





        <div class="form-group">  
            <label for="password" class="col-sm-3 control-label">Password:</label>

           	  <div class="col-sm-8">
          <input type="password" name="u_pass" placeholder="Enter Your Password" class="form-control" required="required">
              </div>
              </div>



           <div class="form-group">  
            <label for="email" class="col-sm-3 control-label">Email:</label>
              <div class="col-sm-8">
              	<input type="email" name="u_email" placeholder="Enter Your Email" class="form-control"  required="required">
              </div>
         </div>




           <div class="form-group">
            <label for="country" class="col-sm-3 control-label">Country</label>
           	  <div class="col-sm-8">
              
              	<select name="u_country" class="form-control"  required="required">
              		<option>Select a Country</option>
              		<option>Kenya</option>
              		<option>Uganda</option>
              		<option>Tanzania</option>
              		<option>Rwanda</option>
              		
              	</select>
            </div>
           </div>



       <div class="form-group">
        <label for="Gender" class="col-sm-3 control-label">Gender</label>
           
           	  <div class="col-sm-8">
              	<select name="u_gender" class="form-control" >
              		<option>Select a Gender</option>
              		<option>Male</option>
              		<option>Female</option>
                </select>
             
            </div>
          </div>





              <div class="form-group">
              <label for="Birthday" class="col-sm-3 control-label">Birthday</label></br>
      
          <div class="col-sm-8">
              	<input type="date" name="u_birthday" class="form-control" >
            </div>

             
              </div>


       <div class="form-group">
         
             <div class="col-md-2 col-sm-offset-3">
              
              	<button name="sign_up" class="btn btn-success">Get Started</button>

           </div>

        </div>

        

           
            </form>

     

        <?php 

          include("user_insert.php");

         ?>

</div>
</div>
</div>