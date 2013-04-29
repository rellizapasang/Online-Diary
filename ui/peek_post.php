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
					if($row['post_type'] === 'text') echo $row['username']." : ".$row['post_content']."<br/>"; //displays text
					else if($row['post_type'] === 'quote') echo $row['username']." : ".$row['post_content']."<br/>"; //displays quote
					else if($row['post_type'] === 'link') echo $row['username'].'<a style="margin-left:10px" target="_blank" href="'.$row['post_content'].'">'.$row['post_content'].'</a><br/>'; //displays link
					else echo $row['username']."<img alt='' src='post_images/".$row['post_content']."' width='150' height='150'></img><br/>"; //displays image
					//LIKE/UNLIKE BUTTON
					$checkPostStatus = "select * from post where username='{$row['username']}' and post_id='{$row['post_id']}'";
					$result2=mysql_query($checkPostStatus);
					while($row2=mysql_fetch_array($result2)){
						if($row2['status']=='unlike'){
							echo '<form method="POST" action="../back/do_like_peek_post.php">';
							echo '<input name="userName" type="hidden" value="'.$row['username'].'"/><br/>';
							echo "<input type='hidden' name='userName2' value=".$username2."></input>";
							echo '<input name="postId" type="hidden" value="'.$row['post_id'].'">';
							echo "<input type='submit' value='Like'></input>";
							echo "</form>";
						}
						else if($row2['status']=='like'){
							echo '<form method="POST" action="../back/do_unlike_peek_post.php">';
							echo '<input name="userName" type="hidden" value="'.$row['username'].'"/><br/>';
							echo "<input type='hidden' name='userName2' value=".$username2."></input>";
							echo '<input name="postId" type="hidden" value="'.$row['post_id'].'">';
							echo "<input type='submit' value='Unlike'></input>";
							echo "</form>";
						}
					}

/***
*	RETRIEVE COMMENTS
*/
					$retrieveComment = "select * from comment where post_id=".$row['post_id']." order by date ASC";
					$result2=mysql_query($retrieveComment,$conn);
					while($comment_row=mysql_fetch_array($result2)){
						echo $comment_row['username'].": ".$comment_row['comment_content'];
						if($comment_row['username']==$_SESSION['username']){
							//deletes comment
							echo "<form method='POST' onSubmit='return deleteCommentAlert()' action='../back/do_delete_peek_comment.php'>";
							echo "<input id='remove_button' type='submit' value='Remove'></input>";
							echo "<input type='hidden' name='userName2' value=".$username2."></input>";
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
		

		<br/><a href="../back/do_logout.php">Logout</a>
	</body>
</html>
