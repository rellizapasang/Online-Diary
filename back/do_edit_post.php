<?php
	session_start();
	if(!isset($_SESSION['username'])){//condition that checks if the user is logged in
		header("Location:../index.php");
	}
	require_once("connect.php");//open db connection
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
	
	if($img!=""){//condition that checks if there is an image file uploaded or if it was replaced
		$extension = end(explode(".", $_FILES["picture"]["name"]));		//get the image file extension
		$ran=time().rand();												//generate a random number for a unique image file name
		$ran2 = $ran.".";												
		$target = "../ui/post_images/";									//image_file_path
		$target = $target.$ran2.$extension;								//image_file_path/file_name
		move_uploaded_file($_FILES["picture"]["tmp_name"],$target);		//move the temp file to the image_file_path with the random name 
		$img=$ran2.$extension;											//initialize $img value
		$editQuery = "update post set post_title=\"{$title}\",text_post=\"{$text}\",image_caption=\"{$caption}\",image_post=\"{$img}\",quote_author=\"{$author}\",quote_post=\"{$quote}\",link_name=\"{$link_name}\",link_source=\"{$link_source}\",post_privacy=\"{$postPrivacy}\" where post_id={$post_id}";
	}
	else {
		$editQuery = "update post set post_title=\"{$title}\",text_post=\"{$text}\",image_caption=\"{$caption}\",quote_author=\"{$author}\",quote_post=\"{$quote}\",link_name=\"{$link_name}\",link_source=\"{$link_source}\",post_privacy=\"{$postPrivacy}\" where post_id={$post_id}";
	}	
	
	mysql_query($editQuery,$conn);		//execute query
	mysql_close($conn);					//close connection
?>
