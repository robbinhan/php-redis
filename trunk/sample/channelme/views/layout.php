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
			<div class="span-14 append-1 prepend-1" id="body"></div>

			<div class="span-7 append-1 last">
				<? if ( $user_id ) { ?>
					<? include '_my_channels.php' ?>
					<? include '_add_channel_form.php' ?>

					<br/><br/>
					<a href="index.php?action=signout">Sign out</a>

				<? } else { ?>
					<? include '_signin_form.php' ?>
					<? include '_signup_form.php' ?>
				<? } ?>
			</div>
		</div>

	</body>
</html>
