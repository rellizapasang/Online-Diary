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
	$img = htmlspecialchars($_FILES['picture']['name']);
	$caption = htmlspecialchars($_POST['caption']);
	$quote = htmlspecialchars($_POST['quote']);
	$author = htmlspecialchars($_POST['author']);
	$link_name = htmlspecialchars($_POST['link_name']);
	$link_source = htmlspecialchars($_POST['link_source']);
	$postPrivacy=htmlspecialchars($_POST['privacy']);
	
	if($img!=""){
		move_uploaded_file($_FILES['picture']['tmp_name'],'../ui/post_images/'.$_FILES['picture']['name']);
	}
	$insertQuery = "insert into post(username,date_posted,post_title,text_post,image_caption,image_post,quote_author,quote_post,link_name,link_source,post_privacy) values(\"{$username}\",sysdate(),\"{$title}\",\"{$text}\",\"{$caption}\",\"{$img}\",\"{$author}\",\"{$quote}\",\"{$link_name}\",\"{$link_source}\",\"{$postPrivacy}\")";
	echo $insertQuery;	
	header("Location:{$_SERVER['HTTP_REFERER']}");
	mysql_query($insertQuery,$conn);
	mysql_close($conn);
?>
