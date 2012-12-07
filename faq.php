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
			
			<center>
			<img src="images/mascot.png" height="50"/>
			<RF2>We will add more as questions come in, for now, here is some information about the site that we thought you would like to know!</RF2></center>
			<br>
			<br>
			<p>Where are our files stored?  Well your files are stored on our servers, when you upload them we take them and put them on amazon s3 which is a file drive that we link to our amazon ec2 instance which is our main server</p>
			<br>
			<p>Why do I need to add facebook?  We are integrated with facebook for several reasons.  The first being that when you register on here, and go to our facebook app: http://apps.facebook.com/mytrive you will be able to see your files and interact with them without ever leaving facebook.  This is just an added convenience for you since lets face it, most of our time on the web is on facebook, so we bring mytrive to you instead of you having to go to mytrive.  Secondly you have the ability to comment on our site on files that you would like to share with friends.  When you share a file you comment on it and this allows for people to know who wants to view the file you have uploaded as well as what they thought, so it is an added collaboration on the site that allows you to connect with your friends here as well as on facebook.</p>
				<br>		
		</div>
		
		
		
				
              		
			
	</div>
	</div>
	<?php include 'includes/footer.html'?>

	</body>

	
</HTML>