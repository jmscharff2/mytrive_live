<?php
	session_start();
?>

<HTML>
<?php
	//session_start();


	if(isset($_SESSION['username']) && $_SESSION['username'] != '')
	{
		include 'includes/loggedin.html';
	}
	elseif(!(isset($_SESSION['username'])))
	{
		include 'includes/loggedout.html';
		echo '<meta http-equiv="Refresh" content="1; URL=http://www.mytrive.com">';
	}

?>

	<BODY>
		  <div class="scroll"></div>
		  <?php include 'includes/sidenav.html';?>
       		
		
	
		<div id="main-content-wrapper">




<?php
	
	require_once('config.php');

	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link)
	{
		die('Failed to connect to server: '. mysql_error());
	}
	
	$db = mysql_select_db(DB_DATABASE);
	if(!$db)
	{
		die("Unable to select database");
	}
	
	$username = $_SESSION['username'];
	$file_name = $_GET['file'];
	
	//
	//$qry = "DELETE FROM files WHERE file_name = '$delete_file' AND owner_id = '$username' LIMIT 1";
	//
	//
	//$qry = "UPDATE files SET share_with = '$share_with_user' WHERE owner_id = '$username' AND file_name = '$file_name' LIMIT 1";
	//$result = mysql_query($qry);
	//
	//if($result)
	//{
	//	//echo "upload/".$username."/".$delete_file;
	//	$file_to_delete = "upload/$username/$delete_file";
	//	unlink($file_to_delete);
	//	header("location: files.php");
	//}
	//else
	//{
	//	header("location: files_error.php");
	//}
	//

?>
<div id="registration-mascot">
		<img src = "images/mascot.png" height="100%">

	</div>
<center>
	<div id="registration-fields">
		<RF1>Share Files with your Buddies<br></RF1>
		<RF2>Please enter your buddies mytrive username to share the file</RF2><br><br>
		

		<form action = "share_file_script.php" method = "POST">
		<input type="text" name="share_with_user" class="placeholder" placeholder="Buddies Username" onkeypress="return submitenter(this,event)"><br>
		<input type="text" name="file_name" value="<?php echo $file_name?>" hidden="true"><br>
		<input type="submit" value="Share" hidden = "true">
		</form>
		</center>
	</div>
	
	</div>
	
	</div>
	<?php include 'includes/footer.html'?>

	</BDOY>
</HTML>