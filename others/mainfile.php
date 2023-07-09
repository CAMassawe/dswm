<?php
//start session
session_start();
//error function
function error($errno, $errwo){
	echo "<b>Error:</b> [$errno] $errwo";
}
//set error handler
set_error_handler('error');

//calling server
$servername = "localhost";
$username = "chriss";
$password = "chris0628329196";
$mydbase = "swm";

//starting connection with server 
$conn = new mysqli($servername, $username, $password, $mydbase);
//check connection
if ($conn->connect_error){
	exit("Connection failed:" . $conn->connect_error);
}
?>