<?php
session_start();

require "config.php";	
require "functions.php";

	if(isset($_GET['key'])) $key =  htmlentities(trim($_GET['key']), ENT_QUOTES, "UTF-8");
	if(isset($_GET['login'])) $login =  htmlentities(trim($_GET['login']), ENT_QUOTES, "UTF-8");
	if(isset($key) && isset($login)) {
		
		$check = pobierz_wartosc("token", "users", "login = ?", $login);
		
		if($check==$key) {
			
			ustal_wartosc("token", "0", "users", "login = ?", $login);
			
			ustal_wartosc("status", "1", "users", "login = ?", $login);
			
			zakoncz_polaczenie();
			$_SESSION['error'] = "Gratulacje, konto zostało aktywowane!\\nTeraz możesz się zalogować.";
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
	else{
	
		zakoncz_polaczenie();
		$_SESSION['error'] = "Odmowa dostępu!";
		header("Location: index.php");
		exit();
			
	}
?>