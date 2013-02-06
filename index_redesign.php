<?php

	session_start();
	
?>

<HTML>

<HEAD>

<TITLE>mytrive redesign</TITLE>

<link rel="stylesheet" type="text/css" href="css/redesign.css" />

<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<link rel="icon" 
      type="image/png" 
      href="images/favicon.ico">


</HEAD>
<BODY>
<nav>
<a href="#" ><img src = "images/trive.png" id="logo"></a>
<ul>
<li><a href="#">Profile</a></li>
<li><a href="#">Files</a></li>
<li><a href="#">Friends</a></li>

<li><input type="text" name="username" placeholder="username"/></li>
<li><input type="password" name="username" placeholder="password"/></li>

</ul>
</nav>

<section>
<form>
<label>Username</label>
<input type="text" name="username" placeholder="username"/>
<label>Email</label>
<input type="text" name="email" placeholder="email"/>
<label>Password</label>
<input type="password" name="password" placeholder="password"/>
<label>Confirm Password</label>
<input type="password" name="cpassword" placeholder="confirm password"/>
</form>
</section>


</BODY>
</HTML>