<?php

// Detect form submission
if(isset($_POST['submit'])){


 if(isset($_POST['username'])  && isset($_POST['password'])){
 
      $username = $_POST['username'];
      $password= $_POST['password'];

     echo "<br/>" . " Username is $username  and my password is $password";
 }

}

?>