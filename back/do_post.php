<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	require_once("connect.php");
	//fetch data from post
	$username=$_SESSION['username'];
	$title = htmlspecialchars($_POST['title']);
	$text = htmlspecialchars($_POST['text']);
	$img = htmlspecialchars($_POST['picture']);
	$caption = htmlspecialchars($_POST['caption']);
	$quote = htmlspecialchars($_POST['quote']);
	$link_name = htmlspecialchars($_POST['link_name']);
	$link_source = htmlspecialchars($_POST['link_source']);
	$postPrivacy=htmlspecialchars($_POST['privacy']);
	
	$insertQuery = "insert into post(username,date_posted,post_title,text_post,image_caption,image_post,quote_post,link_name,link_source,post_privacy) values(\"{$username}\",sysdate(),\"{$title}\",\"{$text}\",\"{$caption}\",\"{$img}\",\"{$quote}\",\"{$link_name}\",\"{$link_source}\",\"{$postPrivacy}\")";
	header("Location:{$_SERVER['HTTP_REFERER']}");
	mysql_query($insertQuery,$conn);
	mysql_close($conn);
?>
