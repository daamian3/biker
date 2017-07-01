<?php
	session_start();

	require "config.php";
	require "functions.php";

	if (isset($_POST['display-time']) ) {

		if ($_POST['display-time'] < 1) {

			zakoncz_polaczenie();
			$_SESSION['error'] = "Przepraszamy, w twoim działaniu wykryto SPAM!";
			header("Location: index.php");
			exit();

		}
	}

	if(isset($_GET['key'])) $key =  htmlentities(trim($_GET['key']), ENT_QUOTES, "UTF-8");
	if(isset($_GET['login'])) $login =  htmlentities(trim($_GET['login']), ENT_QUOTES, "UTF-8");
	if(isset($key) && isset($login)) {

		$check = pobierz_wartosc("token", "users", "login = ?", $login);

		if($check==$key) {

			zakoncz_polaczenie();
			$_SESSION['forgot'] = true;
			$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['login'] = $login;
			header("Location: index.php");
			exit();

		}
		else{

			zakoncz_polaczenie();
			$_SESSION['error'] = "Nieprawidłowy token!";
			header("Location: index.php");
			exit();

		}
	}
	if(isset($_POST['nowe'])) $haslo =  trim($_POST['nowe']);
	if(isset($_POST['nowe'])) $vhaslo =  trim($_POST['nowe']);
	if(isset($_SESSION['login'])) $login =  trim($_SESSION['login']);

	if(isset($haslo) && isset($vhaslo) && isset($login)) {

		$spr1 = strlen($haslo);

		$komunikaty = '';

		if (!$haslo || !$vhaslo ) $komunikaty .= "Musisz wypełnić wszystkie pola!\\n";
		if ($spr1 < 4) $komunikaty .= "Hasło musi mieć przynajmniej 5 znaków!\\n";
		if ($spr4 >  20) $komunikaty .= "Hasło nie może mieć więcej niż 20 znaków!\\n";
		if ($haslo != $vhaslo) $komunikaty .= "Hasła się nie zgadzają!\\n";
		if (
		preg_match('@[ęóąśłżźćńĘÓĄŚŁŻŹĆŃ]@', $haslo)	||
		preg_match('@[ęóąśłżźćńĘÓĄŚŁŻŹĆŃ]@', $vhaslo)) $komunikaty .= "Nie możesz używać polskich znaków\\n";

		if ($komunikaty){

			zakoncz_polaczenie();
			$_SESSION['error'] = $komunikaty;
			header("Location: index.php");
			exit();

		}

		$haslo = password_hash($haslo, PASSWORD_DEFAULT);
		try {

			ustal_wartosc("password", "?", "users", "login = ?", $haslo, $login);
			ustal_wartosc("token", "0", "users", "login = ?", $login);

		}
		catch (Exception $err) {

			$err -> getMessage();
			zakoncz_polaczenie();
			$_SESSION['error'] = "Przepraszamy, wystąpił błąd!";
			header("Location: index.php");
			exit();

		}
		zakoncz_polaczenie();
		$_SESSION['error'] = "Udało się! Hasło zostało zmienione.";
		header("Location: index.php");
		exit();

	}
	else{

		$login = trim($_POST['login_email']);
		$email = filter_var($login, FILTER_SANITIZE_EMAIL);

		if ((filter_var($email, FILTER_VALIDATE_EMAIL)==true) || ($email!=$login)) $login = pobierz_wartosc("login", "users", "email = ?", $email);
		else $email = pobierz_wartosc("email", "users", "login = ?", $login);

		$ile = pobierz_wartosc("COUNT(*)", "users", "login = ?", $login);

		if($ile[0]==0){

			zakoncz_polaczenie();
			$_SESSION['error'] = "Podany login lub email nie istnieje!";
			header("Location: index.php");
			exit();

		}

		$token = sha1(uniqid());
		$temat = 'Prośba o przypomnienie hasła';
		$tekst = 'Witaj '.$login.', aby wygenerować nowe hasło przejdź w podany adres:\n http://starozytnosc-grecja.hol.es/biker/newpass.php?key='.$token.'&login='.$login.'';
		$tekst = wordwrap($tekst,70);
		$tekst = str_replace('\n', '', $tekst);
		$mail = mail($email, $temat, $tekst);

		if($mail){

			ustal_wartosc("token", "?", "users", "login = ?", $token, $login);

			zakoncz_polaczenie();
			$_SESSION['error'] = "Link do zmiany hasła został wysłany na twój email.";
			header("Location: index.php");
			exit();

		}
	}
?>
