<?php
	session_start();

	require "config.php";
	require "functions.php";

	if (isset($_POST['display-time']) ) {

		if ($_POST['display-time'] < 3) {

			zakoncz_polaczenie();
			$_SESSION['error'] = "Przepraszamy, w twoim działaniu wykryto SPAM!";
			header("Location: index.php");
			exit();

		}
	}

	$login = htmlentities(trim($_POST['login']), ENT_QUOTES, "UTF-8");
	$email = htmlentities(trim($_POST['email']), ENT_QUOTES, "UTF-8");
	$haslo = htmlentities(trim($_POST['haslo']), ENT_QUOTES, "UTF-8");
	$vhaslo = htmlentities(trim($_POST['vhaslo']), ENT_QUOTES, "UTF-8");
	$ip = htmlentities(trim($_SERVER['REMOTE_ADDR']), ENT_QUOTES, "UTF-8");
	$data = date("Y-m-d");

	$spr1 = pobierz_wartosc("COUNT(*)", "users", "login = ?", $login);

	$spr2 = pobierz_wartosc("COUNT(*)", "users", "email = ?", $email);

	$spr3 = strlen($login);
	$spr4 = strlen($haslo);
	$spr5 = strlen($email);

	$komunikaty = '';

	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

	if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)){

			$komunikaty .= "Email jest niepoprawny!\\n";

	}

	if (!$login || !$haslo || !$vhaslo ) $komunikaty .= "Musisz wypełnić wszystkie pola!\\n";
	if ($spr1[0]) $komunikaty .= "Ten login jest już zajęty!\\n";
	if ($spr2[0]) $komunikaty .= "Ten email jest już zajęty!\\n";
	if ($spr3 < 4) $komunikaty .= "Login musi mieć przynajmniej 5 znaków!\\n";
	if ($spr3 > 14) $komunikaty .= "Login nie może mieć więcej niż 14 znaków!\\n";
	if ($spr4 < 4) $komunikaty .= "Hasło musi mieć przynajmniej 5 znaków!\\n";
	if ($spr4 >  20) $komunikaty .= "Hasło nie może mieć więcej niż 20 znaków!\\n";
	if ($spr5 >  50) $komunikaty .= "Email nie może mieć więcej niż 50 znaków!\\n";
	if ($haslo != $vhaslo) $komunikaty .= "Hasła się nie zgadzają!\\n";
	if (
		preg_match('@[ęóąśłżźćńĘÓĄŚŁŻŹĆŃ]@', $login) 	||
		preg_match('@[ęóąśłżźćńĘÓĄŚŁŻŹĆŃ]@', $haslo)	||
		preg_match('@[ęóąśłżźćńĘÓĄŚŁŻŹĆŃ]@', $vhaslo)) $komunikaty .= "Nie możesz używać polskich znaków\\n";
	if (preg_match('/[\!\@\#\$\%\^\&\*]/', $login)) $komunikaty .= "Login nie może zawierać znaków specjalnych!\\n";

	if ($komunikaty){

		zakoncz_polaczenie();
		$_SESSION['error'] = $komunikaty;
		header("Location: index.php");
		exit();

	}
	else {

		$token = sha1(uniqid());

		$temat = 'Prośba o aktywację konta';
		$tekst = 'Witaj '.$login.', aby uaktywnić konto przejdź w podany adres:\n http://starozytnosc-grecja.hol.es/biker/confirm.php?key='.$token.'&login='.$login.'';
		$tekst = wordwrap($tekst,70);
		$tekst = str_replace('\n', '', $tekst);
		$mail = mail($email, $temat, $tekst);

		if($mail){

			$haslo =  password_hash($haslo, PASSWORD_DEFAULT);

			dodaj_wartosc("login, password, email, token, data, ip", "users", $login, $haslo, $email, $token, $data, $ip);

		}

		zakoncz_polaczenie();
		$_SESSION['error'] = "Gratulacje! Zostałeś zarejestrowany jako ".$login."!\\nAby zalogować się, aktywuj konto poprzez link wysłany na twój adres email.";
		header("Location: index.php");
		exit();

	}
?>
