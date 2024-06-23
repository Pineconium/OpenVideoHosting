<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

/* Connect to the database 
 * - Replace 'PASSWORDHERE' with the password to the root users SQL Database (the user
 * that can edit, remove, create, and properly manage the SQL Database)
 * - Replace 'DATAHERE' with the database containing the 'users', 'videos' and 'views;
 * tables.
*/
$con=mysqli_connect("localhost", "root", "PASSWORDHERE", "DATAHERE");
if (mysqli_connect_errno()) {
    die("FATAL! Can't access database. Error code: " . mysqli_connect_error);
}else{
    // DO NOTHING, as it means it has connected!
}
?>
