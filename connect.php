<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "ndcweb");

/*
define("DB_SERVER", "localhost");
define("DB_USER", "serverrt_webGuy");
define("DB_PASSWORD", "!@#Diversity23");
define("DB_DATABASE", "serverrt_web");
*/
// Create connection
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error()  . "(" . mysqli_connect_errno() . ")");
}
	   
?>