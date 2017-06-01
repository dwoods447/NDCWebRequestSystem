<div class="content">
  <div id="tab3" class="tab-pane">
<div class="col-lg-12 col-md-12 col-sm-12">
              <div class="row">
                <div class="stat-box col-md-4">
                    <h4 style="text-align: center;">Total Amount of Completed Requests</h4>
                      <div class="stat">
                      	<?php

                            require_once('connect.php');
                            $sqlCountId = "SELECT COUNT(RequestID)"; 
                            $sqlCountId .= " FROM webrequest";
                            $sqlCountId .= " INNER JOIN coordinators ON coordinators.CoordinatorID = webrequest.StaffID"; 
                            $sqlCountId .= " INNER JOIN developer ON developer.DeveloperID = webrequest.CompletedByID"; 
                            $sqlCountId .= " WHERE isComplete = 1 AND isDuplicate = 0";
                            $statResult = mysqli_query($conn, $sqlCountId);
                            while($stat  = mysqli_fetch_row($statResult)):

                               echo '<h2><span class="stat-item">' . $stat[0] . '</span></h2>';

                            endwhile;
                      	 ?>
                      </div>
                	</div>
               
                      <div class="stat-box col-md-4">
                      <h4 style="text-align: center;"><?php echo $year = date("Y") . " Completed Requests";?></h4>
                       <div class="stat">
                       	<?php

                            require_once('connect.php');
                             $sqlCountId = "SELECT COUNT(RequestID)";
                             $sqlCountId .=  " FROM webrequest";
                             $sqlCountId .=  " INNER JOIN coordinators ON coordinators.CoordinatorID = webrequest.StaffID"; 
                             $sqlCountId .=  " INNER JOIN developer ON developer.DeveloperID = webrequest.CompletedByID";
                             $sqlCountId .=  " WHERE isComplete = 1 AND isDuplicate = 0 AND TimeCompleted >= '" .$year. "'";
                             $statResult = mysqli_query($conn, $sqlCountId);
                            while($stat  = mysqli_fetch_row($statResult)):

                               echo '<h2><span class="stat-item">' . $stat[0] . '</span></h2>';

                            endwhile;
                      	 ?>
                       </div>
                       </div>
                      
                      <div class="stat-box col-md-4">
                      <h4 style="text-align: center;"><?php echo $year = date("Y",strtotime("-1 year")) . " Completed Requests";?></h4>
                      <div class="stat">
                      	<?php

                            require_once('connect.php');
              $sqlCountId = "SELECT COUNT(RequestID) FROM webrequest WHERE isComplete = 1 AND isDuplicate = 0 AND TimeCompleted < '".$year."'";
                             $statResult = mysqli_query($conn, $sqlCountId);
                            while($stat  = mysqli_fetch_row($statResult)):

                               echo '<h2><span class="stat-item">' . $stat[0] . '</span></h2>';

                            endwhile;
                      	 ?>
                      </div>
                	 </div>
                 
              </div>
              <div class="sitewrapper" style="border: 1px solid #eee; margin: 1em; padding: 1em;">

              	<table class="table table-bordered table-responsive" id="completed">
              	<tr>
              	  <th>RequestID</th>
                  <th>Date Created</th>
        				  <th>Date to be Completed</th>
        				  <th>Assigned To</th>
        				  <th>Site Link: 1</th>
        				  <th>Site Link: 2</th>
        				  <th>Site Link: 3</th>
        				  <th>Site Link: 4</th>
        				  <th>Dropbox Link</th>
        				  <th>Priority</th>
        				  <th>Staff</th>
        				  <th>Staff Comments</th>
        				  <th>Dev. Comments</th>
                </tr>
                

               <?php
               
               $getRequests = "SELECT webrequest.RequestID, webrequest.DateCreated, webrequest.DateForCompletion, webrequest.Link1, webrequest.Link2, webrequest.Link3, webrequest.Link4, webrequest.StaffID, developer.`First Name`, developer.`Last Name`, coordinators.firstname, coordinators.lastname,coordinators.email,webrequest.CoordinatorComments, webrequest.DeveloperComments, webrequest.DropBoxLink, webrequest.priority";

			   $getRequests .=  " FROM webrequest";

			   $getRequests .=  " INNER JOIN coordinators ON coordinators.CoordinatorID = webrequest.StaffID";

			   $getRequests .=  " INNER JOIN developer ON developer.DeveloperID = webrequest.completedByID";

			   $getRequests .=  " WHERE  coordinators.CoordinatorID  = webrequest.StaffID AND webrequest.isComplete = 1 AND webrequest.isDuplicate = 0";






      $result  = mysqli_query($conn, $getRequests);

      if($result){
       

       }else{
         die('Database query failed ' . mysqli_error($conn));
       }

      
               while($row  = mysqli_fetch_assoc($result)) :
           echo'<tr>
                <td>' . $row['RequestID'] . '</td>
                <td>' . date( 'm-d-Y', strtotime($row['DateCreated'])) . '</td>
                <td>' . date( 'm-d-Y', strtotime($row['DateForCompletion'])) . '</td>
                <td>' . $row['First Name'] . ' ' . $row['Last Name'] . '</td>
                <td class="shortCell" title='. $row['Link1'].'>' . $row['Link1'] . '</td>
                <td class="shortCell" title='. $row['Link2'].'>' . $row['Link2'] . '</td>
                <td class="shortCell" title='. $row['Link3'].'>' . $row['Link3'].'</td>
                <td class="shortCell" title='. $row['Link4'].'>' . $row['Link4'] . '</td>
                <td class="shortCell" title='.$row['DropBoxLink'].'>' . $row['DropBoxLink'] . '</td>
                <td>' . $row['priority'] . '</td>
                <td>' . $row['firstname'] .  ' '  . $row['lastname'] . '</td>
                <td class="shortCell" title="'. mysqli_real_escape_string($conn, $row['CoordinatorComments']) . '">' . $row['CoordinatorComments'] . '</td>
                <td class="shortCell" title="'. mysqli_real_escape_string($conn, $row['DeveloperComments']) . '">' . $row['DeveloperComments'] . '</td>
                </tr>';

                endwhile;

                ?>
                
              	</table>
          </div>
       </div>
     </div>
</div>