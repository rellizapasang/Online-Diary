<?php
	session_start();
	//condition that checks if the session has already been set
	if(isset($_SESSION['username'])){
		header("Location:ui/cover.php");
	}
?>
<!DOCTYPE html>

<html>

	<head>
		<title>Login</title>
		<meta charset="utf-8"/>
	</head>

	<body>
		<?php  
			if(isset($_GET['invalidlogin'])){
					echo "<p style='font-size:15px; color:red'>Username and Password does not match!</p>";
			}
			else echo "Unlock Your Diary!! :)";
		?>
		<form method="POST" action="back/do_login.php">
			Username<input type="text" name="username" title="Enter username" required=""/><br/>
			Password<input type="password" name="password" pattern="[A-Za-z0-9]{8}" title="Enter password" required=""/>
			<input name="loginButton" class="submit" type="submit" value="Login"/>
		</form>
			Need an account?<br/>
			<a href="ui/signUp.php"><input name="signUpButton" class="submit" type="submit" value="Sign Up"/></a>
	</body>
</html>
