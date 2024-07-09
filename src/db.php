<?php
// Do debugging stuff
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

$con = mysqli_connect("localhost", "root", "Qw3rTYUK0nT09", "register");
if (mysqli_connect_errno())
  {
  	die("Fatal! Can not find a way to go to MySQL. Heres the error code for you: " . mysqli_connect_error());
}else{
	// echo "SUCCESS!";
}
?>
