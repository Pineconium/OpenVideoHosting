<!-- 
* Open Video Hosting Project Main Page
* Version: 10a (June 23rd 2024)
*
* Note that some stuff such as donation and database control either have empty or placeholder values.
* It is up to the hoster of this Open page to control how these work and will need to fill in these
* values with their correct data. See HOSTING.MD for more information.
*
* Originally written by Daniel B. (better known as Pineconium) ;-)
-->


<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/* Kick the user if they aren't logged in */
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require('db.php');

/* Once the user has press the Upload button */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /* video data stuff */  
    $title=stripslashes($_POST['title']);
    $title=mysqli_real_escape_string($con, $title);

    $description=stripslashes($_POST['description']);
    $description=mysqli_real_escape_string($con, $description);

    $videoFileName=$_FILES['video']['name'];
    $videoFileTmpName=$_FILES['video']['tmp_name'];
    $videoFilePath='usergen/vid' . $videoFileName;
    move_uploaded_file($videoFileTmpName, $videoFilePath);

    $thumbnailFileName=$_FILES['thumbnail']['name'];
    $thumbnailFileTmpName=$_FILES['thumbnail']['tmp_name'];
    $thumbnailFilePath='usergen/img/thumbnail/' . $thumbnailFileName;
    move_uploaded_file($thumbnailFileTmpName, $thumbnailFilePath);

    $username=$_SESSION['username'];
    $userQuery="SELECT id FROM users WHERE username='$username'";
    $userResult=mysqli_query($con, $userQuery);
    $userRow=mysqli_fetch_assoc($userResult);
    $userId=$userRow['id'];

    /* and and that video to the database */
    $query="INSERT INTO videos (user_id, title, description, filepath, thumbnailpath, vidlength, views, creationdate) VALUES ('$userId', '$title', '$description', '$videoFilePath', '$thumbnailFilePath', 0, 0, NOW())";
    mysqli_query($con, $query) or die(mysqli_error($con));

    echo "<p>Video uploaded successfully!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Open &#187; Upload</title>
    <!-- Styles and Favicon management-->
    <link rel="stylesheet" href="style/styles.css">
    <link rel="icon" type="image/x-icon" href="images/logos/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <!-- Header and Navigation control -->
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
                            <a href="about.html">About Open</a>
                            <a href="tos.html">Terms of Service</a>
                        </div>
                        <div class="nav-actions">
                            <input type="text" placeholder="Search Openly...">
                            <button>Search!</button>
                            <?php if(isset($_SESSION['username'])): ?>
                                <a href="profile.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                                <a href="logout.php">Logout</a>
                            <?php else: ?>
                                <a href="login.php">Login</a>
                                <a href="register.php">Register</a>
                            <?php endif; ?>
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
                    <table class="TopStatusArea">
                        <thead>
                            <tr>
                                <div class="title-container">
                                    <h1 class="table_title">Upload a video</h1>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- TODO: Make a basic algorithm for recommended videos-->
                                <td>
                                    <form method="post" enctype="multipart/form-data">
                                        <h1 class="title">Title</h1>
                                        <input type="text" name="title" required>

                                        <h1 class="title">Video</h1>
                                        <input type="file" name="video" accept="video/*" required>

                                        <h1 class="title">Thumbnail</h1>
                                        <input type="file" name="thumbnail" accept="image/*" required>
                                        
                                        <h1 class="title">Description</h1>
                                        <textarea name="description" required></textarea>
                                        <br> 
                                        <button type="submit">Upload!</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
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