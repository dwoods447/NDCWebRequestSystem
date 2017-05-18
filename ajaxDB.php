
<?php

$server =  "localhost";
$user = "root";
$password = "";
$db  = "ndcweb";

// Create connection
$conn = mysqli_connect($server, $user, $password, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()  . "(" . mysqli_connect_errno() . ")");
}

$id  = $_GET['id'];


if($id !== ""){

$q = "SELECT email FROM Coordinators WHERE coordinatorID = '{$id}'";

$query_result = mysqli_query($conn, $q);


	   while($row = mysqli_fetch_assoc($query_result)){

         
	   	  echo $row['email'];

	   }

}


?>
