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

function validateForm()
{
	var text=document.forms["postForm"]["text"].value;
	var image=document.forms["postForm"]["picture"].value;
	var quote=document.forms["postForm"]["quote"].value;
	var link=document.forms["postForm"]["link_source"].value;
	if ((text==null || text.trim()=="") && (image==null || image.trim()=="") && (quote==null || quote.trim()=="") && (link==null || link.trim()=="")){
  		alert("No input! Please fill the form correctly.");
  		return false;
  	}
}
