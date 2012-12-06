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


?>

<HTML>
	<div class="meny">
		<H2>Your Files:</H2><br><br>
		
		<?php 
		      $side_user = $_SESSION['username'];
		      
		      if(strlen($side_user) > 1)
		      {

		      $qry2 = "SELECT * FROM files WHERE owner_id = '$side_user'";
  		      $result2 = mysql_query($qry2);

		      $x = 0;

		      if($result2)
		      {
			if(mysql_num_rows($result2) > 0)
        	       	{
				echo "<table width='100$'>";
                		while ($x < mysql_num_rows($result2))
                		{
					$member2 = mysql_fetch_assoc($result2);
					echo "<tr><td>";
					echo $member2['file_name']."<br><br>";
					$x++;
					echo "</td></tr>";
				}
			  }
			}	
			echo "</table>";
			}
		?>


	</div>

	<div class="contents">
<?php
	//session_start();
	
	

	if(isset($_SESSION['username']) && $_SESSION['username'] != '')
	{
		include 'includes/loggedin.html';
	}
	elseif(!(isset($_SESSION['username'])))
	{
		include 'includes/loggedout.html';
		echo '<meta http-equiv="Refresh" content="0; URL=http://www.mytrive.com">';
	}

?>	
		
	<script src="js/meny.min.js"></script>
		
		<script>
		
// Create an instance of Meny
			var meny = Meny.create({
				// The element that will be animated in from off screen
				menuElement: document.querySelector( '.meny' ),

				// The contents that gets pushed aside while Meny is active
				contentsElement: document.querySelector( '.contents' ),

				// [optional] The alignment of the menu (top/right/bottom/left)
				position: 'left',

				// [optional] The height of the menu (when using top/bottom position)
				height: 200,

				// [optional] The width of the menu (when using left/right position)
				width: 260,

				// [optional] Distance from mouse (in pixels) when menu should open
				threshold: 40
			});
			
			
			// API Methods:
			// meny.open();
			// meny.close();
			// meny.isOpen();
			
			// Events:
			// meny.addEventListener( 'open', function(){ console.log( 'open' ); } );
			// meny.addEventListener( 'close', function(){ console.log( 'close' ); } );

			// Embed an iframe if a URL is passed in
			if( Meny.getQuery().u && Meny.getQuery().u.match( /^http/gi ) ) {
				var contents = document.querySelector( '.contents' );
				contents.style.padding = '0px';
				contents.innerHTML = '<div class="cover"></div><iframe src="'+ Meny.getQuery().u +'" style="width: 100%; height: 100%; border: 0; position: absolute;"></iframe>';
			}
</script>

	
		  <div class="scroll"></div>
		  <!--<?php include 'includes/sidenav.html';?>-->
       		
		
	
		<div id="main-content-wrapper">

			<?php  
			$file_id = $_GET['file_id'];
			$username = $_SESSION['username'];
			$qry = "SELECT * FROM files WHERE owner_id = '$username' and file_id = '$file_id'";
			$result = mysql_query($qry);
			$x = 0;
			
			if($result)
			{
				if(mysql_num_rows($result) > 0)
				{
				echo "<table  width='100%' border='1'> ";
				echo "<form action='file_setting_script.php' method='POST'>";
					while ($x < mysql_num_rows($result))
					{
						$member = mysql_fetch_assoc($result);
						
						//echo $member['file_name'];
					
						//echo $member['location'];
						//echo "</br>";
						
						
						echo "<tr>";
						echo "<td>";
						echo "File Name: <input type='text' name='file_name' value=". $member['file_name'].">";
						echo "</td>";
						echo "<td>";
						echo "File Size: ".$member['size'];
						echo "</td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td>";
						echo "Willing to Share?: <input type='checkbox' name='want_to_share'>";
						echo "</td>";
						echo "<td>";
						if ($member['share_with'] != '')
						{
							echo "Shared With: ".$member['share_with'];
							echo "<br>";
							echo "<a href='stop_sharing.php?file=".$member['file_name']."'><img src='images/Stop.png' height='25%'/></a>";

						}
						else
						{
							echo "<a href='share_file.php?file=".$member['file_name']."'><img src='images/Share.png'height='25%'/></a>";
						}
						echo "</td>";
						echo "</tr>";
						echo "<input type='text' name='file_id' value=".$member['file_id'].">";
						
			
						//echo "/".$member['location']."/".$member['file_name'];
						
						//echo $result[$x];
						
						//file_put_contents($member['file_name'], file_get_contents("/".$member['location']."/".$member['file_name']))
						
						
						$x++;
						
					}
				}
			
			
			}
			
			
					
						
			?>
		</table>
		<input type=submit value="Update"/>
		</form>

			
		


      	</div>     	
	</div>
	</div>
	<?php include 'includes/footer.html'?>
	</div>
	</body>
	
</HTML>
