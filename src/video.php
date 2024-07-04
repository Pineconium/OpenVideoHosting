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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('db.php');

/* obtain video id from the url, which is numeric instead of a random string */
$videoId = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($videoId === null) {
    echo "<p>STOP 802! Video ID not provided.</p>";
    exit();
}

$videoQuery = "SELECT videos.*, users.username, users.backgroundpath 
               FROM videos 
               JOIN users ON videos.user_id = users.id 
               WHERE videos.id='$videoId'";
$videoResult = mysqli_query($con, $videoQuery);

if (mysqli_num_rows($videoResult) == 0) {
    echo "<p>STOP 801! Video ID requested not found.</p>";
    exit();
}

$videoData = mysqli_fetch_assoc($videoResult);

$commentQuery = "SELECT comments.*, users.username 
                 FROM comments 
                 JOIN users ON comments.user_id = users.id 
                 WHERE comments.video_id='$videoId' 
                 ORDER BY comments.created_at DESC";
$commentResult = mysqli_query($con, $commentQuery);

$similarQuery = "SELECT * 
                 FROM videos 
                 WHERE (user_id='{$videoData['user_id']}' OR title LIKE '%{$videoData['title']}%') 
                 AND id != '$videoId' 
                 ORDER BY upload_time DESC 
                 LIMIT 5";
$similarResult = mysqli_query($con, $similarQuery);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Open &#187; <?php echo htmlspecialchars($videoData['title']); ?></title>
        <!-- Styles and Favicon management-->
        <link rel="stylesheet" href="style/styles.css">
        <link rel="icon" type="image/x-icon" href="images/logos/favicon.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="background: url('/usergen/img/backgrounds/<?php echo htmlspecialchars($videoData['user_id']); ?>.png') no-repeat center center fixed; background-size: cover;">
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
                                <a href="index.html">Home Page</a>
                                <a href="about.html">About Open</a>
                                <a href="tos.html">Terms of Service</a>
                            </div>
                            <div class="nav-actions">
                                <input type="text" placeholder="Search Openly...">
                                <button>Search!</button>
                                <!-- check if the user is signed in -->
                                <?php if(isset($_SESSION['username'])): ?>  
                                    <a href="upload.php">Upload</a>
                                    <a href="profile.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                                    <a href="logout.php">Logut</a>
                                <?php else: ?>
                                    <a href="login.html">Login</a>
                                    <a href="register.html">Register</a>
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
                                        <!-- Profile Picture MUST be on the left-hand side to the video title and creator information-->
                                        <img src="/usergen/img/pfp/<?php echo htmlspecialchars($videoData['user_id']); ?>.png" width="72px" height="72px" alt="Profile Picture">
                                        <h1 class="table_title"><?php echo htmlspecialchars($videoData['title']); ?></h1><br>
                                        <p>by, <?php echo htmlspecialchars($videoData['username']); ?> - (SUBCOUNT) subscribers <button>Subscribe</button></p>
                                    </div>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <video width="100%" controls>
                                            <source src="usergen/vid/<?php echo htmlspecialchars($videoData['id']); ?>.mp4" type="video/mp4">
                                            Your browser does not support native playback of videos.
                                        </video>
                                        <table class="TopStatusArea">
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <?php echo htmlspecialchars($videoData['views']); ?> views - <button>Like</button> <?php echo htmlspecialchars($videoData['likes']); ?> likes - <button>Dislike</button> <?php echo htmlspecialchars($videoData['dislikes']); ?> dislikes
                                                    </td>
                                                </tr>
                                            </thead>
                                            <table class="TopStatusArea">
                                                <tbody>
                                                    <tr>
                                                        <!-- The Comments row goes on the left, while the Similar Videos row goes on the right -->
                                                        <td>
                                                            <h1 class="title">Comments</h1>
                                                            <?php if (isset($_SESSION['username'])): ?>
                                                                <form action="comment.php" method="post">
                                                                    <input type="hidden" name="video_id" value="<?php echo $videoId; ?>">
                                                                    <textarea name="comment" placeholder="Write a comment..." required></textarea>
                                                                    <button type="submit">Post</button>
                                                                </form>
                                                            <?php endif; ?>
                                                            <!-- Fetch comments here -->
                                                            <?php if (mysqli_num_rows($commentResult) > 0): ?>
                                                                <?php while($comment = mysqli_fetch_assoc($commentResult)): ?>
                                                                    <div class="comment">
                                                                        <strong><?php echo htmlspecialchars($comment['username']); ?></strong>: 
                                                                        <?php echo htmlspecialchars($comment['content']); ?>
                                                                    </div>
                                                                <?php endwhile; ?>
                                                            <?php else: ?>
                                                                <p>No comments yet.</p>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <h1 class="title">Similar Videos</h1>
                                                            <!-- Fetch similar videos based on if they are from the same creator, or with a similar title-->
                                                            <?php if (mysqli_num_rows($similarResult) > 0): ?>
                                                                <?php while($similar = mysqli_fetch_assoc($similarResult)): ?>
                                                                    <div class="similar-video">
                                                                        <a href="video.php?id=<?php echo $similar['id']; ?>">
                                                                            <img src="path_to_thumbnail/<?php echo htmlspecialchars($similar['thumbnailpath']); ?>" alt="Thumbnail">
                                                                            <div><?php echo htmlspecialchars($similar['title']); ?></div>
                                                                        </a>
                                                                    </div>
                                                                <?php endwhile; ?>
                                                            <?php else: ?>
                                                                <p>No similar videos found.</p>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </table>
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
