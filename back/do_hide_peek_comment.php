<?php
		session_start();
	require_once("connect.php");
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	//fetch data from post
	$comment_id=htmlspecialchars($_POST['comment_id']);
	$username=htmlspecialchars($_SESSION['username']);
	$username2=htmlspecialchars($_POST['userName2']);
	
	//queries
	$updateQuery = "UPDATE comment SET status = 'hidden' where username = \"{$username}\" and comment_id = \"{$comment_id}\"";
	
	//submit queries
	mysql_query($updateQuery,$conn);
?>
