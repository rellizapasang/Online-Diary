<?php
	session_start();
	//condition that checks if the session has already been set
	if(isset($_SESSION['username'])){
		header("Location:ui/home.php");
	}
?>
<!DOCTYPE html>

<html>

	<head>
		<title>Login</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="ui/css/index.css" />
		<link rel="shortcut icon" href="ui/site_images/icon.ico"/>
	</head>

	<body>
		<div id="centercontainer">
			<div id="centerbox">
					<div id="logincontainer">
						<div id="logincontents">
							<div id="indexwelcome">	
								<?php  
									if(isset($_GET['invalidlogin'])){
											echo "<p style='margin-top:-20px;font-size:14px; color:red'>Username and Password do not match!</p>";
									}
									else echo 'Unlock Your Diary!! :)';
								?>
							</div>
								<form method="POST" action="back/do_login.php"><br/><br/>
									<div id="usernameholder"><input type="text" name="username" title="Enter username" required="" placeHolder="Username" /><br/><br/></div>
									<div id="passwordholder"><input placeHolder="Password" type="password" pattern="[A-Za-z0-9]{8,20}" title="must be at least 8 characters" name="password" required=""/><br/><br/></div>
									<div id="loginbuttonholder"><input id="chepar" type="image" name="loginButton" class="submit" alt="submit" src="ui/site_images/login.png"/></div>
								</form>
								
									Need an account?<br/>
									<style>
										a{
											text-decoration:none;
										}
									</style>
								<div id="signupbuttonholder">	
									<a href="ui/signUp.php"><img name="signUpButton" alt="" src="ui/site_images/signUp.png"/></a>
								</div>
						</div>
					</div>
			</div>
		</div>
	</body>
</html>
