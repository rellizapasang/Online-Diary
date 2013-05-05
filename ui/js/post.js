function deletePostAlert(){//function that confirms the deletion of a post upon submission
	var a = confirm("Are you sure you want to delete this post?");
		if(a==true){
			alert("Post deleted");
			return true;
		}
		else return false;
}

function deleteCommentAlert(){//function that confirms the deletion of a comment upon submission
	var a = confirm("Are you sure you want to delete this comment?");
		if(a==true){
			alert("Comment deleted");
			return true;
		}
		else return false;
}

function validateForm()//function that checks the values of the post form
{
	var text=document.forms["postForm"]["text"].value;						//get the value of the text in the textarea
	var image=document.forms["postForm"]["picture"].value;					//get the value of the uploaded image
	var quote=document.forms["postForm"]["quote"].value;					//get the value of the quote in the textarea
	var link=document.forms["postForm"]["link_source"].value;				//get the value of the link in the textbox 
	
	//condition that checks if the form is null or empty
	if ((text==null || text.trim()=="") && (image==null || image.trim()=="") && (quote==null || quote.trim()=="") && (link==null || link.trim()=="")){
  		alert("No input found. Please fill the form correctly.");
  		return false;
  	}
	//condition that validates the uploaded image file extension
	else if(image!=""){
		var arr = image.split(".");
		var arr1 = image.split("\\");
		if (arr[1] == "gif" || arr[1] == "jpg" || arr[1] == "jpeg" || arr[1] == "png") return true;
		else{
			alert("Invalid image.Please upload a correct file.");
			return false;
		}
	}
}

function validateEditForm(){//function that checks the values of the edited post
	var text=document.forms["postForm"]["text"].value;						//get the value of the text in the textarea
	var image=document.forms["postForm"]["picture"].value;					//get the value of the uploaded image
	var currentImage=document.forms["postForm"]["currentImage"]["alt"];		//get the alt value of the currentImage stored in db
	var quote=document.forms["postForm"]["quote"].value;					//get the value of the quote in the textarea
	var link=document.forms["postForm"]["link_source"].value;				//get the value of the link in the textbox 
	
	//condition that checks if the form is null or empty
	if ((text==null || text.trim()=="") && (image==null || image.trim()=="") && (quote==null || quote.trim()=="") && (link==null || link.trim()=="") && currentImage==""){
  		alert("No input found. Please fill the form correctly.");
  		return false;
  	}
	//condition that validates the uploaded image file extension
	else if(image!=""){
		var arr = image.split(".");
		var arr1 = image.split("\\");
		if (arr[1] == "gif" || arr[1] == "jpg" || arr[1] == "jpeg" || arr[1] == "png") return true;
		else{
			alert("Invalid image.Please upload a correct file.");
			return false;
		}
	}
}

function validateImage(){//function that checks the values of the edited post
	var image=document.forms["postUserForm"]["picture"].value;					//get the value of the uploaded image
	//condition that validates the uploaded image file extension
	if(image!=""){
		var arr = image.split(".");
		var arr1 = image.split("\\");
		if (arr[1] == "gif" || arr[1] == "jpg" || arr[1] == "jpeg" || arr[1] == "png") return true;
		else{
			alert("Invalid image.Please upload a correct file.");
			return false;
		}
	}
}