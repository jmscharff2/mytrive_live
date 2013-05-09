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

//$uploaddir = '/mnt/s3_mytrive_files/'.$username;
$uploaddir = '/var/www/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);


$ext = end(explode('.', $uploadfile));
echo $ext;


if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
    
    
} else {
    echo "Possible file upload attack!\n";
    
}


?>