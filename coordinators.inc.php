
<?php
          if(isset($_POST['delete']) && isset($_POST['coordinatorID'])) :

              require_once 'connect.php';
            $coordinatorID = $_POST['coordinatorID'];

            $deleteCoord = "DELETE FROM coordinators  WHERE coordinatorID = {$coordinatorID}";

            $result  = mysqli_query($conn, $deleteCoord);


              if($result && mysqli_affected_rows($conn) == 1):

                    echo "Success!";
                   
               else: 
                    
                   die('Database query failed ' . mysqli_error($conn));

              endif;
          endif;


       if(isset($_POST['add'])):
                  require_once 'connect.php';
          $firstname = $_POST['firstname'];
          $lastname  = $_POST['lastname'];
          $email =  $_POST['email'];


          $addCoordinator = "INSERT INTO coordinators(firstname, lastname, email) VALUES('{$firstname}', '{$lastname}', '{$email}')";

           $result  = mysqli_query($conn, $addCoordinator);

              if($result):

                    echo "Success!";
                   

               else: 
                    
                     die('Database query failed ' . mysqli_error($conn));
       

              endif;


                    

       endif; 

?>
<div class="content">
  <div id="tab1" class="tab-pane">
       <div class="col-lg-12 col-md-12 col-sm-12">

          <style>
            
            .shortCell{
            white-space: nowrap; 
            text-overflow: ellipsis !important; 
            overflow: hidden; 
            max-width: 210px;
          }
          </style>
         <div style="border: 1px solid #eee; margin: 1em;">
           <h2 style="text-align: center;">Add New Staff</h2> 
           <form class="adminform" method="POST" action=<?php echo$_SERVER['PHP_SELF']; ?>>
             <input type="text" name="firstname" placeholder="First Name" class="form-input">
              <input type="text" name="lastname" placeholder="Last Name" class="form-input">
               <input type="text" name="email" placeholder="Email"   class="form-input">
                <input type="submit" name="add" value="Add New Staff" class="form-submit">
            </form>
            </div>

             <div style="border: 1px solid #eee; margin: 1em;">
             <h2 style="text-align: center;">Update/Remove Staff</h2>
             <div class="sitewrapper">
             <table class="table table-bordered table-responsive">
               <thead>
               <tr>
                 <th style="max-width: 50px !important; text-align: center;">CoordinatorID</th>
                 <th style="max-width: 60px !important; text-align: center;">First Name</th>
                 <th style="max-width: 60px !important; text-align: center;">Last Name</th>
                 <th style="max-width: 110px !important; text-align: center;">Email</th>
               </tr>
               </thead>
               <?php
                echo '<tbody>';
                echo '<form method="POST" action=' . $_SERVER['PHP_SELF'] .'>';
                ?>
              <?php
                 require_once 'connect.php';
                $getCoordinators = "SELECT * FROM coordinators";
                $result  = mysqli_query($conn, $getCoordinators);
                if($result){
                 

                 }else{
                   die('Database query failed ' . mysqli_error($conn));
                 }    
                     while($row  = mysqli_fetch_assoc($result)) :
                     
                     echo  '<tr>';  
                 echo '<td style="max-width: 50px !important;">' . $row['coordinatorID'] .  '<input type="hidden" type="text"  name="coordinatorID" value=' .$row['coordinatorID'] .'></td>';
                 echo '<td style="max-width: 60px !important;">'  . $row['firstname'] .  '</td>';
                 echo '<td style="max-width: 60px !important;">'  . $row['lastname'] .  '</td>';
                 echo '<td style="max-width: 110px !important;">'  . $row['email'] .  '</td>';
                 echo '<td><input type="submit" name="delete" value="Delete"></td>';
                 echo '<td><a href="updateCoordinator.php?edit='.$row['coordinatorID'].'">edit</a></td>';
                 echo '</tr>';
                




                      endwhile;

                ?> 
                <?php
                 echo '</form>';
                 echo '</tbody>';
                ?>
             </table>
              </div>
             </div>

    

       </div>
   </div>
</div>