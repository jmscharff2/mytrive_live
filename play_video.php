<?php
	session_start();

?>
<HTML>
<?php
	
	if(isset($_SESSION['username']) && $_SESSION['username'] != '')
	{
		include 'includes/loggedin.html';
	}
	elseif(!(isset($_SESSION['username'])))
	{
		include 'includes/loggedout.html';
	}

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
	$file_id = $_GET['file_id'];


	//so.addVariable('file','http://www.hawkitics.com/mytrive/live/upload/jon@mytrive.com/movie.m4v');
		$qry = "SELECT * from files WHERE file_id = '$file_id' LIMIT 1";
		
		$result = mysql_query($qry);
		
		if($result)
		{
			if(mysql_num_rows($result) > 0)
			{
				while ($x < mysql_num_rows($result))
				{
					$member = mysql_fetch_assoc($result);
					//this will need to change once the domain name is fixed
					//need some way of checking to make sure the user has permission
					//$play_video = "http://www.mytrive.com/upload/".$member['owner_id']."/".$member['file_name'];
					$play_video = "https://s3.amazonaws.com/mytrive_files/".$member['owner_id']."/".$member['file_name'];
					//$play_video = "../../../../mnt/s3_mytrive_files/".$member['owner_id']."/".$member['file_name'];
					$x++;
				}
			}
		}
		else
		{
			echo "error";
		}
		
?>
	
	<div class = "scroll"></div>
	<?php include 'includes/sidenav.html'?>
	<div id="main-content-wrapper">
	<center>


	<script src="http://www.onthegosystems.com/mediaplayer/swfobject.js" type="text/javascript"></script>
	
	<div id="mediaspace">This text will be replaced</div>
	
	<script type="text/javascript">// <![CDATA[
	var so = new SWFObject('http://www.onthegosystems.com/mediaplayer/player.swf','mpl','640','467','9');
	so.addParam('allowfullscreen','true');
	so.addParam('allowscriptaccess','always');
	so.addParam('wmode','opaque');
	so.addParam('bufferlength','30')
	so.addVariable('file','<?php echo $play_video; ?>');
	so.write('mediaspace');
	// ]]></script>

</center>

	</div>
	</div>
	</div>
	<?php include 'includes/footer.html'?>
	
	<BODY>
</HTML>