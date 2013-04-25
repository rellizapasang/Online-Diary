<?php
	session_start();
	require_once("connect.php");
	
	//fetch data from post
	$comment_id=$_POST['comment_id'];
	$deleteQuery = "delete from comment where comment_id={$comment_id}";
	$result=mysql_query($deleteQuery,$conn);
	mysql_close($conn);
	header("Location:../ui/home.php");
?>