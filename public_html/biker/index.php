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
		<link rel="stylesheet" href="css/index.css">
		<?php include 'detect.php'; ?>

	</head>
	<body>

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

		<?php
			session_start();

			if(isset($_SESSION['error'])) echo '<div id="dialog"></div>';

			if(isset($_SESSION['auth']) && $_SESSION['auth'] == true && $_SESSION['ip'] == $_SERVER['REMOTE_ADDR'])
				echo '<script> var zalogowany = true; </script>';
			else{
				echo '<script> var zalogowany = false; </script>';
			}
		?>

		<header class="header">

			<div class="logo">
				<a href="index.php">
					<img src="images/logo.svg" alt="logo_motocykl">
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
				<img src="images/back.jpeg" alt="motocykl na ciemnym tle">
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
							<input type="text" id="login" name="login" autocomplete="off" maxlength="14" placeholder="Wybierz swój login" required title="Od 4 do 14 znaków. Bez spacji"><br />
							<input type="text" id="email" name="email" autocomplete="on" maxlength="50" placeholder="Twój email" required title="W formie nazwa@domena.pl/com"><br />
							<input type="password" id="haslo" name="haslo" maxlength="20" placeholder="Wpisz tutaj hasło" required title="Od 4 do 14 znaków. Bez spacji."><br />
							<progress id="passwordComplexity" value="0" title="Siła hasła"></progress><br />
							<input type="password" id="vhaslo" name="vhaslo" maxlength="20" placeholder="Potwierdź hasło" required title="Wpisz hasło ponownie."><br />
							<input name="display-time" type="hidden" value="8">
							<input type="submit" value="Kontynuuj"><br />
						</form>
					</div>

					<div id="logowanie">
						<div id="close2" class="close"></div>
						<form id="register" method="POST" action="login.php">
							<h2>Logowanie:</h2><br />
							Login: <input type="text" id="nick" name="name" maxlength="14"autocomplete="off" required><br />
							Hasło: <input type="password" id="pass" name="pass" maxlength="20" autocomplete="off" required><br />
							<input name="display-time" type="hidden" value="24">
							<div id="forgot" class="forgot">Zapomniałem hasła</div>
							<input type="submit" value="Zaloguj">
						</form>
					</div>

				<?php
					if(isset($_SESSION['forgot']) && $_SESSION['forgot'] == true){

						echo '
							<div id="for">
							<div id="close3" class="close"></div>
								<form id="register" method="POST" action="newpass.php">
									<h2>Przypomnij hasło:</h2><br />
									<input type="password" id="haslo" name="nowe" maxlength="20" placeholder="Wpisz nowe hasło" required><br />
									<progress id="passwordComplexity" value="0" title="Siła hasła"></progress><br />
									<input type="password" id="vhaslo" name="vnowe" maxlength="20" placeholder="Potwierdź nowe hasło" required><br />
									<input type="submit" value="Kontynuuj"><br />
								</form>
							</div>
							';

					}
					else{

						echo
						'
						<div id="for">
						<div id="close3" class="close"></div>
							<form id="register" method="POST" action="newpass.php">
								<h2>Przypomnij hasło:</h2></br>
								<input type="text" id="login" name="login_email" autocomplete="off" maxlength="50" placeholder="Wpisz login lub email" required></br>
								<input name="display-time" type="hidden" value="5">
								<input type="submit" value="Kontynuuj"></br>
							</form>
						</div>
						';
				}
			?>

				</div>
				<div id="up" class="bottom">
					<div class="triangle_up"><div></div></div>
				</div>
			</article>

		</div>

		<footer id="footer" class="footer">
			<p>&copy; 2017 | Biker - Miłośnicy motocykli</p>
		</footer>

		<script src="scripts/pass.js"></script>
		<script src="scripts/loader.js"></script>

		<script>

		var down = false;

		$( "#dialog" ).html("<?php
		if(isset($_SESSION['error'])){
			echo $_SESSION['error'];
			unset($_SESSION['error']);
		}
		?>");
		</script>

		<script src="scripts/index_1.js"></script>
		<script>

		function schowaj(){
			rejestracja.hide("clip");
			logowanie.hide("clip");
			przypomnij.hide("clip");
		}

		<?php
		if(isset($_SESSION['forgot']) && $_SESSION['forgot'] == true){

		unset($_SESSION['forgot']);
		echo '
		przypomnij.slideDown( "slow" );
		here2.css("min-height", "600px");
		setTimeout(function(){
			$("html, body").animate({
				scrollTop: here2.offset().top
			}, 1000);
		}, 100);
		';
		}
		?>
		</script>
		<script src="scripts/index_2.js"></script>

	</body>
</html>
