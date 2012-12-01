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

		 <div class="scroll"></div>
        <?php include 'includes/sidenav.html';?>



					
		<div id="main-content-wrapper">
		
			<p>Guess what, we currently have no FAQ so email us at support@trive.com and maybe we will add some.	</p>
						
		</div>
		
		
		
				
              		
			
	</div>
	</div>
	<?php include 'includes/footer.html'?>

	</body>

	
</HTML>