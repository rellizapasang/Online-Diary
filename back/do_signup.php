<?php
	require_once("connect.php");

	//fetch data from post
	$username=htmlspecialchars($_POST['username']);
	$password=htmlspecialchars($_POST['password']);
	$firstName=htmlspecialchars($_POST['firstName']);
	$lastName=htmlspecialchars($_POST['lastName']);
	$emailAdd=htmlspecialchars($_POST['emailAdd']);
	
	$pstmt2 = "select * from user where username = \"{$username}\"";
	$pstmt="insert into user values(\"{$username}\",MD5(\"{$password}\"),\"{$firstName}\",\"{$lastName}\",NULL,\"{$emailAdd}\")";
	
	$result = mysql_query($pstmt2,$conn);
	if(mysql_num_rows($result)){
		header("location:../ui/signUp.php?invalidUsername");
	}
	else{
		mysql_query($pstmt,$conn);
		//header("Location:confirmed.php");
		echo "Your account has been successfully created.You may now use your account details to login.<a href='../index.php'>Sign in</a>";
	}	
?>
