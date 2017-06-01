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
<?php
 if(isset($_POST['updateDev'])){
      
     require_once 'connect.php';

         $id = $_POST['developerID'];
         $firstname  =  $_POST['firstname'];
         $lastname   =  $_POST['lastname'];
         $email   =  $_POST['Email'];


          $sql   = " UPDATE `developer`";
          $sql  .= " SET `First Name`='" .$firstname ."', `Last Name`= '" .$lastname."', `Email`= '" .$email."'";
          $sql  .= " WHERE DeveloperID = '" .$id ."'";


          echo $sql . '<br/>';
       
         $updateResult  = mysqli_query($conn, $sql);

         if($updateResult){
          redirect_to("admin.php");
        }
       
     }
   
  if(isset($_GET['edit'])){
    
          
         $id = $_GET['edit'];


         $sql = "SELECT * FROM developer WHERE DeveloperID = '{$id}'";
           require_once'connect.php';
         $result = mysqli_query($conn, $sql);


   while($row = mysqli_fetch_assoc($result)) :
echo '<form class="adminform" method="POST" action=' . $_SERVER['PHP_SELF'] . '>';
echo '<input type="hidden" name="developerID" value=' . $row['DeveloperID'] .' class="form-input">';
echo '<input type="text" name="firstname"  placeholder="First Name" value='. $row['First Name']. ' class="form-input">';
echo '<input type="text" name="lastname"  placeholder="Last Name" value='.$row['Last Name']. ' class="form-input">';
echo '<input type="text" name="Email" placeholder="Email"  value=' .$row['Email']. ' class="form-input">';
echo '<input type="submit" name="updateDev" value="Update" class="form-submit">';
echo '</form>';

  endwhile; 

 }
echo '<a href="./admin.php">Admin Panel</a>';


include 'footer.php'; 

?>