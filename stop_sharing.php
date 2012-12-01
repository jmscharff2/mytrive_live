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
	$file_name = $_GET['file'];
	
	$qry = "UPDATE files SET share_with = '' WHERE owner_id = '$username' AND file_name = '$file_name' LIMIT 1";
	
	$result = mysql_query($qry);

	if($result)
	{
		header("location: files.php");
	}
	else
	{
		header("location: files_error.php");
	}


?>