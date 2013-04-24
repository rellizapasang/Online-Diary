<?php
	session_start();
	
	require_once("connect.php");
	//fetch data from post
	
	if(isset($_POST['textButton'])){
		$post_content=htmlspecialchars($_POST['post_box']);
		$username=htmlspecialchars($_SESSION['username']);
		$type = 'text';
	}
	$insertQuery = "insert into post(username,post_content,date_posted,type) values(\"{$username}\",\"{$post_content}\",sysdate(), \"{$type}\")";
	$result=mysql_query($insertQuery,$conn);
	mysql_close($conn);

	header("Location:{$_SERVER['HTTP_REFERER']}");
?>
