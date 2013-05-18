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
	$img = htmlspecialchars($_FILES['picture']['name']);
	if($img!=""){//condition that checks if there is an image file uploaded
		$extension = end(explode(".", $_FILES["picture"]["name"]));		//get the image file extension
		$ran=time().rand();												//generate a random number for a unique image file name
		$ran2 = $ran.".";												
		$target = "../ui/profile_pics/";									//image_file_path
		$target = $target.$ran2.$extension;								//image_file_path/file_name
		$img = $ran2.$extension;
		move_uploaded_file($_FILES["picture"]["tmp_name"],$target);		//move the temp file to the image_file_path with the random name 
		$query ="UPDATE user SET first_name=\"{$firstName}\", last_name=\"{$lastName}\", gender=\"{$gender}\", birth_date='$birthYear-$birthMonth-$birthDay', profile_pic=\"{$img}\" WHERE username=\"{$username}\""; 
	} 
	else{
		$query="UPDATE user SET first_name=\"{$firstName}\", last_name=\"{$lastName}\", gender=\"{$gender}\", birth_date='$birthYear-$birthMonth-$birthDay' WHERE username=\"{$username}\"";
	}
	mysql_query($query,$conn);
	header("Location:../ui/profile.php");
?>
