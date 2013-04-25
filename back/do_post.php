<?php
	session_start();
	
	require_once("connect.php");
	//fetch data from post
	
	if(isset($_POST['textButton'])){
		$post_content=htmlspecialchars($_POST['post_box']);
		$username=htmlspecialchars($_SESSION['username']);
		$type = 'text';
	}
	else if(isset($_POST['quoteButton'])){
		$post_author =htmlspecialchars($_POST['author']);
		$post_content=htmlspecialchars('"'.$_POST['quote'].'"-'.$post_author);
		$username=htmlspecialchars($_SESSION['username']);
		$type = 'quote';
	}
	$insertQuery = "insert into post(username,post_content,date_posted,type) values(\"{$username}\",\"{$post_content}\",sysdate(), \"{$type}\")";
	$result=mysql_query($insertQuery,$conn);
	mysql_close($conn);

	header("Location:{$_SERVER['HTTP_REFERER']}");
?>
