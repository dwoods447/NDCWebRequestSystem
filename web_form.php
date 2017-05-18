<?php include 'header.php'; ?>		
<?php include 'nav.php'; ?>	 
<style>

  .label-input{
  	display: block;
  	max-width: 600px;
  }
	
  .custom-input{
    width: 90%;
  	margin: 10px;
  	padding: 10px;
  }

  .remove_field{
  	display: inline-block;
  }

  .fa{
  	color: #fff;
  }

  .dropdown{
  	width: 225px;
  	padding: 0.5em;
  }

  textarea{
  	display: block;
  	width: 90%;
  	height: 225px;
  	margin: 10px;
  }

  #container{
  	background-color: #3f92a8;
  }
  .date{
    width: 300px !important;
   
  }
  .hide{
    visibility: hidden;
  }
</style>
<pre>

<?php

     if(isset($_POST['send'])){


      date_default_timezone_set('America/Chicago');
  
       //$today =  date(("m/d/y"), $_SERVER['REQUEST_TIME']);
       $link  = $_POST['link'];
       $link[0]  = htmlspecialchars($link[0]);
       $link[1]  = htmlspecialchars($link[1]);
       $link[2]  = htmlspecialchars($link[2]);
       $link[3]  = htmlspecialchars($link[3]);


       require_once('connect.php');
      
       $link[0]  = mysqli_real_escape_string($conn, $link[0]);
       $link[1]  = mysqli_real_escape_string($conn, $link[1]);
       $link[2]  = mysqli_real_escape_string($conn, $link[2]);
       $link[3]  = mysqli_real_escape_string($conn, $link[3]);

      $dateCreated = $_POST['dateCreated'];

      $dateCreated  = date("Y-m-d", strtotime($dateCreated));

       $dateforCompletion = $_POST['dateforCompletion'];


       $dateforCompletion  = date("Y-m-d", strtotime($dateforCompletion));

       $dropbox_link  = $_POST['dropboxLink'];
       $dropbox_link = htmlspecialchars($dropbox_link);
     
       $dropbox_link = mysqli_real_escape_string($conn, $dropbox_link);
       
      
         $staffID = $_POST['coordId'];
           $coordComments = $_POST['message'];
       
$query = "INSERT INTO webrequest (DateCreated, DateForCompletion, Link1, Link2, Link3, Link4, DropBoxLink, StaffID, CoordinatorComments) VALUES ('{$dateCreated}','{$dateforCompletion}',  '{$link[0]} ', '{$link[1]}' , '{$link[2]}', '{$link[3]}', '{$dropbox_link}', '{$staffID}' , '{$coordComments}' )";
       
             
             $result = mysqli_query($conn, $query);

       if($result){
         echo "Success!";
         echo '<br/>' . $query;
       }else{
         die('Database query failed ' . mysqli_error($conn));
       }

    

    echo '<br>';
/*
       $query2 = "SELECT DateCreated, DateForCompletion, Link1, Link2, Link3, Link4, DropBoxLink, StaffID, CoordinatorComments FROM webrequest";

         $result = mysqli_query($conn, $query2);


       while($row  = mysqli_fetch_assoc($result)){
             
             echo '<ul>';
            echo '<li>'  . $row['DateCreated'] . '</li>';
            echo '<li>'  . $row['DateForCompletion'] . '</li>';
            echo '<li>'  . $row['Link1'] . '</li>';
            echo '<li>'  . $row['Link2'] . '</li>';
            echo '<li>'  . $row['Link3'] . '</li>';
            echo '<li>'  . $row['Link4'] . '</li>';
            echo '<li>'  . $row['DropBoxLink'] . '</li>';
            echo '<li>'  . $row['StaffID'] . '</li>';
            echo '<li>'  . $row['CoordinatorComments'] . '</li>';
           

             echo '</ul>';
       }

       echo '<br>';
*/

/*
    //Capture all links
         if(isset($_POST['link']) && is_array($_POST['link'])){
          
                 foreach ($_POST['link'] as $key => $link) {
                  

                  //extract($_POST['links'], EXTR_PREFIX_SAME)

                 }


*/

}
  

?>

</pre>
<div class="col-lg-12 col-md-12 col-sm-12" id="container">

<!--<pre>
  <?php /*if(isset($_POST['send'])){}*/?>
</pre>-->
<form  action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" style="padding: 1em; display: block; width: 90%; min-height: 100%; overflow: hidden; margin: 0 auto;">
<div style="text-align: center;"><h2>National Diversity Council &mdash; Web Requests</h2>
  <p>Fill out this form to have web edits completed. To view the status of a request, please visit []. For more information on how to use the form, please visit []. </p></div>
 <div class="col-sm-12">
    <label class="label-input">Site Links (Max 4): </label>
	 <div class="input_fields_wrap">
    			<div><input  class="custom-input" type="text" name="link[]"></div>
	</div>
  <a href="javascript:void(0);" class="add_field_button"><i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i>&nbsp;<span style="font-weight: 300; color: red;">Add New Link</span></a>
  <br/> <br/> <br/>
  </div>

  <div class="col-sm-12">
  <div class="form-group">
     <label class="label-input">Today's Date:</label>
    <div><input type="text" id="datepicker1"  name="dateCreated" class="custom-input date"></div>
   </div>

  </div>

   <div class="col-sm-6">
 <br/><br/>
   <div class="form-group">
     <label class="label-input">Date for Completion:</label>
    <div><input type="text" id="datepicker2"  name="dateforCompletion" class="custom-input date"></div>
   </div>
  </div>
  
 <div class="col-sm-6">
 <br/><br/>
   <div class="form-group">
     <label class="label-input">Dropbox Link:</label>
    <div><input class="custom-input" type="text" name="dropboxLink"></div>
   </div>
  </div>

<div class="col-sm-6">
<br/><br/>
    <div class="form-group">
     <label class="label-input">Staff Member Requesting:</label>
     
    <select class='dropdown' onchange="changeEmail()" id="#coord" name="coordId">
    <?php 
 // Write query to populate select field with coordinators

     $coordinators_query = "SELECT * FROM coordinators";

     require('connect.php');

     $result  = mysqli_query($conn, $coordinators_query);

     ?> 

      <option>Select Coordinator</option> 
        <?php  while($row = mysqli_fetch_assoc($result)) : ?>   
    	   
         <option value=<?php echo $row['coordinatorID']; ?>><?php echo $row['firstname']. '  ' . $row['lastname']; ?></option>

        <?php  endwhile; ?>  
    </select>

   
   </div>
  </div>

  <div class="col-sm-6">
<br/><br/>
   <label class="label-input">Priority:</label>
    <input type="radio" name="priority" value="high"> High<br>
    <input type="radio" name="priority" value="normal" checked="checked"> Normal<br>
  </div>

<div class="col-sm-12">
  <div class="form-group">
    <label class="label-input">Email:</label>
    <input type="email" name="email" class="custom-input" id="email">
   </div>
 </div>


 <div class="col-sm-12">
  <div class="form-group">
    <label class="label-input">Comments:</label>
    <textarea name="message"></textarea>
   </div>
 </div>

 <div class="col-sm-12">
  <div class="form-group">
     <input type="submit" name="send" value="Submit" class="form-control custom-input">
   </div>
 </div>

</form>
</div>


<script>
	
 $(document).ready(function(){
 var max_fields      = 4; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" class="custom-input" name="link[]"/><a href="#" class="remove_field"><i class="fa fa-minus-circle fa-2x" aria-hidden="true"></i></a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })


	});

</script>

<script>
  $(function() {
    $("#datepicker1").datepicker();
    $("#datepicker2").datepicker();
  });
  </script>

  <script>
    

         function changeEmail(){

                var xhttp = new XMLHttpRequest();

                xhttp.open("GET", "ajaxDB.php?id=" + document.getElementById("#coord").value ,false);
                xhttp.send(null);
                document.getElementById("email").value = xhttp.responseText;

         }

          
   
  </script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>