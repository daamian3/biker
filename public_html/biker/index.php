<!DOCTYPE html>
<html lang="pl">
	<head>

		<meta charset="UTF-8">
		<title>Biker</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Spectral" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
		<link rel="stylesheet" href="css/style.css">
		<?php include 'detect.php'; ?>

		<script src="jquery/jquery-3.2.1.min.js"></script>
		<link rel="stylesheet" href="jquery/jquery-ui.min.css">
		<script src="jquery/external/jquery/jquery.js"></script>
		<script src="jquery/jquery-ui.min.js"></script>
	</head>
	<body>

		<!-- ładowanie się strony -->
		<div id="przyciemnienie" class="przyciemnienie"></div>
		<div id="loading" class="loading">
			Trwa ładowanie strony...
			<div class="loader"></div>
		</div>

		<!-- tu można wyłączyc -->
		<script>
		document.getElementById("przyciemnienie").style.display="block";
		document.getElementById("loading").style.display="block";
		</script>

		<?php
			session_start();

			if(isset($_SESSION['error'])) echo '<div id="dialog"></div>';

			if(isset($_SESSION['auth']) && $_SESSION['auth'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
				echo 'Zalogowano';
			else{
				echo 'Niezalogowano';
			}
		?>

		<header class="header">

			<div class="logo">
				<a href="index.php">
					<img src="logo.svg" alt="logo_motocykl">
					<h1>Biker</h1>
					</a>
			</div>

			<div id="scroll" class="hamburger"></div>

			<div id="menu" class="buttons">
				<div class="button"><a href="start.php">Start</a></div>
				<div id="reg" class="button"><a href="#">Zarejestruj się</a></div>
				<div id="log" class="button"><a href="#">Zaloguj się</a></div>
				<div class="button"><a href="o_nas.php">O nas</a></div>
			</div>

		</header>

		<div class="container">

			<article class="image">
				<div class="top" id="down">
					<h2>Motocykle to nasza pasja...</h2>
					<div class="triangle"><div></div></div>
				</div>
				<img src="back.jpeg" alt="motocykl na ciemnym tle">
			</article>

			<article id="here" class="text">
				<div class="zapoznanie">
					Witaj w serwisie Biker, poświęconym motocyklom. Nasza strona to zaawansowana społeczność motocyklistów, w której każdy może dorzucić coś od siebie, aby pomóc w rozwijaniu serwisu. Zarejestruj się i zapoznaj się z korzyściami i przyjemnością użytkowania, a zyskasz dostęp do wielu ciekawych narzędzi.
				</div>
				<div id="reg2" class="register">Dołącz do nas już teraz!</div>
			</article>

			<article class="image" style="clear:both;">
				<div id="here2" class="tor">

					<div id="rejestracja">
						<div id="close" class="close"></div>
						<form id="register" method="POST" action="register.php">
							<h2>Rejestracja:</h2>
							<input type="text" id="login" name="login" autocomplete="off" maxlength="14" placeholder="Wybierz swój login" required=""><br />
							<input type="text" id="email" name="email" autocomplete="on" maxlength="50" placeholder="Twój email" required=""><br />
							<input type="password" id="haslo" name="haslo" maxlength="20" placeholder="Wpisz tutaj hasło" required=""><br />
							<progress id="passwordComplexity" value="0" title="Siła hasła"></progress><br />
							<input type="password" id="vhaslo" name="vhaslo" maxlength="20" placeholder="Potwierdź hasło" required=""><br />
							<input name="display-time" type="hidden" value="8">
							<input type="submit" value="Kontynuuj"><br />
						</form>
					</div>

					<div id="logowanie">
						<div id="close2" class="close"></div>
						<form id="register" method="POST" action="login.php">
							<h2>Logowanie:</h2><br />
							Login: <input type="text" id="nick" name="name" maxlength="14"autocomplete="off" required=""><br />
							Hasło: <input type="password" id="pass" name="pass" maxlength="20" autocomplete="off" required=""><br />
							<input name="display-time" type="hidden" value="24">
							<a href="zapomnialem_hasla.php" id="forgot">Zapomniałem hasła</a>
							<input type="submit" value="Zaloguj">
						</form>
					</div>

				</div>
				<div id="up" class="bottom">
					<div class="triangle_up"><div></div></div>
				</div>
			</article>

		</div>

		<footer class="footer">
			<p>&copy; 2017 | Biker - Miłośnicy motocykli</p>
		</footer>

		<script src="pass.js"></script>
		<script>

		var zalogowany = false;
		var down = false;

		$(document).ready(function(){
	 		// Po poprawnym załadowaniu strony wyłącza przyciemnienie
		 	$("#przyciemnienie").fadeOut('fast');
		 	// Po poprawnym załadowaniu strony wyłącza loading
		 	$("#loading").fadeOut('fast');
			return false;
		});

		$( "#dialog" ).html("<?php echo $_SESSION['error']; unset($_SESSION['error']); ?>");

		$( "#dialog" ).dialog({
			autoOpen: true,
			title: "Uwaga",
			draggable: false
		}).css("font-size", "18px");

		$("#down").click(function() {
    	$('html, body').animate({
      	scrollTop: $("#here").offset().top
    	}, 1000);
			return false;
		});

		$("#up").click(function() {
    	$('html, body').animate({
      	scrollTop: 0
    	}, 1000);
			return false;
		});

		var here2 = $("#here2");
		var rejestracja = $("#rejestracja");

		$("#reg").click(function() {
			$('html, body').animate({
      	scrollTop: here2.offset().top
    	}, 1000);

			setTimeout(function(){
				rejestracja.slideDown( "slow" );
			}, 1000);
			here2.css('min-height', '600px');
			return false;
		});

		$("#reg2").click(function() {
			$('html, body').animate({
      	scrollTop: here2.offset().top
    	}, 500);

			setTimeout(function(){
				rejestracja.slideDown( "slow" );
			}, 500);
			here2.css('min-height', '600px');
			return false;
		});

		$("#log").click(function() {
			if(zalogowany==true) window.location.href = "logowanie.php";
			$('html, body').animate({
      	scrollTop: here2.offset().top
    	}, 1000);

			setTimeout(function(){
				$("#logowanie").slideDown( "slow" );
			}, 1000);
			here2.css('min-height', '600px');
			return false;
		});

		var menu = $("#menu");

		$("#scroll").click(function() {
			if(down==true){
				menu.slideUp( "slow" );
				down = false;
			}
			else{
				menu.slideDown( "slow" );
				down = true;
			}
			return false;
		});

		$("#close").click(function() {
			$("#rejestracja").slideUp( "slow" );
			$('#here2').css('min-height', '250px');
			return false;
		});

		$("#close2").click(function() {
			$("#logowanie").slideUp( "slow" );
			$('#here2').css('min-height', '250px');
			return false;
		});

		$("#scroll").click(function() {
			$("#scroll").toggleClass( "exit" );
			return false;
		});

		</script>

	</body>
</html>
