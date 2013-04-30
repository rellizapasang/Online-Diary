<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>My Profile</title>
		<meta charset="utf-8"/>
	</head>

	<body>
		<?php include("nav.html");?>
		<?php 
			require_once("../back/connect.php");
			$username=$_SESSION['username'];
			$query="select * from user where username='{$username}'";
			$result=mysql_query($query,$conn);
			while($row=mysql_fetch_array($result)){
				echo "NAME: {$row['first_name']} {$row['last_name']}<br/>";
				echo "BIRTHDATE: {$row['birth_date']}<br/>";
				echo "GENDER: {$row['gender']}<br/>";
				echo "HOME ADDRESS: {$row['home_add']}<br/>";
			}
			mysql_close($conn);
		?>
		<br/><a href="javascript:history.back()">Back</a>
	</body>
</html>
