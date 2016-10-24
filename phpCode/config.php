<?php

error_reporting(E_ALL);
ini_set('display_errors','on');


$servername = ("127.0.0.1:3306");
$username = "root";
$password = "";
$dbname = "cargoDB";

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
