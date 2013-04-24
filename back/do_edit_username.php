<?php
	//do_edit_profile_info.php
	
	session_start();
	require_once("connect.php");
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	$username=$_SESSION['username'];
	$username2=htmlspecialchars($_POST['userName']);
	
	$query1="select * from user where username = \"{$username2}\"";  
	$query2="UPDATE user SET username=\"{$username2}\" WHERE username=\"{$username}\"";

	
	$result = mysql_query($query1,$conn);
	if(mysql_num_rows($result)){
		header("location:../ui/edit_username.php?invalidUsername");
	}
	else{
		//updates the session username to new username
		$_SESSION['username']=$username2;
		mysql_query($query2,$conn);
		header("Location:../ui/manage_account.php");
	}
?>
