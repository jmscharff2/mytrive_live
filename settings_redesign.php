<?php
	session_start();
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
<a href="#nav-banner" ><img src = "images/trive.png" id="logo"></a>
<ul>
<li><a href="index_redesign.php">Signup</a></li>
<li><a href="info_redesign.php">Steps</a></li>
<li><a href="faq_redesign.php">FAQ</a></li>
</ul>
<form action = "login.php" method ="post">
<input type="text" name="username" placeholder="username" onkeypress="return submitenter(this,event)"/>
<input type="password" name="username" placeholder="password" onkeypress="return submitenter(this,event)"/>
</form>
</nav>
</div>

<section id="content">
<section id="settings_edit">
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



</section>

	</section>
	



</BODY>
</HTML>