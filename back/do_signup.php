<?php
	require_once("connect.php");

	//fetch data from post
	$username=htmlspecialchars($_POST['username']);
	$password=htmlspecialchars($_POST['password']);
	$confirmPassword=htmlspecialchars($_POST['confirmPassword']);
	$firstName=htmlspecialchars($_POST['firstName']);
	$lastName=htmlspecialchars($_POST['lastName']);
	$emailAdd=htmlspecialchars($_POST['emailAdd']);
	$gender=htmlspecialchars($_POST['gender']);
	$birthMonth=htmlspecialchars($_POST['birth_month']);
	$birthDay=htmlspecialchars($_POST['birth_day']);
	$birthYear=htmlspecialchars($_POST['birth_year']);
	
	
	$pstmt2 = "select * from user where username = \"{$username}\"";
	$pstmt="insert into user values(\"{$username}\",MD5(\"{$password}\"),\"{$firstName}\",\"{$lastName}\", \"{$gender}\", '$birthYear-$birthMonth-$birthDay',\"{$emailAdd}\")";
	
	$result = mysql_query($pstmt2,$conn);
	if(mysql_num_rows($result)){
		if(strcmp($password,$confirmPassword)!==0){
			header("location:../ui/signUp.php?invalidUsernameAndPassword");
		}
		else header("location:../ui/signUp.php?invalidUsername");
	}
	else if(strcmp($password,$confirmPassword)!==0){
		header("location:../ui/signUp.php?invalidPassword");
	}
	else{
		mysql_query($pstmt,$conn);
		//header("Location:confirmed.php");
		echo "Your account has been successfully created.You may now use your account details to login.<a href='../index.php'>Sign in</a>";
	}	
?>
