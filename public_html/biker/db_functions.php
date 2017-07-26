<?php

session_regenerate_id();

$index = "Location: biker/..";
$start = "Location: start";

function db_connect(){

	$plik = fopen('config.txt','r');

	date_default_timezone_set('Europe/Warsaw');

	while(!feof($plik)){
	   $linia = fgets($plik);
	   $config[] = $linia;
	}

	$host = trim($config[0]);
	$nazwa = trim($config[1]);
	$dostep = trim($config[2]);
	$baza = trim($config[3]);
	$port = trim($config[4]);

	try{
		$connect = new PDO('mysql:host='.$host.';dbname='.$baza.';port='.$port, $nazwa, $dostep,
			array(
				PDO::ATTR_EMULATE_PREPARES => false,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			));

		return $connect;
	}

	catch(PDOException $err){
			$err -> getMessage();
			$_SESSION['error'] = "Przepraszamy, wystąpił błąd!";
			header($index);
			exit();
	}
}

function db_disconnect(){

	global $connect;

	$connect = null;
	return $connect;

}

function pobierz_wartosc($co = null, $tabela = null, $warunki = null, $one = null, $two = null, $three = null, $four = null){

	$connect = db_connect();

	try{
		if(isset($warunki)) $sql = "SELECT $co FROM $tabela WHERE $warunki";
		else if($co=="COUNT(*)") $sql = "SELECT COUNT(*) FROM $tabela WHERE $warunki LIMIT 1";
		else $sql = "SELECT $co FROM $tabela";

		$zapytanie = $connect -> prepare($sql);

		if(isset($one)){
			if (is_int($one)) $zapytanie -> bindValue(1, $one, PDO::PARAM_INT);
			else $zapytanie -> bindValue(1, $one, PDO::PARAM_STR);
		}

		if(isset($two)){
			if (is_int($two)) $zapytanie -> bindValue(2, $two, PDO::PARAM_INT);
			else $zapytanie -> bindValue(2, $two, PDO::PARAM_STR);
		}

		if(isset($three)){
			if (is_int($three)) $zapytanie -> bindValue(3, $three, PDO::PARAM_INT);
			else $zapytanie -> bindValue(3, $three, PDO::PARAM_STR);
		}

		if(isset($four)){
			if (is_int($four)) $zapytanie -> bindValue(4, $four, PDO::PARAM_INT);
			else $zapytanie -> bindValue(4, $four, PDO::PARAM_STR);
		}

		$zapytanie -> execute();
		$zapytanie = $zapytanie->fetch();
		$zapytanie = $zapytanie[0];

		db_disconnect();

		return $zapytanie;
	}

	catch(PDOException $err){
			$err -> getMessage();
			$_SESSION['error'] = "Przepraszamy, wystąpił błąd!";
			header($index);
			exit();
	}
}

function ustal_wartosc($co = null, $ile = null, $tabela = null, $warunki = null, $one = null, $two = null, $three = null, $four = null){

	$connect = db_connect();

	try{

		if(isset($warunki)) $sql = "UPDATE $tabela SET $co = $ile WHERE $warunki";
		else $sql = "UPDATE $tabela SET $co = $ile";

		$zapytanie = $connect -> prepare($sql);

		if(isset($one)){

			if (is_int($one)) $zapytanie -> bindValue(1, $one, PDO::PARAM_INT);
			else $zapytanie -> bindValue(1, $one, PDO::PARAM_STR);

		}
		if(isset($two)){

			if (is_int($two)) $zapytanie -> bindValue(2, $two, PDO::PARAM_INT);
			else $zapytanie -> bindValue(2, $two, PDO::PARAM_STR);

		}
		if(isset($three)){

			if (is_int($three)) $zapytanie -> bindValue(3, $three, PDO::PARAM_INT);
			else $zapytanie -> bindValue(3, $three, PDO::PARAM_STR);

		}
		if(isset($four)){

			if (is_int($four)) $zapytanie -> bindValue(4, $four, PDO::PARAM_INT);
			else $zapytanie -> bindValue(4, $four, PDO::PARAM_STR);

		}
		$zapytanie -> execute();

		db_disconnect();

		return $zapytanie;
	}

	catch(PDOException $err){
			$err -> getMessage();
			$_SESSION['error'] = "Przepraszamy, wystąpił błąd!";
			header($index);
			exit();
	}
}

function dodaj_wartosc($co = null, $tabela = null, $one = null, $two = null, $three = null, $four = null, $five = null, $six = null){

	$connect = db_connect();

	try{

		if(isset($six)) $sql = "INSERT INTO $tabela ($co) VALUES(?, ?, ?, ?, ?, ?)";
		else if(isset($five)) $sql = "INSERT INTO $tabela ($co) VALUES(?, ?, ?, ?, ?)";
		else if(isset($four)) $sql = "INSERT INTO $tabela ($co) VALUES(?, ?, ?, ?)";
		else if(isset($three)) $sql = "INSERT INTO $tabela ($co) VALUES(?, ?, ?)";
		else if(isset($two)) $sql = "INSERT INTO $tabela ($co) VALUES(?, ?)";
		else if(isset($one)) $sql = "INSERT INTO $tabela ($co) VALUES(?)";

		$zapytanie = $connect -> prepare($sql);

		if(isset($one)){

			if (is_int($one)) $zapytanie -> bindValue(1, $one, PDO::PARAM_INT);
			else $zapytanie -> bindValue(1, $one, PDO::PARAM_STR);

		}
		if(isset($two)){

			if (is_int($two)) $zapytanie -> bindValue(2, $two, PDO::PARAM_INT);
			else $zapytanie -> bindValue(2, $two, PDO::PARAM_STR);

		}
		if(isset($three)){

			if (is_int($three)) $zapytanie -> bindValue(3, $three, PDO::PARAM_INT);
			else $zapytanie -> bindValue(3, $three, PDO::PARAM_STR);

		}
		if(isset($four)){

			if (is_int($four)) $zapytanie -> bindValue(4, $four, PDO::PARAM_INT);
			else $zapytanie -> bindValue(4, $four, PDO::PARAM_STR);

		}
		if(isset($five)){

			if (is_int($five)) $zapytanie -> bindValue(5, $five, PDO::PARAM_INT);
			else $zapytanie -> bindValue(5, $five, PDO::PARAM_STR);

		}
		if(isset($six)){

			if (is_int($six)) $zapytanie -> bindValue(6, $six, PDO::PARAM_INT);
			else $zapytanie -> bindValue(6, $six, PDO::PARAM_STR);

		}
		$zapytanie -> execute();

		db_disconnect();

		return $zapytanie;
	}

	catch(PDOException $err){
			$err -> getMessage();
			$_SESSION['error'] = "Przepraszamy, wystąpił błąd!";
			header($index);
			exit();
	}
}
?>
