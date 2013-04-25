<?php
	session_start();
	
	require_once("connect.php");
	//fetch data from post
	
	if(isset($_POST['textButton'])){
		$post_content=htmlspecialchars($_POST['post_box']);
		$username=htmlspecialchars($_SESSION['username']);
		$type = 'text';
		header("Location:{$_SERVER['HTTP_REFERER']}");
	}
	else if(isset($_POST['quoteButton'])){
		$post_author =htmlspecialchars($_POST['author']);
		$post_content=htmlspecialchars('"'.$_POST['quote'].'"-'.$post_author);
		$username=htmlspecialchars($_SESSION['username']);
		$type = 'quote';
		header("Location:../ui/home.php?insertedQuote");
	}
	else if(isset($_POST['linkButton'])){
		$post_content=htmlspecialchars($_POST['postLink']);
		$username=htmlspecialchars($_SESSION['username']);
		$type = 'link';
		header("Location:../ui/home.php?insertedLink");
	}
	$insertQuery = "insert into post(username,date_posted,post_content,post_type) values(\"{$username}\",date(now()),\"{$post_content}\",\"{$type}\")";
	mysql_query($insertQuery,$conn);
	mysql_close($conn);
	
?>
