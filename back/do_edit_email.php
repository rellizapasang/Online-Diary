<?php
	//do_edit_profile_info.php
	
	session_start();
	require_once("connect.php");
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	$username=$_SESSION['username'];
	$emailAdd=htmlspecialchars($_POST['emailAdd']);
	
	$query1="select * from user where email_add = \"{$emailAdd}\"";  
	$query2="UPDATE user SET email_add=\"{$emailAdd}\" WHERE username=\"{$username}\"";

	
	$result = mysql_query($query1,$conn);
	if(mysql_num_rows($result)){
		header("location:../ui/edit_email.php?invalidEmailAdd");
	}
	else{
		mysql_query($query2,$conn);
		header("Location:../ui/manage_account.php");
	}
?>
