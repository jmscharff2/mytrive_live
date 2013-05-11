<?php
	session_start();

	
	
	//Include database connection details
	require_once('config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
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
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$login = clean($_POST['username']);
	//$login = $_POST['username'];
	$password = clean($_POST['password']);
	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		//header("location: login-form.php");
		exit();
	}
	
	//Create query
	$passwordmd5 = md5($password);
	$qry = "SELECT * FROM users WHERE username='$login' AND password='$passwordmd5'";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//echo "Login success";
			//Login Successful
			//session_regenerate_id();
			$member = mysql_fetch_assoc($result);
			//$_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
			//$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
			//$_SESSION['SESS_LAST_NAME'] = $member['lastname'];
			$_SESSION['username'] = $login;
			$_SESSION['user_id'] = $member['user_id'];
			$_SESSION['first_name'] = $member['first_name'];
			//session_write_close();
			//echo $_SESSION['SESS_USERNAME'];
			//header("location: member-index.php");
			//header("location: test.html");
			//echo session_id();
			//echo "<br><a href='test.html'>testhtml</a>";
			//echo "You have sucessfully logged in as ".$_SESSION['username']." please navigate around!";
			
			
			$DateOfRequest = date('Y-m-d H:i:s'); 
			
			/*Mongo DB script for logging users actions*/
			$mdb = new MongoClient();
			$db = $mdb -> mytrive;
			$coll = $db -> users;
			
			$insert = array( "username" => $login, "date" => $dateOfRequest, "page" => "login");
			$coll -> insert($insert);

			//echo $DateOfRequest;
		$qry2 = "UPDATE users SET last_logged_in = '$DateOfRequest', loggedin = 1 WHERE username = '$login'";
		//echo "<br>".$qry2;
		$result2 = 	mysql_query($qry2);
		if(result)
		{
			//echo "Updated Time Stamp";
			header("location: profile.php");
		}
		else
		{
			//echo "NOT Updated Time Stamp";
			header("location: index.php");
		}
			exit();
		}else {
		
				//Login failed
			//echo "error: " . $result . "num_rows: " . mysql_num_rows($result);
			//header("location: login.html");
			header("location: index.php");
			exit();
		}
	}else {
		die("Query failed");
		echo"error";
	}
?>	