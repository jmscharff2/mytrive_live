<?php
//destroy session when they logout
session_start();

?>

<HTML>
<?php
	//session_start();


	if(isset($_SESSION['username']) && $_SESSION['username'] != '')
	{
		include 'includes/loggedin.html';
	}
	elseif(!(isset($_SESSION['username'])))
	{
		include 'includes/loggedout.html';
	}

?>
	<BODY>
		</div>
		  <div class="scroll"></div>
       
        <?php include 'includes/sidenav.html';?>
       		

	
		<div id="main-content-wrapper">
		

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
	
	
		$username = $_SESSION['username'];
		
		$DateOfRequest = date('Y-m-d H:i:s'); 

		
		$qry2 = "UPDATE users SET last_logged_out = '$DateOfRequest',loggedin = 0 WHERE username = '$username'";
		//echo "<br>".$qry2;
		$result2 = 	mysql_query($qry2);
		
		
		echo "<div id='registration-mascot'><img src = 'images/mascot.png' height='100%'></div>";
		echo "<div id='registration-fields'>";
		echo "<center><RF1>";
		echo $_SESSION['username'] . " ";


		if(isset($_SESSION['username']))
		  {
		  	unset($_SESSION['username']);
		  	unset($_SESSION['user_id']);
		  	echo "logged out.<br></RF1> <RF2> Please come back! You will be redirected in 5 seconds.</RF2></center>";
		  }
		  else
		  {
			  echo "not logged out, please try again.";
		  }
		  echo "</div>";
		
		echo '<meta http-equiv="Refresh" content="5; URL=http://www.mytrive.com">';

		
		
		?>	
		</div>    	
	</div>
	</body>	
</HTML>
