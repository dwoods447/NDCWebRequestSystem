<?php include 'header.php'; ?>		
<?php include 'nav.php'; ?>	 

<style>
	th{
      color: #fff;
     font-weight: 600;
     background-color: #2e83c7;
     min-width: 150px;
     }
	table{
    font-size: 0.8em !important;
    padding:  0.2em !important;
  }

  table td{
    font-size: 1em !important;
    padding:  0.5em !important;
    min-width: 150px;
    text-align: center;

  }

  table{
  	padding:0.8em;
  	
  	 }
  #wrapper{
  	overflow-x: scroll;
  	min-height: 480px;
  	padding: 0.5em;
  	margin: 0.5em;
  }

  .shortCell{
  	white-space: nowrap; 
  	text-overflow: ellipsis !important; 
  	overflow: hidden; 
  	max-width: 210px;
  }

   .db-url{
    display: inline-block;
    width: 200px;
    text-align: left;
   }
  .hideInput{
    visibility: hidden;
  }
</style>
<div id="wrapper">
<div class="row">
 <div class="col-lg-12 col-md-12 col-sm-12">
  <table class="table table-responsive table-bordered table-hover ">
	  <thead>
	  <tr>
	  <th style="max-width: 50px;">ID</th>
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
	  <th style="max-width: 79px;">Is Complete ?<br/> Yes or No</th>
	  </tr>
	  </thead>
	  <!-- Trigger -->

	  <tbody>
	  

     
	   <?php
	  

$query  = "SELECT Webrequest.RequestID, Webrequest.DateCreated, Webrequest.DateForCompletion, Webrequest.Link1, Webrequest.Link2, Webrequest.Link3, Webrequest.Link4, Coordinators.firstname, Coordinators.lastname,Coordinators.email,Webrequest.CoordinatorComments, Webrequest.DropBoxLink, Webrequest.priority";

$query .=  " FROM Webrequest";

$query .=  " INNER JOIN Coordinators ON Coordinators.CoordinatorID = Webrequest.StaffID";

/*$query .=  "INNER JOIN Developers ON Developers.DeveloperID = Webrequest.CompletedByID";*/

$query .=  " WHERE  Coordinators.CoordinatorID  = Webrequest.StaffID AND isComplete  = 0";





 require('connect.php');
     $result = mysqli_query($conn, $query);

     $devSQL = "SELECT * FROM developer";

     
     /*echo $query . '<br>';*/


 

     /*$result2 = mysqli_query($query3 , $result2);*/

	  ?>
	   <?php while($row = mysqli_fetch_assoc($result)) : ?>
       
       
        <?php 
        echo '<tr id=' . $row['RequestID'] . '>'; 
        echo '<form action='. $_SERVER['PHP_SELF'] .  ' method="post">';
	    echo '<td style="max-width: 50px;">' . $row['RequestID'] . '</td>';
	    echo  '<input  type="hidden" name="rowID" value=' . $row['RequestID']  . '>';
	  	echo '<td>' . date( 'm-d-Y', strtotime($row['DateCreated'])) . '</td>';
	  	echo '<td>' .  date( 'm-d-Y', strtotime($row['DateForCompletion'])) . '</td>';

	  	echo '<td>';
	  	echo '<select class="select" name="devId" onchange="getDeveloper()">';
	  	echo '<option value="0"></option>';
	  	 $devResult = mysqli_query($conn, $devSQL);
         while($developerRow = mysqli_fetch_assoc($devResult)) :

	  	echo '<option value=' . $developerRow['DeveloperID'] . '>';
            
             

             	echo $developerRow['First Name'] . ' ' . $developerRow['Last Name'];
           
          endwhile;

	  	     '</option>';

	  	echo '</select>';
	  	echo '</td>';

	  	echo '<td class="shortCell" title=' . $row['Link1'] . '><button class="btn" data-clipboard-target="#site1-'. $row['RequestID']. '"><i class="fa fa-clipboard" aria-hidden="true"></i></button><span>&nbsp;</span><span class="db-url">'. $row['Link1'] . '</span><span><input   type="text" name="link1" id=site1-'. $row['RequestID'] . ' value='. $row['Link1'] .'></span></td>';

	  	echo '<td class="shortCell" title=' . $row['Link2'] . '><button class="btn" data-clipboard-target="#site2-'. $row['RequestID']. '"><i class="fa fa-clipboard" aria-hidden="true"></i></button><span>&nbsp;</span><span class="db-url">'. $row['Link2'] . '</span><span><input  type="text" name="link2" id=site2-'. $row['RequestID'] . ' value='. $row['Link2'] .' ></span></td>';

      echo '<td class="shortCell" title=' . $row['Link3'] . '><button class="btn" data-clipboard-target="#site3-'. $row['RequestID']. '"><i class="fa fa-clipboard" aria-hidden="true"></i></button><span>&nbsp;</span><span class="db-url">'. $row['Link3'] . '</span><span><input  type="text" name="link3" id=site3-'. $row['RequestID'] . ' value='. $row['Link3'] .' ></span></td>';

      echo '<td class="shortCell" title=' . $row['Link4'] . '><button class="btn" data-clipboard-target="#site4-'. $row['RequestID']. '"><i class="fa fa-clipboard" aria-hidden="true"></i></button><span>&nbsp;</span><span class="db-url">'. $row['Link4'] . '</span><span><input   type="text" name="link4" id=site4-'. $row['RequestID'] . ' value='. $row['Link4'] .' ></span></td>';

      echo '<td class="shortCell" title=' . $row['DropBoxLink']. '><button class="btn" data-clipboard-target="#siteDrop-'. $row['RequestID'] . '"><i class="fa fa-clipboard" aria-hidden="true"></i></button><span>&nbsp;</span><span class="db-url">'. $row['DropBoxLink'] . '</span><span><input  type="text" name="droplink5" id=siteDrop-'. $row['RequestID'] . ' value='. $row['DropBoxLink'] .'></span></td>';


	  	echo '<td>' . $row['priority'] .'</td>';

	  	echo '<td>' . $row['firstname'] .  ' '  . $row['lastname'] . '</td>';
	  	
	  	echo'<td style="white-space: nowrap; text-overflow: ellipsis !important; overflow: hidden; max-width: 140px;">' . $row['CoordinatorComments'] . '</td>';
	  	echo '<td style="white-space: nowrap; text-overflow: ellipsis !important; overflow: hidden; max-width: 140px;"><input type="text" name="comments"></td>';

	  	echo'<td style="max-width: 75px;"><input type="checkbox" name="iscomplete"></td>
	  	     <td><input type="submit" name="upDate" value="Update" style="width: 100px;"></td>';
        
         echo '</form>';
	  	?>

	  </tr>
	  <?php  endwhile; ?>
	  <tr>
	 
	  
     <?php if(isset($_POST['upDate']) && isset($_POST['iscomplete']) ) : ?> 

     	

       
       <?php require_once('connect.php'); ?>
         <?php

         // Once update button is hit update request in db 

         $comments  = $_POST['comments'];
     	 $isComplete = $_POST['iscomplete'];

     	 if($isComplete == "on"){

          $isComplete = 1;

     	 }else{
     	 	$isComplete = 0;
     	 }
     	 $developer = $_POST['devId'];
     	 $rowID  = $_POST['rowID'];

       $coordinatorID  = $row['email'];

          $updateQuery = "UPDATE webrequest";

          $updateQuery .= " SET DeveloperComments = '{$comments}',  CompletedByID = '$developer', isComplete = '$isComplete' ";

          $updateQuery .= " WHERE RequestID = '{$rowID}'";

        $result2 = mysqli_query($conn, $updateQuery);

       if($result2){

        $devEmailQuery = "SELECT email FROM Developer WHERE DeveloperID = '{$developer}'";
        
        require_once('connect.php');
         

        $result3 = mysqli_query($conn, $devEmailQuery);

         
          while($developerEmail = mysqli_fetch_assoc($result3)) :

            $developerEmail['email'];

          endwhile;  
                           // Email coodinator and cc developer after request is complete
          echo '<pre>';
               $space = "\r\n\r\n";
              
               $site1 = $_POST['link1'];
               $site2 = $_POST['link2'];
               $site3 = $_POST['link3'];
               $site4 = $_POST['link4'];
               $dropBoxLinkComplete = $_POST['droplink5'];
             

              $to = $coordinatorID;
              $subject = "Web Request-" . $rowID  . " Complete";
              $txt = " Your web request hast been completed. You may view results at the link(s) below. $space";
              $txt .= " Site 1: $site1 $space Site 2:  $site2 $space  Site 3: $site3  $space  Site 4: $site4  $space";
              $txt .= " Dropbox: $dropBoxLinkComplete $space";
              $txt .= " If there are any questions or concerns please contact:" . $developerEmail['email'] . "$space";
              $headers = "From: webmaster@example.com" . $space .
              "CC:" . $developerEmail['email'];

           echo  $to;
           echo  $subject;
           echo  $txt;
           echo  $headers;

           echo '</pre>';  

              //mail($to,$subject,$txt,$headers);
        }else{
              die('Database query failed ' . mysqli_error($conn));
        }




          ?>

	 <?php endif;?>
	 
      </tr>
	  </tbody>
  </table>
 </div>
</div>
</div>
<script>
	$(function() {
        $(document).tooltip();

      });



	// If value of developer field changes change row highlight


	
function getDeveloper(){

var $select = $('select');


 $select.on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
     if(valueSelected  == 1){

         var parent = $(this).parents('tr');

         parent.css("background-color", "blue");

     }else if(valueSelected  == 2){

        var parent = $(this).parents('tr');

         parent.css("background-color", "purple");
     }
     else if(valueSelected  == 0){

        var parent = $(this).parents('tr');

         parent.css("background-color", "transparent");
     }

});



}
   
     

  
</script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="./bower_components/clipboard/dist/clipboard.min.js"></script>
<script>
    var btns = document.querySelectorAll('button');
    var clipboard = new Clipboard(btns);
    clipboard.on('success', function(e) {
        console.log(e);
    });
    clipboard.on('error', function(e) {
        console.log(e);
    });
    </script>
<?php include 'footer.php'; ?>	
