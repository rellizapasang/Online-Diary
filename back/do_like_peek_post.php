<?php
	//do_like_peek_post.php
	session_start();
	require_once("connect.php");
	if(!isset($_SESSION['username'])){
		header("Location:../index.php");
	}
	$username=$_SESSION['username'];
	$username2=htmlspecialchars($_POST['userName2']);
	$post_id=htmlspecialchars($_POST['postId']);
	
	//queries
	$insertQuery = "insert into like_table (post_id,username) values('{$post_id}',\"{$username}\")";
	
	//submit queries
	mysql_query($insertQuery,$conn);
	$checkLikeTable = "select * from like_table where username='{$username}' and post_id='{$post_id}'";
		$result2=mysql_query($checkLikeTable);
		echo '<script type="text/javascript" src="js/retrieve.js"></script>';
		if(mysql_num_rows($result2)){
			echo '<form method="POST" id="unlikeForm" action="../back/do_unlike_post.php">';
			echo '<input name="userName" type="hidden" value="'.$username.'"/><br/>';
			echo '<input name="postId" type="hidden" value="'.$post_id.'">';
			echo "<div id='switch1'><input class='likeForm' title='Dislike this post' type='image' alt='submit' src='site_images/unlike_icon.png' height=40 width=40 value='Unlike'></input></div>";
			echo "</form>";
		}
		else{
			//echo '<form method="POST" action="../back/do_like_post.php">';
			echo '<form method="POST" id="likeForm" action="../back/do_like_post.php">';
			echo '<input name="userName" type="hidden" value="'.$username.'"/><br/>';
			echo '<input name="postId" type="hidden" value="'.$post_id.'">';
			echo "<div id='switch2'><input class='likeForm' title='Like this post' type='image' alt='submit' src='site_images/like_icon.png' height=40 width=40 value='Like'></input></div>";
			echo "</form>";
		}
		//Checks and prints the liker(s) of the post
		$checkLikers = "select * from like_table where post_id='{$post_id}'";
		$result3=mysql_query($checkLikers);
		$result4=mysql_query($checkLikers);
							
		//Counts likes
		$likeCounter = 0;
		while($row2=mysql_fetch_array($result3)){
			if($row2['post_id']==$post_id){
				$likeCounter++; //counts the likes in the post
			}
		}
		echo "<div id='numOfLikes'>";
		if($likeCounter==1){
			echo $likeCounter." Like</br>";
		}
		else if($likeCounter>=2){
			echo $likeCounter." Likes</br>";
		}
		else{
			echo " ";
		}
		echo "</div>";
	mysql_close($conn);
?>
