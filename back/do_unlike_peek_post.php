<?php
		//do_like_post.php
		session_start();
		require_once("connect.php");
		if(!isset($_SESSION['username'])){
			header("Location:../index.php");
		}
		$username=$_SESSION['username'];
		$username2=htmlspecialchars($_POST['userName2']);
		$postId=htmlspecialchars($_POST['postId']);
		
		//queries
		$deleteQuery = "delete from like_table where post_id='{$postId}' and username='{$username}'";
		$updatePostStatus = "update post set status='unlike' where username=\"{$username2}\" and post_id='{$postId}'";
		
		
		//submit queries
		mysql_query($deleteQuery,$conn);
		mysql_query($updatePostStatus,$conn);
		header("Location:../ui/peek_post.php?uName={$username2}");
?>
