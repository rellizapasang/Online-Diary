<?php
	session_start();
	require_once("connect.php");
	
	//fetch data from post
	$post_id=$_POST['post_id'];
	$deleteQuery = "delete from post where post_id={$post_id}";
	//execute delete post query	
	$result=mysql_query($deleteQuery,$conn);
	mysql_close($conn);
	header("Location:../ui/home.php");
?>
