<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Manage Profile</title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php include("nav.html");?>
		<?php 
			require_once("../back/connect.php");
			$username=$_SESSION['username'];
			$pstmt2 = "select * from user where username = \"{$username}\"";
			$result = mysql_query($pstmt2,$conn);
			while($row=mysql_fetch_array($result)){
				$first_name = $row['first_name'];
				$last_name = $row['last_name'];
				$home_add = $row['home_add'];
				echo '<form method="POST" action="../back/do_edit_profile_info.php">';
				echo 'First Name <input name="firstName" placeholder= "First" type="text" title="Enter your first name"  value="'.$first_name.'" required=""/><br/>';
				echo 'Last Name <input name="lastName" placeholder= "Last" type="text" title="Enter your last name"  value="'.$last_name.'" required=""/><br/>';
				echo 'Gender <select name="gender">
							<option value="male">Male</option>
							<option value="female">Female</option>
							</select><br/>';
				echo 'Birthday <select name="birth_month">
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
							   
							   <select name="birth_day">';
								for($i=1;$i<=31;$i++)
								{
									echo "<option value=$i>$i</option>";
								}
				echo	   	    '</select>';			
				
				echo 			'<select name="birth_year">';
									for($i=2012;$i>=1900;$i--)
									{
										echo "<option value=$i>$i</option>";
									}
				echo 		   '</select><br/>';
				echo 'Home Address <input name="homeAdd" class="textbox" type="text" value="'.$home_add.'" required=""/><br/>';
				echo '<input class="submit" type="submit" value="Save"/>'; //save
				echo '</form>';
			}
			mysql_close($conn);
		?>
		<br/><a href="javascript:history.back()">Back</a>
	</body>
</html>
