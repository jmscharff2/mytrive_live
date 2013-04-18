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


<script>

$(document).ready(function(){

	var shown = false;
	
	$(".files").hover( function() {
	    if ( shown === false ) {
	        var that = $(this),
	            offset = that.offset(),
	            tooltipElement = $("#file_information");
	            
	        tooltipElement.css({
	            top: offset.top + that.height()-5,
	            left: offset.left + that.width()/2 - tooltipElement.width()/2
	        }).show();
	    }
	}, function() {
	    if ( shown === false ) {   
	        $("#file_information").hide();
	    }
	}).bind('click', function() {
	    var tooltipElement = $("#file_information"),
	        that = $(this);
	    
	    if ( shown === that.index() ) {
	        tooltipElement.hide();
	        shown = false;
	    } else {
	        shown = $(this).index();
	        
	        var that = $(this),
	            offset = that.offset(),
	            tooltipElement = $("#file_information");
	            
	        tooltipElement.css({
	            top: offset.top + that.height()-5,
	            left: offset.left + that.width()/2 - tooltipElement.width()/2
	        }).show();
	    }
	});
	
	/*filtering for files*/
	var  $files = $('#file_list'),
     $filesAll = $files.find('li'),
     $filter = $('#filters_menu');

	$filter.change(function() {
	
	    //var val1 = $filter.val();
	    var val1 = $filter.val();
	        
	    $files.empty();
	    
	    if ( val1 == 'ALL') {
	        $files.append( $namesAll );
	    }
	    else {
	        $filesAll.filter(function(i, el) {
	            var $el = $(el);
	            return ~$el.text().indexOf( val1 );
	            
	        }).appendTo( $files );
	    }
	});
	
	
});
</script>


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

	<section id="profile_content">
		<section id="profile_picture">
			<img src="../images/placeholder.jpg" height="20%"/>
		</section>
		Username: Jonathan Scharff<br>
		Storage: 2Gb/10Gb
	</section>
	
	<section id="file_content">
	<h2>Files</h2>
				<ul id ="file_list">
				<li class="files" id="Movie">Movie<img src="../images/placeholder.jpg"/></li>
				<li class="files" id="Movie"><img src="../images/placeholder.jpg"/></li>
				<li class="files" id="Books"><img src="../images/placeholder.jpg"/></li>
				<li class="files" id="Movie"><img src="../images/placeholder.jpg"/></li>
				<li class="files" id="Documents"><img src="../images/placeholder.jpg"/></li>
				<li class="files" id="Book"><img src="../images/placeholder.jpg"/></li>
				<li class="files" id="Documents"><img src="../images/placeholder.jpg"/></li>
				<li class="files" id="Documents"><img src="../images/placeholder.jpg"/></li>


			
				</ul>
<div id="file_information"> 
	<img src="images/Stop.png" height="5%"/>
	<img src="images/Delete.png"height="20%"/>
	<img src="images/Share.png"height="20%"/>
	<img src="images/Play.png"height="20%"/>	
</div>
	</section>
	
	<section id="friend_content">
	<h2>Friends</h2>  <input type="text" name="add_friend" placeholder="Add New Friends" style="width: 150px; border: 1px solid black;"/><br>
		<img src="../images/placeholder.jpg"/>
		<img src="../images/placeholder.jpg"/>
		<img src="../images/placeholder.jpg"/>
		<img src="../images/placeholder.jpg"/>
		<img src="../images/placeholder.jpg"/>
		

	
	</section>
	
</section>

<div id ="filters">
<select id="filters_menu">
<option selected> All</option>
<option>Movie</option>
<option>Documents</option>
<option>Books</option>
<option>Custom Filter</option>
<option>Custom Filter</option>
</select>
</div>

</BODY>


</HTML>