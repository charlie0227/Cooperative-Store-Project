<!DOCTYPE HTML>
<!--
	Prologue by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->


<html>
	<head>
		<title>Prologue by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>
		<!-- Header -->
			<div id="header">		
				<div class="top">
					
					<!-- Log In -->
					
				
						<div id="logo">
						
							<form method="post" action="#">
								<div class="row">
								
									<div><input id="sign_in_self" type="text" name="name" placeholder="Account" /></div>
									<BR>
									<div><input id="sign_up_self" type="text" name="email" placeholder="Password"  /></div>
								</div>
							</form>
							<br>
							<div>
							<input id="submit_self" type="submit" value="Sign in" />
							</div>
							<br>
							<div>
							<input id="submit_sign_up" type="submit" value="Sign up" onclick="tttt();" />
							</div>
							</form>
							<!--<span class="image avatar48"><img src="images/avatar.jpg" alt="" /></span>-->

						</div>
					
		
					<!-- Nav -->
						<nav id="nav">
							<!--

								Prologue's nav expects links in one of two formats:

								1. Hash link (scrolls to a different section within the page)

								   <li><a href="#foobar" id="foobar-link" class="icon fa-whatever-icon-you-want skel-layers-ignoreHref"><span class="label">Foobar</span></a></li>

								2. Standard link (sends the user to another page/site)

								   <li><a href="http://foobar.tld" id="foobar-link" class="icon fa-whatever-icon-you-want"><span class="label">Foobar</span></a></li>

							-->
							<ul>
								<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Intro</span></a></li>
								<li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Portfolio</span></a></li>
								<li><a href="#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">About Me</span></a></li>
								<li><a href="#contact" id="contact-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Contact</span></a></li>
							</ul>
						</nav>

				</div>

				<div class="bottom">

					<!-- Social Icons -->
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
						</ul>

				</div>

			</div>

		<!-- Main -->
			<div id="main">
				<!-- Intro -->
					<section id="top">
						<header>
							<h2>Intro</h2>
						</header>
						<!--<div class="container">

							<header>
								
							</header>

							<footer>
								<a href="#portfolio" class="button scrolly">Magna Aliquam</a>
							</footer>

						</div>
						-->
					</section>

				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">

							<header>
								<h2>Portfolio</h2>
							</header>

							<p>
							<a href="#" class="big-link" data-reveal-id="myModal" > Fade 效果觸發點 </a>
							</p>

							<div class="row">
								
							</div>

						</div>
					</section>

				<!-- About Me -->
					<section id="about" class="three">
						<div class="container">

							<header>
								<h2>About Me</h2>
							</header>

							
							<p>
							</p>

						</div>
					</section>

				<!-- Contact -->
					<section id="contact" class="four">
						<div class="container">

							<header>
								<h2>Contact</h2>
							</header>

							<p>
							</p>
							<form method="post" action="#">
								<div class="row">
									<div class="6u 12u$(mobile)"><input type="text" name="name" placeholder="Name" /></div>
									<div class="6u$ 12u$(mobile)"><input type="text" name="email" placeholder="Email" /></div>
									<div class="12u$">
										<textarea name="message" placeholder="Message"></textarea>
									</div>
									<div class="12u$">
										<input type="submit" value="Send Message" />
									</div>
								</div>
							</form>

						</div>
					</section>

			</div>

		<!-- Footer -->
			<div id="footer">

				<!-- Copyright -->
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>

			</div>
		<!-- TEST -->
		
		
		<a href="#" class="big-link" data-reveal-id="myModal">
		Fade and Pop
		</a>
		<div id="myModal" class="reveal-modal">
			<div id="main">
				<div class="container">
					<header>
						<h2>Log in</h2>
					</header>
					<form method="post" action="#">
						<div class="row">
							<div class="6u 12u$(mobile)"><input type="text" name="account" placeholder="account" /></div>
							<div class="6u$ 12u$(mobile)"><input type="text" name="password" placeholder="password" /></div>
							
							<div class="12u$">
								<input type="submit" value="Login" />
							</div>
						</div>
					</form>
				</div>
			</div>

		</div><br type="_moz">

		
	
		<!-- Scripts -->
			<!-- script for sign_up -->
			
			
			<script>
			 $(document).ready(function() {
				  $('#myModal').reveal();
			   });
			</script>
			<link rel="stylesheet" href="assets/css/reveal.css"> 
			<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
			<script type="text/javascript" src="assets/js/jquery.reveal.js"></script>
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollzer.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>