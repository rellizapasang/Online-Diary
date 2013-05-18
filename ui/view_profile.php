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
		<title>View Profile</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" href="site_images/icon.ico"/>
		
		<link rel="stylesheet" type="text/css" href="css/uipage.css" />
		<link rel="stylesheet" href="css/jquery-ui.css" />
		
		<script type="text/javascript" src="js/post.js"></script>
		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/homepage.js"></script>
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
				
				<div id="mypeekprofile">
				<?php 
					require_once("../back/connect.php");
					//set values to the variables
					$username1=$_SESSION['username'];
					if(isset($_GET['userName'])){
							$username2 = $_GET['userName'];
						}
					//query
					$query="select * from user where username=\"{$username2}\"";
					$query2="select * from mypeeks where username=\"{$username1}\" and peeks=\"{$username2}\"";
					//submit query
					$result=mysql_query($query,$conn);
					$result2=mysql_query($query2,$conn);
					//checks if the username entered by the user exists in the database
					if(mysql_num_rows($result)){
						//print profile information
						while($row=mysql_fetch_array($result)){
							echo "<div id='polaroidpic'><img id='profilepic' height=207 width=204 src='profile_pics/{$row['profile_pic']}' alt=''/></div>";
							echo "NAME: {$row['first_name']} {$row['last_name']}<br/>";
							echo "BIRTHDATE: {$row['birth_date']}<br/>";
							echo "GENDER: {$row['gender']}<br/>";
							
							//if the session user is already peeking the user he/she searched,show button to unpeek the searched user
							if(mysql_num_rows($result2)){
								//button to view the posts of the user
								echo '<form method="POST" action="../back/do_unpeek_user.php">';
								echo '<input name="userName" type="hidden" value="'.$username2.'"/>';
								echo '<input class="submit" type="submit" value="Unpeek"/><br/><br/>';
								echo '</form>';
								
							echo '<div id="retrievepeekpost">';
								echo '<div id="peekpostList">	';
/***
*	RETRIEVE POSTS
*/							
							$retrieveQuery = "select * from post where (username = '{$username2}' and post_privacy='forpeek') or (username = '{$username2}' and post_privacy='public')  order by date_posted desc";				
							$result=mysql_query($retrieveQuery,$conn);
							if(mysql_num_rows($result)){
								while($row=mysql_fetch_array($result)){		
									echo "<div id='diaryentry'>";
										echo "<div id='diaryentryBG'> <img height='160' width='320' src='site_images/{$row['paper_color']}.png' /> </div>";
											echo "<div id='papercontent'>";
													echo $row['post_title']."<br/>";
													echo "[".$row['post_privacy']." post]  ";
													echo $row['date_posted']."<br/>";
													if($row['image_post']!=""){echo "<img height=60 width=60 src='post_images/{$row['image_post']}' alt''/>";}
															echo '<div id="postfunctions">';
															echo '<img class="view_post_button" height="20" width="20" src="site_images/view.png" />';
															echo '</div>';
												echo '</div>';
									echo '</div>';
									echo '<div class="viewpost" style="display:none">';
									echo '<div class=close_button style="float:right"><img alt="" src="site_images/close.png"/></div>';
									if(strlen($row['post_title']) !==0) echo "Title:<br/>".$row['post_title']."<br/>"; //displays title					
									if(strlen($row['text_post']) !==0) echo "Text:<br/>".$row['text_post']."<br/>"; //displays text
									if(strlen($row['quote_post']) !==0) echo "Quote:<br/>{$row['quote_post']}-{$row['quote_author']}<br/>"; //displays quote
									if(strlen($row['link_source']) !==0) echo "Link:<br/>".'<a style="margin-left:10px" target="_blank" href="'.$row['link_source'].'">'.$row['link_name'].'</a><br/>'; //displays link
									if($row['image_post'] !== "") echo "Image:<br/>{$row['image_caption']}<br/><img alt='' src='post_images/".$row['image_post']."' width='150' height='150'></img><br/>"; //displays image
									echo '</div>';	
								}
						
							}
					
								echo '</div>';
							echo '</div>';
							}
							
							else{
								echo '<form method="POST" action="../back/do_peek_user.php">';
								echo '<input name="userName" type="hidden" value="'.$username2.'"/>';
								echo '<input class="submit" type="submit" value="Peek"/><br/>';
								echo '</form>';	
							}
						}
					}
							
							
				
				
					?>
				</div>
				
			</div>
		</div>
		<br/><a href="javascript:history.back()">Back</a>
	</body>
</html>
