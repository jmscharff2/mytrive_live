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
		echo '<meta http-equiv="Refresh" content="1; URL=http://www.mytrive.com">';

	}
	
	
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


?>
<body>
<div class="scroll"></div>
        <?php include 'includes/sidenav.html';?>

<div id="main-content-wrapper">

	<div id="registration-mascot">
		<img src = "images/mascot.png" height="100%">

	</div>
	<center>
	<div id="registration-fields">
		<RF1>Upload your files below<br></RF1>
		<RF2>Click on upload to upload multiple files!</RF2><br><br>
	
		<div id="container">
	    <div id="filelist">No runtime found.</div>
	    <br />
	    <a id="pickfiles" href="javascript:;">[Select files]</a> 
	    <a id="uploadfiles" href="javascript:;">[Upload files]</a>
	    </div>
	</center>
</div>


<script type="text/javascript">
            // Custom example logic
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
		{title : "Video files", extensions : "m4v,avi,mkv"},
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
    </div>			
	</div>
	</div>
	
	<?php include 'includes/footer.html'?>
</body>

</html>