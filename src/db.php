<?php
// Do debugging stuff
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

/*
The $con variable has placeholder names as your SQL database maybe different (by default Open uses MySQL)
- Replace 'REPLACEME_PASSWORD' with the password to your SQL's root user
- Replace 'REPLACEME_DBNAME' with the database's name containing the tables described in HOSTING.MD
*/

$con = mysqli_connect("localhost", "root", "REPLACEME_PASSWORD", "REPLACEME_DBNAME");

if (mysqli_connect_errno())
  {
  	die("Fatal! Can not find a way to go to MySQL. Heres the error code for you: " . mysqli_connect_error());
}else{
	// echo "SUCCESS!";
}
?>
