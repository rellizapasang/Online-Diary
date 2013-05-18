<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="css/index.css" />
		<link rel="stylesheet" type="text/css" href="css/signUp.css" />
		<link rel="shortcut icon" href="site_images/icon.ico"/>
	</head>
	<body>
		<div id="centercontainer">
			<div id="centerbox">
				<?php  
					if(isset($_GET['invalidUsername'])|| isset($_GET['invalidUsernameAndPassword'])){
						echo "<div style='font-size:10px; color:red; left:50px;position:relative;top:43px;margin-top:10px;'>Username already taken.</div>";
						echo "<style>
						#usernameBox{
						position: relative;
						top:48px;
						left:113px;
						}
						#passwordBox{
						position: relative;
						top:95px;
						left:113px;
					}
					#confirmPwdBox{
							position:relative;
							top:115px;
							left:110px;
						}
						#emailAddBox{
							position:relative;
							top:138px;
							left:110px;
						}
						#fullName{
							position: relative;
							top:160px;
							left:108px;
						}

						#gender select{
							background: transparent;
							width: 80px;
							padding: 5px;
							font-size: 12px;
							line-height: 1;
							border: 0;
							border-radius: 0;
							height: 25px;
						   -webkit-appearance: none;
						}
						#genderLabel{
							position: relative;
							top:183px;
							left:125px;
						}
						#gender{
							position: relative;
							top:160px;
							left:190px;
						   border-radius:5px;
						   width: 75px;
						   height: 20px;
						   overflow: hidden;
						   background: url(../site_images/down.jpg) no-repeat right #ddd;
						   border: 1px solid #ccc;
						}
						.birthday select{
						   background: transparent;
						   width: 80px;
						   padding: 5px;
						   font-size: 12px;
						   line-height: 1;
						   border: 0;
						   border-radius: 0;
						   height: 25px;
						   -webkit-appearance: none;
						}
						#bdayLabel{
							position:relative;
							top:190px;
							left:100px;
							font-size:11px;
						}
						.birthday {
						   border-radius:5px;
						   width: 75px;
						   height: 20px;
						   overflow: hidden;
						   background: url(../site_images/down.jpg) no-repeat right #ddd;
						   border: 1px solid #ccc;
						}

						.month{
							position:relative;
							top:170px;
							left:133px;
						}

						.day{
						   position:relative;
						   top:148px;
						   left:213px;
						   border-radius:5px;
						   width: 35px;
						   height: 20px;
						   overflow: hidden;
						   background: url(../site_images/down.jpg) no-repeat right #ddd;
						   border: 1px solid #ccc;
						}

						.year{
						   position:relative;
						   top:126px;
						   left:255px;
						   border-radius:5px;
						   width: 50px;
						   height: 20px;
						   overflow: hidden;
						   background: url(../site_images/down.jpg) no-repeat right #ddd;
						   border: 1px solid #ccc;
						}

						#createButton{
							position:relative;
							top:185px;
							left:135px;
						}

						#signIn{
							position:relative;
							top:185px;
							left:60px;
						} 	 	
						</style>";
					}
				?>
				<form id="signup_form" method="POST" action="../back/do_signup.php">
					<input id="usernameBox" size="23" placeHolder="Enter a unique username" class="textbox" type="text" name="username" pattern="[A-Za-z0-9]{8,20}" title="must be at least 8 characters"  required=""/><br/>
					<?php
						if(isset($_GET['invalidPassword']) || isset($_GET['invalidUsernameAndPassword'])){
							echo "<p style='font-size:10px; position:relative;top:43px;margin-left: 200px; margin-top:-40px; color:red'>Passwords did not match.</p>";
							
						}
					?>
					<input id="passwordBox" size="23" placeHolder="Create Password"class="textbox" type="password" pattern="[A-Za-z0-9]{8,20}" title="must be at least 8 characters" name="password" required=""/><br/>
					<input id="confirmPwdBox" size="23" placeHolder="Confirm password" class="textbox" type="password" title="must be at least 8 characters" name="confirmPassword" required=""/><br/>
					<input id="emailAddBox" size="23" placeHolder="Email Address" name="emailAdd" class="textbox" type="email" required=""/>
					<div id="fullName">
						<input size="10" name="firstName" placeholder= "First Name" type="text" title="Enter your first name"  required=""/>
						<input size="10" name="lastName" placeholder= "Last Name" type="text" title="Enter your last name"  required=""/>
					</div>
					<p id="genderLabel">Gender</p>
					<div id="gender">
						<select name="gender">
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select><br/>	
					</div>
					<p id="bdayLabel">Bday</p>
					<div class="birthday month">
						<select id="birthday1" name="birth_month">
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
					</div>
					<div class="birthday day">			   
						<select name="birth_day">
							<?php
								for($i=1;$i<=31;$i++)
								{
									echo "<option value=$i>$i</option>";
								}
							?>
						</select>
					</div>
					<div class="birthday year">
						<select name="birth_year">
							<?php 
								for($i=2012;$i>=1900;$i--)
								{
									echo "<option value=$i>$i</option>";
								}
							?>
						</select>
					</div>
					<!--input id="createButton" type="image"  alt="submit" src="site_images/createButton.png"/-->
					<input id="createButton" style="font-family:titlefont; padding:5px;" type="submit" value="Create Account"/>
					<div id="signIn" >Already have an account? <a href="../index.php" style="font-family:titlefont">Sign in</a></div>
				</form>
			</div>
		</div>
	</body>
</html>
