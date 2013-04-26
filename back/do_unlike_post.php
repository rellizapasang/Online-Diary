<?php
	//do_unlike_post.php
	session_start();
	require_once("connect.php");
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	$username=htmlspecialchars($_POST['userName']);
	$postId=htmlspecialchars($_POST['postId']);
	//queries
	$deleteQuery = "delete from like_table where post_id=\"{$postId}\" and username=\"{$username}\"";
	$updatePostStatus = "update post set status='unlike' where username=\"{$username}\" and post_id=\"{$postId}\"";
	//submit queries
	mysql_query($deleteQuery,$conn);
	mysql_query($updatePostStatus,$conn);
	header("Location:../ui/home.php");
?>