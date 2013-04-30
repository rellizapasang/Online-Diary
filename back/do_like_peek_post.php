<?php
	//do_like_peek_post.php
	session_start();
	require_once("connect.php");
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	$username=$_SESSION['username'];
	$username2=htmlspecialchars($_POST['userName2']);
	$postId=htmlspecialchars($_POST['postId']);
	
	//queries
	$insertQuery = "insert into like_table (post_id,username) values('{$postId}',\"{$username}\")";
	$updatePostStatus = "update post set status='like' where username=\"{$username2}\" and post_id='{$postId}'";
	
	
	//submit queries
	mysql_query($insertQuery,$conn);
	mysql_query($updatePostStatus,$conn);
	header("Location:../ui/peek_post.php?uName={$username2}");

?>
