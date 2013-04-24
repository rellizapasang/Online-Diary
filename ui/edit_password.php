<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Change Password</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		
		<?php 
			require_once("../back/connect.php");
			$username=$_SESSION['username'];
			$pstmt2 = "select * from user where username = \"{$username}\"";
			$result = mysql_query($pstmt2,$conn);
			
			if(isset($_GET['invalidCurrentPassword'])){
				echo "<p style='font-size:15px; color:red'>Saved and typed current password did not match.</p>";
			}
			else echo "Change Password"; 
			
			echo '<form method="POST" action="../back/do_edit_password.php">';
			echo 'Current Password <input name="currPassword" type="password" value="" required=""/><br/>';
			if(isset($_GET['invalidNewAndRetypePassword'])){
				echo "<p style='font-size:15px; color:red'>Passwords did not match.</p>";
			}
			echo 'New Password <input name="newPassword" type="password" value="" required=""/><br/>';
			echo 'Re-type Password <input name="retypePassword" type="password" value="" required=""/><br/>';
			echo '<input class="submit" type="submit" value="Save"/>'; //save
			echo '<a href="manage_account.php"><input type="button" name="Cancel" value="Cancel"/></a>'; //cancel button for now..... fix it later
			echo '</form>';
			
			mysql_close($conn);
		?>
		<a href="../back/do_logout.php">Logout</a>
	</body>
</html>

