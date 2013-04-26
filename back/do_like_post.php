<?php
	//do_like_post.php
	session_start();
	require_once("connect.php");
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	
	$username=htmlspecialchars($_POST['userName']);
	$postId=htmlspecialchars($_POST['postId']);
	
	//queries
	$insertQuery = "insert into like_table (post_id,username) values(\"{$postId}\",\"{$username}\")";
	$updatePostStatus = "update post set status='like' where username=\"{$username}\" and post_id=\"{$postId}\"";
	
	//submit queries
	mysql_query($insertQuery,$conn);
	mysql_query($updatePostStatus,$conn);
	header("Location:../ui/home.php");
?>