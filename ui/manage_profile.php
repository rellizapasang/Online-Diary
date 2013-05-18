<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Manage Profile</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" href="site_images/icon.ico"/>
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
					<?php 
						require_once("../back/connect.php");
						$username=$_SESSION['username'];
						$pstmt2 = "select * from user where username = \"{$username}\"";
						$result = mysql_query($pstmt2,$conn);
						while($row=mysql_fetch_array($result)){
							$first_name = $row['first_name'];
							$last_name = $row['last_name'];
							
							//edit profile picture
							echo'<div id="uploadprofilepic">';
							echo '<form method="POST" name="postUserForm" onSubmit="return validateImage()" action="../back/do_edit_profile_info.php" enctype="multipart/form-data">';
							echo "<div id='polaroidpic'><img id='profilepic' src='profile_pics/{$row['profile_pic']}' alt=''/></div>";
							echo '<div id="uploadimgtext">';
							echo '<p style="font-size:20px;font-family:titlefont">Upload a profile picture!<br/><input id="upload" type="file" name="picture"/>';
							echo '<h6 style="color:grey;">(Extensions: .jpeg, .jpg, .gif, .png)</h6>';
							echo '</div>';
							echo '</div>';
							
							//edit profile info
							echo '<div id="editprofileinfo">';
							echo '<p style="font-size:20px;font-family:titlefont">First Name</p> <input name="firstName" placeholder= "First" type="text" title="Enter your first name"  value="'.$first_name.'" required=""/><br/><br/>';
							echo '<p style="font-size:20px;font-family:titlefont">Last Name</p><input name="lastName" placeholder= "Last" type="text" title="Enter your last name"  value="'.$last_name.'" required=""/><br/><br/>';
							echo '<p style="font-size:20px;font-family:titlefont">Gender</p><select name="gender">
										<option value="male">Male</option>
										<option value="female">Female</option>
										</select><br/><br/>';
							echo '<p style="font-size:20px;font-family:titlefont">Birthday</p><select name="birth_month">
											<option value="1">January</option>
											<option value="2">February</option>
											<option value="3">March</option>
											<option value="4">April</option>
											<option value="5">May</option>
											<option value="6">June</option>
											<option value="7">July</option>
											<option value="8">August</option>
											<option value="9">September</option>
											<option value="10">October</option>
											<option value="11">Novermber</option>
											<option value="12">December</option>
										   </select>
										   
										   <select name="birth_day">';
											for($i=1;$i<=31;$i++)
											{
												echo "<option value=$i>$i</option>";
											}
							echo	   	    '</select>';			
							
							echo 			'<select name="birth_year">';
												for($i=2012;$i>=1900;$i--)
												{
													echo "<option value=$i>$i</option>";
												}
							echo 		   '</select><br/><br/><br/>';
							echo '<input style="font-family:titlefont;font-size:30px;padding-left:10px; padding-right:10px;"class="submit" type="submit" value="Save"/>'; //save
							echo '</form>';
							echo '</div>';
						}
						mysql_close($conn);
					?>
				</div>
		</div>
	</body>
</html>
