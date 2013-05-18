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
				<a  title="Home" id="home_nav_button" style="text-decoration: none;" href="home.php"><img height="85%" width="85" src="site_images/inactive_home.png" /></a>
			</div>
			<div id="profilenavbutton">
				<a  title="Profile" id="profile_nav_button" style="text-decoration: none;" href="profile.php"><img height="85%" width="85" src="site_images/active_profile.png" /></a>
			</div>
			<div id="peeksnavbutton">
				<a  title="Peeks" id="peeks_nav_button" style="text-decoration: none;" href="peek_page.php"><img height="85%" width="85" src="site_images/inactive_peek.png" /></a>
			</div>
			<div id="explorenavbutton">
				<a  title="Explore" id="explore_nav_button" style="text-decoration: none;" href="explore.php"><img height="85%" width="85" src="site_images/inactive_explore.png" /></a>
			</div>
			<div id="logoutnavbutton">
				<a  title="Logout" id="logout_nav_button" style="text-decoration: none;" href="../back/do_logout.php"><img height="85%" width="85" src="site_images/logout.png" /></a>
			</div>
			<div class="profileview">
					<?php 
						require_once("../back/connect.php");
						$username=$_SESSION['username'];
						$query="select * from user where username='{$username}'";
						$result=mysql_query($query,$conn);
						while($row=mysql_fetch_array($result)){
							echo "<div id='polaroidpic'><img id='profilepic' height=207 width=204 src='profile_pics/{$row['profile_pic']}' alt=''/></div>";
						}
							mysql_close($conn);
						?>
			</div>
			<div id="account_settings_field" style="padding:30px;background-color:white;height:200px; width:200px; position:absolute;top:120px;left:730px;
	box-shadow: 0 0 7px 0px #000 inset, 0 0 10px 0px #000;opacity:.8">
				<p style="font-size:20px;font-family:titlefont">Username</p><input type="text" value="<?php echo $_SESSION['username']?>"></input><br/><br/>
				<p style="font-size:20px;font-family:titlefont">Password</p><input type="password" value="<?php echo $_SESSION['username']?>"></input><br/><br/>
				<p style="font-size:20px;font-family:titlefont">Email Address</p><input type="email" value="<?php echo $_SESSION['username']."@ym.com"?>"></input><br/><br/>
				<a href="profile.php"><input style="font-size:20px;margin-left:10px;font-family:titlefont; padding-left:10px; padding-right:10px;" type="button" value="SAVE CHANGES"></input></a><br/>
			</div>
			</div>
			</div>
		</div>
	</body>
</html>
