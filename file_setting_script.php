<?php

session_start();

function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}

//Include database connection details
require_once('config.php');

//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}


	//setup variables to update the database
	$username = $_SESSION['username'];		
	$file_name = $_POST['file_name'];
	$want_to_share = $_POST['want_to_share'];
	$file_id = $_POST['file_id'];
	
		
	if($want_to_share == 'on')
	{
		$sharing = 1;
	}
	else
	{
		$sharing = 0;
	}
		
	$qry2 = "SELECT * FROM files WHERE file_id = '$file_id'";
	$result2 = mysql_query($qry2);

      $x = 0;

      if($result2)
      {
	      if(mysql_num_rows($result2) > 0)
	       	{
    	       	echo "<table width='100$'>";
        		while ($x < mysql_num_rows($result2))
        		{
            		$member2 = mysql_fetch_assoc($result2);
            		
            		$origonal_file_name = $member2['file_name'];
            		$file_path = $member2['location']; 
            		$x++;
            	}
			}
		}
		
		
	$old_file_name = $file_path."/".$origional_file_name;
	echo $old_file_name."<br>";
	$new_file_name = $file_path."/".$file_name;
	echo $new_file_name;
	$qry = "UPDATE files SET file_name = '$file_name', want_to_share = '$sharing' WHERE file_id = '$file_id'";

	$result = @mysql_query($qry);
	
	if($result)
	{
		//echo "Good";
		rename($old_file_name, $new_file_name);
		//header("location: files.php");
	}
	else
	{
		//echo "Bad";
		//header("location: files_error.php");
	}

?>