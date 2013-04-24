<?php
	//start session
	session_start();
	require_once("connect.php");
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	//set values to the variables
	$username=$_SESSION['username'];
	$username2=htmlspecialchars($_POST['userName']);
	
	//query to delete the peekers and peeks from the database of the user
	$query1="delete from mypeeks where username=\"{$username}\" and peeks=\"{$username2}\"";
	$query2="delete from mypeekers where username=\"{$username2}\" and peekers=\"{$username}\"";
	
	//submit queries
	mysql_query($query1,$conn);
	mysql_query($query2,$conn);
	
	
	header("Location:../ui/peek_page.php"); //redirects to peek_page.php
?>
