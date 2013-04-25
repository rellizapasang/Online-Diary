<?php
	session_start();
	require_once("connect.php");
	
	//fetch data from post
	$post_id=htmlspecialchars($_POST['post_id']);
	$username=htmlspecialchars($_SESSION['username']);
	$comment_content=htmlspecialchars($_POST['comment_box']);
	$insertQuery = "insert into comment(post_id,username,comment_content,date) values('{$post_id}',\"{$username}\",\"{$comment_content}\",sysdate())";
	
	$result=mysql_query($insertQuery,$conn);
	mysql_close($conn);
	header("Location:../ui/home.php");
?>