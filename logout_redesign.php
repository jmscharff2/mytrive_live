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
<li><a href="profile_redesign.php">Profile</a></li>
<li><a href="profile_redesign.php#friends">Friends</a></li>
<li><a href="profile_redesign.php#friends_files">Friends Files</a></li>
<li><a href="profile_redesign.php#upload" >Upload</a></li>
</ul>
</div>

<section id="content">
<section id="settings_edit">
<?php
$DateOfRequest = date('Y-m-d H:i:s'); 

		
		$qry2 = "UPDATE users SET last_logged_out = '$DateOfRequest',loggedin = 0 WHERE username = '$username'";
		//echo "<br>".$qry2;
		$result2 = 	mysql_query($qry2);
		
		
		echo "<center>";
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
		
		echo '<meta http-equiv="Refresh" content="5; URL=http://www.mytrive.com/index_redesign.php">';

		
		
		?>	




</section>

	</section>
	



</BODY>
</HTML>