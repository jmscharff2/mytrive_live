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
	$user_id = $_SESSION['user_id'];
	$friendship_id = $_GET['friendship_id'];

	$user_friend_request_action = $_GET['friend_request_response'];

	$qry = "UPDATE friends SET accepted = -1 WHERE friendship_id = '$friendship_id'";
	$result = mysql_query($qry);
	
	if($result)
	{
		header("location: profile.php");
	}
	else
	{
		header("location: profile_error.php");
	}
	
?>
	
	