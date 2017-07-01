<?php
	session_start();

	require "config.php";
	require "functions.php";

	$wrong_pass = "Nieprawidłowa nazwa użytkownika lub login!";
	$acces_denied = "Odmowa dostępu!";

	if(!isset($_POST['name']) || !isset($_POST['pass'])){

		zakoncz_polaczenie();
		$_SESSION['error'] = $acces_denied;
		header("Location: index.php");
		exit();

	}

	if($_GET['name'] != ''){

		zakoncz_polaczenie();
		$_SESSION['error'] = $acces_denied;
		header("Location: index.php");
		exit();

	}

	if($_GET['pass'] != ''){

		zakoncz_polaczenie();
		$_SESSION['error'] = $acces_denied;
		header("Location: index.php");
		exit();

	}

	if (isset($_POST['display-time']) ) {

		if ($_POST['display-time'] < 1) {

			zakoncz_polaczenie();
			$_SESSION['error'] = "Przepraszamy, w twoim działaniu wykryto SPAM!";
			header("Location: index.php");
			exit();

		}
	}

	$login = htmlentities(trim($_POST['name']), ENT_QUOTES, "UTF-8");
	$haslo = htmlentities(trim($_POST['pass']), ENT_QUOTES, "UTF-8");

	$spr3 = strlen($login);
	$spr4 = strlen($haslo);

	$komunikaty = '';

	if ($spr3 < 4) $komunikaty .= "Login musi mieć przynajmniej 5 znaków!\\n";
	if ($spr3 > 14) $komunikaty .= "Login nie może mieć więcej niż 14 znaków!\\n";
	if ($spr4 < 4) $komunikaty .= "Hasło musi mieć przynajmniej 5 znaków!\\n";
	if ($spr4 >  20) $komunikaty .= "Hasło nie może mieć więcej niż 20 znaków!\\n";

	if ($komunikaty){

		zakoncz_polaczenie();
		$_SESSION['error'] = $komunikaty;
		header("Location: index.php");
		exit();

	}

	$pass = pobierz_wartosc("password", "users", "login = ?", $login);

	$status = pobierz_wartosc("status", "users", "login = ?", $login);

	if(password_verify($haslo, $pass)) {

		if($status[0]==0){

			zakoncz_polaczenie();
			$_SESSION['error'] = "Konto nie zostało jeszcze aktywowane!";
			header("Location: index.php");
			exit();

		}

		ustal_wartosc("attempt", "0", "users", "login = ?", $login);

		ustal_wartosc("token", "0", "users", "login = ?", $login);

		zakoncz_polaczenie();
		$_SESSION['auth'] = true;
		$_SESSION['login'] = $login;
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		header("Location: index.php");
		exit();

	}
	else {

		$attempt = pobierz_wartosc("attempt", "users", "login = ?", $login);

		if($attempt==10){

			$godzina = time()+600;

			ustal_wartosc("godzina", $godzina, "users", "login = ?", $login);

			ustal_wartosc("attempt", "?", "users", "login = ?", $attempt+=1, $login);

			zakoncz_polaczenie();
			$_SESSION['error'] = "Przekroczono limit 10 prób logowania!<br />Po upływie 10 minut będziesz mógł zalogować się ponownie.";
			header("Location: index.php");
			exit();

		}

		else if($attempt==11){

			$data = pobierz_wartosc("godzina", "users", "login = ?", $login);
			$teraz = time();

			if($data - $teraz<=0) {

				ustal_wartosc("attempt", "0", "users", "login = ?", $login);

				ustal_wartosc("godzina", "0", "users", "login = ?", $login);

				pobierz_wartosc("password", "users", "login = ?", $login);

				$pass = pobierz_wartosc("password", "users", "login = ?", $login);;

				if(password_verify($haslo, $pass)) {

					if($status[0]==0){

						zakoncz_polaczenie();
						$_SESSION['error'] = "Konto nie zostało jeszcze aktywowane!";
						header("Location: index.php");
						exit();

					}

					ustal_wartosc("attempt", "0", "users", "login = ?", $login);

					zakoncz_polaczenie();
					$_SESSION['auth'] = true;
					$_SESSION['login'] = $login;
					$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
					header("Location: index.php");
					exit();

				}
				else{

					ustal_wartosc("attempt", "0", "users", "login = ?", $login);

					zakoncz_polaczenie();
					$_SESSION['error'] = $wrong_pass;
					header("Location: index.php");
					exit();

				}
			}
			else{

				zakoncz_polaczenie();
				$_SESSION['error'] = "Przekroczono limit 10 prób logowania!<br />Po upływie 10 minut będziesz mógł zalogować się ponownie.";
				header("Location: index.php");
				exit();

			}
		}

		else{

			ustal_wartosc("attempt", "?", "users", "login = ?", $attempt+=1, $login);

			zakoncz_polaczenie();
			$_SESSION['error'] = $wrong_pass;
			header("Location: index.php");
			exit();
		}
	}
?>
