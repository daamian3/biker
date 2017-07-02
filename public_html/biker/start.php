<!DOCTYPE html>
<html lang="pl">
	<head>

		<meta charset="UTF-8">
		<title>Biker</title>

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
					Login: <input type="text" id="nick" name="name" maxlength="14"autocomplete="off" required><br />
					Hasło: <input type="password" id="pass" name="pass" maxlength="20" autocomplete="off" required><br />
					<input name="display-time" type="hidden" value="24">
					<div id="forgot" class="forgot">Zapomniałem hasła</div>
					<input type="submit" value="Zaloguj">
				</form>
			</div>
		</div>

		<header id="nav" class="header">
			<div id="scroll" class="hamburger"></div>

			<div class="logo2">
				<a href="index.php">
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

		<div id="menu" style="clear: both;">
  			<ul>
					<li class="moto"><img src="images/honda_logo.svg"></li>
					<li class="moto"><img src="images/yamaha_logo.svg"></li>
					<li class="moto"><img src="images/suzuki_logo.svg"></li>
					<li class="moto"><img src="images/aprilia_logo.svg"></li>
					<li class="moto"><img src="images/bmw_logo.svg"></li>
					<li class="moto"><img src="images/ducati_logo.svg"></li>
					<li class="moto"><img src="images/ktm_logo.svg"></li>
					<li class="moto"><img src="images/triumph_logo.svg"></li>
  		</ul>
		</div>

		<div class="container">

		</div>

		<footer id="footer" class="footer">
			<p>&copy; 2017 | Biker - Miłośnicy motocykli</p>
		</footer>

		<script>

		$(window).on("load", function() {
	 		// Po poprawnym załadowaniu strony wyłącza przyciemnienie
		 	$("#przyciemnienie").fadeOut("fast");
		 	// Po poprawnym załadowaniu strony wyłącza loading
		 	$("#loading").fadeOut("fast");
			return false;
		});

		var dialog = $("#dialog");

		dialog.html("<?php echo $_SESSION['error']; unset($_SESSION['error']); ?>");

		dialog.dialog({
			autoOpen: true,
			title: "Uwaga",
			draggable: false,
			modal: true,
			hide: {
        effect: "fold",
        duration: 1000
      }
		}).css("font-size", "18px");

		dialog.effect("pulsate", "slow");

		var login = $("#login");

		login.dialog({
			autoOpen: false,
			title: "Logowanie",
			draggable: true,
			resizable: false,
			modal: true,
			height: "auto",
			width: "auto",
			hide:{
        effect: "fold",
        duration: 1000
      },
			show:{
        effect: "blind",
        duration: 1000
      }
		}).css('font-size', '16px');

		$("#log").on("click", function() {
      login.dialog("open");
    });

		var open = $("#open");
		var options = $("#options");
		var down2 = false;

		open.click(function() {
			if(down2==true){
				options.slideUp("medium");
				open.html("&#9660;");
				down2 = false;
			}
			else{
				options.slideDown("medium");
				open.html("&#9650;");
				down2 = true;
			}
			return false;
		});

		$(document).ready(function() {
			var NavY = $('#nav').offset().top;

			var stickyNav = function(){
				var ScrollY = $(window).scrollTop();

				if (ScrollY > NavY) {
					$("#nav").addClass("fixed");
				} else {
					$("#nav").removeClass("fixed");
				}
			};

			stickyNav();

			$(window).scroll(function() {
				stickyNav();
			});
		});

		var moto = $(".moto");
		var menu = $("#menu");
		var scroll = $("#scroll");
		var down = false;

		moto.mouseenter(function() {
			moto.css("opacity","0.5");
			$(this).css("opacity","1");
		});

		moto.mouseleave(function() {
			moto.css("opacity","1");
		});

		scroll.click(function() {
			if(down==true){
				menu.slideUp("slow");
				down = false;
			}
			else{
				menu.slideDown("slow");
				down = true;
			}
			return false;
		});

		scroll.click(function() {
			scroll.toggleClass("exit");
			return false;
		});

		</script>

	</body>
</html>
