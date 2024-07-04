<!-- 
* Open Video Hosting Project Main Page
* Version: 10a (July 5th 2024)
*
* Note that some stuff such as donation and database control either have empty or placeholder values.
* It is up to the hoster of this Open page to control how these work and will need to fill in these
* values with their correct data. See HOSTING.MD for more information.
*
* Originally written by Daniel B. (better known as Pineconium) ;-)
-->


<?php
session_start();
require('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['username']) && isset($_POST['comment']) && isset($_POST['video_id'])) {
        $comment = mysqli_real_escape_string($con, $_POST['comment']);
        $videoId = intval($_POST['video_id']);
        $username = $_SESSION['username'];

        /* fetch the commentors user id */
        $userQuery = "SELECT id FROM users WHERE username='$username'";
        $userResult = mysqli_query($con, $userQuery);
        if ($userResult && mysqli_num_rows($userResult) > 0) {
            $userData = mysqli_fetch_assoc($userResult);
            $userId = $userData['id'];

            /* add the comments data into the database
             * This makes it so that the comment is viewable on the page
             */
            $insertQuery = "INSERT INTO comments (video_id, user_id, content) VALUES ('$videoId', '$userId', '$comment')";
            if (mysqli_query($con, $insertQuery)) {
                header("Location: video.php?id=$videoId");
                exit();
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "Invalid comment or not logged in.";
    }
} else {
    header("Location: index.html");
    exit();
}
?>
