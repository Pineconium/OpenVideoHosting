<?php
	session_start();
	function amILoggedIn() {
		return isset($SESSION['username.php']);
	}
?>
