<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>
<html>
	<head>
		<title>My Diary</title>
		<meta charset="utf-8"/>
	</head>

	<body>
		<?php echo "{$_SESSION['username']}'s Diary"; ?>
		<a href="profile.php">My Profile</a>
		<!--POST-->	
	</body>
</html>
