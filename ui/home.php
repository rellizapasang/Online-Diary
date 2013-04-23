<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>My Diary</title>
		<meta charset="utf-8"/>
	</head>

	<body>
<!--ADD-->
		-Date today?
		-What happen to you today?
         insert txt, images, quotes or links
		-Publish as private or public
		-view previous posts
		-peek
		<a href="../back/do_logout.php">Logout</a>
	</body>
</html>
