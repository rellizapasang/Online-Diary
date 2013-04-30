<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Change Username</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php include("nav.html");?>
		<?php 
			require_once("../back/connect.php");
			$username=$_SESSION['username'];
			$pstmt2 = "select * from user where username = \"{$username}\"";
			$result = mysql_query($pstmt2,$conn);
			
			if(isset($_GET['invalidUsername'])){
				echo "<p style='font-size:15px; color:red'>Username already taken.</p>";
			}
			else echo "Change Username"; 
		
			while($row=mysql_fetch_array($result)){
				echo '<form method="POST" action="../back/do_edit_username.php">';
				echo 'Username <input name="userName" type="text" value="'.$username.'" required=""/><br/>';
				echo '<input class="submit" type="submit" value="Save"/>'; //save
				echo '<a href="manage_account.php"><input type="button" name="Cancel" value="Cancel"/></a>'; //cancel button for now..... fix it later
				echo '</form>';
			}
			mysql_close($conn);
		?>
		<a href="javascript:history.back()">Back</a>
	</body>
</html>

