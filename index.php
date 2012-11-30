<?php
	session_start();
?>
<HTML>
<?php

	if(isset($_SESSION['username']) && $_SESSION['username'] != '')
	{
		include 'includes/loggedin.html';
	}
	elseif(!(isset($_SESSION['username'])))
	{
		include 'includes/loggedout.html';
	}

?>

	<div class ="scroll"></div>
	<?php include 'includes/sidenav.html'?>
	<div id="main-content-wrapper">
	
	<!--<center><h1>Welcome to mytrive.com</h1></center>-->
	<br>
	
	<div id="registration-mascot">
		<img src = "images/mascot.png" height="100%">

	</div>
	<center>
	<div id="registration-fields">
		<RF1>Signup for mytrive<br></RF1>
		<RF2>Join mytrive to connect and share your<br> files anywhere with friends</RF2><br><br>

		<form action = "register.php" method = "POST">
		<input type="text" name="username" class="placeholder" placeholder="username"><br>
		<input type="password" name="password" class="placeholder" placeholder="password"><br>
		<input type="password" name="cpassword" class="placeholder" placeholder="confirm password"><br>
		<input type="text" name="code" class="placeholder" placeholder="registration code" onkeypress="return submitenter(this,event)"><br>
		<input type="submit" value="Register" hidden = "true">
		</form>
		</center>
	</div>
	
	</div>
	
	</div>
	<?php include 'includes/footer.html'?>

	</BDOY>
</HTML>