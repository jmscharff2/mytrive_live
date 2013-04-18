<HTML>

<HEAD>

<TITLE>mytrive profile redesign</TITLE>

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
</section>

</section>


</BODY>


</HTML>