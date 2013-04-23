<!--DO LOGIN PROCESS-->
<?php 
	session_start();
	require_once("connect.php");

	//fetch data from post
	$username=htmlspecialchars($_POST['username']);
	$password=htmlspecialchars($_POST['password']);
	$query="select * from user";
	
	$data=mysql_query($query,$conn);
	while($info = mysql_fetch_array($data)){
		if(($info['username']===$username) && ($info['password'] === MD5($password))){
			$_SESSION['username'] = $info['username'];
			header("Location:../ui/cover.php");
			break;
		}
		else header("Location:../index.php?invalidlogin");
	}
	mysql_close($conn);
?>
