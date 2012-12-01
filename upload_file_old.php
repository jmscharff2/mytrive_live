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
	}

?>
	<BODY>
		  <div class="scroll"></div>
		  <?php include 'includes/sidenav.html';?>
       		
		
	
		<div id="main-content-wrapper">




<?php


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
$allowedExts = array("jpg", "jpeg", "gif", "png","doc","docx","pdf","avi","mp4","m4v","m4p","html","js","rtf");

$y = count($_FILES['file']['name']);

for($x = 0; $x < $y; $x++)
{
	$extension = end(explode(".", $_FILES["file"]["name"][$x]));
	//$illegal_characters = strpos($_FILES["file"]["name"][$x],"*");
	//
	//if($illegal_characters = true)
	//{
	//	echo "Illegal Character: * ". $_FILES["file"]["name"][$x]."<br>";
	//	die("Please rename your files.");
	//}
	if (($_FILES['file']['size'][$x] < 200000000000))
	  {
	  if ($_FILES['file']['error'][$x] > 0)
	    {
	    echo "Return Code: " . $_FILES["file"]["error"][$x] . "<br />";
	    }
	  else
	    {
	    echo "Upload: " . $_FILES["file"]["name"][$x] . "<br />";
	    $file_name = $_FILES['file']['name'][$x];
	    echo "Type: " . $_FILES['file']['type'][$x] . "<br />";
	    echo "Size: " . ($_FILES['file']['size'][$x] / 1024) . " Kb<br />";
	    //echo "Temp file: " . $_FILES['file']['tmp_name'][$x] . "<br />";
	
	    if (file_exists("upload/" . $_FILES['file']['name'][$x]))
	      {
	      echo $_FILES['file']['name'][$x] . " already exists. ";
	      }
	    else
	      {
	      move_uploaded_file($_FILES['file']['tmp_name'][$x],
	      "upload/" .$username. "/" . $_FILES['file']['name'][$x]);
	      echo "Stored in: " . "/upload/" . $username . "/" . $_FILES['file']['name'][$x];
	      $location = "upload/" . $_SESSION['username'];
	      
	      }
	    }
	  }
	else
	  {
	  echo "Invalid file2";
	  }
	   echo "</br>";
	  echo "File: " . $file_name;
	  echo "</br>";
	  echo "Location: ".$location;
	   echo "</br>";
	  //echo $username;
	  //echo "</br>";
	  $qry = "INSERT INTO files (file_name, location, owner_id) VALUES ('$file_name', '$location', '$username')";
	 // echo "</br> " . $qry;
	  $result = mysql_query($qry);
	  
	  if($result)
	  {
		  echo "file added to DB";
	  }
	  else
	  {
		  echo "file not added to DB " . $result;
	  }
}



  
  ?>
  
  
  

		
		</div>
		
		
		
				
      	
	</div>

	</body>
	
</HTML>