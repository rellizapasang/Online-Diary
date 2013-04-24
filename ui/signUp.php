<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php  
			if(isset($_GET['invalidUsername'])){
				echo "<p style='font-size:15px; color:red'>Username already taken.</p>";
			}
			else echo "Create an Account"; 
		?>
		<form method="POST" action="../back/do_signup.php">
			Username<br/><input class="textbox" type="text" name="username" pattern="[A-Za-z0-9]{8,20}" title="must be at least 8 characters"  required=""/><br/>
			Create Password<br/><input class="textbox" type="password" pattern="[A-Za-z0-9]{8,20}" title="must be at least 8 characters" name="password" required=""/><br/>
			Name<br/>
			<input name="firstName" placeholder= "First" type="text" title="Enter your first name"  required=""/>
			<input name="lastName" placeholder= "Last" type="text" title="Enter your last name"  required=""/><br/>
			Email Address<br/><input name="emailAdd" class="textbox" type="email" required=""/><br/>
			<input class="submit" type="submit" value="Create Account"/><br/>
			Already have an account? <a href="../index.php">Sign in</a>
		</form>
	</body>
</html>
