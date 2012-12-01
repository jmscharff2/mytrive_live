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
echo "<h1>Profile Update Error, Please Try Again.</h1>";
echo $_SESSION['username']."'s user information:</br></br></br>";
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

 
$qry = "SELECT * FROM users WHERE username = '$username'";
$result = mysql_query($qry);
$x = 0;

if($result)
{
	if(mysql_num_rows($result) > 0)
	{
	echo "<table  width='100%' border='1'> ";
	echo "<form action='update_profile_script.php' method='POST'>";
		while ($x < mysql_num_rows($result))
		{
			$member = mysql_fetch_assoc($result);
			
			//echo $member['file_name'];
		
			//echo $member['location'];
			//echo "</br>";
			
			
			echo "<tr>";
			echo "<td>";
			echo "Username:".$member['username'];
			echo "</td>";
			echo "<td>";
			echo "Email: <input type='text' name='email' value=". $member['email'].">";
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>";
			echo "<br>";
			echo "Name: <input type='text' name='first_name' value=". $member['first_name']."><input type='text' name='last_name' value=".$member['last_name'].">";
			echo "</td>";
			echo "<td>";
			echo "<br>";
			echo "City: <input type='text' name='city' value=".$member['city']."><br> State: <input type='text' name='state' value=".$member['state']."><br> Country: <input type='text' name='country' value=".$member['country'].">";
			echo "</td>";
			echo "</tr>";
			

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

	</body>

	
</HTML>