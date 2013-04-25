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
		<?php 
			require_once("../back/connect.php");
			//set values to the variables
			$username1=$_SESSION['username'];
			$username2=htmlspecialchars($_POST['userName']);
			
			//query
			$query="select * from user where username=\"{$username2}\"";
			
			//submit query
			$result=mysql_query($query,$conn);
			
			//checks if the username entered by the user exists in the database
			if(mysql_num_rows($result)){
				//print profile information
				while($row=mysql_fetch_array($result)){
					echo "NAME: {$row['first_name']} {$row['last_name']}<br/>";
					echo "BIRTHDATE: {$row['birth_date']}<br/>";
					echo "GENDER: {$row['gender']}<br/>";
					echo "HOME ADDRESS: {$row['home_add']}<br/>";
					//view posts will be inserted here.
				}
			}
			
			echo '<a href="peek_page.php"><input type="button" name="Back" value="Back"/></a>'; //cancel button for now..... fix it later
			mysql_close($conn);
		?>
		<a href="../back/do_logout.php">Logout</a>
	</body>
</html>
