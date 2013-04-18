<!DOCTYPE html>
<HTML lang="en-us">

<HEAD>
	<meta charset="utf-8"/>
	
	<TITLE>mytrive profile redesign</TITLE>

<link rel="stylesheet" type="text/css" href="css/design.css" />
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
		
		s


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
<li><a href="index_redesign.php">Profile</a></li>
<li><a href="info_redesign.php">Files</a></li>
<li><a href="faq_redesign.php">Upload</a></li>
</ul>
<form action = "login.php" method ="post">
<input type="text" name="username" placeholder="username" onkeypress="return submitenter(this,event)"/>
<input type="password" name="username" placeholder="password" onkeypress="return submitenter(this,event)"/>
</form>
</nav>
</div>

<section id="content">


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
	
	
</section>


</BODY>


</HTML>

