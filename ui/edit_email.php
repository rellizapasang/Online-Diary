<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Change Email Address</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php include("nav.html");?>
		<?php 
			require_once("../back/connect.php");
			$username=$_SESSION['username'];
			$pstmt2 = "select * from user where username = \"{$username}\"";
			$result = mysql_query($pstmt2,$conn);
			
			if(isset($_GET['invalidEmailAdd'])){
				echo "<p style='font-size:15px; color:red'>Email Address already taken.</p>";
			}
			else echo "Change Email Address"; 
		
			while($row=mysql_fetch_array($result)){
				$email = $row['email_add'];
				echo '<form method="POST" action="../back/do_edit_email.php">';
				echo 'Email Address <input name="emailAdd" type="email" value="'.$email.'" required=""/><br/>';
				echo '<input class="submit" type="submit" value="Save"/>'; //save
				echo '<a href="manage_account.php"><input type="button" name="Cancel" value="Cancel"/></a>'; //cancel button for now..... fix it later
				echo '</form>';
			}
			mysql_close($conn);
		?>
		<a href="javascript:history.back()">Back</a>
	</body>
</html>

