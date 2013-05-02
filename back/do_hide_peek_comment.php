<?php
	session_start();
	require_once("connect.php");
	
	//fetch data from post
	$comment_id=htmlspecialchars($_POST['comment_id']);
	$username=htmlspecialchars($_SESSION['username']);
	$updateQuery = "UPDATE comment SET status = 'hidden' where username = \"{$username}\" and comment_id = \"{$comment_id}\"";
	
	
	$result=mysql_query($updateQuery,$conn);
	mysql_close($conn);
	header("Location:../ui/peek_post.php");
?>
