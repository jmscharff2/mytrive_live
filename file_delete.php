<?php

	session_start();
	
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
	$delete_file = $_GET['file'];
	
	$qry = "DELETE FROM files WHERE file_name = '$delete_file' AND owner_id = '$username' LIMIT 1";
	$result = mysql_query($qry);

	if($result)
	{
		//echo "upload/".$username."/".$delete_file;
		$file_to_delete = "upload/$username/$delete_file";
		unlink($file_to_delete);
		header("location: files.php");
	}
	else
	{
		header("location: files_error.php");
	}


?>