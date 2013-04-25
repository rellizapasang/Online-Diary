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
	<script>
		var currentTime = new Date()
		//currentTime=currentTime.toUTCString();
		var month = currentTime.getMonth() + 1
		var day = currentTime.getDate()
		var year = currentTime.getFullYear()
		document.write("<h2 style='float:right'>"+month + "/" + day + "/" + year + "</h2>")
	</script>
	<!--ADD-->
		-What happen to you today?<br/>
         insert txt, images, quotes or links<br/>
		<form method = "POST" action = "../back/do_post.php">
			<textarea rows=30 cols=150 name="post_box" placeHolder="Dear Diary," required></textarea><br/> 
			<input class="post" type="submit" name = "textButton" value = "POST"/><br/>
		</form>
		<div id="postArea"></div>
		<div id="postList">
			<?php
				//for viewing posts
				require_once("../back/connect.php");
				$username = $_SESSION['username'];
								
				$retrieveQuery = "select * from post where username = '{$username}' order by date_posted desc";				
				$result=mysql_query($retrieveQuery,$conn);
				while($row=mysql_fetch_array($result)){
					//checks if the post is a text type post
					if($row['type'] === 'text') {
						//prompt the post
						echo $row['username']." : ".$row['post_content']."<br/>";
						//this will retrieve the comments
						$retrieveComment = "select * from comment where post_id=".$row['post_id']." order by date ASC";
						$result2=mysql_query($retrieveComment,$conn);
						while($comment_row=mysql_fetch_array($result2)){
							echo $comment_row['username'].": ".$comment_row['comment_content'];
							if($comment_row['username']==$_SESSION['username']){
								echo "<form method='POST' action='../back/do_delete_comment.php'>";
								echo "<input id='remove_button' type='submit' value='Remove'></input>";
								echo "<input type='hidden' name='comment_id' value=".$comment_row['comment_id']."></input></form>";
								echo "<div class='date'>".$comment_row['date']."</div></div>";
							}
							else echo "<div class='date'>".$comment_row['date']."</div></div>";
						}
						//this will add comment to a post
						echo "<form method='POST' action='../back/do_add_comment.php'>
								<textarea style='margin-left:10px;margin-bottom:10px;' rows=3 cols=93 placeholder='comment..' size=60 name='comment_box' required='required'></textarea>
								<input type='hidden' name='post_id' value=".$row['post_id']."></input>
								<input  class='comment_button' type='submit' value='Comment'></input>
							  </form>";
					}
				}
			?>
		</div>
		<div id="postArea"></div>
		-Publish as private or public
		-view previous posts

		<br/><a href="../back/do_logout.php">Logout</a>
	</body>
</html>
