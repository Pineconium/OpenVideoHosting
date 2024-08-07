<?php
	session_start();
	session_destroy();		// <-- This "kills" the user, making them logout.
	header('index.php');    // <-- And send them to the afterlife, better known as the main page.
	exit();
?>
