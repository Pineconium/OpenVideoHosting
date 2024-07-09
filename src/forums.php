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
// Require the user to be logged in
require('auth.php');

if(!amILoggedIn) {
	header("Location: login.php");
	exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pineconium &#187; Forums</title>
        <!-- Styles and Favicon management-->
        <link rel="stylesheet" href="styles.css">
        <link rel="icon" type="image/x-icon" href="images/logos/favicon.png">
        <script>
          function MainPageReSpawn() {
            confirm("That's where you are dummy.");
          }
          </script>
    </head>
    <body>
        <!-- Header Table-->
        <table class="PineconiumLogoSector">
          <thead>
            <tr>
              <th><img src="images/header.png"></th>
            </tr>
          </thead>
          <!-- Navigation Areas-->
          <tbody>
            <tr>
              <td><a href="projects/index.html"><img src="images/Software-uh.png" onmouseover="this.src='images/Software-h.png';" onmouseout="this.src='images/Software-uh.png';" ></a><a href="wallpapers.html"><img src="images/WP-uh.png" onmouseover="this.src='images/WP-h.png';" onmouseout="this.src='images/WP-uh.png';" ></a><a href="socials.html"><img src="images/Socials-uh.png" onmouseover="this.src='images/Socials-h.png';" onmouseout="this.src='images/Socials-uh.png';" ></a><a href="forums.php"><img src="images/Forums-uh.png" onmouseover="this.src='images/Forums-h.png';" onmouseout="this.src='images/Forums-uh.png';" ></a></td>
            </tr>
          </tbody>
          </table>
        <!-- Main Table-->
        <table class="PineconiumTabNav">
          <thead>
            <tr>
              <th>
		 <h1 class="table_title">Forums</h1>
		 <?php if(isset($_SESSION['username'])): ?>
		   <center><p>Welcome <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>! <a href="logout.php">Logout?</a></p></center>
		 <?php else: ?>
		   <center><p>You are currently not signed in to an account. Why not <a href="login.php">login</a> to or <a href="registration.php">create</a> one?</p></center>
		 <?php endif; ?>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                  <p>
                    Pineconium, <i style="font-family:Serif">(pronounced as 'pine-con-eee-um')</i>, is a British one-man company that makes software and other stuff. Why not check what we have in stock?
                    <br><br><br>
                    We have games, operating systems (both proper and simu's)<br>tools and many many more.<br><i>Quality isn't guaranteed</i>
                  </p>
                  <center><h3 class="title"><big><big>Projects</big></big></h3></center>
                  <h3 class="title">Capybarweba</h3>
                  <p>
                    A little browser I'm working on... uh yeah.
                  </p>
                  <center>
                    <p>&darr; You can download the (slighty old, but public) Android version here</p>
                    <a href="https://davetheduk.itch.io/capybarweba"><img src="images/Generic-uh.png" onmouseover="this.src='images/Generic-h.png';" onmouseout="this.src='images/Generic-uh.png';" /></a>
                  </center>
                  
                  <h3 class="title">PineOS</h3>
                  <p>
                    PineOS is a simulated operating system, (or a simu for short), created with Scratch. PineOS is currently in development and there will be many updates to come.<br>
                    If you are a Windows, Linux, or Mac user, you can download the demo for free or you can try out the Scratch Version on any browser. <!--Or don't I don't really care if you do-->
                    <br><br>
                    The current version of PineOS is 0.4, but you can easily download all the previous versions of PineOS Desktop on the <a href="https://davetheduk.itch.io/pineos-demo">Itch.io</a> page, all through most of them require Windows.
                  </p>
                  <center>
                    <a href="pineos.html"><img src="images/Generic-uh.png" onmouseover="this.src='images/Generic-h.png';" onmouseout="this.src='images/Generic-uh.png';" /></a>
                  </center>
                  
                  <h3 class="title">Choacury</h3>
                  <p>What <i>is</i> Choacury? Well its a custom built operating system that is completely open-source! If you want to swap operating systems but don't want Windows or a Linux distro? We got your back!
                    <br>Compared to most other modern operating systems, we have a more "retro" visual style, inspired by many early Linux distro and UNIX operating systems.</p><p>Want to help out? Go ahead! You can join our Discord server <a href="https://discord.gg/SZW9aR8cw3">here</a> for free. You can also make your own Choacury distro, as long as if you know how to make an operating system.<br>
                      You can always download the source code from our <a href="https://github.com/Pineconium/ChoacuryOS">GitHub</a>! Go crazy with it!
                  </p>
                  <center>
                    <a href="https://pineconiumsoftware.neocities.org/choacury/"><img src="images/Generic-uh.png" onmouseover="this.src='images/Generic-h.png';" onmouseout="this.src='images/Generic-uh.png';" /></a>
                  </center>
                  <!-- Updates Information -->
                  <table class="UpdatesSect">
                    <thead>
                      <tr>
                        <th><img src="images/header_announcements.png"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
			<h1 class="title">Experimental Login forms are here! | <small><small><small><i>Jun 12th 2024</i></small></small></small></h1>
                                  <p>
                                    Yes you can now make and login to your account via <i>Pineconium Passport</i>! It's currently in private alpha testing on a test server but when I get my domain figured, you can try it out!
                                  </p>
                          <h1 class="title">New Blogging Page here! | <small><small><small><i>Apr 8th 2024</i></small></small></small></h1>
                                  <p>
                                    Yep, blogs and updates are moving here! But what would happen to the Google Sites page? Well we are still gonna keep it up, with the final blog coming soon over there.
                                    
                                    
                                  </p>
                          <h1 class="title">PineOS 0.5 is nearly ready! | <small><small><small><i>Apr 1st 2024</i></small></small></small></h1>
                                  <p>
                                    This sounds like an Aprils Fools joke but I'm pretty much nearly ready for PineOS 0.5 to be get a Public Beta Build. Keep an eye out for the month of June though...
                                    
                                    
                                  </p>
                          <h1 class="title">Springing in to a new design... Soon | <small><small><small><i>Mar 12th 2024</i></small></small></small></h1>
                                  <p>
                                    Excluding the obviously painful Spring joke, we are redesigning the website slightly. It should be live by April.
                                    
                                    
                                  </p>
                          <h1 class="title">Resetting the announcements. | <small><small><small><i>Mar 12th 2024</i></small></small></small></h1>
                                  <p>
                                    With me adding the date system now next to the announcement name, I forgot the dates with the older announcements, I did a reset...
                                  </p>
                          <center><small>Want to see older announcements? As well as our blogs? Check out our <a href="https://sites.google.com/view/pineos/blogs">Blogging Page!</a></small></center>
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </td>
            </tr>
          </table>
          <table class="UpdatesSect">
            <!-- Footer -->
            <tfoot>
              <tr>
                  <td><p class="footerText">(C)opyright Pineconium 2022-2024. All rights reserved. Site Layout Version: Mintycore 1.0 (Feb, 11th 2024 Revision)</p></td>
              </tr>
              </tfoot>
          </table>
    </body>
</html>
