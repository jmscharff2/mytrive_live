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
	
	$username = $_SESSION['username'];

?>

<HTML>

<HEAD>

<TITLE>mytrive redesign</TITLE>

<link rel="stylesheet" type="text/css" href="css/design.css" />
<script type="text/javascript" src="includes/submitenter.js" language="javascript"></script>


<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<link rel="icon" 
      type="image/png" 
      href="images/favicon.ico">

</HEAD>

<BODY>
<!--top banner-->
<div id="nav-banner">
<nav>
<a href="index_redesign.php" ><img src = "images/trive.png" id="logo"></a>
<ul>
<li><a href="profile.php">Profile</a></li>
<li><a href="profile.php#friends">Friends</a></li>
<li><a href="profile.php#friends_files">Friends Files</a></li>
<li><a href="profile.php#upload" >Upload</a></li>
</ul>
</div>

<section id="content">
	<section id="settings_edit">
	
	<?php  
			$file_id = $_GET['file_id'];
			$username = $_SESSION['username'];
			$user_id = $_SESSION['user_id'];
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
						if($member['want_to_share'] == 0)
						{
							echo "Willing to Share?: <input type='checkbox' name='want_to_share' >";
						}
						elseif($member['want_to_share'] == 1)
						{
							echo "Willing to Share?: <input type='checkbox' name='want_to_share' checked='checked'>";
						}
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
						echo "<input type='text' name='file_id' value=".$member['file_id']." hidden='true'>";
						$file_id = $member['file_id'];
			
						//echo "/".$member['location']."/".$member['file_name'];
						
						//echo $result[$x];
						
						//file_put_contents($member['file_name'], file_get_contents("/".$member['location']."/".$member['file_name']))
						
						
						$x++;
						
					}
					echo "</table><input type=submit value='Update'/></form><br><br>";
				}
			
				$qry4 = "SELECT * FROM files JOIN file_request ON files.file_id = file_request.file_id WHERE owner_user_id = '$user_id'";
				$result4 = mysql_query($qry4);
				$x = 0;
				
				if($result4)
				{
					if(mysql_num_rows($result4) > 0)
					{
						echo "Users who would like to have this file shared to them: <br>";

						while($x < mysql_num_rows($result4))
						{
							$member4 = mysql_fetch_assoc($result4);
							
							echo "File Name: ".$member4['file_name'];
							echo "<a href=approve_file_share_script.php?request_id=".$member4['request_id'].">Approve</a>";
							echo "<a href=reject_file_share_script.php?request_id=".$member4['request_id'].">Reject</a>";
							echo "<br>";
							$x++;
						}
					}
				}

			}
			
			$qry2 = "SELECT * FROM files WHERE share_with = '$username' and file_id = '$file_id'";
			$result2 = mysql_query($qry2);
			$x = 0;
			
			if($result2)
			{
				if(mysql_num_rows($result2) > 0)
				{
					while ($x < mysql_num_rows($result2))
					{
						$member2 = mysql_fetch_assoc($result2);

						echo "File Name: ".$member2['file_name'];
						echo "<br>Shared By: ".$member2['owner_id'];
						$x++;
					}
				}
			}
			
			$qry3 = "SELECT * FROM files JOIN friends on files.owner_user_id = friends.friend1 OR files.owner_user_id = friends.friend2 WHERE ((file_id = '$file_id') AND (accepted = 1) AND (friends.friend1 = '$user_id' OR friends.friend2 = '$user_id')) LIMIT 1";
			$result3 = mysql_query($qry3);
			$x = 0;
			if($result3)
			{
				if(mysql_num_rows($result3) > 0)
				{
					while($x < mysql_num_rows($result3))
					{
						$member3 = mysql_fetch_assoc($result3);
						if($member3['owner_user_id'] != $user_id)
						{
						echo "File Name: ".$member3['file_name']."<br>";
						echo "<a href=request_file_share.php?file_id=".$file_id.">Request file to be shared from owner</a>";
						}
						$x++;
					}
				}
			}
						
			?>
	
	
	
	
	
	</section>
</section>
	



</BODY>
</HTML>