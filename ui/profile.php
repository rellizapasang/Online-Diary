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
				echo "BIRTHDATE: {$row['birth_date']}<br/>";
				echo "GENDER: {$row['gender']}<br/>";
				echo "HOME ADDRESS: {$row['home_add']}<br/>";
				echo '<a href="manage_profile.php">Manage Profile</a>';
				echo '<a href="manage_account.php">Manage Account</a><br/>';
				echo '<a href="home.php">Go to my diary..</a>';
				echo '<a href="peek_page.php">Peeks</a><br/>';
				$_SESSION['firstName']=$row['first_name'];
			}
			mysql_close($conn);
		?>
		
	</body>
</html>
