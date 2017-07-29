<!DOCTYPE html>
<html lang="pl">
	<head>

		<meta charset="UTF-8">
		<title>Katalog motocykli</title>

		<script src="jquery/jquery-3.2.1.min.js"></script>
		<link rel="stylesheet" href="jquery/jquery-ui.min.css">
		<script src="jquery/external/jquery/jquery.js"></script>
		<script src="jquery/jquery-ui.min.js"></script>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Spectral" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/start.css">
		<?php include 'detect.php'; ?>

	</head>
	<body>

		<?php
			session_start();
		?>

		<!-- ładowanie się strony -->
		<div id="przyciemnienie" class="przyciemnienie"></div>
		<div id="loading" class="loading">
			<div class="loader"></div>
		</div>

		<!-- tu można wyłączyc -->
		<script>
			document.getElementById("przyciemnienie").style.display="block";
			document.getElementById("loading").style.display="block";
		</script>

		<div id="login">
			<div id="logowanie">
					<form id="register" method="POST" action="login.php">
					Login:<br />
					<input type="text" id="nick" name="name" maxlength="14"autocomplete="off" required><br />
					Hasło:<br />
					<input type="password" id="pass" name="pass" maxlength="20" autocomplete="off" required><br />
					<input name="display-time" type="hidden" value="24">
					<div id="forgot" class="forgot">Zapomniałem hasła</div>
					<input type="submit" value="Zaloguj">
				</form>
			</div>
		</div>

		<header id="nav" class="header">
			<div id="scroll" class="hamburger"></div>

			<div class="logo2">
				<a href="biker/..">
					<img src="images/logo.svg" alt="logo_motocykl">
					<h1>Biker</h1>
					</a>
			</div>

			<div id="log_in" class="buttons">
				<?php

					if(isset($_SESSION['error'])) echo '<div id="dialog"></div>';

					if(isset($_SESSION['auth']) && $_SESSION['auth'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
					//<a href="https://icons8.com/icon/21828/Motorbike-Helmet-Filled">Motorbike helmet filled icon credits</a>
						echo '
						<div id="icon" class="icon">
							'.$_SESSION['login'].'
							<img src="images/icon.png" height="50px">
							<div id="open" class="open">&#9660;</div>
							<ul id="options">
  							<li><a href="#"><div>Profil</div></li></a>
  							<li><a href="#"><div>Edytuj</div></li></a>
  							<li><a href="logout.php"><div>Wyloguj się</div></a>
							</ul>
						</div>
						';
					else{
						echo '<div id="log" class="button"><a href="#">Zaloguj się</a></div>';
					}
				?>
			</div>
			<div style="clear: both;"></div>
		</header>
		<div class="content">
			<div class="center">
			<form class="wyszukiwarka" action="start" method="GET">
				<input id="szukane" type="text" name="szukane" placeholder="Wpisz szukany motocykl">
				<input type="submit" value="">
			</form>
		</div>
			<div id="menu">

	  			<ul>
						<a href="start?marka=honda"><li class="moto"><img src="images/honda_logo.svg"></li></a>
						<a href="start?marka=yamaha"><li class="moto"><img src="images/yamaha_logo.svg"></li></a>
						<a href="start?marka=suzuki"><li class="moto"><img src="images/suzuki_logo.svg"></li></a>
						<a href="start?marka=aprilia"><li class="moto"><img src="images/aprilia_logo.svg"></li></a>
						<a href="start?marka=kawasaki"><li class="moto"><img src="images/kawasaki_logo.svg"></li></a>
						<a href="start?marka=bmw"><li class="moto"><img src="images/bmw_logo.svg"></li></a>
						<a href="start?marka=ducati"><li class="moto"><img src="images/ducati_logo.svg"></li></a>
						<a href="start?marka=ktm"><li class="moto"><img src="images/ktm_logo.svg"></li></a>
						<a href="start?marka=trumph"><li class="moto"><img src="images/triumph_logo.svg"></li></a>
	  		</ul>
			</div>
