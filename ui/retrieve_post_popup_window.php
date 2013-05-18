<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="css/retrieve.css"/>
	<script type="text/javascript" src="js/retrieve.js"></script>
</head>

<body>
<?php 
	if(isset($_GET['postId'])){
		$postId = $_GET['postId'];				
	}
	//for viewing posts
	echo "<p style='float:left'>Diary Entry #1</p><br/>";
	require_once("../back/connect.php");
	$username = $_SESSION['username'];
	$retrieveQuery = "select * from post where post_id = '{$postId}' order by date_posted desc";				
	$result=mysql_query($retrieveQuery,$conn);
	while($row=mysql_fetch_array($result)){
		echo "<p style='float:left;font-size:8px;'>{$row['date_posted']}</p><br/>";
		if(strlen($row['post_title']) !==0){
			echo '<div id="title">';
			echo $row['post_title']."<br/>"; //displays title
			echo '</div>';
		}
		if($row['image_post'] !== ""){
		echo '<div id="image_box">';
			echo "<img alt='' src='site_images/polaroid.png'/>";
			echo "<div id='image'>";
			echo "<img alt='' src='post_images/".$row['image_post']."' width='330' height='335'></img><br/>";
			echo '</div>';
			echo '<div id="caption">';
			echo $row['image_caption'];
			echo '</div>';
		echo '</div>';
		}	//displays image
		if(strlen($row['text_post']) !==0){
			if($row['image_post'] !== ""){
				echo "<style>";
				echo "div#text_box{";
				echo "margin-top:-330px;}";
				echo "</style>";
			}
		else ;
		echo '<div id="text_box">';
			echo '<div id="text">'; 
			echo $row['text_post']; //displays text
			if(strlen($row['link_source']) !==0){
				echo "<br/>Shared Link: ".'<a id="link" style="text-decoration:none; margin-left:10px;" target="_blank" href="'.$row['link_source'].'">'.$row['link_name'].'</a><br/><style>a#link:hover{text-decoration:underline}</style>'; //displays link
			}
			echo '</div>';
		echo '</div>';
		}
		if(strlen($row['quote_post']) !==0){
		echo '<div id="quote_box" style="font-family:quotefont;">';
			echo '<img alt="" src="site_images/quote.png" height=100 width=100 style="float:left;"/>';
			echo '<div id="quote">';
			echo $row['quote_post'];
			echo '</div>';
			if(strlen($row['quote_author']) !==0){
				echo '<div id="author">';
				echo "- ".$row['quote_author'];
				echo '</div>';
			}
		echo '</div>';
		}
		//LIKE/UNLIKE BUTTON
		echo "<div id='like_field'>";
		$checkLikeTable = "select * from like_table where username='{$username}' and post_id='{$row['post_id']}'";
		$result2=mysql_query($checkLikeTable);
		if(mysql_num_rows($result2)){
			echo '<form method="POST" id="unlikeForm" action="../back/do_unlike_post.php">';
			echo '<input name="userName" type="hidden" value="'.$row['username'].'"/><br/>';
			echo '<input name="postId" type="hidden" value="'.$row['post_id'].'">';
			echo "<div id='switch1'><input class='likeForm' title='Dislike this post' type='image' alt='submit' src='site_images/unlike_icon.png' height=40 width=40 value='Unlike'></input></div>";
			echo "</form>";
		}
		else{
			//echo '<form method="POST" action="../back/do_like_post.php">';
			echo '<form method="POST" id="likeForm" action="../back/do_like_post.php">';
			echo '<input name="userName" type="hidden" value="'.$row['username'].'"/><br/>';
			echo '<input name="postId" type="hidden" value="'.$row['post_id'].'">';
			echo "<div id='switch2'><input class='likeForm' title='Like this post' type='image' alt='submit' src='site_images/like_icon.png' height=40 width=40 value='Like'></input></div>";
			echo "</form>";
		}
		//Checks and prints the liker(s) of the post
		$checkLikers = "select * from like_table where post_id='{$row['post_id']}'";
		$result3=mysql_query($checkLikers);
		$result4=mysql_query($checkLikers);
							
		//Counts likes
		$likeCounter = 0;
		while($row2=mysql_fetch_array($result3)){
			if($row2['post_id']==$row['post_id']){
				$likeCounter++; //counts the likes in the post
			}
		}
		echo "<div id='numOfLikes'>";
		if($likeCounter==1){
			echo $likeCounter." Like</br>";
		}
		else if($likeCounter>=2){
			echo $likeCounter." Likes</br>";
		}
		else{
			echo " ";
		}
		echo "</div>";
		echo "</div>";
		echo '<div id="commentLabel">COMMENTS</div>';
		/***
		*	RETRIEVE COMMENTS
		*/
		$retrieveComment = "select * from comment where post_id=".$row['post_id']." order by date ASC";
		$result2=mysql_query($retrieveComment,$conn);
		echo '<div class="comment_list">';
		while($comment_row=mysql_fetch_array($result2)){
			//if a comment is not the user's comment and the status is hidden, do not print anything.
			if(($comment_row['username']!=$_SESSION['username'])&&($comment_row['status']=='hidden')){
			}
			//else if a comment is not the user's comment and the status is unhidden, print comment.
			else if(($comment_row['username']!=$_SESSION['username'])&&($comment_row['status']=='unhidden')){
				$getPicQuery = 'select profile_pic from user where username="'.$_SESSION['username'].'"';
				$pic=mysql_query($getPicQuery,$conn);
				$pic=mysql_fetch_array($pic);
				echo '<div class="comment_box">';
					echo '<div class="picBox"><img class="profile_pic" alt="" src="profile_pics/'.$pic['profile_pic'].'" height="50" width=50/></div>';
						echo '<img class="tail" height=39 width=40 src="site_images/comment.png" alt=""/>';
						echo '<div class="comment"><div class="comment_username">'.$comment_row['username'].'</div>';
						echo '<div class="content">'.$comment_row['comment_content'].'</div></div>';
				echo '</div>';
			}
			//else if a comment is from the user
			else if($comment_row['username']==$_SESSION['username']){
				$getPicQuery = 'select profile_pic from user where username="'.$_SESSION['username'].'"';
				$pic=mysql_query($getPicQuery,$conn);
				$pic=mysql_fetch_array($pic);
				echo '<div class="comment_box">';
					echo '<div class="picBox"><img class="profile_pic" alt="" src="profile_pics/'.$pic['profile_pic'].'" height="50" width=50/></div>';
						echo '<img class="tail" height=39 width=40 src="site_images/comment.png" alt=""/>';
						echo '<div class="comment"><div class="comment_username">'.$comment_row['username'].'</div>';
						echo '<div class="content"><p style="margin:5px;" align="justify">'.$comment_row['comment_content'].'</p></div>';
						echo '<div id="comment_settings">';
						//hides comment
						if($comment_row['status']=='unhidden'){
							echo "<form class='hide_comment_form' method='POST' action='../back/do_hide_comment.php'>";
							echo "<input type='hidden' name='post_id' value=".$comment_row['post_id']."></input>";
							echo "<input class='hide_button' type='image' alt='submit' value='Hide' title='Hide this comment' src='site_images/hide.png' height=20 width=20/>";
							echo "<input type='hidden' name='comment_id' value=".$comment_row['comment_id']."></input></form>";
							$message ='';
						}
						//unhides comment
						else if ($comment_row['status']=="hidden"){
							$message ="<p align='left' style='left:150px;top:-15px;position:relative;color: grey;font-size:13px;font-family:textfont;'>-This comment is hidden from other users-</p>";
							echo "<form class='unhide_comment_form' method='POST' action='../back/do_unhide_comment.php'>";
							echo "<input type='hidden' name='post_id' value=".$comment_row['post_id']."></input>";
							echo "<input class='unhide_button' type='image' alt='submit' value='Unhide' title='This comment is hidden. Click to unhide this comment.' src='site_images/view.png' height=20 width=20/>";
							echo "<input type='hidden' name='comment_id' value=".$comment_row['comment_id']."></input></form>";
						}
						//deletes comment
						echo "<form class='delete_comment_form' method='POST' onSubmit='return deleteCommentAlert()' action='../back/do_delete_comment.php'>";
						echo "<input class='remove_button' title='Delete this comment.' type='image' alt='submit' value='Remove' src='site_images/delete.png' height=20 width=20/>";
						echo "<input type='hidden' name='post_id' value=".$comment_row['post_id']."></input>";
						echo "<input type='hidden' name='comment_id' value=".$comment_row['comment_id']."></input></form>";
						echo "</div><div class='date'><p style='margin-left:10px;color: rgba(100, 100, 255, .9); font-family: textfont;' align='left'>".$comment_row['date'].$message."</div></div></div>";
			}
			else echo "<div class='date'>".$comment_row['date']."</div>";
		}
		echo "</div>";
		/***
		*	ADD COMMENT
		*/
		$getPicQuery = 'select profile_pic from user where username="'.$_SESSION['username'].'"';
		$pic=mysql_query($getPicQuery,$conn);
		$pic=mysql_fetch_array($pic);
		echo '<div class="comment_box">';
			echo '<div class="picBox"><img class="profile_pic" alt="" src="profile_pics/'.$pic['profile_pic'].'" height="50" width=50/></div>';
			echo '<img class="tail" height=39 width=40 src="site_images/comment.png" alt=""/>';
			echo '<div class="comment"><div class="comment_username">'.$comment_row['username'].'</div>';
			echo '<div class="content">'."<form id='addComment' method='POST' action='../back/do_add_comment.php'>
				<textarea class='add_comment_text' style='border: 0px;margin:10px;' rows=3 cols=50 placeholder='comment here..' size=60 name='comment_box' required='required'></textarea>
				<input type='hidden' name='post_id' value=".$row['post_id']."></input></br>
				<input  style='font-family:titlefont; padding:3px;' class='comment_button' type='submit' value='Comment'></input>
			</form>".'</div></div></div>';		
	}	
?>
</body>
</html>