<!DOCTYPE html>
<HTML lang="en-us">

<HEAD>
	<meta charset="utf-8"/>
	
	<TITLE>mytrive profile redesign</TITLE>

<link rel="stylesheet" type="text/css" href="css/design.css" />
<script type="text/javascript" src="includes/submitenter.js" language="javascript"></script>
	<script src="js/jquery.js"></script>
	<script src="js/jquery-ui.js"></script>


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
	// ]]>
	</script>
	<?php
	echo $play_video;
	?>
</center>
</section>


</BODY>


</HTML>


