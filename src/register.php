<!-- 
* Open Video Hosting Project Main Page
* Version: 10a (June 23rd 2024)
*
* Note that some stuff such as donation and database control either have empty or placeholder values.
* It is up to the hoster of this Open page to control how these work and will need to fill in these
* values with their correct data. See HOSTING.MD for more information.
-->

<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('db.php');

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

/* Login control stuff */
if(isset($_POST['username'])){
    $username = stripslashes($_REQUEST['username']);    // Removes backslashes.
    /* Escape any special character in a string. */
    $username = mysqli_real_escape_string($con, $username);

    /* ...and now do the same for the password */
    $password = stripslashes($_REQUEST['password']);    // Removes backslashes.
    $password = mysqli_real_escape_string($con, $password);

    /* Make sure that the user doesnt exist so that no double registers occur */
    $query = "SELECT * FROM `users` WHERE username='$username'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));


    /* and now register */
    $rows = mysqli_num_rows($result);
    if($rows == 0){
            $result = $con->query("SELECT MAX(id) AS max_id FROM users");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $maxid = (int)$row['max_id'];
            }
            else $maxid=0;
            $userId=$maxid+1;
            $query="INSERT INTO users (id, username, password) VALUES ('$userId', '$username', '".md5($password)."')";
            mysqli_query($con, $query) or die(mysqli_error($con));
            header("Location: index.php");  
            exit();
    }
    else{
        echo "<p>Invaild register info.</p>";
    }
}else{
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Open &#187; Register</title>
        <!-- Styles and Favicon management-->
        <link rel="stylesheet" href="styles.css">
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
                      <a href="index.php">Home Page</a>
                      <a href="about.php">About Open</a>
                      <a href="tos.php">Terms of Service</a>
                  </div>
                  <div class="nav-actions">
                      <input type="text" placeholder="Search Openly...">
                      <button>Search!</button>
                      <a href="login.php">Login</a>
                      <a href="register.php">Register</a>
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
                <h1 class="loginpage_title">Register to Open...</h1>
                <p class="loginpage_text">Register in here to create a Open account. Already have one? Why not Login?</p>
                <form name="login" action="" method="post">
                  <input type="text" name="username" placeholder="Username" required />
                  <input type="password" name="password" placeholder="Password" required />
                  <input type="submit" name="submit" value="Register" />
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