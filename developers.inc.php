<?php
          if(isset($_POST['deleteDev']) && isset($_POST['developerID'])) :

              require_once 'connect.php';
            $developerID = $_POST['developerID'];

            $deleteDev = "DELETE FROM developer  WHERE DeveloperID = {$developerID}";

            $result  = mysqli_query($conn, $deleteDev);


              if($result && mysqli_affected_rows($conn) == 1):

                    echo "Success!";
                   
               else: 
                    
                   die('Database query failed ' . mysqli_error($conn));

              endif;
          endif;


       if(isset($_POST['addDev'])):
                  require_once 'connect.php';
          $firstname = $_POST['firstname'];
          $lastname  = $_POST['lastname'];
          $email =  $_POST['email'];


          $addDeveloper = "INSERT INTO developer(`First Name`, `Last Name`, `Email`) VALUES('{$firstname}', '{$lastname}', '{$email}')";

           $result  = mysqli_query($conn, $addDeveloper);

              if($result):

                    echo "Success!";
                   

               else: 
                    
                     die('Database query failed ' . mysqli_error($conn));
       

              endif;


                    

       endif; 

?>
<style>
  input{
    display: block;
    width: 80%;
  }

  .person-cell{
    max-width: 50px !important;
  }

</style>
<div class="content">
  <div id="tab2" class="tab-pane">
       <div class="col-lg-12 col-md-12 col-sm-12">

         
           <div style="border: 1px solid #eee; margin: 1em;">

           <h2 style="text-align: center;">Add New Developer</h2> 
           <form class="adminform" method="POST" action=<?php echo$_SERVER['PHP_SELF']; ?>>
             <input type="text" name="firstname" placeholder="First Name" class="form-input">
              <input type="text" name="lastname" placeholder="Last Name" class="form-input">
               <input type="text" name="email" placeholder="Email"   class="form-input">
                <input type="submit" name="addDev" value="Add New Developer" class="form-submit">
            </form>
           </div>


            <h2 style="text-align: center;">Update/Remove Developer</h2>
                     <div class="sitewrapper" style="border: 1px solid #eee; margin: 1em; padding: 1em;">

                            <table class="table table-bordered table-responsive">
                            <thead>
                             <tr>
                               <th style="max-width: 50px !important; text-align: center;">DeveloperID</th>
                               <th style="max-width: 60px !important; text-align: center;">First Name</th>
                               <th style="max-width: 60px !important; text-align: center;">Last Name</th>
                               <th style="max-width: 110px !important; text-align: center;">Email</th>
                             </tr>
                             </thead>
                             <tbody>
                             <?php
                              echo '<tbody>';
                              echo '<form method="POST" action=' . $_SERVER['PHP_SELF'] .'>';
                              ?>
                     <?php
                         require_once 'connect.php';
                                  $getDevs = "SELECT * FROM developer";

                                  $answer = mysqli_query($conn, $getDevs);

                      while($row = mysqli_fetch_assoc($answer)) :
                           echo '<tr>';                   
                           echo '<td  class="person-cell">' . $row['DeveloperID'] .'<input type="hidden" type="text"  name="developerID" value=' . $row['DeveloperID'] .'></td>';
                           echo '<td class="person-cell">' . $row['First Name']. '</td>';
                           echo '<td class="person-cell">' . $row['Last Name']. '</td>';
                           echo '<td class="person-cell">' . $row['Email']. '</td>';
                           echo '<td><input type="submit" name="deleteDev" value="Delete"></td>';
                           echo '<td><a href="updateDeveloper.php?edit='.$row['DeveloperID'].'">edit</a></td>';
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