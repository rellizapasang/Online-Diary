<?php
	//start session
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Peek Users</title>
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
				<a  title="Profile" id="profile_nav_button" style="text-decoration: none;" href="profile.php"><img height="39" width="85" src="site_images/inactive_profile.png" /></a>
			</div>
			<div id="peeksnavbutton">
				<a  title="Peeks" id="peeks_nav_button" style="text-decoration: none;" href="peek_page.php"><img height="39" width="85" src="site_images/active_peek.png" /></a>
			</div>
			<div id="explorenavbutton">
				<a  title="Explore" id="explore_nav_button" style="text-decoration: none;" href="explore.php"><img height="39" width="85" src="site_images/inactive_explore.png" /></a>
			</div>
			<div id="logoutnavbutton">
				<a  title="Logout" id="logout_nav_button" style="text-decoration: none;" href="../back/do_logout.php"><img height="39" width="85" src="site_images/logout.png" /></a>
			</div>
			<?php 
				require_once("../back/connect.php");
				//set session username to variable username
				$username=$_SESSION['username'];
				
				//queries
				$query1="select * from mypeeks";
				$query2="select * from mypeekers";
				
				//submit query
				$result1=mysql_query($query1,$conn);
				$result2=mysql_query($query2,$conn);
				
				//search other users to peek
				echo '<div id="searchuserspane1">';
					echo '<form method="POST" action="../ui/search_user.php">';
					echo 'Search User <input name="userName" type="text" value="" required=""/>';
					echo '<input class="submit" type="submit" value="Search"/><br/>';
					echo '</form>';
				echo '</div>';
				
				//displays other users that the user peeks
				echo '<div id="mypeekspane">';
					echo "<p style='font-size:30px;font-family:titlefont'>USERS THAT I PEEK</p><br/>";
					while($row=mysql_fetch_array($result1)){
						$username2=$row['peeks'];
						
						//checks if the username in the database matches with the session username of the user, if true, print the username the user peeks  
						if(strcmp($username,$row['username'])==0){
							
							//get the image of the user you are peeking
							$query3 = "select * from user where username=\"{$username2}\"";
							$result3=mysql_query($query3,$conn);
							$row3=mysql_fetch_array($result3);
							
							//display the image
							echo "<div id='peekpolaroidpic'><img id='peekprofilepic' src='profile_pics/{$row3['profile_pic']}' alt=''/></div>";
							
							//button to view other user's profile
							echo "<div id='mypeekusername'><a href='../ui/view_profile.php?userName={$username2}'>".$username2."</a></div>";
							
							
							
							
							
						}	
					}
				echo '</div>';
				
				//diplays other users that peeks the user
				echo '<div id="peekerspane">';
					echo "<p style='font-size:30px;font-family:titlefont'>USERS THAT PEEK ME</p><br/>";
					while($row=mysql_fetch_array($result2)){
						$username2=$row['peekers'];
						//checks if the session username of the user matches with the username in the database, if true, display the peekers of the user
						if(strcmp($username,$row['username'])==0){
							$query3 = "select * from user where username=\"{$username2}\"";
							$result3=mysql_query($query3,$conn);
							$row3=mysql_fetch_array($result3);
							echo "<div id='peekpolaroidpic'><img id='peekprofilepic' height=20 width=20 src='profile_pics/{$row3['profile_pic']}' alt=''/></div>";
							echo "<div id='mypeekusername'><a href='../ui/view_profile.php?userName={$username2}'>".$username2."</a></div>";
						}
					}
				echo '</div>';
				mysql_close($conn);
			?>
		</div>
	</div>
	</body>
</html>
