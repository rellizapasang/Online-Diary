<?php
	session_start();
	require_once("connect.php");
	
	//fetch data from post
	$date_posted=htmlspecialchars($_POST['date_posted']);
	$username=htmlspecialchars($_SESSION['username']);
	$comment_content=htmlspecialchars($_POST['comment_box']);
	$insertQuery = "insert into comment(date_posted,username,comment_content,date) values('{$date_posted}',\"{$username}\",\"{$comment_content}\",sysdate())";
	
	$result=mysql_query($insertQuery,$conn);
	mysql_close($conn);
	header("Location:../ui/home.php");
?>