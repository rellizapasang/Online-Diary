<?php
	//do_edit_profile_info.php
	
	session_start();
	require_once("connect.php");
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	
	$username=$_SESSION['username'];
	
	$currentPassword=htmlspecialchars($_POST['currPassword']);
	$newPassword=htmlspecialchars($_POST['newPassword']);
	$retypePassword=htmlspecialchars($_POST['retypePassword']);
	
	$query1 = "select * from user where username = \"{$username}\"";
	$query2="UPDATE user SET password=MD5(\"{$newPassword}\") WHERE username=\"{$username}\"";

	//fetches the user account's saved password in the database
	$result = mysql_query($query1,$conn);
	while($row=mysql_fetch_array($result)){
		$userSavedPassword = $row['password'];
		
	}
	
	
	if(strcmp(MD5($currentPassword),$userSavedPassword)==0){
		if(strcmp($newPassword,$retypePassword)==0){
			mysql_query($query2,$conn);
			header("Location:../ui/manage_account.php");
		}
		else{
			header("location:../ui/edit_password.php?invalidNewAndRetypePassword");
		}
	}
	else 
	{
		header("location:../ui/edit_password.php?invalidCurrentPassword");
	}
?>