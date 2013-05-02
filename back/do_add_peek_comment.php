
<html>
	<head>
		<title></title>
	</head>
	<body>
	<?php
	session_start();
	require_once("connect.php");
	
	//fetch data from post
	
	$username2=htmlspecialchars($_POST['userName2']);
	$postId=htmlspecialchars($_POST['postId']);
	$username=htmlspecialchars($_SESSION['username']);
	$comment_content=htmlspecialchars($_POST['comment_box']);
	$insertQuery = "insert into comment(post_id,username,comment_content,date,status) values('{$postId}',\"{$username}\",\"{$comment_content}\",sysdate(),'unhidden')";
	
	
	$result=mysql_query($insertQuery,$conn);
	mysql_close($conn);
	header("Location:../ui/peek_post.php?uName={$username2}");
	?>
	</body>
</html>
