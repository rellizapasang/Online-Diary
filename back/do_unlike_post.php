<?php
	//do_like_post.php
	session_start();
	require_once("connect.php");
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	
	$username=htmlspecialchars($_POST['userName']);
	$date_posted=htmlspecialchars($_POST['date_posted']);
	
	//queries
	$deleteQuery = "delete from like_table where date_posted='{$date_posted}'";
	$updatePostStatus = "update post set status='unlike' where username=\"{$username}\" and date_posted='{$date_posted}'";
	
	//submit queries
	mysql_query($deleteQuery,$conn);
	mysql_query($updatePostStatus,$conn);
	header("Location:../ui/home.php");
?>
