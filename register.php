<?php
	session_start();

?>

<HTML>

<HEAD>

<TITLE>mytrive redesign</TITLE>

<link rel="stylesheet" type="text/css" href="css/design.css" />
<script type="text/javascript" src="includes/submitenter.js" language="javascript"></script>


<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<link rel="icon" 
      type="image/png" 
      href="images/favicon.ico">

</HEAD>

<BODY>
<!--top banner-->
<div id="nav-banner">
<nav>
<a href="index_redesign.php" ><img src = "images/trive.png" id="logo"></a>
<ul>
<li><a href="profile.php">Profile</a></li>
<li><a href="profile.php#friends">Friends</a></li>
<li><a href="profile.php#friends_files">Friends Files</a></li>
<li><a href="profile.php#upload" >Upload</a></li>
</ul>
</div>

<section id="content">
	<section id="settings_edit">
	<?php
	
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
	//$fname = clean($_POST['fname']);
	//$lname = clean($_POST['lname']);
	$login = clean($_POST['username']);
	$password = clean($_POST['password']);
	$code = clean($_POST['code']);
	$cpassword = clean($_POST['cpassword']);
	
	//Input Validations
/*	if($fname == '') {
		$errmsg_arr[] = 'First name missing';
		$errflag = true;
	}
	if($lname == '') {
		$errmsg_arr[] = 'Last name missing';
		$errflag = true;
	}*/
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
	
	
	$qry2 = "SELECT * FROM invitations WHERE invitation_code = '$code'";
	$result2 = mysql_query($qry2);
	
	if($result2)
	{
		if(mysql_num_rows($result2) > 0)
			{
			
				while ($x < mysql_num_rows($result2))
				{
					$member = mysql_fetch_assoc($result2);
					$user_invited_by = $member['user'];
					$x++;
				}
			}
			if($user_invited_by != '')
			{
				$qry3 = "UPDATE users SET invitees_joined = invitees_joined+1 WHERE username = '$user_invited_by'";
				$result3 = mysql_query($qry3);
				$qry4 = "DELETE FROM invitations WHERE invitation_code = '$code' LIMIT 1";
				$result4 = mysql_query($qry4);
			}
	}
	
	
	/*if(md5($code) != '71e857c186cf11bf9681133d27d3a21c')
	{
		$errmsg_arr[] = 'Registration code not valid';
		$errflag = true;
	}*/

	
	//Check for duplicate login ID
	if($login != '') {
		$qry = "SELECT * FROM users WHERE username='$login'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				
				$errmsg_arr[] = 'Login ID already in use';
				$errflag = true;
				die("Login ID already in use Please try again: </br><a href='index.html'>Register Here</a>");
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed2");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		//$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		//session_write_close();
		//header("location: register-form.php");
		for($x = 0; $x < sizeof($errmsg_arr); $x++)
		{
			echo $errmsg_arr[$x]."<br>";
		}
		echo "<a href='index.html'>Register here</a>";
		exit();
	}
	
	//Create INSERT query
	$qry = "INSERT INTO users(username,password) VALUES('$login','".md5($_POST['password'])."')";
	
	if($errflag != true)
	{
		$result = @mysql_query($qry);
	
		//Check whether the query was successful or not
		if($result) {
		
			$qry2 = "INSERT INTO drive_size(user_id) VALUES('$login')";
			$result2 = mysql_query($qry2);
		
		
			//header("location: register-success.php");
			echo $login. " created";
			echo "This page will load your profile in 5 seconds. </br>";
			echo '<meta http-equiv="Refresh" content="1; URL=http://www.mytrive.com/index.php">';
			//exit();
		}else {
			echo $login. "not created please try again</br>";
			echo "<a href='index.php'>Register Here</a>";
			}
		//$directory = "upload/".$login."/";
		$directory = "/mnt/s3_mytrive_files/".$login."/";
		if(is_dir($directory))
		{
			//echo "directory exists!";
		}
		else
		{
			mkdir($directory);
			//echo "directory created!";
			return index2.html;
		}
	}
	
?>	
	
	
	</section>
</section>
	



</BODY>
</HTML>