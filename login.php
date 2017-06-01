<?php
     
      $missing = [];
      $errors = [];

$credential_check = true;      

// Detect form submission
if(isset($_POST['submit'])){
  
 function cleanValues($values){
   $values = trim($values);
   $values = htmlspecialchars($values);
   $values  = htmlentities($values);
   $values  = strip_tags($values);
    return  $values;
 }

  $username  =	 cleanValues($_POST['username']);
  $password =    $_POST['password'];


       $expected_values = ['username', 'password'];
	   $required_fields = ['username', 'password'];

 

	  
	foreach($_POST as $key => $value){
	 $value = is_array($value) ? $value : trim($value);
	 if(empty($value) && in_array($key, $required_fields)){
		 $missing[] = $key;
		 $$key =  '';
		 
	 }elseif(in_array($key, $expected_values)){
		  $$key =  $value;
	 }
 } 



function checkCredentials($username, $password){
   
    $query = "SELECT *  FROM users WHERE username =  '" . $username . "' AND password = '" . $password ."'";

       require('connect.php');

		$result = mysqli_query($conn,  $query);

		if (mysqli_num_rows($result) > 0) {
		    // return result if found
		    header( 'Location: admin.php') ;
		    echo "Result Found";
		} else {

		    return  false;
		}

} 

   $credential_check = checkCredentials($username, $password);
}


  
?>
<?php include 'header.php'; ?>		
<?php include 'nav.php'; ?>	 


 <div class="container-fluid">
          <div class="row">
           <h3 style="text-align: center; margin: 0 auto; max-width: 48%;">Sign In&nbsp;<span style="display: inline-block;"></h3> 
         </div>
      <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="form-container">



   <form  class="" action="<?php $_SERVER['PHP_SELF'];?>" method="POST" style="display: block; width: 430px; height: 512px; padding: 0.5em; margin:1em auto; background-color: rgba(46, 131, 200, 0.7);">

		 
           <div class="row">
             <div class="col-sm-12"><i id="avatar" class="fa fa-user-circle-o " aria-hidden="true"></i></div>
           </div>
           <?php if($missing && in_array('username', $missing)) : ?>
            <span class="error">*&nbsp;Username can't be blank. </span>
            <?php endif; ?>

		    <div class="form-group">
		     <label for="username"  class="control-label">Username</label>
		     <input type=text" name="username" placeholder="Enter your Username" class="form-control" 
		     <?php if($errors || $missing): 
		       echo 'value = "' . htmlentities($username) . '" ';
	          endif;
            ?>>

		    </div>

		    
            <?php if($missing && in_array('password', $missing)) : ?>
            <span class="error">*&nbsp;Password can't be blank. </span>
            <?php endif; ?>

		     <div class="form-group">
		       <label for="password" class="control-label">Password</label>
		       <input type="password" name="password"  placeholder="Enter your Password" class="form-control" <?php if($errors || $missing): 
		       echo 'value = "' . htmlentities($password) . '" ';
	          endif;
            ?>>
		     </div>
		     <div class="form-group">
		       <label for="password" class="control-label">Remember Me</label>
		       <input type="checkbox" name="remember" value="<?php echo $password; ?>" id="checkbox">
		     </div>

		     <div class="form-group">
		 		       <input type="submit" name="submit" value="Submit" class="form-control">
		     </div>
             
            <?php if(!$credential_check && !$missing): ?>
		     <p class="error" style="text-align: center;">Incorrect Usernme/Password combination.</p>
		   <?php endif;?>

		    <div>
		    	
		    	<p style="text-align: center;">username: admin</p>

		    	<p style="text-align: center;">password: password</p>

		    </div>
		</form>


		</div>
	  </div>
	 </div>
<?php include 'footer.php'; ?>