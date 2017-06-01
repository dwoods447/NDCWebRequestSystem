<?php
// Script for updating, and viewing web requests.
// Author: Demaria Woods
// dwoods447@gmail.com
// May 19, 2017
?>
<?php include 'header.php'; ?>		
<?php include 'nav.php'; ?>	 
<div id="requestContainer">

</div>

<!-- This is a reload script that reloads the page every x seconds -->
<script type="text/javascript">
    setInterval(function () {

        $('#requestContainer').load("requests.php");
 

    }, 3000);

</script>

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
  
<?php include 'footer.php'; ?>	

