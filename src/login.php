<!-- 
* Open Video Hosting Project Main Page
* Version: 10d (July 9th 2024)
*
* Note that some stuff such as donation and database control either have empty or placeholder values.
* It is up to the hoster of this Open page to control how these work and will need to fill in these
* values with their correct data. See HOSTING.MD for more information.
*
* Originally written by Daniel B. (better known as Pineconium) ;-)
-->

<?php
session_start();
// Debugging support
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* connet to the database */
require('db.php');

/* Login control stuff */
if(isset($_POST['username'])){
        $username = stripslashes($_REQUEST['username']);  // Removes backslashes.
        /* Escape any special character in a string. */
        $username = mysqli_real_escape_string($con, $username);

        /* ...and now do the same for the password */
        $password = stripslashes($_REQUEST['password']);  // Removes backslashes.
        $password = mysqli_real_escape_string($con, $password);

        /* make sure that the user exists first so that ghost accounts can't be signed in! */
        $query = "SELECT * FROM `users` WHERE username='$username' AND password='".md5($password)."'";    // <-- Fancy SQL stuff
        $result = mysqli_query($con, $query) or die(mysqli_error($con));

        /* and now login */
        $rows = mysqli_num_rows($result);
        if($rows == 1){
                $_SESSION['username'] = $username;
                header("Location: index.php");  // <--  and now go home.
                exit();
        }else{
                echo "<div class='form'>
                <h1>STOP 201</h1>
                <p>The Username or password provided is invalid. Click here to go back to the <a href='login.php'>login</a> page or <a href='register.php'>register now!</a></p></div>";
        }
}else{
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Open &#187; Login</title>
        <!-- Styles and Favicon management-->
        <link rel="stylesheet" href="style/styles.css">
        <link rel="icon" type="image/x-icon" href="images/logos/favicon.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <!-- Header and Navagation control -->
        <table class="PineconiumLogoSector">
          <thead>
            <tr>
              <th><img src="images/header.gif"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="navbar">
                  <div class="nav-links">
                      <a href="index.html">Home Page</a>
                      <a href="about.html">About Open</a>
                      <a href="tos.html">Terms of Service</a>
                  </div>
                  <div class="nav-actions">
                      <input type="text" placeholder="Search Openly...">
                      <button>Search!</button>
                      <a href="login.html">Login</a>
                      <a href="register.html">Register</a>
                  </div>
              </div>
              </td>
            </tr>
          </tbody>
          </table>

        <!-- Main Layout-->
        <table class="PineconiumTabNav">
          <tbody>
            <tr>
              <td>
                <h1 class="loginpage_title">Login to Open...</h1>
                <p class="loginpage_text">Sign in here to login to your Open account. Don't have one? Why not register?</p>
                <form name="login" action="" method="post">
                  <input type="text" name="username" placeholder="Username" required />
                  <input type="password" name="password" placeholder="Password" required />
                  <input type="submit" name="submit" value="Login" />
		              <?php if (isset($error)) { echo "<center><p style='color:red;'>$error</p></center>"; } ?>
              </form>
              </td>
            </tr>
          </table>
          <table class="UpdatesSect">
            <!-- Footer -->
            <tfoot>
              <tr>
                  <td><p class="footerText">&copy; Pineconium 2024. All rights reserved. Powered by OpenViHo version 10a</p></td>
              </tr>
              </tfoot>
          </table>
    </body>
</html>
<?php } ?>
