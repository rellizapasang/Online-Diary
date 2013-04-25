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
		<title>Peek Users</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php 
			require_once("../back/connect.php");
			//set values to the variables
			$username1=$_SESSION['username'];
			$username2=htmlspecialchars($_POST['userName']);
			
			//queries
			$query1="select * from user where username=\"{$username2}\"";
			$query2="select * from user where username=\"{$username1}\"";
			$query3="select * from mypeeks where username=\"{$username1}\" and peeks=\"{$username2}\"";
			
			//submit queries
			$result1=mysql_query($query1,$conn);
			$result2=mysql_query($query2,$conn);
			$result3=mysql_query($query3,$conn);
			
			//checks if the username entered by the user exists in the database
			if(mysql_num_rows($result1)){
				while($row=mysql_fetch_array($result2)){
						$username3=$row['username'];
						//checks if the username being seeached is the user's own username, if true, just show the user's username
						if(strcmp($username2,$username3)==0){
							echo '<form method="POST" action="../ui/profile.php">';
							echo $username2.'<input name="userName" type="hidden" value="'.$username2.'"/>';
							echo '<input class="submit" type="submit" value="My Profile"/><br/>';
							echo '</form>';
						}
						//else print the username along with a "peek button"
						else{
							//checks if the user is already peeking the use he/she searched.
							if(mysql_num_rows($result3)){
								echo '<form method="POST" action="../ui/view_profile.php">';
								echo $username2.'<input name="userName" type="hidden" value="'.$username2.'"/>';
								echo '<input class="submit" type="submit" value="View Profile"/><br/>';
								echo '</form>';
							}
							else{
								echo '<form method="POST" action="../back/do_peek_user.php">';
								echo $username2.'<input name="userName" type="hidden" value="'.$username2.'"/>';
								echo '<input class="submit" type="submit" value="Peek"/><br/>';
								echo '</form>';
							}
						}
					
				}
			}
			//else prompt message
			else{
				echo "user not in the database.";
			}
			echo '<a href="peek_page.php"><input type="button" name="Cancel" value="Cancel"/></a>'; //cancel button for now..... fix it later
			mysql_close($conn);
		?>
		<a href="../back/do_logout.php">Logout</a>
	</body>
</html>
