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
	<!--ADDING A POST-->
		<form method = "POST" action = "../back/do_post.php">
			<input type="text" size=100 name="title" placeHolder="Title(Optional)"/><br/>

			<textarea rows=3 cols=77 name="text" placeHolder="Dear Diary,"></textarea><br/><br/>
			_______________________________________________________________________________<br/><br/>  
			Add a pic!<br/>
			<input type="file" name="picture"  required/>
			Image Caption:<input name="caption" type=text/><br/><br/>
			_______________________________________________________________________________<br/><br/>  
			Add a quote!<br/>
			Author:<input name="author" type=text/><br/>
			<textarea rows=2 cols=77 name="quote" placeHolder="'Quote'"></textarea><br/>
			_______________________________________________________________________________<br/><br/>  
			Add a Link!<br/>
			Text to display:<input size=50 name="link_name" type=text/><br/>
			Web address:<input size=50 name="link_source" type=text/><br/>
			_______________________________________________________________________________<br/><br/> 
			<br/><input class="post" type="submit" name = "textButton" value = "POST"/> 			
			<!--Select Privacy of the post-->
			<select name="privacy">
				<option value="private">Private</option>
				<option value="public">Public</option>
			</select>
		</form>
		
		<div id="postList">
			<?php
				//for viewing posts
				require_once("../back/connect.php");
				$username = $_SESSION['username'];
				
				
/***
*	RETRIEVE POSTS
*/				
				$retrieveQuery = "select * from post where username = '{$username}' order by date_posted desc";				
				$result=mysql_query($retrieveQuery,$conn);
				while($row=mysql_fetch_array($result)){
					if($row['post_type'] === 'text') echo $row['username']." : ".$row['post_content']."<br/>"; //displays text
					else if($row['post_type'] === 'quote') echo $row['username']." : ".$row['post_content']."<br/>"; //displays quote
					else if($row['post_type'] === 'link') echo $row['username'].'<a style="margin-left:10px" target="_blank" href="'.$row['post_content'].'">'.$row['post_content'].'</a><br/>'; //displays link
					else echo $row['username']."<img alt='' src='post_images/".$row['post_content']."' width='150' height='150'></img><br/>"; //displays image
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
					while($row2=mysql_fetch_array($result3)){
						if($row2['post_id']==$row['post_id']){
							echo $row2['username'];
						}
					}
					
/***
*	REMOVE POST
*/
				if($row['username']==$_SESSION['username']){
					echo '<form method="POST" onSubmit="return deletePostAlert()" action="../back/do_remove_post.php">';
					echo "<input id='remove_post_button' type='submit' value='Remove Post'></input>";
					echo "<input type='hidden' name='post_id' value=".$row['post_id']."></input></form>";
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
					echo "<form method='POST' action='../back/do_add_comment.php'>
							<textarea style='margin-left:10px;margin-bottom:10px;' rows=2 cols=93 placeholder='comment..' size=60 name='comment_box' required='required'></textarea>
							<input type='hidden' name='post_id' value=".$row['post_id']."></input>
							<input  class='comment_button' type='submit' value='Comment'></input>
						  </form>";				
				}
			?>
		</div>
	</body>
</html>
