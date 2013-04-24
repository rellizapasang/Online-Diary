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
			//set session username to variable username
			$username=$_SESSION['username'];
			
			//queries
			$query1="select * from mypeeks";
			$query2="select * from mypeekers";
			
			//submit query
			$result1=mysql_query($query1,$conn);
			$result2=mysql_query($query2,$conn);
			
			//search other users to peek
			echo '<form method="POST" action="../ui/search_user.php">';
			echo 'Search User <input name="userName" type="text" value=""/>';
			echo '<input class="submit" type="submit" value="Search"/><br/>';
			echo '</form>';
			
			//displays other users that the user peeks
			echo "USERS THAT I PEEK<br/>";
			while($row=mysql_fetch_array($result1)){
				$username2=$row['peeks'];
				//checks if the username in the database matches with the session username of the user, if true, print the username the user peeks  
				if(strcmp($username,$row['username'])==0){
					echo '<form method="POST" action="../back/do_unpeek_user.php">';
					echo '<input name="userName" type="text" value="'.$username2.'"/>';
					echo '<input class="submit" type="submit" value="Unpeek"/><br/>';
					echo '</form>';
					
				}	
			}
			
			//diplays other users that peeks the user
			echo "USERS THAT PEEKS ME<br/>";
			while($row=mysql_fetch_array($result2)){
				//checks if the session username of the user matches with the username in the database, if true, display the peekers of the user
				if(strcmp($username,$row['username'])==0){
					echo "{$row['peekers']}<br/>";
				}
			}
			
			echo '<input type="button" value="Back" onClick="history.go(-1);return true;">'; //back
			mysql_close($conn);
		?>
		
	</body>
</html>
