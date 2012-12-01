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
	$rename_file = $_POST['file_id'];
	$new_name = $_POST['new_file_name'];
	$old_name = $_POST['old_file_name'];
	
	$qry = "UPDATE files SET file_name = '$new_name' WHERE file_id = '$rename_file'";
	$result = mysql_query($qry);
	
	if($result)
	{
		$file_to_rename = "upload/$username/$new_name";
		rename("upload/$username/$old_name", "upload/$username/$new_name");
		header("location: files.php");
	}
	else
	{
		header("location: files_error.php");
	}


?>