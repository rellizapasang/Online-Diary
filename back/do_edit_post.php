<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	require_once("connect.php");
	//fetch data from post
	$post_id=$_POST['post_id'];
	$title = htmlspecialchars($_POST['title']);
	$text = htmlspecialchars($_POST['text']);
	$img = htmlspecialchars($_FILES['picture']['name']);
	$caption = htmlspecialchars($_POST['caption']);
	$quote = htmlspecialchars($_POST['quote']);
	$author = htmlspecialchars($_POST['author']);
	$link_name = htmlspecialchars($_POST['link_name']);
	$link_source = htmlspecialchars($_POST['link_source']);
	$postPrivacy=htmlspecialchars($_POST['privacy']);
	//if the image is not replaced
	if($img!==""){
		move_uploaded_file($_FILES['picture']['tmp_name'],'../ui/post_images/'.$_FILES['picture']['name']);
		$editQuery = "update post set post_title=\"{$title}\",text_post=\"{$text}\",image_caption=\"{$caption}\",image_post=\"{$img}\",quote_author=\"{$author}\",quote_post=\"{$quote}\",link_name=\"{$link_name}\",link_source=\"{$link_source}\",post_privacy=\"{$postPrivacy}\" where post_id={$post_id}";
	}
	else {
		$editQuery = "update post set post_title=\"{$title}\",text_post=\"{$text}\",image_caption=\"{$caption}\",quote_author=\"{$author}\",quote_post=\"{$quote}\",link_name=\"{$link_name}\",link_source=\"{$link_source}\",post_privacy=\"{$postPrivacy}\" where post_id={$post_id}";
	}	
	header("Location:../ui/home.php");
	mysql_query($editQuery,$conn);
	mysql_close($conn);
?>
