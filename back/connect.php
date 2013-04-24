<!--CONNECTING TO THE DATABASE-->
<?php			
			$conn=mysql_connect('localhost','root','');
			if(!$conn) die("cannot connect to the db server: ".mysql_error());

			$db=mysql_select_db("diary",$conn);
			if(!$db) die("cannot select to the db: ".mysql_error()); 
?>
