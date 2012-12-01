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
	}

?>




					
		<div id="main-content-wrapper">
		<h1>Welcome to Trive</h1> </br>
		<p>Thank you for logging in.  You are currently logged in as: <?php
		echo $_SESSION['username'];
		?>
		</p>
						
		</div>
		
		
		
				
        <div class="scroll"></div>
        <?php include 'includes/sidenav.html';?>
       		
			
	</div>

	</body>

	
</HTML>