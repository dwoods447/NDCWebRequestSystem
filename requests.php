<?php
// Script for updating, and viewing web requests.
// Author: Demaria Woods
// dwoods447@gmail.com
// May 19, 2017
?>
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
    <th style="max-width: 110px;">Is a Duplicate ?<br/> Yes or No</th>
	  </tr>
	  </thead>
	  <!-- Trigger -->

	  <tbody>
	  

     
	   <?php
	  

$query  = "SELECT webrequest.RequestID, webrequest.DateCreated, webrequest.DateForCompletion, webrequest.Link1,";

$query .= " webrequest.Link2, webrequest.Link3, webrequest.Link4, webrequest.StaffID, coordinators.firstname, ";

$query .= " coordinators.lastname,coordinators.email,webrequest.CoordinatorComments, webrequest.DropBoxLink, webrequest.priority";

$query .= " FROM webrequest";

$query .= " INNER JOIN coordinators ON coordinators.CoordinatorID = webrequest.StaffID";

$query .= " WHERE  coordinators.coordinatorID  = webrequest.StaffID AND isComplete = 0";





 require('connect.php');
     $result = mysqli_query($conn, $query);

     $devSQL = "SELECT * FROM developer";

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
	  	echo '<select class="select" name="devId" onchange="getDeveloper()" style="color: #000; width:110px; height: 25px;">';
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

	  	echo '<td>' . $row['firstname'] .  ' '  . $row['lastname'] . '<input type="hidden" name="coordId" value='. $row['StaffID'] .'></td>';

	  	
	  	echo'<td class="shortCell" title="'. mysqli_real_escape_string($conn, $row['CoordinatorComments']) .'">' . $row['CoordinatorComments'] . '</td>';
	  	echo '<td class="shortCell"><input type="text" name="comments" style="color: #000;"></td>';

	  	echo'<td style="max-width: 75px;"><input type="checkbox" name="iscomplete"></td>
           <td style="max-width: 110px;"><input type="checkbox" name="isduplicate"></td>
	  	     <td><input type="submit" name="upDate" value="Update" style="width: 100px; color: #000;"></td>';
        
         echo '</form>';
	  	?>

	  </tr>
	  <?php  endwhile; ?>
	  <tr>
	
     <?php if(isset($_POST['upDate']) && isset($_POST['iscomplete']) ) : ?> 

       <?php require_once('connect.php'); ?>
         <?php

         // Once update button is hit update request in db 

         $comments  = htmlspecialchars($_POST['comments']);
        $comments  =  mysqli_real_escape_string($conn, $_POST['comments']);
     	 $isComplete = $_POST['iscomplete'];

     	 if($isComplete == "on"){

          $isComplete = 1;

     	 }else{
     	 	$isComplete = 0;
     	 }
     	 $developer = $_POST['devId'];
       $coordinator = $_POST['coordId'];
     	 $rowID  = $_POST['rowID'];
       $coordComments = $_POST['comments'];

       $coordinatorID  = $row['email'];

          $updateQuery = " UPDATE webrequest";

          $updateQuery .= " SET DeveloperComments = '{$comments}',  CompletedByID = '$developer', isComplete = '$isComplete'";

          $updateQuery .= " WHERE RequestID = '{$rowID}'";

        $updateResult = mysqli_query($conn, $updateQuery);

       if($updateResult && mysqli_affected_rows($conn) == 1){

       
        require_once('connect.php');

        if(isset($coordinator) && $coordinator == 1){

           $coordinatorEmail = "coorindator 1";

         }elseif(isset($coordinator) && $coordinator == 2){

           $coordinatorEmail = "coorindator 2";
         }elseif(isset($coordinator) && $coordinator == 3){

           $coordinatorEmail = "coorindator 3";
         }elseif(isset($coordinator) && $coordinator == 4){

           $coordinatorEmail = "coorindator 4";
         }elseif(isset($coordinator) && $coordinator == 5){

           $coordinatorEmail = "coorindator 5";
         }elseif(isset($coordinator) && $coordinator == 6){

           $coordinatorEmail = "coorindator 6";
         }elseif(isset($coordinator) && $coordinator == 7){

           $coordinatorEmail = "coorindator 7";
         }elseif(isset($coordinator) && $coordinator == 8){

           $coordinatorEmail = "coorindator 8";
         }elseif(isset($coordinator) && $coordinator == 9){

           $coordinatorEmail = "coorindator 9";
         }elseif(isset($coordinator) && $coordinator == 10){

           $coordinatorEmail = "coorindator 10";
         }elseif(isset($coordinator) && $coordinator == 11){

           $coordinatorEmail = "coorindator 11";
         }elseif(isset($coordinator) && $coordinator == 12){

           $coordinatorEmail = "coorindator 12";
         }elseif(isset($coordinator) && $coordinator == 13){

           $coordinatorEmail = "coorindator 13";
         }elseif(isset($coordinator) && $coordinator == 14){

           $coordinatorEmail = "coorindator 14";
         }elseif(isset($coordinator) && $coordinator == 15){

           $coordinatorEmail = "coorindator 15";
         }elseif(isset($coordinator) && $coordinator == 16){

           $coordinatorEmail = "coorindator 16";
         }elseif(isset($coordinator) && $coordinator == 17){

           $coordinatorEmail = "coorindator 17";
         }elseif(isset($coordinator) && $coordinator == 18){

           $coordinatorEmail = "coorindator 18";
         }elseif(isset($coordinator) && $coordinator == 19){

           $coordinatorEmail = "coorindator 19";
         }elseif(isset($coordinator) && $coordinator == 20){

           $coordinatorEmail = "coorindator 20";
         }elseif(isset($coordinator) && $coordinator == 21){

           $coordinatorEmail = "coorindator 21";
         }
 

          if (isset($developer) && $developer == 1):
               $developerEmail = "jasonlee@gmail.com";
          elseif (isset($developer) && $developer == 2): // Note the combination of the words.
             $developerEmail = "demaria.woods@nationaldiversitycouncil.org";
          else:
              echo "No developer selected";
          endif;



         // Email coodinator and cc developer after request is complete
          echo '<pre>';
               $space = "\r\n\r\n";
              
               $site1 = $_POST['link1'];
               $site2 = $_POST['link2'];
               $site3 = $_POST['link3'];
               $site4 = $_POST['link4'];
               $dropBoxLinkComplete = $_POST['droplink5'];
             

              $to = $coordinatorEmail . $space;
              $subject = "Web Request-" . $rowID  . " Complete  - ". substr("$coordComments", 0,  20) .  "$space";
              $txt = " Your web request hast been completed. You may view results at the link(s) below. $space";
              $txt .= " Site 1: <a href=$site1>$site1</a> $space Site 2:  <a href=$site2>$site2</a> $space  Site 3: <a href=$site3>$site3</a>  $space  Site 4: <a href=$site4>$site4</a>  $space";
              $txt .= " Dropbox: <a href=$dropBoxLinkComplete>$dropBoxLinkComplete</a> $space";
              $txt .= " If there are any questions or concerns please contact:<a href=". $developerEmail . ">" . $developerEmail . "</a> $space";
              $headers = "From: webmaster@example.com" . $space .
              "CC:" . $developerEmail;

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
var $select = $('select.select');
$select.on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
     if(valueSelected  == 1){

         var parent = $(this).parents('tr');

         parent.css("background-color", "blue");
         parent.css("color", "white");

     }else if(valueSelected  == 2){

        var parent = $(this).parents('tr');

         parent.css("background-color", "purple");
         parent.css("color", "white");
     }
     else if(valueSelected  == 0){

        var parent = $(this).parents('tr');

         parent.css("background-color", "transparent");
         parent.css("color", "black");
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


 <script>
  var body = $('body');

  var windowObj = $(window);

  var windowObjHeight = windowObj.height();

  var bodyHeight = body.height();


  $('#wrapper').height(windowObjHeight - 160);

 </script> 

<script type="text/javascript">
    setInterval(function () {

    document.location = "requests.php";
 

    }, 30000);

</script>
  
<?php include 'footer.php'; ?>  
