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
		var currentDate = new Date()
		//currentTime=currentTime.toUTCString();
		var month = currentDate.getMonth() + 1
		var day = currentDate.getDate()
		var year = currentDate.getFullYear()
		document.write("<h2 style='float:right'>"+month + "/" + day + "/" + year + "</h2>")
	</script>
	<!--ADD-->
		-What happen to you today?<br/>
         insert txt, images, quotes or links<br/>
		<form method = "POST" action = "../back/do_post.php">
			<textarea rows=30 cols=150 name="post_box" placeHolder="Dear Diary," required></textarea><br/> 
			<input class="post" type="submit" name = "textButton" value = "POST"/><br/>
		</form>
		<button type="button" onclick="postQuote()">Insert Quote</button>
		<button type="button" onclick="postLink()">Insert Link</button>
		<button type="button" onclick="postImage()">Insert Image</button>
		<div id="postArea">
			<?php
				if(isset($_GET['insertedQuote'])){
					echo "<p>Quote inserted! :)</p>";
				}
				else if(isset($_GET['insertedLink'])){
					echo "<p>Link inserted! :)</p>";
				}
				else if(isset($_GET['insertedImage'])){
					echo "<p>Image inserted! :)</p>";
				}
			?>
		</div>
		<div id="postList">
			<?php
				//for viewing posts
				require_once("../back/connect.php");
				$username = $_SESSION['username'];


/***
*	RETRIEVE POSTS
*/			
			$retrieveQuery = "select * from post where username = '{$username}' AND date(date_posted)=date(now())";				
			$result=mysql_query($retrieveQuery,$conn);
			$content= "{$username}'s today's post<br/>";
			$date_posted=$result['date_posted'];
			while($row=mysql_fetch_array($result)){
				if($row['post_type'] === 'text') $content=$content.$row['post_content']."<br/>"; //displays text				
				if($row['post_type'] === 'quote') $content=$content.$row['post_content']."<br/>"; //displays quote
				else if($row['post_type'] === 'link') $content=$content.'<a style="margin-left:10px" target="_blank" href="'.$row['post_content'].'">'.$row['post_content'].'</a><br/>'; //displays link
				else if($row['post_type'] === 'image') $content=$content."<img alt='' src='post_images/".$row['post_content']."' width='150' height='150'></img><br/>"; //displays image
				$date_posted=$row['date_posted'];
				$username=$row['username'];
			}
			echo $content;
/***
*	LIKE/UNLIKE BUTTON
*/
			$checkPostStatus = "select * from post where username='{$username}' and date_posted='{$date_posted}'";
			$result2=mysql_query($checkPostStatus);
			$row2=mysql_fetch_array($result2);
			if($row2['status']=='unlike'){
				echo '<form method="POST" action="../back/do_like_post.php">';
				echo '<input name="userName" type="hidden" value="'.$username.'"/><br/>';
				echo '<input name="date_posted" type="hidden" value="'.$date_posted.'">';
				echo "<input type='submit' value='Like'></input>";
				echo "</form>";
			}
			else if($row2['status']=='like'){
				echo '<form method="POST" action="../back/do_unlike_post.php">';
				echo '<input name="userName" type="hidden" value="'.$username.'"/><br/>';
				echo '<input name="date_posted" type="hidden" value="'.$date_posted.'">';
				echo "<input type='submit' value='Unlike'></input>";
				echo "</form>";
			}	
/***
*	REMOVE POST
*/
				if($username==$_SESSION['username']){
					echo '<form method="POST" onSubmit="return deletePostAlert()" action="../back/do_remove_post.php">';
					echo "<input id='remove_post_button' type='submit' value='Remove Post'></input>";
					echo "<input type='hidden' name='date_posted' value=".$date_posted."></input></form>";
				}
/***
*	RETRIEVE COMMENTS
*/
				$retrieveComment = "select * from comment where date_posted=date(now()) order by date ASC";
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
						<textarea style='margin-left:10px;margin-bottom:10px;'rows=3 cols=93 placeholder='comment..' size=60 name='comment_box' required='required'></textarea>
						<input type='hidden' name='date_posted' value=".$date_posted."></input>
						<input  class='comment_button' type='submit' value='Comment'></input>
					  </form>";				
			?>
		</div>
		-Publish as private or public
		-view previous posts

		<br/><a href="../back/do_logout.php">Logout</a>
	</body>
</html>