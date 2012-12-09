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




$friends_user_id = $_GET['friends_user_id'];
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

$security_qry = "SELECT * FROM friends WHERE (friend1 = '$user_id' OR friend2 = '$user_id') AND (friend1 = '$friends_user_id' OR friend2 = '$friends_user_id') AND accepted = 1";
$security_result = mysql_query($security_qry);

/*
if($security_result)
{
	if(mysql_num_rows($result) > 0)
		{*/

	//$security_qry = "SELECT friendship_id, username, user_id FROM friends JOIN users ON friends.friend1 = users.user_id OR friends.friend2 = users.user_id WHERE accepted = 1 AND (friends.friend1 =  '$user_id' OR friends.friend2 = '$user_id') AND (friends.friend1 = '$friend_user_id' OR friends.friend2 = '$friend_user_id')";
	
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
	
	//$username = $_SESSION['username'];
	
	 
	$qry = "SELECT * FROM users WHERE user_id = '$friends_user_id'";
	$result = mysql_query($qry);
	$x = 0;
	
	if($result)
	{
		if(mysql_num_rows($result) > 0)
		{
		$member = mysql_fetch_assoc($result);
		echo $member['username']."'s user information:<br><br><br>";
		echo "<table  width='100%' border='1'> ";
		echo "<form>";
			while ($x < mysql_num_rows($result))
			{
				//$member = mysql_fetch_assoc($result);
				
				//echo $member['file_name'];
			
				//echo $member['location'];
				//echo "</br>";
				
				echo "<tr>";
				echo "<td>";
				echo "Username: ". $member['username'];
				echo "</td>";
				echo "<td>";
				echo "Email: ". $member['email'];
				echo "</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>";
				echo "<br>";
				echo "Name: ". $member['first_name']." ".$member['last_name'];
				echo "</td>";
				echo "<td>";
				echo "<br>";
				echo "City: ".$member['city']." State: ".$member['state']." Country: ".$member['country'];
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
			
			<?php
		
			
			
			
			$qry2 = "SELECT * FROM friends WHERE (friend1 = '$friends_user_id' OR friend2 = '$friends_user_id') AND accepted = 1";
			$result2 = mysql_query($qry2);
			$x = 0;
			
			?><table border="1">
			<tr><td>Buddy List:</td></tr>
			<?php
			if($result2)
			{
				if(mysql_num_rows($result2) > 0)
				{
					while ($x < mysql_num_rows($result2))
					{
						echo "<tr>";
						echo "<td>";
						$member4 = mysql_fetch_assoc($result2);
						if($member4['friend1'] != $friends_user_id)
						{
							$friend_id = $member4['friend1'];
							$qry3 = "SELECT username, first_name, last_name FROM users WHERE user_id = '$friend_id'";
							$result3 = mysql_query($qry3);
							$y = 0;
							if($result3)
							{
								if(mysql_num_rows($result3) > 0)
								{
									while($y < mysql_num_rows($result3))
									{
										$member3 = mysql_fetch_assoc($result3);
										if($member3['first_name'] != '' && $member3['last_name'] != '')
										{
											echo $member3['first_name']." ".$member3['last_name'];
										}
										else
										{
											echo $member3['username'];
										}
										$y++;
									}
								}
							}
							else
							{
								echo "Friend Find Error :(";
							}
							
						}
						elseif($member4['friend2'] != $friends_user_id)
						{
							$friend_id = $member4['friend2'];
							$qry3 = "SELECT username, first_name, last_name FROM users WHERE user_id = '$friend_id'";
							$result3 = mysql_query($qry3);
							$y = 0;
							if($result3)
							{
								if(mysql_num_rows($result3) > 0)
								{
									
									while($y < mysql_num_rows($result3))
									{
										$member3 = mysql_fetch_assoc($result3);
										if($member3['first_name'] != '' && $member3['last_name'] != '')
										{
											echo $member3['first_name']." ".$member3['last_name'];
										}
										else
										{
											echo $member3['username'];
										}
										$y++;
									}
								}
							}
							else
							{
								echo "Friend Find Error :(";
							}
						}
						echo "</td>";
						echo "</tr>";
						$x++;
						
					}
				}
			}
			echo "</table>";
			echo "<br><br>";
		/*}	
	}
	else
	{
		echo "You are not friends with this person! Redirecting to your profile in 5 seconds.";
		echo '<meta http-equiv="Refresh" content="15; URL=http://www.mytrive.com/profile.php">';
		
	}*/
	?>		
		</div>	

	</div>
	</div>
	<?php include 'includes/footer.html'?>

	</body>

	
</HTML>