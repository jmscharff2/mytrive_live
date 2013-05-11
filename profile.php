<!DOCTYPE html>


<?php
	session_start();
	$username = $_SESSION['username'];
	
	$DateOfRequest = date('Y-m-d H:i:s'); 
			
			/*Mongo DB script for logging users actions*/
			$mdb = new MongoClient();
			$db = $mdb -> mytrive;
			$coll = $db -> users;
			
			$insert = array( "username" => $login, "date" => $DateOfRequest, "page" => "profile");
			$coll -> insert($insert);
	
	
	require_once('config.php');
	require_once('includes/amazon.php');

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
	
	
	$qry = "SELECT background_image FROM users WHERE username = '$username'";
		$result = mysql_query($qry);
		$x = 0;
		
		if($result)
		{
			if(mysql_num_rows($result) > 0)
			{
				while ($x < mysql_num_rows($result))
				{
					$member = mysql_fetch_assoc($result);
					
					$file4 = $member['background_image'];
					$bucket4 = "mytrive_files";
					$download_file_string4 = gs_prepareS3URL($file4, $bucket4);
					
					if($member['background_image'] != '')
					{
						$background_image = $download_file_string4;
					}
					$x++;
				}
			}
		}

	

?>

<HTML lang="en-us">
<?php
	if(!(isset($_SESSION['username'])))
	{
		echo '<meta http-equiv="Refresh" content="0; URL=http://www.mytrive.com/index.php">';

	}
	?>

<HEAD>
	<meta charset="utf-8"/>
	
	<TITLE>mytrive profile redesign</TITLE>

<link rel="stylesheet" type="text/css" href="css/design.css" />
<style type="text/css">@import url(/js/jquery.plupload.queue/css/jquery.plupload.queue.css);</style>

<script type="text/javascript" src="includes/submitenter.js" language="javascript"></script>
	<script src="js/jquery.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/plupload.js"></script>
	<script type="text/javascript" src="js/plupload.gears.js"></script>
	<script type="text/javascript" src="js/plupload.silverlight.js"></script>
	<script type="text/javascript" src="js/plupload.flash.js"></script>
	<script type="text/javascript" src="js/plupload.browserplus.js"></script>
	<script type="text/javascript" src="js/plupload.html4.js"></script>
	<script type="text/javascript" src="js/plupload.html5.js"></script>

<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>
<script type="text/javascript" src="/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script type="text/javascript" src="/js/plupload.full.js"></script>
<script type="text/javascript" src="/js/jquery.ui.plupload/jquery.ui.plupload.js"></script>


<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<link rel="icon" 
      type="image/png" 
      href="images/favicon.ico">


<script>

$(document).ready(function(){


	
		
	
	/*file drop jquery*/
	$('#file_drop').on(
    'dragover',
    function(e) {
        e.preventDefault();
        e.stopPropagation();
		    }
		)
		$('#file_drop').on(
		    'dragenter',
		    function(e) {
		        e.preventDefault();
		        e.stopPropagation();
		    }
		)
		$('#file_drop').on(
		    'drop',
		    function(e){
		        if(e.originalEvent.dataTransfer){
		            if(e.originalEvent.dataTransfer.files.length) {
		                e.preventDefault();
		                e.stopPropagation();
		                /*UPLOAD FILES HERE*/
		                upload(e.originalEvent.dataTransfer.files);
		            }   
		        }
		    }
		);
		function upload(files){
		   alert('Upload '+files.length+' File(s).'); 
		   document.getElementById("#drop_submit").click();
		   
		}
		


	
	
});








		
		
		
		$(function() {

			$("#html5_uploader").pluploadQueue({
			
			     // General settings
			     runtimes : 'html5',
			     url : 'upload_file.php',
			     max_file_size : '10000mb',
			     chunk_size : '1mb',
			     unique_names : false,
			     // Resize images on clientside if we can
			     resize : {width : 320, height : 240, quality : 90},
			     // Specify what files to browse for
			     filters : [	
			        {title : "Image files", extensions : "jpg,gif,png"},
					{title : "Zip files", extensions : "zip, gzip,tar.gz, gz"},
					{title : "Video files", extensions : "m4v,avi,mkv, mp4"},
					{title : "Document Files", extensions : "doc,docx,odt,xls,xlsx,ppt,pptx"},
					{title : "Book Files", extensions : "mobi"}	
			     ]	
			     });
			 });
			 
			 function showDiv(section) {
			if(section == "friend_content")
			{
				document.getElementById(section).style.display = "block";
				document.getElementById('file_content').style.display = "none";
				document.getElementById('friend_files').style.display = "none";
				document.getElementById('upload').style.display = "none";
				document.getElementById('file_drop').style.display = "block";
			}
			if(section == "file_content")
			{
				document.getElementById(section).style.display = "block";
				document.getElementById('friend_content').style.display = "none";
				document.getElementById('friend_files').style.display = "none";
				document.getElementById('upload').style.display = "none";
				document.getElementById('file_drop').style.display = "block";
			}
			if(section == "friend_files")
			{
				document.getElementById(section).style.display = "block";
				document.getElementById('friend_content').style.display = "none";
				document.getElementById('file_content').style.display = "none";
				document.getElementById('upload').style.display = "none";
				document.getElementById('file_drop').style.display = "block";

			}
			if(section == "upload")
			{
				document.getElementById(section).style.display = "block";
				document.getElementById('friend_content').style.display = "none";
				document.getElementById('file_content').style.display = "none";
				document.getElementById('friend_files').style.display = "none";
				document.getElementById('file_drop').style.display = "none";
			}
		}

</script>


</HEAD>

<BODY>

<style type="text/css">
	body
	{
		background-image: url('<?php echo $background_image; ?>');
	}
</style>


<!--top banner-->
<div id="nav-banner">
<nav>
<a href="index_redesign.php" ><img src = "images/trive.png" id="logo"></a>
<ul>
<li><a href="#profile" onclick="showDiv('file_content')">Profile</a></li>
<li><a href="#friends" onclick="showDiv('friend_content')">Friends</a></li>
<li><a href="#friends_files" onclick="showDiv('friend_files')">Friends Files</a></li>
<li><a href="#upload" onclick="showDiv('upload')">Upload</a></li>
</ul>



</nav>
</div>

<section id="content">

	<section id="profile_content">
		<section id="profile_picture">

		<?php 
		$qry = "SELECT * FROM users WHERE username = '$username'";
		$result = mysql_query($qry);
		$x = 0;
		
		if($result)
		{
			if(mysql_num_rows($result) > 0)
			{
				while ($x < mysql_num_rows($result))
				{
					$member = mysql_fetch_assoc($result);
					
					$file2 = $member['profile_picture'];
					$bucket2 = "mytrive_files";
					$download_file_string2 = gs_prepareS3URL($file2, $bucket2);
					
					if($member['profile_picture'] != '')
					{
						echo "<img src='".$download_file_string2."' height='100px'/>";
					}
					else
					{
						echo "<img src='../images/placeholder.jpg' height='100px'/>";
					}
					$x++;
				}
			}
		}
		
		
		?>	









		</section>	
		Username: <?php echo $username; ?><br>
		
		<a href="settings.php">Settings</a><br>
		<a href=logout.php>logout</a>
		</section>
	<section id="file_drop">
		File Drop
	</section>
	
		<section id="friend_content" style="display: none;">
		<h2>Friends</h2>
		<form action = "request_friend_script.php" method = "POST">
		<input type="text" name="friend_username" placeholder="Add New Friends" onkeypress="return submitenter(this,event)" style="width: 150px; border: 1px solid black;">
		</form>
		
			<?php
				$user_id = $_SESSION['user_id'];
				$qry2 = "SELECT * FROM friends WHERE (friend1 = '$user_id' OR friend2 = '$user_id') AND accepted = 1";
				$result2 = mysql_query($qry2);
				$x = 0;
				
				
				
				if($result2)
				{
					if(mysql_num_rows($result2) > 0)
					{
						while ($x < mysql_num_rows($result2))
						{
							$member4 = mysql_fetch_assoc($result2);
							if($member4['friend1'] != $user_id)
							{
								$friend_id = $member4['friend1'];
								$qry3 = "SELECT username, first_name, last_name, profile_picture FROM users WHERE user_id = '$friend_id'";
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
												echo "<a href=friends_profile.php?friends_user_id=".$friend_id.">".$member3['first_name']." ".$member3['last_name']."</a><br>";
												$file3 = $member3['profile_picture'];
												$bucket3 = "mytrive_files";
												$download_file_string3 = gs_prepareS3URL($file3, $bucket3);
												
												if($member['profile_picture'] != null)
												{
													echo "<img src='".$download_file_string3."' height='100px'/><br>";
												}
												else
												{
													echo "<img src='../images/placeholder.jpg' height='100px'/><br>";
												}

												
											}
											else
											{
												echo "<a href=friends_profile.php?friends_user_id=".$friend_id.">".$member3['username']."</a><br>";
												$file3 = $member3['profile_picture'];
												$bucket3 = "mytrive_files";
												$download_file_string3 = gs_prepareS3URL($file3, $bucket3);
												
												if($member['profile_picture'] != null)
												{
													echo "<img src='".$download_file_string3."' height='100px'/><br>";
												}
												else
												{
													echo "<img src='../images/placeholder.jpg' height='100px'/><br>";
												}
		
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
												echo "<a href=friends_profile.php?friends_user_id=".$friend_id.">".$member3['first_name']." ".$member3['last_name']."</a><br>";
												$file3 = $member3['profile_picture'];
												$bucket3 = "mytrive_files";
												$download_file_string3 = gs_prepareS3URL($file3, $bucket3);
												
												if($member['profile_picture'] != null)
												{
													echo "<img src='".$download_file_string3."' height='100px'/><br>";
												}
												else
												{
													echo "<img src='../images/placeholder.jpg' height='100px'/><br>";
												}
											}
											else
											{
												echo "<a href=friends_profile.php?friends_user_id=".$friend_id.">".$member3['username']."</a><br>";
												$file3 = $member3['profile_picture'];
												$bucket3 = "mytrive_files";
												$download_file_string3 = gs_prepareS3URL($file3, $bucket3);
												
												if($member['profile_picture'] != null)
												{
													echo "<img src='".$download_file_string3."' height='100px'/><br>";
												}
												else
												{
													echo "<img src='../images/placeholder.jpg' height='100px'/><br>";
												}
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
						}
					}
				}

				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
							
			?>
		
			<!--
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			-->
		</section>
		
		<section id="friend_files" style="display: none;">
		<h2>Friends Files</h2>
		
		
		<?php
		
		
		$qry2 = "SELECT * FROM friends WHERE (friend1 = '$user_id' OR friend2 = '$user_id') AND accepted = 1";
				$result2 = mysql_query($qry2);
				$x = 0;
				
				
				
				if($result2)
				{
					if(mysql_num_rows($result2) > 0)
					{
						while ($x < mysql_num_rows($result2))
						{
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
												echo "<a href=friends_profile.php?friends_user_id=".$friend_id.">".$member3['first_name']." ".$member3['last_name']."</a><br>";
												//Display friends files willing to share
												$friends_files_qry = "SELECT * FROM files WHERE owner_user_id = '$friend_id' AND want_to_share = 1";
													$friends_files_result = mysql_query($friends_files_qry);
													$z = 0;
													if($friends_files_result)
													{
														if(mysql_num_rows($friends_files_result) > 0)
														{
															while ($z < mysql_num_rows($friends_files_result))
															{
																$friends_files_member = mysql_fetch_assoc($friends_files_result);
																$file_id = $friends_files_member['file_id'];
																echo "<a href='file_settings.php?file_id=".$friends_files_member['file_id']."'>".$friends_files_member['file_name']."</a>";
																
																if($friends_files_member['share_with'] != $username)
																{
																	echo "<a href=request_file_share.php?file_id=".$file_id."><img src='images/Share.png'height='20'/></a><br>";
																}
																else
																{
																	echo ": Currently shared with you.<br>";
																}
																
																
																$z++;
															}
														}
													}
											}
											else
											{
												echo "<a href=friends_profile.php?friends_user_id=".$friend_id.">".$member3['username']."</a><br>";
												//Display friends files willing to share
												$friends_files_qry = "SELECT * FROM files WHERE owner_user_id = '$friend_id' AND want_to_share = 1";
													$friends_files_result = mysql_query($friends_files_qry);
													$z = 0;
													if($friends_files_result)
													{
														if(mysql_num_rows($friends_files_result) > 0)
														{
															while ($z < mysql_num_rows($friends_files_result))
															{
																$friends_files_member = mysql_fetch_assoc($friends_files_result);
																$file_id = $friends_files_member['file_id'];
																echo "<a href='file_settings.php?file_id=".$friends_files_member['file_id']."'>".$friends_files_member['file_name']."</a>";
																
																if($friends_files_member['share_with'] != $username)
																{
																	echo "<a href=request_file_share.php?file_id=".$file_id."><img src='images/Share.png'height='20'/></a><br>";
																}
																else
																{
																	echo ": Currently shared with you.<br>";
																}
																$z++;
															}
														}
													}
		
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
												echo "<a href=friends_profile.php?friends_user_id=".$friend_id.">".$member3['first_name']." ".$member3['last_name']."</a><br>";
												//Display friends files willing to share
												$friends_files_qry = "SELECT * FROM files WHERE owner_user_id = '$friend_id' AND want_to_share = 1";
													$friends_files_result = mysql_query($friends_files_qry);
													$z = 0;
													if($friends_files_result)
													{
														if(mysql_num_rows($friends_files_result) > 0)
														{
															while ($z < mysql_num_rows($friends_files_result))
															{
																$friends_files_member = mysql_fetch_assoc($friends_files_result);
																$file_id = $friends_files_member['file_id'];
																echo "<a href='file_settings.php?file_id=".$friends_files_member['file_id']."'>".$friends_files_member['file_name']."</a>";
																
																if($friends_files_member['share_with'] != $username)
																{
																	echo "<a href=request_file_share.php?file_id=".$file_id."><img src='images/Share.png'height='20'/></a><br>";
																}
																else
																{
																	echo ": Currently shared with you.<br>";
																}
																
																
																$z++;
															}
														}
													}
											}
											else
											{
												echo "<a href=friends_profile.php?friends_user_id=".$friend_id.">".$member3['username']."</a><br>";
												//Display friends files willing to share
												$friends_files_qry = "SELECT * FROM files WHERE owner_user_id = '$friend_id' AND want_to_share = 1";
													$friends_files_result = mysql_query($friends_files_qry);
													$z = 0;
													if($friends_files_result)
													{
														if(mysql_num_rows($friends_files_result) > 0)
														{
															while ($z < mysql_num_rows($friends_files_result))
															{
																$friends_files_member = mysql_fetch_assoc($friends_files_result);
																$file_id = $friends_files_member['file_id'];
																echo "<a href='file_settings.php?file_id=".$friends_files_member['file_id']."'>".$friends_files_member['file_name']."</a>";
																
																if($friends_files_member['share_with'] != $username)
																{
																	echo "<a href=request_file_share.php?file_id=".$file_id."><img src='images/Share.png'height='20'/></a><br>";
																}
																else
																{
																	echo ": Currently shared with you.<br>";
																}
																
																
																$z++;
															}
														}
													}
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
						}
					}
				}
				
				
				
		$qry4 = "SELECT * FROM friends WHERE (friend1 = '$user_id' OR friend2 = '$user_id') AND accepted = 0";
		$result4 = mysql_query($qry4);
		$x = 0;
		
		if($result4)
		{
			if(mysql_num_rows($result4) > 0)
			{
				echo"<h2>Pending Friends</h2>";
				while($x < mysql_num_rows($result4))
				{
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
				}
			}
		}
		
				
				
				

		
		?>
		
		
		<!--
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			<img src="../images/placeholder.jpg"/>
			-->
		</section>
		
		<section id="upload" style="display: none;">
		<!--<style type="text/css">@import url(/js/jquery.plupload.queue/css/jquery.plupload.queue.css);</style>
		<div id="html5_uploader">You browser doesn't support native upload. Try Firefox 3 or Safari 4.</div>	
		-->
		
		<div id="container">
	   <!-- <div id="filelist">No runtime found.</div>
	    <br />
	    <a id="pickfiles" href="javascript:;">[Select files]</a> 
	    <a id="uploadfiles" href="javascript:;">[Upload files]</a>
	    </div>
		</center>-->
		<div id="html5_uploader">You browser doesn't support native upload. Try Firefox 3 or Safari 4.</div>

		</div>
<!--
		<script>
		
function $(id) {
	return document.getElementById(id);	
}


var uploader = new plupload.Uploader({
	runtimes : 'gears,html5,flash,silverlight,browserplus',
	browse_button : 'pickfiles',
	container: 'container',
	max_file_size : '10000mb',
	chunk_size : '10mb',
	url : 'upload_file.php',
	resize : {width : 320, height : 240, quality : 90},
	flash_swf_url : 'js/plupload.flash.swf',
	silverlight_xap_url : 'js/plupload.silverlight.xap',
	filters : [
		{title : "Image files", extensions : "jpg,gif,png"},
		{title : "Zip files", extensions : "zip, gzip, tar.gz, gz"},
		{title : "Video files", extensions : "m4v,avi,mkv, mp4"},
		{title : "Document Files", extensions : "doc, docx, odt, xls, xlsx, ppt, pptx"},
		{title : "Book Files", extensions : "mobi"}
	]
});

uploader.bind('Init', function(up, params) {
	$('filelist').innerHTML = "<div>Current runtime: " + params.runtime + "</div>";
});

uploader.bind('FilesAdded', function(up, files) {
	for (var i in files) {
		$('filelist').innerHTML += '<div id="' + files[i].id + '">' + files[i].name + ' (' + plupload.formatSize(files[i].size) + ') <b></b></div>';
	}
});

uploader.bind('UploadProgress', function(up, file) {
	$(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
});


$('uploadfiles').onclick = function() {
	uploader.start();
	return false;
};

uploader.init();

</script>
		-->
			
		</section>
		
		
		
	<section id="file_content">
		<h2>Files</h2>
		
		<ul id ="file_list">
		
		<?php
		
		
			$qry = "SELECT * FROM files WHERE owner_id = '$username'";
			$result = mysql_query($qry);
			
			$x = 0;
			
			if($result)
			{
				if(mysql_num_rows($result) > 0)
				{
					while ($x < mysql_num_rows($result))
					{
						$member = mysql_fetch_assoc($result);
						$ext = end(explode('.', $member['file_name']));
						
						echo "<li class='files'>";
						
						/*$member['file_name'];*/
						echo "<a href='file_settings.php?file_id=".$member['file_id']."'><span class='file_type'>".$member['file_name']."</span></a>";

						$file2 = $member['owner_id']."/".$member['file_name'];
						$bucket2 = "mytrive_files";
						$download_file_string2 = gs_prepareS3URL($file2, $bucket2);	 
						 ?>
						 <a href="<?php echo $download_file_string2; ?>"><img src="images/Download.png" height="20"/> </a><?php
						echo "<a href='file_delete.php?file=".$member['file_name']."'><img src='images/Delete.png'height='20'/></a>";
						echo "<a href='share_file.php?file=".$member['file_name']."'><img src='images/Share.png'height='20'/></a>";
				
						if($ext == 'm4v' || $ext == 'avi' || $ext == 'mkv')
						{
							echo "<a href='play_video.php?file_id=".$member['file_id']."'><img src='images/Play.png'height='20'/></a>";	
						}
						if($member['share_with'] != '')
						{
							echo "<a href='stop_sharing.php?file=".$member['file_name']."'><img src='images/Stop.png' height='20'/></a>";
						}
						
						echo "<li><br>";
						/*
						if($ext == 'png' || $ext == 'jpg' || $ext == 'gif' || $ext == 'psd')
						{
							echo "<li class='files'>";
							echo $member['file_name'];
							echo "<br><img src='../images/placeholder.jpg'/></li><br>";
						}
						elseif($ext == 'mov' || $ext == 'm4v' || $ext == 'avi' || $ext == 'mkv')
						{
							echo "<li class='files'>";
							echo $member['file_name'];
							echo "<br><img src='../images/movie.png'/></li><br>";							
						}
						else
						{
							echo "<li class='files'>";
							echo $member['file_name'];
							echo "<br><img src='../images/document.png'/></li><br>";
						}
						*/
						$x++;
					}
				}
			}
			
			
			
	echo  "<br><br><h2>Shared Files</h2>";


	$qry2 = "SELECT * FROM files WHERE share_with = '$username'";
	$result2 = mysql_query($qry2);
	$x = 0;
	if($result2)
	{
	if(mysql_num_rows($result2) > 0)
	{
		while ($x < mysql_num_rows($result2))
		{
			$member2 = mysql_fetch_assoc($result2);
			
			$ext = end(explode('.', $member2['file_name']));

			
			echo "<a href='file_settings.php?file_id=".$member2['file_id']."'>".$member2['file_name']."</a>";
			 
			$file2 = $member2['owner_id']."/".$member2['file_name'];
			$bucket2 = "mytrive_files";
			$download_file_string2 = gs_prepareS3URL($file2, $bucket2);

			 
			 ?>
			 <a href="<?php echo $download_file_string2; ?>"><img src="images/Download.png" height="25"/> </a>

			 <?php
			if($ext == 'm4v' || $ext == 'avi' || $ext == 'mkv')
			{
				echo "<td><a href='play_video.php?file_id=".$member2['file_id']."'><img src='images/Play.png'height='25'/></a>";	
			}
			echo "<br>";
			echo "Shared by:	 ".$member2['owner_id'];
			echo "<br>";	
			$x++;
			
		}
	}


}

		
		
				
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
					
					echo "<a href=approve_file_share_script.php?request_id=".$member6['request_id'].">Approve</a>/";
					echo "<a href=reject_file_share_script.php?request_id=".$member6['request_id'].">Reject</a>";
					echo "<br>";
					$x++;
				}
			}
		}
		?>
		
		
		
	
		
		
		
		
					<!--
					
					<li class="files" id="Movie"><h3 style="display:none;">Movies</h3><img src="../images/document.png"/></li>
					<li class="files" id="Movie"><h3 style="display:none;">Movies</h3><img src="../images/document.png"/></li>
					<li class="files" id="Books"><h3 style="display:none;">Books</h3><img src="../images/movie.png"/></li>
					<li class="files" id="Movie"><h3 style="display:none;">Movies</h3><img src="../images/movie.png"/></li>
					<li class="files" id="Documents"><h3 style="display:none;">Documents</h3><img src="../images/placeholder.jpg"/></li>
					<li class="files" id="Book"><h3 style="display:none;">Books</h3><img src="../images/placeholder.jpg"/></li>
					<li class="files" id="Documents"><h3 style="display:none;">Documents</h3><img src="../images/placeholder.jpg"/></li>
					<li class="files" id="Documents"><h3 style="display:none;">Documents</h3><img src="../images/placeholder.jpg"/></li>
					-->
					</ul>
				<!--	
				<div id="file_information"> 
				<img src="images/Stop.png" height="5%"/>
				<img src="images/Delete.png"height="20%"/>
				<img src="images/Share.png"height="20%"/>
				<img src="images/Play.png"height="20%"/>
				-->	
			</div>
			
		</section>

	
</section>
<!--
<div id ="filters">
<input id="filer" type="text" name="fname" /><br>
</div>
-->


</BODY>


</HTML>