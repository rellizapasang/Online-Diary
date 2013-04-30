<?php
	//start session
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>View Profile</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php include("nav.html");?>
		<?php 
			require_once("../back/connect.php");
			//set values to the variables
			$username1=$_SESSION['username'];
			$username2=htmlspecialchars($_POST['userName']);
			
			//query
			$query="select * from user where username=\"{$username2}\"";
			$query2="select * from mypeeks where username=\"{$username1}\" and peeks=\"{$username2}\"";
			//submit query
			$result=mysql_query($query,$conn);
			$result2=mysql_query($query2,$conn);
			//checks if the username entered by the user exists in the database
			if(mysql_num_rows($result)){
				//print profile information
				while($row=mysql_fetch_array($result)){
					echo "NAME: {$row['first_name']} {$row['last_name']}<br/>";
					echo "BIRTHDATE: {$row['birth_date']}<br/>";
					echo "GENDER: {$row['gender']}<br/>";
					echo "HOME ADDRESS: {$row['home_add']}<br/>";
					if(mysql_num_rows($result2)){
					//button to view the posts of the user
					echo '<form method="POST" action="../ui/peek_post.php">';
					echo '<input name="userName" type="hidden" value="'.$username2.'"/><br/>';
					echo '<input name="userName2" type="hidden" value="'.$username2.'"/><br/>';
					echo '<input class="submit" type="submit" value="View Posts"/>';
					echo '</form>';
					}
				}
			}
			mysql_close($conn);
		?>
		<br/><a href="javascript:history.back()">Back</a>
	</body>
</html>
