<!-- 
* Open Video Hosting Project Main Page
* Version: 10e (August 7th 2024)
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
$vid_id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($vid_id === null) {
    echo "<p>STOP 802! Video ID not provided.</p>";
    exit();
}

$vid_query = "SELECT videos.*, users.username, users.backgroundpath 
               FROM videos 
               JOIN users ON videos.user_id = users.id 
               WHERE videos.id='$vid_id'";
$vid_result = mysqli_query($con, $vid_query);

if (mysqli_num_rows($vid_result) == 0) {
    echo "<p>STOP 801! Video ID requested not found.</p>";
    exit();
}

$vid_data = mysqli_fetch_assoc($vid_result);

$comm_query = "SELECT comments.*, users.username 
                 FROM comments 
                 JOIN users ON comments.user_id = users.id 
                 WHERE comments.video_id='$vid_id' 
                 ORDER BY comments.created_at DESC";
$comm_result = mysqli_query($con, $comm_query);

$simi_query = "SELECT * 
                 FROM videos 
                 WHERE (user_id='{$vid_data['user_id']}' OR title LIKE '%{$vid_data['title']}%') 
                 AND id != '$vid_id' 
                 ORDER BY upload_time DESC 
                 LIMIT 5";
$simi_result = mysqli_query($con, $simi_query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Open &#187; <?php echo htmlspecialchars($vid_data['title']); ?></title>
    <!-- Styles and Favicon management-->
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="images/logos/favicon.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!-- Make the background match the users profile background, akin to what old YouTube is like. -->
<body style="background: url('/usergen/img/backgrounds/<?php echo htmlspecialchars($vid_data['user_id']); ?>.png') no-repeat center center fixed; background-size: cover;">
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
                            <?php if (isset($_SESSION['username'])): ?>  
                                <a href="upload.php">Upload</a>
                                <a href="profile.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
                                <a href="logout.php">Logout</a>
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

    <!-- Main Layout -->
    <table class="PineconiumTabNav">
        <tbody>
            <tr>
                <td>
                    <table class="TopStatusArea">
                        <thead>
                            <tr>
                                <div class="title-container">
                                    <!-- Profile Picture MUST be on the left-hand side to the video title and creator information -->
                                    <img src="/usergen/img/pfp/<?php echo htmlspecialchars($vid_data['user_id']); ?>.png" width="72px" height="72px" alt="Profile Picture">
                                    <h1 class="table_title"><?php echo htmlspecialchars($vid_data['title']); ?></h1><br>
                                    <p>by, <?php echo htmlspecialchars($vid_data['username']); ?> - (SUBCOUNT) subscribers <button>Subscribe</button></p>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <video width="100%" controls>
                                        <source src="usergen/vid/<?php echo htmlspecialchars($vid_data['id']); ?>.mp4" type="video/mp4">
                                        <!-- fallout -->
                                        ERROR 901: Your browser doesn't support the video tag.
                                    </video>
                                    <table class="TopStatusArea">
                                        <!-- TODO: Make like and dislike icons and fix stuff regarding the like counter-->
                                        <thead>
                                            <tr>
                                                <td>
                                                    <?php echo htmlspecialchars($vid_data['views']); ?> views - 
                                                    <button>Like</button> <?php echo htmlspecialchars($vid_data['likes']); ?> like(s) - 
                                                    <button>Dislike</button> <?php echo htmlspecialchars($vid_data['dislikes']); ?> dislike(s)<br>
                                                    <h3>Description</h3>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    Uploaded on: <?php echo htmlspecialchars($vid_data['upload_time']); ?><br>
                                                    <?php echo nl2br(htmlspecialchars($vid_data['description'])); ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <table class="TopStatusArea">
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <h1 class="table_title">Similar Videos</h1>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php if (mysqli_num_rows($simi_result) > 0): ?>
                                                            <?php while($similar = mysqli_fetch_assoc($simi_result)): ?>
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
                                        <table class="TopStatusArea">
                                            <thead>
                                                <tr>
                                                    <td>
                                                        <h1 class="table_title">Comments</h1>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?php if (isset($_SESSION['username'])): ?>
                                                            <form action="comment.php" method="post">
                                                                <input type="hidden" name="video_id" value="<?php echo $vid_id; ?>">
                                                                <textarea name="comment" placeholder="Write a comment..." required></textarea>
                                                                <button type="submit">Post</button>
                                                            </form>
                                                        <?php endif; ?>
                                                        <?php if (mysqli_num_rows($comm_result) > 0): ?>
                                                            <?php while($comment = mysqli_fetch_assoc($comm_result)): ?>
                                                                <div class="comment">
                                                                    <strong><?php echo htmlspecialchars($comment['username']); ?></strong>: 
                                                                    <?php echo htmlspecialchars($comment['content']); ?>
                                                                </div>
                                                            <?php endwhile; ?>
                                                        <?php else: ?>
                                                            <p>No comments yet.</p>
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

