<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Manage Account</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php 
			require_once("../back/connect.php");
			$username=$_SESSION['username'];
			$query="select * from user where username='{$username}'";
			$result=mysql_query($query,$conn);
			while($row=mysql_fetch_array($result)){
				echo "USERNAME: {$row['username']}";
				echo '<a href="edit_username.php">&nbspEdit</a><br/>';
				echo "PASSWORD:";
				echo '<a href="edit_password.php">&nbspEdit</a><br/>';
				echo "EMAIL ADDRESS: {$row['email_add']}";
				echo '<a href="edit_email.php">&nbspEdit</a><br/>';
				echo '<a href="profile.php"><input type="button" name="Cancel" value="Cancel"/></a>'; //cancel button for now..... fix it later
			}
			mysql_close($conn);
		?>
		<a href="../back/do_logout.php">Logout</a>
	</body>
</html>
