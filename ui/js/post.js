function postQuote(){
	var f = '<form method = "POST" action = "../back/do_post.php">';
	var formBody = '<textarea rows=6 cols=80 name="quote" placeHolder="insert quote " required=""></textarea><br/>Author<input name="author" type=text/>';
	var submitB	= '<input class="post" type="submit" name = "quoteButton" value = "Quote it!"/><br/>';
	var fe = '</form>';
 
	document.getElementById("postArea").innerHTML = f+formBody+submitB+fe;
}

 
function postLink(){
	
	var f = '<form method = "POST" action = "../back/do_post.php">';
	var formBody = '<textarea rows=6 cols=80 name="postLink" placeHolder="Link" required=""></textarea><br/>'; 
	var submitB	= '<input class="post" type="submit" name = "linkButton" value = "Share it!"/><br/>';
	var fe = '</form>';
 
	document.getElementById("postArea").innerHTML = f+formBody+submitB+fe;
}

function postImage(){
	
	var f = '<form method = "POST" action ="../back/do_post.php" enctype="multipart/form-data">';
	var formBody = '<input type="file" name="picture"  required/>';
	var submitB = '<input  class="post" type="submit" name="photoButton" value="UPLOAD" /><br/>';
	var fe = '</form>';
	
	document.getElementById("postArea").innerHTML = f+formBody+submitB+fe;

}

function deletePostAlert(){
	var a = confirm("Are you sure you want to delete this post?");
		if(a==true){
			alert("Post deleted");
			return true;
		}
		else return false;
}

function deleteCommentAlert(){
	var a = confirm("Are you sure you want to delete this comment?");
		if(a==true){
			alert("Comment deleted");
			return true;
		}
		else return false;
}
