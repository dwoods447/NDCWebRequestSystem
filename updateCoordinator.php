<?php
 function redirect_to($location){
    header("Location :" . $location);
    exit;
 }
?>
<?php include 'header.php'; ?>    
<?php include 'nav.php'; ?>  
<style>
  .adminform{
              max-width: 850px; 
              margin: 0.5em auto; 
              padding: 0.5em; 
              background-color: #fff;
            }
            .form-input{
              width: 90%;
              height: 45px;
              margin: 0.5em auto;
              padding: 0.5em;
            }
            .form-submit{
              width: 90%;
              height: 60px;
              margin: 0.5em auto;
            }
</style>

<pre>
<?php
 if(isset($_POST['update'])){
      
     require_once 'connect.php';

         $id = $_POST['coordinatorID'];
         $firstname  =  $_POST['firstname'];
         $lastname   =  $_POST['lastname'];
         $email   =  $_POST['email'];

          $sql   = " UPDATE coordinators";
          $sql  .= " SET firstname =  '" .$firstname ."',lastname ='" .$lastname."', email ='".$email."'";
          $sql  .= " WHERE coordinatorID ='" . $id."'";
         $updateResult  = mysqli_query($conn, $sql);
    
         if($updateResult && mysqli_affected_rows($conn) == 1){
          /*
          redirect_to("admin.php");
          */
        }
 
     }

  if(isset($_GET['edit'])){
    
          
         $id = $_GET['edit'];


         $sql = "SELECT * FROM coordinators WHERE coordinatorID = '" .$id ."'";

           require_once'connect.php';
         $result = mysqli_query($conn, $sql);


       
 

 


echo'</pre>';
   while($row = mysqli_fetch_assoc($result)) :
echo '<form class="adminform" method="POST" action=' . $_SERVER['PHP_SELF'] . '>';
echo '<input type="hidden" name="coordinatorID" value=' .$id .' class="form-input">';
echo '<input type="text" name="firstname" placeholder="First Name" value='. $row['firstname']. ' class="form-input">';
echo '<input type="text" name="lastname" placeholder="Last Name" value='.$row['lastname']. ' class="form-input">';
echo '<input type="text" name="email" placeholder="Email"  value=' .$row['email']. ' class="form-input">';
echo '<input type="submit" name="update" value="Update" class="form-submit">';
echo '</form>';

  endwhile; 

 }
echo '<a href="./admin.php">Back to Admin Panel</a>';
include 'footer.php'; 
?>