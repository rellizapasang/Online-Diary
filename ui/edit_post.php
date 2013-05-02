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
		<script type="text/javascript" src="js/post.js"></script>
	</head>

	<body>
	<?php 
			include("nav.html");
			require_once("../back/connect.php");
			$post_id=$_POST['post_id'];
/***
*	RETRIEVE POST
*/				
			$retrieveQuery = "select * from post where post_id=$post_id";				
			$result=mysql_query($retrieveQuery,$conn);
			$row=mysql_fetch_array($result);
			$title=$row['post_title'];
			$text=$row['text_post'];
			$author=$row['quote_author']; 
			$quote=$row['quote_post'];
			$link_name=$row['link_name'];
			$link_source=$row['link_source'];
			$image_caption=$row['image_caption'];
			$image_post=$row['image_post'];	
			$post_privacy=$row['post_privacy'];
	?>

	<!--EDIT POST-->
		<form method = "POST" name="postForm" onSubmit="return validateForm()" action = "../back/do_edit_post.php" enctype="multipart/form-data">
			Start Editing!<br/>	
			<input type="hidden" name="post_id" value="<?php echo $post_id; ?>"/>
			Title:<input type="text" size=100 name="title" value="<?php echo $title;?>"/><br/>
			Text:<br/><textarea rows=3 cols=77 name="text"><?php echo $text;?></textarea><br/>
			_______________________________________________________________________________<br/><br/>  
			<?php
				
				if(strlen(trim($image_post))!==0){			
					echo 'Replace Image:<input type="file" name="picture"/><br/>';
					echo "<div id='currentImage'><img alt='' src='post_images/".$image_post."' width='150' height='150'></div>";
				}
				else{
					echo 'Add Image:<input type="file" name="picture"/>';
				} 
				echo '<br/>Caption:<input name="caption" type="text" value="'.$image_caption.'"/><br/>'
			?>_______________________________________________________________________________<br/><br/>  
			Quote:<br/><textarea rows=2 cols=77 name="quote"><?php echo $quote?></textarea><br/>
			Author:<input name="author" type="text" value="<?php echo $author;?>" /><br/>
			_______________________________________________________________________________<br/><br/>  
			Link<br/>
			Text to display:<input size=50 name="link_name" type="text" value="<?php echo $link_name;?>"/><br/>
			Web address:<input size=50 name="link_source" type="text" value="<?php echo $link_source;?>"/><br/>
			_______________________________________________________________________________<br/><br/> 
			Privacy:<!--Select Privacy of the post-->
					
			<?php
				if($post_privacy==="private") echo '<select name="privacy"><option value="private" selected="selected">Private</option><option value="public">Public</option></select>';
				else echo '<select name="privacy"><option value="private">Private</option><option value="public" selected="selected">Public</option></select>';
			?>
			<br/><input class="post" type="submit" name = "textButton" value = "SAVE"/> 			
		</form>
		</div>
	</body>
</html>
