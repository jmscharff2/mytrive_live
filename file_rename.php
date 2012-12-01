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
	$file_id = $_GET['file_id'];
	
	$qry = "SELECT * FROM files WHERE file_id = '$file_id'";
	$result = mysql_query($qry);
	
	if($result)
	{
		if(mysql_num_rows($result) > 0)
		{
			while ($x < mysql_num_rows($result))
			{
				$member = mysql_fetch_assoc($result);
				$x++;
			}
		}			
	}
	
	
?>

	<div id="registration-mascot">
		<img src = "images/mascot.png" height="100%">

	</div>
	<center>
	<div id="registration-fields">
		<RF1>Rename your file: <?php echo $member['file_name']; ?><br></RF1>
		<RF2>Please type the new file name<br>It is not recommended to change the file extension!</RF2><br><br>

	<form action="file_rename_script.php" method="POST" >
	
	<input type="text" name = "old_file_name" value = "<?php echo $member['file_name']; ?>" hidden = "true"/><br>
	<input type="text" name = "new_file_name" onkeypress="return submitenter(this,event)" placeholder="New File Name"/>
	<input type="text" name = "file_id" hidden="true" value = "<?php echo $file_id; ?>"/><br>
	<input type=submit value="Rename" hidden="true"/>
	</form>

	</center>

	</div>
			
		</div>
	<?php include 'includes/footer.html'?>
	
	</div>

	</body>

	
</HTML>