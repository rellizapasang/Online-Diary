
<html>
	<head>
		<title></title>
	</head>
	<body>
	<?php
	session_start();
	require_once("connect.php");
	
	//fetch data from post
	$comment_id=$_POST['comment_id'];
	$username2=htmlspecialchars($_POST['userName2']);
	$deleteQuery = "delete from comment where comment_id={$comment_id}";
	
	$result=mysql_query($deleteQuery,$conn);
	mysql_close($conn);
	header("Location:../ui/peek_post.php?uName={$username2}");

?>
	</body>
</html>
