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
					<div id="searchuser">
						<?php 
							require_once("../back/connect.php");
							//set values to the variables
							$username1=$_SESSION['username'];
							$username2=htmlspecialchars($_POST['userName']);
							
							//queries
							$query1="select * from user where username=\"{$username2}\"";
							$query2="select * from user where username=\"{$username1}\"";
							$query3="select * from mypeeks where username=\"{$username1}\" and peeks=\"{$username2}\"";
							
							//submit queries
							$result1=mysql_query($query1,$conn);
							$result2=mysql_query($query2,$conn);
							$result3=mysql_query($query3,$conn);
							
							//checks if the username entered by the user exists in the database
							if(mysql_num_rows($result1)){
								
								//search other users to peek
								echo '<div id="searchuserspane">';
									echo '<form method="POST" action="../ui/search_user.php">';
									echo 'Search User <input name="userName" type="text" value="" required=""/>';
									echo '<input class="submit" type="submit" value="Search"/><br/>';
									echo '</form>';
								echo '</div>';
								echo "Search Results";
								while($row=mysql_fetch_array($result2)){
										$username3=$row['username'];
										//checks if the username being seeached is the user's own username, if true, just show the user's username
										if(strcmp($username2,$username3)==0){
											echo "<div id='searchpeekpolaroidpic'><img id='searchpeekprofilepic' height=20 width=20 src='profile_pics/{$row['profile_pic']}' alt=''/></div>";
											echo "<div id='mypeekusername'><a href='../ui/view_profile.php?userName={$username2}'>My Profile</a></div>";
										}
										//else print the username along with a "peek button"
										else{
											//checks if the user is already peeking the use he/she searched.
											if(mysql_num_rows($result3)){
												$row2=mysql_fetch_array($result1);
												echo "<div id='searchpeekpolaroidpic'><img id='searchpeekprofilepic' height=20 width=20 src='profile_pics/{$row2['profile_pic']}' alt=''/></div>";
												echo "<div id='mypeekusername'><a href='../ui/view_profile.php?userName={$username2}'>".$username2."</a></div>";
											}
											else{
												$row2=mysql_fetch_array($result1);
												echo "<div id='searchpeekpolaroidpic'><img id='searchpeekprofilepic' src='profile_pics/{$row2['profile_pic']}' alt=''/></div>";
												echo "<div id='mypeekusername'><a href='../ui/view_profile.php?userName={$username2}'>".$username2."</a></div>";
											}
										}
									
								}
							}
							//else prompt message
							else{
								
								//search other users to peek
								echo '<div id="searchuserspane">';
									echo '<form method="POST" action="../ui/search_user.php">';
									echo 'Search User <input name="userName" type="text" value="" required=""/>';
									echo '<input class="submit" type="submit" value="Search"/><br/>';
									echo '</form>';
								echo '</div>';
								echo "Search Results</br>";
								echo '0 results';
							}
							
							mysql_close($conn);
						?>
					</div>
			</div>
		</div>
	</body>
</html>
