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
	//$file_name = $_GET['file'];
	$share_with_user = $_POST['share_with_user'];
	$file_name = $_POST['file_name'];
	
	//$qry = "DELETE FROM files WHERE file_name = '$delete_file' AND owner_id = '$username' LIMIT 1";
	
	
	$qry = "UPDATE files SET share_with = '$share_with_user' WHERE owner_id = '$username' AND file_name = '$file_name' LIMIT 1";
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