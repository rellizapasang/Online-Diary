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
	
	//queries to add peekers and peeks to the database of the user
	$query1="insert into mypeeks values(\"{$username}\",\"{$username2}\")";
	$query2="insert into mypeekers values(\"{$username2}\",\"{$username}\")";
	
	//submit queries
	mysql_query($query1,$conn);
	mysql_query($query2,$conn);
	header("Location:../ui/peek_page.php"); //redirects to peek_page.php
?>
