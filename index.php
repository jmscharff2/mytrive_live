<!DOCTYPE html>
<HTML lang="en-us">




<HEAD>
	<meta charset="utf-8"/>
	
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
<!--top banner-->
<div id="nav-banner">
<nav>
<a href="#nav-banner" ><img src = "images/trive.png" id="logo"></a>
<ul>
<li><a href="#signup">Signup</a></li>
<li><a href="#how_it_works">How it Works</a></li>
<li><a href="#use">Why use myTrive</a></li>
</ul>
<form action = "login.php" method ="post">
	<input type="text" name="username" id="username" class="placeholder" placeholder="username"/>
	<input type="password" name="password" id="password" class="placeholder" placeholder="password" onkeypress="return submitenter(this,event)"/>
	<input type="submit" name="login" value="Submit"hidden="true"/>  
</form>
</nav>
</div>


<!--registration form -->
<section>
<form action = "register.php" method = "POST" id="signup">
<label>Username</label>
<input type="text" name="username" placeholder="username"/>
<label>Email</label>
<input type="text" name="email" placeholder="email" pattern=".+@.+\..+"/>
<label>Password</label>
<input type="password" name="password" placeholder="password" pattern=".+@.+\..+" onkeypress="return submitenter(this,event)"/>
<label>Confirm Password</label>
<input type="password" name="cpassword" placeholder="confirm password"/>
<label>Registration Code</label>
<input type="text" name="code" placeholder="registration code"  onkeypress="return submitenter(this,event)"/>
</form>
</section>

<!--pricing table-->
<ul class="pricing_table">
	<!-- Active/Hover styles -->
	<li>
		<h3>More Filez</h3>
		<div class="price_body">
			<div class="price">
				<span class="price_figure">$$</span>
				<span class="price_term">per month</span>
			</div>
		</div>
		<div class="features">
			<ul>
				<li>Storage Size</li>
				<li>upload/download</li>
				<li>Unlimited Sharing</li>
				<li><strong>20</strong> invites for friends</li>
				<li>Customizable Profile Page</li>
			</ul>
		</div>
		<div class="footer">
			<a href="#" class="action_button">Coming Soon!</a>
		</div>
	</li>
	
	<li class="active">
		<h3>Some Filez</h3>
		<div class="price_body">
			<div class="price">
				Free
			</div>
		</div>
		<div class="features">
			<ul>
				<li>Storage Size</li>
				<li>upload/download</li>
				<li>Unlimited Sharing</li>
				<li><strong>10</strong> invites for friends</li>
				<li>Customizable Profile Page</li>
			</ul>
		</div>
		<div class="footer">
			<a href="#" class="action_button">Signup</a>
		</div>
	</li>
	
	<li>
		<h3>Lots of Filez</h3>
		<div class="price_body">
			<div class="price">
				<span class="price_figure">$$$</span>
				<span class="price_term">per month</span>
			</div>
		</div>
		<div class="features">
			<ul>
				<li>Storage Size</li>
				<li>upload/download</li>
				<li>Unlimited Sharing</li>
				<li><strong>50</strong> invites for friends</li>
				<li>Customizable Profile Page</li>
			</ul>
		</div>
		<div class="footer">
			<a href="#" class="action_button">Coming Soon!</a>
		</div>
	</li>
	<!-- To prevent .pricing_table height collapse(as its children are floated) -->
	<div class="clr"></div>
</ul>

<!--pricing table here-->


<!--information about mytrive -->

<article id="how_it_works">
<h1>How does mytrive work?</h1>
<p>TLorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam commodo accumsan faucibus. Donec non nisi sed turpis consequat molestie laoreet a mi. Aenean elementum, urna a volutpat ullamcorper, nibh sem tempor elit, ut pharetra elit dolor quis lorem. In hac habitasse platea dictumst. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In hac habitasse platea dictumst. Vivamus consequat diam at sapien ultrices sodales suscipit arcu imperdiet. Curabitur luctus congue erat ut tempus.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam commodo accumsan faucibus. Donec non nisi sed turpis consequat molestie laoreet</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam commodo accumsan faucibus. Donec non nisi sed turpis consequat molestie laoreet a mi. Aenean elementum, urna a volutpat ullamcorper, nibh sem tempor elit, ut pharetra elit dolor quis lorem. In hac habitasse platea dictumst. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In hac habitasse platea dictumst. Vivamus consequat diam at sapien ultrices sodales suscipit arcu imperdiet. Curabitur luctus congue erat ut tempus.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam commodo accumsan faucibus. Donec non nisi sed turpis consequat molestie laoreet</p>
<center>
<p><h2><a href="info_redesign.php">Once you sign up what do I do?</a></h2></p>
</center>
</article>

<article id="use">
<h1>Why use mytrive?</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam commodo accumsan faucibus. Donec non nisi sed turpis consequat molestie laoreet a mi. Aenean elementum, urna a volutpat ullamcorper, nibh sem tempor elit, ut pharetra elit dolor quis lorem. In hac habitasse platea dictumst. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In hac habitasse platea dictumst. Vivamus consequat diam at sapien ultrices sodales suscipit arcu imperdiet. Curabitur luctus congue erat ut tempus.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam commodo accumsan faucibus. Donec non nisi sed turpis consequat molestie laoreetLorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam commodo accumsan faucibus. Donec non nisi sed turpis consequat molestie laoreet a mi. Aenean elementum, urna a volutpat ullamcorper, nibh sem tempor elit, ut pharetra elit dolor quis lorem. In hac habitasse platea dictumst. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In hac habitasse platea dictumst. Vivamus consequat diam at sapien ultrices sodales suscipit arcu imperdiet. Curabitur luctus congue erat ut tempus.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam commodo accumsan faucibus. Donec non nisi sed turpis consequat molestie laoreet</p>
</article>

</BODY>
</HTML>