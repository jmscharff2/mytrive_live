<?php
// In PHP versions earlier than 4.1.0, $HTTP_POST_FILES should be used instead
// of $_FILES.
session_start();

require_once('config.php');

$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!link)
{
	die('Failed to connect to server: ' . mysql_error());
}

$db = mysql_select_db(DB_DATABASE);
if(!db)
{
	die("Unable to select database");
}
$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

$uploaddir = '/mnt/s3_mytrive_files/'.$username.'/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

$file_info = $username.'/'.basename($_FILES['userfile']['name']);

$ext = end(explode('.', $uploadfile));
//echo $ext;


if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
   // echo "File is valid, and was successfully uploaded.\n";
    
   	$qry = "UPDATE users SET profile_picture = '".$file_info."' WHERE users.user_id = '".$user_id."'";
	$result = mysql_query($qry);
	//echo $qry."<br>";
	echo '<meta http-equiv="Refresh" content="0; URL=http://www.mytrive.com/settings.php">';

	
    
} else {
   // echo "Possible file upload attack!\n";
   			echo '<meta http-equiv="Refresh" content="0; URL=http://www.mytrive.com/settings_error.php">';

    
}

//echo $uploadfile;

?>