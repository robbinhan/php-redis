<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>ChannelMe</title>
		<link rel="stylesheet" href="css/blueprint/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="css/blueprint/print.css" type="text/css" media="print">

		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
		
		<!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
	</head>
	
	<body>
		<div class="container">
			<div id="header" class="span-24 last">
				<h1>ChannelMe</h1>
			</div>
		</div>

		<div class="container main">
			<div class="span-15 prepend-1" id="body"></div>

			<div class="span-7 append-1 last">
				<? if ( $user_id ) { ?>
					<h3>My channels</h3>
					<ul>
						<li><a href="#body:channel&id=1">PHP</a></li>
					</ul>

					<a href="index.php?action=signout">Sign out</a>

				<? } else { ?>
					<form>
						<fieldset>
							<legend>Signin</legend>
							
							<label>Login</label><br />
							<input type="text" class="text span-6" name="nickname" />

							<label>Password</label><br />
							<input type="password" class="text span-6" name="password" />
						</fieldset>
					</form>

					<form action="#signup" id="signup">
						<fieldset>
							<legend>Signup</legend>

							<label>Login</label><br />
							<input type="text" class="text span-6" name="nickname" />

							<label>Password</label><br />
							<input type="password" class="text span-6" name="password" />

							<label>Password confirm</label><br />
							<input type="password" class="text span-6" name="password_confirm" />

							<br/><br/>
							<input type="submit" value=" Register " />
						</fieldset>
					</form>

				<? } ?>
			</div>
		</div>

	</body>
</html>
