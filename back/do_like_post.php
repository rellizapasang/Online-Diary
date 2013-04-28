<?php
	//do_like_post.php
	session_start();
	require_once("connect.php");
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	
	$username=htmlspecialchars($_POST['userName']);
	$datePosted=htmlspecialchars($_POST['date_posted']);
	
	//queries
	$insertQuery = "insert into like_table (date_posted,username) values('{$datePosted}',\"{$username}\")";
	$updatePostStatus = "update post set status='like' where username=\"{$username}\" and date_posted='{$datePosted}'";
	
	//submit queries
	mysql_query($insertQuery,$conn);
	mysql_query($updatePostStatus,$conn);
	header("Location:../ui/home.php");
?>
