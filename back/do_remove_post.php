<?php
	session_start();
	require_once("connect.php");
	
	//fetch data from post
	$date_posted=$_POST['date_posted'];
	$deleteQuery = "delete from post where date_posted='{$date_posted}'";
	echo $deleteQuery;
	//execute delete post query	
	$result=mysql_query($deleteQuery,$conn);
	mysql_close($conn);
	header("Location:../ui/home.php");
?>
