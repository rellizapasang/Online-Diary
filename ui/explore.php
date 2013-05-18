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
		<title>Explore</title>
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
				<a  title="Profile" id="profile_nav_button" style="text-decoration: none;" href="profile.php"><img height="39" width="85" src="site_images/inactive_profile.png" /></a>
			</div>
			<div id="peeksnavbutton">
				<a  title="Peeks" id="peeks_nav_button" style="text-decoration: none;" href="peek_page.php"><img height="39" width="85" src="site_images/inactive_peek.png" /></a>
			</div>
			<div id="explorenavbutton">
				<a  title="Explore" id="explore_nav_button" style="text-decoration: none;" href="explore.php"><img height="39" width="85" src="site_images/active_explore.png" /></a>
			</div>
			<div id="logoutnavbutton">
				<a  title="Logout" id="logout_nav_button" style="text-decoration: none;" href="../back/do_logout.php"><img height="39" width="85" src="site_images/logout.png" /></a>
			</div>
			
			
			<div id="publicpostlabel"><p style='font-size:30px;font-family:titlefont'>PUBLIC POSTS</p></div>
			<div id="showpublicposts">
				
				<?php
								//for viewing posts
								require_once("../back/connect.php");
								$username = $_SESSION['username'];
		/***
		*	RETRIEVE PUBLIC POSTS
		*/				
								$retrieveQuery = "select * from post where post_privacy='public' order by date_posted desc";				
								$result=mysql_query($retrieveQuery,$conn);
								$i=0;
								
								while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
									$i+=1;
								}
								$result=mysql_query($retrieveQuery,$conn);
								if($i!=0){
									while($row=mysql_fetch_array($result)){		
										echo "<div id='diaryentry'>";
											echo "<div id='diaryentryBG'> <img height='180' width='320' src='site_images/{$row['paper_color']}.png' /> </div>";
												echo "<div id='papercontent'>";
														echo $row['username'].":&nbsp";
														echo $row['post_title']."<br/>";
														echo "[".$row['post_privacy']." post]  ";
														echo $row['date_posted']."<br/>";
														if($row['image_post']!=""){echo "<img height=60 width=60 src='post_images/{$row['image_post']}' alt''/>";}
																echo '<div id="postfunctions">';
																echo '<a  title="View Post" id="explore_view_post_button" style="text-decoration: none;" href="retrieve_post_popup_window.php?postId='.$row["post_id"].'" rel="#overlay">
																	  <img height="20" width="20" src="site_images/view.png" />
																	  </a>';
																
														echo '</div>';
													echo '</div>';
										echo '</div>';	
										}
								}
				?>
			</div>
			
			<div id="forpeeklabel"><p style='font-size:30px;font-family:titlefont'>FOR PEEK POSTS</p></div>
			<div id="showforpeekposts">
				
				<?php
								//for viewing posts
								require_once("../back/connect.php");
								$username = $_SESSION['username'];
		/***
		*	RETRIEVE FOR PEEK POSTS
		*/				
								$retrieveQuery = "select * from post where username = '{$username}' and post_privacy='forpeek' order by date_posted desc";				
								$result=mysql_query($retrieveQuery,$conn);
								$i=0;
								while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
									$i+=1;
								}
								$result=mysql_query($retrieveQuery,$conn);
								if($i!=0){
									while($row=mysql_fetch_array($result)){		
										echo "<div id='diaryentry'>";
											echo "<div id='diaryentryBG'> <img height='180' width='320' src='site_images/{$row['paper_color']}.png' /> </div>";
												echo "<div id='papercontent'>";
														echo $row['username'].":&nbsp";
														echo $row['post_title']."<br/>";
														echo "[".$row['post_privacy']." post]  ";
														echo $row['date_posted']."<br/>";
														if($row['image_post']!=""){echo "<img height=60 width=60 src='post_images/{$row['image_post']}' alt''/>";}
																echo '<div id="postfunctions">';
																echo '<a  title="View Post" id="explore_view_post_button" style="text-decoration: none;" href="retrieve_post_popup_window.php?postId='.$row["post_id"].'" rel="#overlay">
																	  <img height="20" width="20" src="site_images/view.png" />
																	  </a>';
														echo '</div>';
													echo '</div>';
										echo '</div>';	
										}
								}
				?>
			</div>
			
		</div>
	</div>
	</body>
</html>
