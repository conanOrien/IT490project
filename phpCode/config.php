<?php

error_reporting(E_ALL);
ini_set('display_errors','on');


$servername = ("sql.njit.edu");
$username = "dkl9";
$password = "8yx5VMy2x";
$dbname = "dkl9";

// Create connection
try{
	$conn = new mysqli($servername, $username, $password, $dbname);
   }
catch (Exception $e)
   {
	echo "Something Broke!\n";
	echo "Error Message:". $e->message;
	exit;	
   }
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
