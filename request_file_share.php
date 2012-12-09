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
	$request_friend = $_GET['file_id'];
	
	$user_id = $_SESSION['user_id'];
	
	//$qry3 = "INSERT INTO friends (friend1, friend2) VALUES('$user_id', '$friend_id')";
	$qry3 = "INSERT INTO file_request (file_id, request_user_id) VALUES('$file_id', '$user_id')";
	$result3 = mysql_query($qry3);
	$x = 0;
	
	if($result3)
	{
		header("location: file_settings.php?file_id='$file_id'");
	}
	else
	{
		header("location: file_settings.php?file_id='$file_id'");
	}
		

?>