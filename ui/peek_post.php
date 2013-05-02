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
		<script type="text/javascript" src="js/post.js"></script>
	</head>

	<body>
			<?php include("nav.html");?>
			<?php
				//for viewing posts
				require_once("../back/connect.php");
				$username = $_SESSION['username'];
				
				
/***
*	RETRIEVE POSTS
*/				
				if(isset($_GET['uName'])){
					$username2 = $_GET['uName'];
				}
				else $username2 = $_POST['userName2'];

				$retrieveQuery = "select * from post where username = '{$username2}' order by date_posted desc";				
				$result=mysql_query($retrieveQuery,$conn);
				while($row=mysql_fetch_array($result)){
					echo "________________________________________________________________________________<br/>";
					echo $row['username']." posts something!".$row['date_posted'];
					if(strlen($row['text_post']) !==0) echo $row['text_post']."<br/>"; //displays text
					if(strlen($row['quote_post']) !==0) echo $row['quote_post']."<br/>"; //displays quote
					if(strlen($row['link_source']) !==0) echo '<a style="margin-left:10px" target="_blank" href="'.$row['link_source'].'">'.$row['link_name'].'</a><br/>'; //displays link
					if($row['image_post'] !== "") echo $row['image_caption']."<br/><img alt='' src='post_images/".$row['image_post']."' width='150' height='150'></img><br/>"; //displays image
					//LIKE/UNLIKE BUTTON
					$checkLikeTable = "select * from like_table where username='{$username}' and post_id='{$row['post_id']}'";
					$result2=mysql_query($checkLikeTable);
					if(mysql_num_rows($result2)){
						echo '<form method="POST" action="../back/do_unlike_post.php">';
						echo '<input name="userName" type="hidden" value="'.$row['username'].'"/><br/>';
						echo '<input name="postId" type="hidden" value="'.$row['post_id'].'">';
						echo "<input type='submit' value='Unlike'></input>";
						echo "</form>";
					}
					else{
						echo '<form method="POST" action="../back/do_like_post.php">';
						echo '<input name="userName" type="hidden" value="'.$row['username'].'"/><br/>';
						echo '<input name="postId" type="hidden" value="'.$row['post_id'].'">';
						echo "<input type='submit' value='Like'></input>";
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
						if($likeCounter==1){
							echo $likeCounter." Like</br>";
							
						}
						else if($likeCounter>=2){
							echo $likeCounter." Likes</br>";
							
						}
						else{
							echo " ";
						}
					//Gets the users who liked the post
					while($row4=mysql_fetch_array($result4)){
							if($row4['post_id']==$row['post_id']){
								echo $row4['username']." ";
							}
					}

/***
*	RETRIEVE COMMENTS
*/
					$retrieveComment = "select * from comment where post_id=".$row['post_id']." order by date ASC";
					$result2=mysql_query($retrieveComment,$conn);
					while($comment_row=mysql_fetch_array($result2)){
						//if a comment is not the user's comment and the status is hidden, do not print anything.
						if(($comment_row['username']!=$_SESSION['username'])&&($comment_row['status']=='hidden')){
						}
						//else if a comment is not the user's comment and the status is unhidden, print comment.
						else if(($comment_row['username']!=$_SESSION['username'])&&($comment_row['status']=='unhidden')){
							echo $comment_row['username'].": ".$comment_row['comment_content'];
						}
						//else if a comment is from the user
						else if($comment_row['username']==$_SESSION['username']){
							echo $comment_row['username'].": ".$comment_row['comment_content'];
							//hides comment
							if($comment_row['status']=='unhidden'){
								echo "<form method='POST' action='../back/do_hide_peek_comment.php'>";
								echo "<input type='hidden' name='userName2' value=".$username2."></input>";
								echo "<input id='hide_button' type='submit' value='Hide'></input>";
								echo "<input type='hidden' name='comment_id' value=".$comment_row['comment_id']."></input></form>";
							}
							//unhides comment
							else if ($comment_row['status']=="hidden"){
								echo "  -This comment is hidden from other users.-";
								echo "<form method='POST' action='../back/do_unhide_peek_comment.php'>";
								echo "<input type='hidden' name='userName2' value=".$username2."></input>";
								echo "<input id='unhide_button' type='submit' value='Unhide'></input>";
								echo "<input type='hidden' name='comment_id' value=".$comment_row['comment_id']."></input></form>";
							}
							//deletes comment
							echo "<form method='POST' onSubmit='return deleteCommentAlert()' action='../back/do_delete_comment.php'>";
							echo "<input id='remove_button' type='submit' value='Remove'></input>";
							echo "<input type='hidden' name='comment_id' value=".$comment_row['comment_id']."></input></form>";
							echo "<div class='date'>".$comment_row['date']."</div></div>";
						}
						else echo "<div class='date'>".$comment_row['date']."</div></div>";
					}
/***
*	ADD COMMENT
*/
					echo "<form method='POST' action='../back/do_add_peek_comment.php'>
							<textarea style='margin-left:10px;margin-bottom:10px;' rows=3 cols=93 placeholder='comment..' size=60 name='comment_box' required='required'></textarea>
							<input type='hidden' name='postId' value=".$row['post_id']."></input>
							<input type='hidden' name='userName2' value=".$username2."></input>
							<input  class='comment_button' type='submit' value='Comment'></input>
						  </form>";				
					}
			?>
		</div>
		<br/><a href="javascript:history.back()">Back</a>
	</body>
</html>
