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
		<link rel="stylesheet" type="text/css" href="css/edit_post.css"/>
	</head>

	<body>
	<?php 
	if(isset($_GET['postId'])){
		$post_id = $_GET['postId'];
	}
	?>
	<?php 
			require_once("../back/connect.php");
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
	<div id="edit_post">
		<form id="edit_post_form" method = "POST" name="postForm" onSubmit="return validateEditForm()" action = "../back/do_edit_post.php" enctype="multipart/form-data">
			<p>Start Editing!</p><br/>
			<input type="hidden" name="post_id" value="<?php echo $post_id; ?>"/>
			<p>Title</p>  <input required="" maxlength=26 type="text" size=42 name="title" value="<?php echo $title;?>"/><br/><br/>
			<p>_______________________________________________________</p><br/>
			<p>Text</p>
			<div id="text_box">
				<textarea  placeHolder="Dear diary.." border="0px" rows=3 cols=31 name="text"><?php echo $text;?></textarea><br/><br/>
			</div>
			<p>_______________________________________________________</p><br/> 
			<div id="image_box">
			<?php
				if($image_post!==""){			
					echo '<p>Replace Image</p><input style="background-color:white; color:grey; width:360px" id="upload" type="file" name="picture"/><br/>';
					echo "<img style='border-radius:10px;'name='currentImage' alt='taken' src='post_images/".$image_post."' width='150' height='150'/>";
				}
				else{
					echo '<p>Add Image</p><input style="background-color:white; color:grey; width:360px" id="upload" type="file" name="picture"/>';
					echo "<img name='currentImage' alt='' src='' width='0' height='0'/>";
				}
				echo '<br/><p>Caption</p><input placeHolder="Add image caption.." name="caption" type="text" size=42 value="'.$image_caption.'"/><br/>'
			?>
			</div>
			<p>_______________________________________________________</p><br/>
			<div id="quote_box">
				<p>Quote</p><br/><textarea placeHolder="Add quote here.."rows=2 cols=31 name="quote"><?php echo $quote?></textarea><br/>
				<p>Author</p><input name="author" placeHolder="Quote author.." size=42 type="text" value="<?php echo $author;?>" /><br/>
			</div>
			<p>_______________________________________________________</p><br/>  
			<div id="link_box">
				<p>Link</p><br/>
				<p>Text to display</p><input placeHolder="Enter text.." size=42 name="link_name" type="text" value="<?php echo $link_name;?>"/><br/><br/>
				<p>Web address</p><input size=42 placeHolder="Enter address.." name="link_source" type="text" value="<?php echo $link_source;?>"/><br/>
			</div>
			<p>_______________________________________________________</p><br/>
			<p>Privacy</p><!--Select Privacy of the post-->
					
			<?php
				if($post_privacy==="private") echo '<select style="border-radius:5px; font-family:titlefont; font-size:20px; padding:5px;" name="privacy"><option value="private" selected="selected">Private</option><option value="public">Public</option></select>';
				else echo '<select style="border-radius:5px; font-family:titlefont; font-size:20px; padding:5px;" name="privacy"><option value="private">Private</option><option value="public" selected="selected">Public</option></select>';
			?>
			<br/><br/><input style="border-radius:5px; font-family:titlefont; font-size:20px; padding:5px;" class="post" type="submit" name = "textButton" value = "SAVE"/>
		</form>
		</div>
	</div>
	<script>
	$(function () {
	$('#edit_post_form').submit(function () {
		var action = $(this).attr('action');
	
		$.ajax({
			type: "POST",
			url: action,
			data: $(this).serialize(),
			success: function(response)
			{
				alert('Changes Saved!');
			}
		});
		return false;
	});
});
	</script>
	</body>
</html>
