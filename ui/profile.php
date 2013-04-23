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
		<?php 
			require_once("../back/connect.php");
			$username=$_SESSION['username'];
			$query="select * from user where username='{$username}'";
			$result=mysql_query($query,$conn);
			while($row=mysql_fetch_array($result)){
				echo "NAME: {$row['first_name']} {$row['last_name']}<br/>";
				echo "EMAIL ADDRESS: {$row['email_add']}";
			}
			mysql_close($conn);
		?>
		<a href="home.php">Go to my diary..</a>
		<a href="../back/do_logout.php">Logout</a>
	</body>
</html>
