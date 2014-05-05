<?php
include_once 'scripts/php/db_connect.php';
include_once 'scripts/php/functions.php';

sec_session_start();
?>
        
        <!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Tune Source</title>
		<meta charset = "utf-8" />
		
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css" />
		<meta name="viewpoint" content="width=device-width, initial-scale=1.0">
	</head>

	<body class="body">
	        <?php if (login_check($mysqli) == true) : ?>

		<header class="mainheader">
		<a href="index.html"><img src='res/image/Logo.png'></a>
		
		<nav><ul>
			<li class="active"><a href="index.php">MainPage</a></li>
			<li><a href="artist.php">Artist</a></li>
			<li><a href="songs.php">Songs</a></li>
			<li><a href="albums.php">Albums</a></li>
			<li><a href="project.html">About</a></li>
		</nav></ul>
		</header>

		<div class = "content">
			<article class="Intro">
				<header>
					<h2><a href="Stuff" title="Fist Stuff">Top 10 Songs</a></h2>
				</header>
				<footer>
					<p class="information">By Calvin, Sam, Jared</p>
				</footer>
				
				<content>
				<p>	Music is a passion that should be presude by everbnody around the world Tune Sorce is a world for artisit that may upload there music onto the site and people can enjoy that music and the artist themself.
				Music is a passion that should be presude by everbnody around the world Tune Sorce is a world for artisit that may upload there music onto the site and people can enjoy that music and the artist themself.
				Music is a passion that should be presude by everbnody around the world Tune Sorce is a world for artisit that may upload there music onto the site and people can enjoy that music and the artist themself.
				Music is a passion that should be presude by everbnody around the world Tune Sorce is a world for artisit that may upload there music onto the site and people can enjoy that music and the artist themself.</p>
				</content>
			</article>
			
			<article class="Intro-middle">
				<header>
					<h2><a href="Stuff" title="Second Stuff">Top 10 Artist</a></h2>
				</header>
				<footer>
					<p class="information">By Calvin, Sam, Jared</p>
				</footer>
				
				<content>
				<p>	Music is a passion that should be presude by everbnody around the world Tune Sorce is a world for artisit that may upload there music onto the site and people can enjoy that music and the artist themself.
				Music is a passion that should be presude by everbnody around the world Tune Sorce is a world for artisit that may upload there music onto the site and people can enjoy that music and the artist themself.
				Music is a passion that should be presude by everbnody around the world Tune Sorce is a world for artisit that may upload there music onto the site and people can enjoy that music and the artist themself.
				Music is a passion that should be presude by everbnody around the world Tune Sorce is a world for artisit that may upload there music onto the site and people can enjoy that music and the artist themself.</p>
				</content>
			</article>
			
			<article class="Intro-end">
				<header>
					<h2><a href="Stuff" title="Third Stuff">Top 10 Albums</a></h2>
				</header>
				<footer>
					<p class="information">By Calvin, Sam, Jared</p>
				</footer>
				
				<content>
				<p>	Music is a passion that should be presude by everbnody around the world Tune Sorce is a world for artisit that may upload there music onto the site and people can enjoy that music and the artist themself.
				Music is a passion that should be presude by everbnody around the world Tune Sorce is a world for artisit that may upload there music onto the site and people can enjoy that music and the artist themself.
				Music is a passion that should be presude by everbnody around the world Tune Sorce is a world for artisit that may upload there music onto the site and people can enjoy that music and the artist themself.
				Music is a passion that should be presude by everbnody around the world Tune Sorce is a world for artisit that may upload there music onto the site and people can enjoy that music and the artist themself.</p>
				</content>
			</article>
		</div>
	</div>
	
	<aside class="top-sidebar">
		<article>
		<div id='basic-modal'>
		<input type='button' name='basic' value='Login' class='basic'/>
		</div>

		<!-- modal content -->
		<div id="basic-modal-content">
				        <form action="includes/process_login.php" method="post" name="login_form">
            Email<br>
            <input type="text" name="email" /><br><br>
            Password<br>
            <input type="password"
                             name="password"
                             id="password"/>  <br><br>
            <input type="button"
                   value="Login"
                   onclick="formhash(this.form, this.form.password);" />
        </form>
        <p>If you don't have a login, please <a href="register.php">register</a></p>
        <p>If you are done, please <a href="includes/logout.php">log out</a>.</p>
        <p>If you are logged in, you can view this <a href="protected_page.php">page</a></p>
        <p>You are currently logged out.</p>
		</div>
		
		<div style='display:none'>
			<img src='img/basic/x.png' alt='' />
		</div>
			 
		</article>
	</aside>
	
	<aside class="middle-sidebar">
		<article>
			<h2>Middle SideBar</h2>
			<p>Middle Side Bar put w.e you want here</p>
		</article>
	</aside>

	<aside class="bottom-sidebar">
		<article>
			<h2>Bottom SideBar</h2>
			<p>Bottom Side Bar put w.e you want here
			Bottom Side Bar put w.e you want here
			Bottom Side Bar put w.e you want here
			Bottom Side Bar put w.e you want here
			Bottom Side Bar put w.e you want here
			Bottom Side Bar put w.e you want here
			Bottom Side Bar put w.e you want here
			Bottom Side Bar put w.e you want here
			Bottom Side Bar put w.e you want here
			Bottom Side Bar put w.e you want here</p>
		</article>
	</aside>

	<footer class="mainfooter">
	<p>Copyright &copy; 2014 <a href="copyright footer" title="tunesourceWebsite">tunesource.com</a></p>
	</footer>

<?php else : ?>

		<header class="mainheader">
		<a href="index.html"><img src='res/image/Logo.png'></a>
		
		<nav><ul>
			<li class="active"><a href="index.php">MainPage</a></li>
			<li><a href="artist.php">Artist</a></li>
			<li><a href="songs.php">Songs</a></li>
			<li><a href="albums.php">Albums</a></li>
			<li><a href="project.html">About</a></li>
		</nav></ul>
		</header>

		<div class = "content">
			<article class="Intro">
				<header>
					<h2><a href="Stuff" title="Fist Stuff">Top 10 Songs</a></h2>
				</header>
				<footer>
					<p class="information">By Calvin, Sam, Jared</p>
				</footer>
				
				<content>
				<p>	Please Log in to view this content</p></content>
			</article>
			
			<article class="Intro-middle">
				<header>
					<h2><a href="Stuff" title="Second Stuff">Top 10 Artist</a></h2>
				</header>
				<footer>
					<p class="information">By Calvin, Sam, Jared</p>
				</footer>
				
				<content>
				<p>	Please Log in to view this content</p></content>
			</article>

			<article class="Intro-end">
				<header>
					<h2><a href="Stuff" title="Third Stuff">Top 10 Albums</a></h2>
				</header>
				<footer>
					<p class="information">By Calvin, Sam, Jared</p>
				</footer>
				
				<content>
				<p>Please Log in to view this content<p>
                                </content>
			</article>
		</div>
	</div>

	<aside class="top-sidebar">
		<article>
		<div id='basic-modal'>
		<input type='button' name='basic' value='Login' class='basic'/>
		</div>

		<!-- modal content -->
		<div id="basic-modal-content">
				        <form action="/process_login.php" method="post" name="login_form">
            Email<br>
            <input type="text" name="email" /><br><br>
            Password<br>
            <input type="password"
                             name="password"
                             id="password"/>  <br><br>
            <input type="button"
                   value="Login"
                   onclick="formhash(this.form, this.form.password);" />
        </form>
        <p>If you don't have a login, please <a href="register.php">register</a></p>
        <p>If you are done, please <a href="scripts/php/logout.php">log out</a>.</p>
        <p>If you are logged in, you can view this <a href="protected_page.php">page</a></p>
        <p>You are currently logged out.</p>
		</div>
		
		<div style='display:none'>
			<img src='img/basic/x.png' alt='' />
		</div>
			 
		</article>
	</aside>
	
	<aside class="middle-sidebar">
		<article>
			<h2>Middle SideBar</h2>
			<p>Please Log in to view this content</p>
		</article>
	</aside>

	<aside class="bottom-sidebar">
		<article>

		</article>
	</aside>
	
	<footer class="mainfooter">
	<p>Copyright &copy; 2014 <a href="copyright footer" title="tunesourceWebsite">tunesource.com</a></p>
	</footer>
         <?php endif; ?>

        <!-- Load jQuery, SimpleModal and Basic JS files -->

<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/basic.js'></script>


</body>

</html>