<?php
session_regenerate_id();

$plik = fopen('config.txt','r');

date_default_timezone_set('Europe/Warsaw');

while(!feof($plik))
{

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

}

catch(PDOException $err){

		$err -> getMessage();
		$_SESSION['error'] = "Przepraszamy, wystąpił błąd!";
		header("Location: index.php");
		exit();

}

?>
