<?php
	session_start();
	require_once("connect.php");
	
	//fetch data from post
	
	$comment_id=htmlspecialchars($_POST['comment_id']);
	$post_id=htmlspecialchars($_POST['post_id']);
	$deleteQuery = "delete from comment where comment_id={$comment_id}";
	$result=mysql_query($deleteQuery,$conn);
	$retrieveComment = "select * from comment where post_id=".$post_id." order by date ASC";
		$result2=mysql_query($retrieveComment,$conn);
		echo '<script type="text/javascript" src="js/retrieve.js"></script>';
		while($comment_row=mysql_fetch_array($result2)){
			//if a comment is not the user's comment and the status is hidden, do not print anything.
			if(($comment_row['username']!=$_SESSION['username'])&&($comment_row['status']=='hidden')){
			}
			//else if a comment is not the user's comment and the status is unhidden, print comment.
			else if(($comment_row['username']!=$_SESSION['username'])&&($comment_row['status']=='unhidden')){
				$getPicQuery = 'select profile_pic from user where username="'.$_SESSION['username'].'"';
				$pic=mysql_query($getPicQuery,$conn);
				$pic=mysql_fetch_array($pic);
				echo '<div class="comment_box">';
					echo '<div class="picBox"><img class="profile_pic" alt="" src="profile_pics/'.$pic['profile_pic'].'" height="50" width=50/></div>';
						echo '<img class="tail" height=39 width=40 src="site_images/comment.png" alt=""/>';
						echo '<div class="comment"><div class="comment_username">'.$comment_row['username'].'</div>';
						echo '<div class="content">'.$comment_row['comment_content'].'</div></div>';
				echo '</div>';
			}
			//else if a comment is from the user
			else if($comment_row['username']==$_SESSION['username']){
				$getPicQuery = 'select profile_pic from user where username="'.$_SESSION['username'].'"';
				$pic=mysql_query($getPicQuery,$conn);
				$pic=mysql_fetch_array($pic);
				echo '<div class="comment_box">';
					echo '<div class="picBox"><img class="profile_pic" alt="" src="profile_pics/'.$pic['profile_pic'].'" height="50" width=50/></div>';
						echo '<img class="tail" height=39 width=40 src="site_images/comment.png" alt=""/>';
						echo '<div class="comment"><div class="comment_username">'.$comment_row['username'].'</div>';
						echo '<div class="content"><p style="margin:5px;" align="justify">'.$comment_row['comment_content'].'</p></div>';
						echo '<div id="comment_settings">';
						//hides comment
						if($comment_row['status']=='unhidden'){
							echo "<form class='hide_comment_form' method='POST' action='../back/do_hide_comment.php'>";
							echo "<input type='hidden' name='post_id' value=".$comment_row['post_id']."></input>";
							echo "<input class='hide_button' type='image' alt='submit' value='Hide' title='Hide this comment' src='site_images/hide.png' height=20 width=20/>";
							echo "<input type='hidden' name='comment_id' value=".$comment_row['comment_id']."></input></form>";
							$message ='';
						}
						//unhides comment
						else if ($comment_row['status']=="hidden"){
							$message ="<p align='left' style='left:150px;top:-15px;position:relative;color: grey;font-size:13px;font-family:textfont;'>-This comment is hidden from other users-</p>";
							echo "<form class='unhide_comment_form' method='POST' action='../back/do_unhide_comment.php'>";
							echo "<input type='hidden' name='post_id' value=".$comment_row['post_id']."></input>";
							echo "<input class='unhide_button' type='image' alt='submit' value='Unhide' title='This comment is hidden. Click to unhide this comment.' src='site_images/view.png' height=20 width=20/>";
							echo "<input type='hidden' name='comment_id' value=".$comment_row['comment_id']."></input></form>";
						}
						//deletes comment
						echo "<form class='delete_comment_form' method='POST' onSubmit='return deleteCommentAlert()' action='../back/do_delete_comment.php'>";
						echo "<input class='remove_button' title='Delete this comment.' type='image' alt='submit' value='Remove' src='site_images/delete.png' height=20 width=20/>";
						echo "<input type='hidden' name='post_id' value=".$comment_row['post_id']."></input>";
						echo "<input type='hidden' name='comment_id' value=".$comment_row['comment_id']."></input></form>";
						echo "</div><div class='date'><p style='margin-left:10px;color: rgba(100, 100, 255, .9); font-family: textfont;' align='left'>".$comment_row['date'].$message."</div></div></div>";
			}
			else echo "<div class='date'>".$comment_row['date']."</div>";
		}
	mysql_close($conn);
?>