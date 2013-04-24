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
			
			//submit queries
			$result1=mysql_query($query1,$conn);
			$result2=mysql_query($query2,$conn);
			
			//checks if the username entered by the user exists in the database
			if(mysql_num_rows($result1)){
				while($row=mysql_fetch_array($result2)){
						$username3=$row['username'];
						//checks if the username being seeached is the user's own username, if true, just show the user's username
						if(strcmp($username2,$username3)==0){
							echo '<input name="userName" type="text" value="'.$username2.'"/><br/>';
						}
						//else print the username along with a "peek button"
						else{
							echo '<form method="POST" action="../back/do_peek_user.php">';
							echo '<input name="userName" type="text" value="'.$username2.'"/>';
							echo '<input class="submit" type="submit" value="Peek"/><br/>';
							echo '</form>';
						}
					
				}
			}
			//else prompt message
			else{
				echo "user not in the database.";
			}
			echo '<input type="button" value="Back" onClick="history.go(-1);return true;">'; //back
			mysql_close($conn);
		?>
		
	</body>
</html>
