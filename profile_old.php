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
		$qry2 = "SELECT * FROM friends WHERE (friend1 = '$user_id' OR friend2 = '$user_id') AND accepted = 1";
		$result2 = mysql_query($qry2);
		$x = 0;
		
		?><table border="1">
		<tr><td>Friend List:</td></tr>
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
					if($member4['friend1'] != $user_id)
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
										echo "<a href=friends_profile.php?friends_user_id=".$friend_id.">".$member3['first_name']." ".$member3['last_name']."</a>";
									}
									else
									{
										echo "<a href=friends_profile.php?friends_user_id=".$friend_id.">".$member3['username']."</a>";

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
					elseif($member4['friend2'] != $user_id)
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
										echo "<a href=friends_profile.php?friends_user_id=".$friend_id.">".$member3['first_name']." ".$member3['last_name']."</a>";
									}
									else
									{
										echo "<a href=friends_profile.php?friends_user_id=".$friend_id.">".$member3['username']."</a>";
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
		
		
		$qry4 = "SELECT * FROM friends WHERE (friend1 = '$user_id' OR friend2 = '$user_id') AND accepted = 0";
		//echo $qry4;
		$result4 = mysql_query($qry4);
		$x = 0;
		echo "<table  border='1'>";
		echo"<tr><td>Pending Friends</td></tr>";
		if($result4)
		{
			if(mysql_num_rows($result4) > 0)
			{
				
				while($x < mysql_num_rows($result4))
				{
					echo "<tr>";
					echo "<td>";
					$member4 = mysql_fetch_assoc($result4);
					
					if($member4['friend1'] != $user_id)
					{
						$friend_id = $member4['friend1'];
						$qry5 = "SELECT username, first_name, last_name FROM users WHERE user_id = '$friend_id'";
						$result5 = mysql_query($qry5);
						$y = 0;
						if($result5)
						{
							if(mysql_num_rows($result5) > 0)
							{
								while($y < mysql_num_rows($result5))
								{
									$member5 = mysql_fetch_assoc($result5);
									if($member5['first_name'] != '' && $member5['last_name'] != '')
									{
										echo $member5['first_name']." ".$member5['last_name'];
										echo "<a href=accept_friend_request_script.php?friendship_id=".$member4['friendship_id'].">Accept </a>";
										echo "<a href=reject_friend_request_script.php?friendship_id=".$member4['friendship_id'].">/ Reject</a>";
									}
									else
									{
										echo $member5['username'];
										echo "<a href=accept_friend_request_script.php?friendship_id=".$member4['friendship_id'].">Accept</a>";
										echo "<a href=reject_friend_request_script.php?friendship_id=".$member4['friendship_id'].">Reject</a>";
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
					elseif($member4['friend2'] != $user_id)
					{
						$friend_id = $member4['friend2'];
						$qry5 = "SELECT username, first_name, last_name FROM users WHERE user_id = '$friend_id'";
						$result5 = mysql_query($qry5);
						$y = 0;
						if($result5)
						{
							if(mysql_num_rows($result5) > 0)
							{
								
								while($y < mysql_num_rows($result5))
								{
									$member5 = mysql_fetch_assoc($result5);
									if($member5['first_name'] != '' && $member5['last_name'] != '')
									{
										echo $member5['first_name']." ".$member5['last_name']." (Pending)";
									}
									else
									{
										echo $member5['username']." (Pending)";
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
				
					$x++;	
					echo "</td>";
					echo "</tr>";
				}
			}
		}


		

		?>
		<br><br>
		</table>
		Add a new Friend<br>
		<form action = "request_friend_script.php" method = "POST">
		<input type="text" name="friend_username" placeholder="Friends Username" onkeypress="return submitenter(this,event)">
		<input type="submit" value="Add Friend"/> 
		</form>

		<?php
		$qry6 = "SELECT * FROM files INNER JOIN file_request ON files.file_id = file_request.file_id INNER JOIN users ON file_request.request_user_id = users.user_id WHERE files.owner_user_id = '$user_id' ORDER BY users.username";
		$result6 = mysql_query($qry6);
		$x = 0;
		
		if($result6)
		{
			if(mysql_num_rows($result6) > 0)
			{
				echo "<br><br>Files Users have Requested to be shared: <br><br>";
				while($x < mysql_num_rows($result6))
				{
					$member6 = mysql_fetch_assoc($result6);
					echo "File Name: <a href='file_settings.php?file_id=".$member6['file_id']."'>".$member6['file_name']."</a>, Requested by: <a href=friends_profile.php?friends_user_id=".$member6['user_id'].">".$member6['username']."</a>       ";
					
					echo "<a href=approve_file_share_script.php?request_id=".$member6['request_id'].">Approve</a>";
					echo "<a href=reject_file_share_script.php?request_id=".$member6['request_id'].">Reject</a>";
					$x++;
				}
			}
		}
		?>
			
		</div>	

	</div>
	</div>
	<?php include 'includes/footer.html'?>

	</body>

	
</HTML>