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


<body>

					
		<div id="main-content-wrapper">
		<form action="upload_file.php" method="post" enctype="multipart/form-data">
			<input type="file" class="multi" name="file[]" id="file"/>
			<input type="submit" name="upload2" />
			</form>
		</p>
						
		</div>
		
		
		
				
        <div class="scroll"></div>
        <?php include 'includes/sidenav.html';?>
       		
			
	</div>
	</div>
	<?php include 'includes/footer.html'?>

	</body>

	
</HTML>