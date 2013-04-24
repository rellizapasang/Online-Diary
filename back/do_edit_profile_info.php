<?php
	//do_edit_profile_info.php
	
	session_start();
	require_once("connect.php");
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	$username=$_SESSION['username'];
	
	$firstName=htmlspecialchars($_POST['firstName']);
	$lastName=htmlspecialchars($_POST['lastName']);
	$gender=htmlspecialchars($_POST['gender']);
	$birthMonth=htmlspecialchars($_POST['birth_month']);
	$birthDay=htmlspecialchars($_POST['birth_day']);
	$birthYear=htmlspecialchars($_POST['birth_year']);
	$homeAdd=htmlspecialchars($_POST['homeAdd']);
	
	$query="UPDATE user SET first_name=\"{$firstName}\", last_name=\"{$lastName}\", gender=\"{$gender}\", birth_date='$birthYear-$birthMonth-$birthDay', 
	home_add=\"{$homeAdd}\" WHERE username=\"{$username}\"";

	mysql_query($query,$conn);
	header("Location:../ui/profile.php");
?>
