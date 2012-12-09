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
	echo "<form>";
		while ($x < mysql_num_rows($result))
		{
			$member = mysql_fetch_assoc($result);
			
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

		<tr>
		<td>
		<right><a href= "update_profile.php">Edit Profile</a></right>
		</td>
		<td>
		<a href="send_invitation.php">Invite a Friend</a>
		</td>
		</tr>
		</table>
		
		</form>
		<br><br><br>
		<?php if($member['fb_id'] == 0)
		{?>
		We recommend linking your MyTrive account to Facebook so you can use our app there.  To do this please fill out the information below:
		<center>
		<fb:registration fields="[
			 {'name':'name'},
			 {'name':'email'},
			 {'name':'location'},
			 {'name':'gender'},
			 {'name':'birthday'},
			 {'name':'force',      'description':'Which side?',              'type':'select',    'options':{'jedi':'Jedi','sith':'Sith'}, 'default':'jedi'},
			 {'name':'mytrive_username', 'description':'MyTrive Username', 'type':'text'}
			]"	redirect-uri="https://safe-citadel-5114.herokuapp.com/test.php" fb-xfbml-state="rendered" class="fb_iframe_widget"/>			
		
		</center>
		<?php 
		}
		else
		{
			echo $member['fb_id'];
		}?>
		
		
		<?php
		$user_id = $_SESSION['user_id'];
		echo $user_id."<br>";
		$qry2 = "SELECT * FROM friends WHERE friend1 = '$user_id' OR friend2 = '$user_id' AND accepted = 1";
		echo $qry2;
		$result2 = mysql_query($qry2);
		$x = 0;
		
		?><table border="1">
		<tr>
		<td><tr>Buddy List:</tr></td>
		<?php
		if($result2)
		{
			if(mysql_num_rows($result2) > 0)
			{
				while ($x < mysql_num_rows($result2))
				{
					echo "<tr>";
					echo "<td>";
					$member2 = mysql_fetch_assoc($result2);
					if($member2['friend1'] != $user_id)
					{
						$friend_id = $member2['friend1'];
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
					elseif($member2['friend2'] != $user_id)
					{
						$friend_id = $member2['friend2'];
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
					$y=0;
				}
			}
		}

		?>
		</table>
			
		</div>	

	</div>
	</div>
	<?php include 'includes/footer.html'?>

	</body>

	
</HTML>