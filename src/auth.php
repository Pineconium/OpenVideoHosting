<?php
session_start();
function amILoggedIn() {
    return isset($_SESSION['username']);
}
?>