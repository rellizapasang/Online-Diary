function postQuote(){
	var f = '<form method = "POST" action = "../back/do_post.php">';
	var formBody = '<textarea rows=6 cols=80 name="quote" placeHolder="insert quote " required=""></textarea><br/>Author<input name="author" type=text/>';
	var submitB	= '<input class="post" type="submit" name = "quoteButton" value = "Quote it!"/><br/>';
	var fe = '</form>';
 
	document.getElementById("postArea").innerHTML = f+formBody+submitB+fe;
}