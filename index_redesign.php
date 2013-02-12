<?php

	session_start();
	
?>

<HTML>

<HEAD>

<TITLE>mytrive redesign</TITLE>

<link rel="stylesheet" type="text/css" href="css/redesign.css" />
<script type="text/javascript" src="includes/submitenter.js" language="javascript"></script>


<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<link rel="icon" 
      type="image/png" 
      href="images/favicon.ico">


</HEAD>
<BODY>
<div id="nav-banner">
<nav>
<a href="#" ><img src = "images/trive.png" id="logo"></a>
<ul>
<li><a href="#">Signup</a></li>
<li><a href="#">How it Works</a></li>
<li><a href="#">Why use myTrive</a></li>
</ul>
<form action = "login.php" method ="post">
<input type="text" name="username" placeholder="username" onkeypress="return submitenter(this,event)"/>
<input type="password" name="username" placeholder="password" onkeypress="return submitenter(this,event)"/>
</form>

</nav>
</div>

<section>
<form action = "register.php" method = "POST">
<label>Username</label>
<input type="text" name="username" placeholder="username"/>
<label>Email</label>
<input type="text" name="email" placeholder="email"/>
<label>Password</label>
<input type="password" name="password" placeholder="password"/>
<label>Confirm Password</label>
<input type="password" name="cpassword" placeholder="confirm password" onkeypress="return submitenter(this,event)"/>
</form>
</section>


</BODY>
</HTML>