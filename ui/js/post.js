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
