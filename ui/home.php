<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>My Diary</title>
		<meta charset="utf-8"/>
		<link rel="shortcut icon" href="site_images/icon.ico"/>
		<link rel="stylesheet" type="text/css" href="css/uipage.css" />
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<link rel="stylesheet" type="text/css" href="css/overlay-apple.css">
		<!---scripts--->
		<script type="text/javascript" src="js/post.js"></script>
		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/homepage.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bookflip.js"></script>
	</head>

	<body>
	<div id="centercontainer">
		<div id="centerbox"> 
			<div id="turningpage">
				<!---for flip effect---->
				<div align=center>
					<div>
						<div id="newerturnbutton"><input type=button style='border:transparent;background-color:transparent;height:82px;background-image: url(site_images/newer.png);' class="buttons" value='        ' onclick="clipmeR();"></input></div>
						<div id="olderturnbutton"><input type=button style='border:transparent;background-color:transparent;height:82px;background-image: url(site_images/older.png);'class="buttons" value='        ' onclick="clipmeL();"></div>
					</div>
					<div id="bookflip"></div>
				</div>
				
				
				<!--navigation buttons-->
				<div id="homenavbutton2">
					<a  title="Home" id="home_nav_button" style="text-decoration: none;" href="home.php"><img height="39" width="85" src="site_images/active_home.png" /></a>
				</div>
				<div id="profilenavbutton2">
					<a  title="Profile" id="profile_nav_button" style="text-decoration: none;" href="profile.php"><img height="39" width="85" src="site_images/inactive_profile.png" /></a>
				</div>
				<div id="peeksnavbutton2">
					<a  title="Peeks" id="peeks_nav_button" style="text-decoration: none;" href="peek_page.php"><img height="39" width="85" src="site_images/inactive_peek.png" /></a>
				</div>
				<div id="explorenavbutton2">
					<a  title="Explore" id="explore_nav_button" style="text-decoration: none;" href="explore.php"><img height="39" width="85" src="site_images/inactive_explore.png" /></a>
				</div>
				<div id="logoutnavbutton2">
					<a  title="Logout" id="logout_nav_button" style="text-decoration: none;" href="../back/do_logout.php"><img height="39" width="85" src="site_images/logout.png" /></a>
				</div>
				
				
				<div id="pages" style="width:1px;height:1px;overflow:hidden;">
				
					<!--post box-->	
					<div id="postcontent">
						<form method = "POST" name="postForm" onSubmit="return validateForm()" action = "../back/do_post.php" enctype="multipart/form-data">
						<!--Diary Entry-->
							<div id="diarytextinput">
								<input id="title_field" style="font-family:titlefont; outline:none" type="text" size=27 maxlength="26" name="title" placeHolder="Title"/><br/><br/>
								<textarea id="text_field" style="outline:none" rows=10 cols=30 name="text" placeHolder="Dear Diary,"></textarea><br/>
								<div id="diarypostbutton">
									<br/><div id="postbutton"><input class="post" style="font-family:titlefont;font-size:15px;padding-top:5px;padding-bottom:5px;" type="submit" name = "textButton" value = "POST"/></div> 			
									<!--Select Privacy of the post-->
									<div id="postprivacy">
										<select style="font-family:titlefont;" name="privacy">
											<option value="private">Private</option>
											<option value="forpeek">For Peek</option>
											<option value="public">Public</option>
										</select>
									</div>
								</div>
							</div>	
							
							<ul class="accordion">
							  <li class="slide-01">
								<div>
								  <h2><img title="Add Pics" height="80" width="60" src="site_images/image_icon.png" /></h2>
								  <p>
									<div id="uploadimg">
									<input style="font-size: 9px;" id="upload" type="file" name="picture"/></br> 
									<input name="caption" size="17" type="text" placeHolder="Image Caption"/>
									</div>
								  </p>
								</div>
							  </li>

							  <li class="slide-02">
								<div>
								  <h2><img title="Add Quote" height="80" width="60" src="site_images/quote_icon.png" /></h2>
								  <p>
									<div id="insertquote">
											<input size=17 name="author" type="text" placeHolder="Author" /><br/>
											<textarea rows=2 cols=17 name="quote" placeHolder="'Quote'"></textarea><br/>
									</div>
								  </p>
								</div>
							  </li>

							  <li class="slide-03">
								<div>
								  <h2><img title="Add Link" height="80" width="60" src="site_images/link_icon.png" /></h2>
									<p>
										<div id="insertlink">
											<input size=17 name="link_name" type="text" placeHolder="Text to display"/><br/>
											<input size=17 name="link_source" type="text" placeHolder="Web address"/><br/>	
										</div>
									</p>
								</div>
							  </li>

							  <li class="slide-04">
								<div>
								  <h2><img title="Choose your mood" height="80" width="60" src="site_images/paper.png" /></h2>
									<p>
										<div id="choosemood">
										<input type="radio" name="paper_color" value="paper" checked="checked"> <img title="Normal" height="25" width="40" src="site_images/paper.png" />
										<input type="radio" name="paper_color" value="yellow" > <img title="(YELLOW) Happy" height="25" width="40" src="site_images/yellow.png" /><br/>
										<input type="radio" name="paper_color" value="red"> <img title="(RED) Angry" height="25" width="40" src="site_images/red.png" /> 						
										<input type="radio" name="paper_color" value="pink"> <img title="(PINK) Sweet" height="25" width="40" src="site_images/pink.png" /><br/>
										<input type="radio" name="paper_color" value="orange" > <img title="(ORANGE) Irritated" height="25" width="40" src="site_images/orange.png" />
										<input type="radio" name="paper_color" value="blue"> <img title="(BLUE) Sad" height="25" width="40" src="site_images/blue.png" /> <br/>
										</div>
									</p> 
								</div>
							  </li>
							</ul>
							
						</form>
					</div>
						
					
							<?php
								//for viewing posts
								require_once("../back/connect.php");
								$username = $_SESSION['username'];
		/***
		*	RETRIEVE POSTS
		*/				
								$retrieveQuery = "select * from post where username = '{$username}' order by date_posted desc";				
								$result=mysql_query($retrieveQuery,$conn);
								$i=0;
								while($row=mysql_fetch_array($result, MYSQL_ASSOC)){
									$i+=1;
								}
								$result=mysql_query($retrieveQuery,$conn);
								if($i!=0){
									while($row=mysql_fetch_array($result)){		
										echo '<div id="flippage">';
										echo "<div id='diaryentry'>";
											echo "<div id='diaryentryBG'> <img height='180' width='320' src='site_images/{$row['paper_color']}.png' /> </div>";
												echo "<div id='papercontent'>";
														echo $row['post_title']."<br/>";
														echo "[".$row['post_privacy']." post]  ";
														echo $row['date_posted']."<br/>";
														if($row['image_post']!=""){echo "<img height=60 width=60 src='post_images/{$row['image_post']}' alt''/>";}
																echo '<div id="postfunctions">';
																echo '<a  title="View Post" id="view_post_button" style="text-decoration: none;" href="retrieve_post_popup_window.php?postId='.$row["post_id"].'" rel="#overlay">
																	  <img height="20" width="20" src="site_images/view.png" />
																	  </a>';
																echo '<a  title="Edit Post" id="edit_post_button" style="text-decoration: none;" href="edit_post_popup_window.php?postId='.$row["post_id"].'" rel="#overlay">
																	  <img height="20" width="20" src="site_images/edit.png" />
																	  </a>';
																echo '<form method="POST" onSubmit="return deletePostAlert()" action="../back/do_remove_post.php">';
																echo "<input type='hidden' name='post_id' value=".$row['post_id']."></input>";
																echo "<input  title='Delete Post' id='remove_post_button' type='image' height='20' width='20' src='site_images/delete.png' value='' alt='submit'/></form>";
														echo '</div>';
													echo '</div>';
										echo '</div>';
										echo '</div>';
										
										}
										echo '<div></div>';
								}
								?>
				</div>
				<!-- overlayed element -->
				<div class="apple_overlay" id="overlay"><a class="close"></a>
					<!-- the external content is loaded inside this tag -->
					<div class="contentWrap"></div>
				</div>
			</div>
		</div>
	</div>
		

	<!-- make all links with the 'rel' attribute open overlays -->
	<script>
	$(function() {

		// if the function argument is given to overlay,
		// it is assumed to be the onBeforeLoad event listener
		$("a[rel]").overlay({

			mask: 'white',
			effect: 'apple',

			onBeforeLoad: function() {

				// grab wrapper element inside content
				var wrap = this.getOverlay().find(".contentWrap");

				// load the page specified in the trigger
				wrap.load(this.getTrigger().attr("href"));
			}

		});
	});
	</script>
	
	<script type="text/javascript">
	/****************************************************************************
	//** Software License Agreement (BSD License)
	//** Book Flip slideshow script- Copyright 2011, Will Jones (coastworx.com)
	//** This Script is wholly developed and owned by CoastWorx.com
	//** Copywrite: http://www.coastworx.com/
	//** You are free to use this script so long as this coptwrite notices
	//** and link back to http://www.coastworx.com stays intact in its entirety.
	//** If you want to remove the link back to http://www.coastworx.com then purchase a licence.
	//** You are NOT Permitted to claim this script as your own or
	//** use this script for commercial purposes without the express
	//** permission of CoastWorx Technologies!
	//***************************************************************************/

	pWidth=355; //width of each page
	pHeight=440; //height of each page

	numPixels=20;  //size of block in pixels to move each pass
	pSpeed=15; //speed of animation, more is slower

	startingPage="10";//select page to start from, for last page use "e", eg. startingPage="e"
	allowAutoflipFromUrl = true; //true allows querystring in url eg bookflip.html?autoflip=5

	pageBackgroundColor="white";
	pageFontColor="#ffffff";

	pageBorderWidth="1";
	pageBorderColor="#3D4D5D";
	pageBorderStyle="none";  //dotted, dashed, solid, double, groove, ridge, inset, outset, dotted solid double dashed, dotted solid

	/* not needed :-)
	pageShadowLeftImgUrl ="black_gradient.png";
	pageShadowWidth = 80;
	pageShadowOpacity = 60;
	pageShadow=1 //0=shadow off, 1= shadow on left page
	allowPageClick=true; //allow page turn by clicking the page directly*/
	
	allowNavigation=true; //this builds a drop down list of pages for auto navigation.
	pageNumberPrefix="page "; //displays in the drop down list of pages if enabled

	ini();
	</script>
	</body>
</html>