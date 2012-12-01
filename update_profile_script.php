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
	$email = clean($_POST['email']);
	$first_name = clean($_POST['first_name']);
	$last_name = clean($_POST['last_name']);
	$city = clean($_POST['city']);
	$state = clean($_POST['state']);
	$country = clean($_POST['country']);
		
	
	$qry = "UPDATE users SET email = '$email', first_name = '$first_name', last_name = '$last_name', city = '$city', state = '$state', country = '$country' WHERE username = '$username'";
	
	$result = @mysql_query($qry);
	
	if($result)
	{
		header("location: profile.php");
	}
	else
	{
		header("location: profile_error.php");
	}

?>