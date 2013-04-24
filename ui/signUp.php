<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php  
			if(isset($_GET['invalidUsername'])|| isset($_GET['invalidUsernameAndPassword'])){
				echo "<p style='font-size:15px; color:red'>Username already taken.</p>";
			}
			else echo "Create an Account"; 
		?>
		<form method="POST" action="../back/do_signup.php">
			Username<br/><input class="textbox" type="text" name="username" pattern="[A-Za-z0-9]{8,20}" title="must be at least 8 characters"  required=""/><br/>
			<?php
				if(isset($_GET['invalidPassword']) || isset($_GET['invalidUsernameAndPassword'])){
					echo "<p style='font-size:15px; color:red'>Passwords did not match.</p>";
				}
			?>
			Create Password<br/>
			<input class="textbox" type="password" pattern="[A-Za-z0-9]{8,20}" title="must be at least 8 characters" name="password" required=""/><br/>
			Confirm Password<br/><input class="textbox" type="password" title="must be at least 8 characters" name="confirmPassword" required=""/><br/>
			Name<br/>
			<input name="firstName" placeholder= "First" type="text" title="Enter your first name"  required=""/>
			<input name="lastName" placeholder= "Last" type="text" title="Enter your last name"  required=""/><br/>
			Email Address<br/><input name="emailAdd" class="textbox" type="email" required=""/><br/><br/>
			Gender <select name="gender">
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select><br/><br/>
			Birthday <select name="birth_month">
								<option value="1">January</option>
								<option value="2">February</option>
								<option value="3">March</option>
								<option value="4">April</option>
								<option value="5">May</option>
								<option value="6">June</option>
								<option value="7">July</option>
								<option value="8">August</option>
								<option value="9">September</option>
								<option value="10">October</option>
								<option value="11">Novermber</option>
								<option value="12">December</option>
							   </select>
							   
				<select name="birth_day">
					<?php
						for($i=1;$i<=31;$i++)
						{
							echo "<option value=$i>$i</option>";
						}
					?>
				</select>			
				
				<select name="birth_year">
					<?php 
						for($i=2012;$i>=1900;$i--)
						{
							echo "<option value=$i>$i</option>";
						}
					?>
				</select><br/><br/>
			<input class="submit" type="submit" value="Create Account"/><br/>
			Already have an account? <a href="../index.php">Sign in</a>
		</form>
	</body>
</html>
