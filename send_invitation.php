<?php
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
		echo '<meta http-equiv="Refresh" content="1; URL=http://www.mytrive.com">';

	}

?>

	 <div class="scroll"></div>
        <?php include 'includes/sidenav.html';?>


					
		<div id="main-content-wrapper">
		
		
<?php
		
		require_once('config.php');

$username = $_SESSION['username'];
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
	$qry = "SELECT * FROM users WHERE username='$username'";
	$result = mysql_query($qry);
	
	if($result)
	{
		if(mysql_num_rows($result) > 0)
		{
		
			while ($x < mysql_num_rows($result))
			{
				$member = mysql_fetch_assoc($result);
	
				$invitations = $member['invitation'];
				$x++;
			}
		}
	}

?>
		<div id="registration-mascot">
			<img src = "../images/mascot.png" height="100%">
		</div>
		<center>
		<div id="registration-fields">
			<RF1>Invite your buddies<br></RF1>
			<RF2>Please enter your buddies email below to send them an invitation to mytrive</RF2><br><br>
		
			<form action = "invitations.php" method = "POST">
			<input type="text" name="email" class="placeholder" placeholder="email" onkeypress="return submitenter(this,event)"><br>
			<input type="submit" value="Register" hidden = "true">
			</form>
			<p>You have <?php echo $invitations; ?> left!</p>
		</div>
		</center>
		</div>
			
			

	</div>
	</div>
	<?php include 'includes/footer.html'?>

	</body>

	
</HTML>