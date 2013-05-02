<?php
	session_start();
	require_once("connect.php");
	
	//fetch data from post
	$post_id=$_POST['post_id'];
	$deleteQuery = "delete from post where post_id={$post_id}";
	$deleteCommentQuery = "delete from comment where post_id={$post_id}"; //query to delete comment(s) when a post is deleted
	$deleteLikeTableEntry = "delete from like_table where post_id={$post_id}"; //query to delete like(s) when a post is deleted
	//execute delete post query	
	mysql_query($deleteQuery,$conn);
	mysql_query($deleteCommentQuery,$conn);
	mysql_query($deleteLikeTableEntry,$conn);
	mysql_close($conn);
	header("Location:{$_SERVER['HTTP_REFERER']}");
?>
