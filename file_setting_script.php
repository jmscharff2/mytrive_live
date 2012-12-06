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
	$want_to_share = $_POST['willing_to_share'];
	$file_id = $_POST['file_id'];
	
	echo $want_to_share;
		
	
	$qry = "UPDATE files SET file_name = '$file_name', want_to_share = '$want_to_share' WHERE file_id = '$file_id'";
	echo $qry;
	
	$result = @mysql_query($qry);
	
	if($result)
	{
		echo "Good";
		//header("location: files.php");
	}
	else
	{
		echo "Bad";
		//header("location: files_error.php");
	}

?>