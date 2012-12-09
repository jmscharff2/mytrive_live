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
	$request_friend = $_POST['friend_username'];
	echo $request_friend;
	$qry = "SELECT user_id FROM users WHERE username = '$request_friend' LIMIT 1";
	echo $qry;
	$result = mysql_query($qry);
	$x = 0;
	if($result)
	{
		if(mysql_num_rows($result) > 0)
		{
			while ($x < mysql_num_rows($result))
			{
				$member = mysql_fetch_assoc($result);
				$friend_id = $member['user_id'];
				$x++;
			}
		}
	}
	
	/*$qry2 = "SELECT user_id FROM users WHERE username = '$username' LIMIT 1";
	$result2 = mysql_query($qry2);
	$x = 0;
	
	if($result2)
	{
		if(mysql_num_rows($result2) > 0)
		{
			while ($x < mysql_num_rows($result2))
			{
				$member2 = mysql_fetch_assoc($result2);
				$user_id = $member2['user_id'];
				$x++;
			}
		}
	}*/
	$user_id = $_SESSION['user_id'];
	
	$qry3 = "INSERT INTO friends (friend1, friend2) VALUES('$user_id', '$friend_id')";
	$result3 = mysql_query($qry3);
	$x = 0;
	
	if($result3)
	{
		//header("location: profile.php");
	}
	else
	{
		//header("location: profile_error.php");
	}
		

?>