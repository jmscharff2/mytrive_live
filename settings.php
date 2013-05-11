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

	$DateOfRequest = date('Y-m-d H:i:s'); 
			
			/*Mongo DB script for logging users actions*/
			$mdb = new MongoClient();
			$db = $mdb -> mytrive;
			$coll = $db -> users;
			
			$insert = array( "username" => $username, "date" => $DateOfRequest, "page" => "settings");
			$coll -> insert($insert);


?>

<HTML>

<?php
	if(!(isset($_SESSION['username'])))
	{
		echo '<meta http-equiv="Refresh" content="0; URL=http://www.mytrive.com/index.php">';

	}
	?>


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


echo $_SESSION['username']."'s user information:</br></br></br>";

$qry = "SELECT * FROM users WHERE username = '$username'";
$result = mysql_query($qry);
$x = 0;

if($result)
{
	if(mysql_num_rows($result) > 0)
	{
	echo "<form action='update_profile_script.php' method='POST'>";
		while ($x < mysql_num_rows($result))
		{
			$member = mysql_fetch_assoc($result);
			
			//echo $member['file_name'];
		
			//echo $member['location'];
			//echo "</br>";
			
			

			echo "Username:".$member['username']."<br>";
			echo "Email: <input type='text' name='email' value=". $member['email']." ><br>";

			echo "Name: <input type='text' name='first_name' value=". $member['first_name']."><input type='text' name='last_name' value=".$member['last_name'].">";

			echo "<br>";
			echo "City: <input type='text' name='city' value=".$member['city']."><br> State: <input type='text' name='state' value=".$member['state']."><br> Country: <input type='text' name='country' value=".$member['country'].">";

			

			//echo "/".$member['location']."/".$member['file_name'];
			
			//echo $result[$x];
			
			//file_put_contents($member['file_name'], file_get_contents("/".$member['location']."/".$member['file_name']))
			
			
			$x++;
			
		}
	}


}


		
			
?>

		<input type=submit value="Update"/><br><br>
		</form>

		<form enctype="multipart/form-data" action="upload_profile_picture.php" method="POST">
	    <input type="hidden" name="MAX_FILE_SIZE" value="5120000" />
	    Profile Picture <input name="userfile" type="file" />
	    <input type="submit" value="Upload" />
	    </form>
	    
		</form>

		<form enctype="multipart/form-data" action="upload_background_image.php" method="POST">
	    <input type="hidden" name="MAX_FILE_SIZE" value="5120000" />
	    Background Image <input name="userfile" type="file" />
	    <input type="submit" value="Upload" />
	    </form>
	    
	    
	    
	    <?php
	    
	     $cursor = $coll->find(array("username" => $username));
	     
	     foreach ($cursor as $doc) {
			    var_dump($doc);
			}
	    
	    ?>

</section>

	</section>
	



</BODY>
</HTML>