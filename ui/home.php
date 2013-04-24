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
					if($row['type'] === 'text') echo $row['username']." : ".$row['post_content']."<br/>";				
				}
			?>
		</div>
		<div id="postArea"></div>
		-Publish as private or public
		-view previous posts

		<br/><a href="../back/do_logout.php">Logout</a>
	</body>
</html>
