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




<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
	<script>
$(document).ready(function($) {
    $('a[href^="#"]').bind('click.smoothscroll', function(e) {
        e.preventDefault();
        
        // Get the current target hash
        var target = this.hash;
        
        if(target == '#nav-banner')
        {
	         $('html, body').stop().animate({
            'scrollTop' : 0
        }, 900, 'swing', function() {
            window.location.hash = target;
        });

        }
        else if(target == '#signup')
        {
	         $('html, body').stop().animate({
            'scrollTop' : $(target).offset().top -100
        }, 900, 'swing', function() {
            window.location.hash = target;
        }); 
        }
        
        {
        // Animate the scroll bar action so its smooth instead of a hard jump
        $('html, body').stop().animate({
            'scrollTop' : $(target).offset().top -100//+800
        }, 900, 'swing', function() {
            window.location.hash = target;
        });
        }
    });
});
	</script>



</HEAD>
<BODY>
<div id="nav-banner">
<nav>
<a href="#nav-banner" ><img src = "images/trive.png" id="logo"></a>
<ul>
<li><a href="#signup">Signup</a></li>
<li><a href="#how_it_works">How it Works</a></li>
<li><a href="#use">Why use myTrive</a></li>
</ul>
<form action = "login.php" method ="post">
<input type="text" name="username" placeholder="username" onkeypress="return submitenter(this,event)"/>
<input type="password" name="username" placeholder="password" onkeypress="return submitenter(this,event)"/>
</form>

</nav>
</div>

<section>
<form action = "register.php" method = "POST" id="signup">
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

<!--pricing table-->
<ul class="pricing_table">
	<li>
		<h3>Starter</h3>
		<div class="price_body">
			<div class="price">
				Free
			</div>
		</div>
		<div class="features">
			<ul>
				<li>Premium Profile Listing</li>
				<li>Unlimited File Access</li>
				<li>Free Appointments</li>
				<li><strong>5 Bonus Points</strong> every month</li>
				<li>Customizable Profile Page</li>
				<li><strong>2 months</strong> support</li>
			</ul>
		</div>
		<div class="footer">
			<a href="#" class="action_button">Get Started</a>
		</div>
	</li>
	<!-- Active/Hover styles -->
	<li class="active">
		<h3>Basic</h3>
		<div class="price_body">
			<div class="price">
				<span class="price_figure">$24</span>
				<span class="price_term">per month</span>
			</div>
		</div>
		<div class="features">
			<ul>
				<li>Premium Profile Listing</li>
				<li>Unlimited File Access</li>
				<li>Free Appointments</li>
				<li><strong>20 Bonus Points</strong> every month</li>
				<li>Customizable Profile Page</li>
				<li><strong>6 months</strong> support</li>
			</ul>
		</div>
		<div class="footer">
			<a href="#" class="action_button">Get Started</a>
		</div>
	</li>
	<li>
		<h3>Premium</h3>
		<div class="price_body">
			<div class="price">
				<span class="price_figure">$49</span>
				<span class="price_term">per month</span>
			</div>
		</div>
		<div class="features">
			<ul>
				<li>Premium Profile Listing</li>
				<li>Unlimited File Access</li>
				<li>Free Appointments</li>
				<li><strong>50 Bonus Points</strong> every month</li>
				<li>Customizable Profile Page</li>
				<li><strong>Lifetime</strong> support</li>
			</ul>
		</div>
		<div class="footer">
			<a href="#" class="action_button">Get Started</a>
		</div>
	</li>
	<!-- To prevent .pricing_table height collapse(as its children are floated) -->
	<div class="clr"></div>
</ul>

<!--pricing table here-->




<article id="how_it_works">
<h1>How does mytrive work?</h1>
<p>The site is very simple.  You will create an account, and have a profile page.  Here is what people will see about you along with a list of files that you upload.  You will have the ability to show different files for the ability to share with friends.</p>
<p>You can have private files and files that you are willing to share.  This is where your online life will reside.  You have facebook for your social life, you will use mytrive for the life of your digital files.</p>
</article>

<article id="use">
<h1>Why use mytrive?</h1>
<p>The idea behind mytrive was first to find a way to store your digital content.  We came by this idea because we all have a lot of movies/files/songs/etc that we want to save in a safe place.  So why not online?  Once we did that while I was in college I always would have people come over and watch movies I had or music for parties...so like facebook why not take this expierence online.  After college I came up with the idea for mytrive to store my files and be able to watch them online if they are the right kind of file.  I then said why cant I "loan" my file like I would do with a DVD.  So I built in the functionality to share with any of your friends your file.  You can only share with one at a time and depending on the file will determine if they can download it.  Obviously if you have pictures that you took on a trip you would want your friends to be able to download it.  If it is a movie then you cannot since you are not allowed to just give away copies of movies, so they will only be able to watch the movie...no different than sharing a DVD.</p>
<p>This is where mytrive will differ from a traditional social network or a dropbox type site.  It is not only for file storage but also to interact about files that you store online.  You will be able to add friends and interact with them throughout the site.</p>
</article>

</BODY>
</HTML>