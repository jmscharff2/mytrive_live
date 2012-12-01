<?php
	session_start();

	require_once('config.php');

	$username = $_SESSION['username'];
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
		$qry = "SELECT * FROM users WHERE username='$username'";
		$result = mysql_query($qry);
		
		if($result)
		{
			if(mysql_num_rows($result) > 0)
			{
			
				while ($x < mysql_num_rows($result))
				{
					$member = mysql_fetch_assoc($result);
		
					$first_name = $member['first_name'];
					$last_name = $member['last_name'];
					$invitations_left = $member['invitation'];
					$x++;
				}
			}
		}
		
	$to = $_POST['email'];
	$date = date('Y-m-d H:i:s'); 
	$invitation = RandomInvitationCode(20);
	$invitation_code = md5($invitation);
	$invitations_left--;


	$qry2 = "INSERT INTO invitations (email,user,invitation_code,date_invited) VALUES ('$to','$username','$invitation_code','$date')";
	$result2 = mysql_query($qry2);	
		
	


	$subject = "mytrive Invitation";
	$message = "Here is your mytrive.com invitation sent by ". $first_name." ".$last_name.".  Please go to www.mytrive.com to register and use this activation code: ". $invitation_code."\n\n Please email support@mytrive.com if you have any questions concerns or problems.  Your invitation will be valid for 2 days.\n\n Thanks,\n The mytrive Team!\n\n";
	$from = "invitations@mytrive.com";
	$headers = "From:".$from;
	mail($to,$subject,$message,$headers);
	
	
	$qry3 = "UPDATE users SET invitation = '$invitations_left' WHERE username = '$username'";
	
	$result3 = @mysql_query($qry3);
	
	if($result3)
	{
		header("location: send_invitation.php");
	}
	else
	{
		header("location: send_invitation.php");
	}


?>


<?php
	function RandomInvitationCode($length)
	{
		$codes = array_merge(range(0,9), range('a','z'));
		
		for($x = 0; $x < $length; $x++)
		{
			$code .= $codes[array_rand($codes)];
		}
		
		return $code;
	}

?>