<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>My Profile</title>
		<meta charset="utf-8"/>
		<script type="text/javascript" src="js/post.js"></script>
		<link rel="shortcut icon" href="site_images/icon.ico"/>
		<link rel="stylesheet" type="text/css" href="css/uipage.css" />
	</head>

	<body>
		<div id="centercontainer">
			<div id="centerbox"> 
			<!--navigation buttons-->
			<div id="homenavbutton">
				<a  title="Home" id="home_nav_button" style="text-decoration: none;" href="home.php"><img height="39" width="85" src="site_images/inactive_home.png" /></a>
			</div>
			<div id="profilenavbutton">
				<a  title="Profile" id="profile_nav_button" style="text-decoration: none;" href="profile.php"><img height="39" width="85" src="site_images/active_profile.png" /></a>
			</div>
			<div id="peeksnavbutton">
				<a  title="Peeks" id="peeks_nav_button" style="text-decoration: none;" href="peek_page.php"><img height="39" width="85" src="site_images/inactive_peek.png" /></a>
			</div>
			<div id="explorenavbutton">
				<a  title="Explore" id="explore_nav_button" style="text-decoration: none;" href="explore.php"><img height="39" width="85" src="site_images/inactive_explore.png" /></a>
			</div>
			<div id="logoutnavbutton">
				<a  title="Logout" id="logout_nav_button" style="text-decoration: none;" href="../back/do_logout.php"><img height="39" width="85" src="site_images/logout.png" /></a>
			</div>
			<div id="edit_profile_field" style="position:absolute;top:80px;left:900px;">
				<a href="manage_profile.php"><img title="Edit profile details"alt="Edit Profile" height=40 width=40 src="site_images/edit.png"></a>
			</div>
			<div id="manage_account_field" style="position:absolute;top:80px;left:950px;">
				<a href="account_settings.php"><img title="Manage Account Settings"alt="Account Settings" height=40 width=40 src="site_images/settings.png"></a>
			</div>
			<div class="profileview">
					<?php 
						require_once("../back/connect.php");
						$username=$_SESSION['username'];
						$query="select * from user where username='{$username}'";
						$result=mysql_query($query,$conn);
						while($row=mysql_fetch_array($result)){
							echo "<div id='polaroidpic'><img id='profilepic' height=207 width=204 src='profile_pics/{$row['profile_pic']}' alt=''/></div>";
							echo "<p style='font-family:titlefont'>Name>&nbsp {$row['first_name']} {$row['last_name']}<br/>";
							echo "Birthdate>&nbsp {$row['birth_date']}<br/>";
							echo "Gender>&nbsp{$row['gender']}<br/>";
							echo "Email>&nbsp{$row['email_add']}<br/></p>";
							echo "<div id='profile_username' style='opacity:.6;left:60px;top:220px;position:absolute;font-size:30px;font-family:forte;'>{$row['username']}</div>";
							}
							mysql_close($conn);
						?>
			</div>
			</div>
			</div>
		</div>
	</body>
</html>
