<?php

function zakoncz_polaczenie(){
	
	global $connect;
	
	$connect = null;
	return $connect;
	
}

function pobierz_wartosc($co = null, $tabela = null, $warunki = null, $one = null, $two = null, $three = null, $four = null){
	
	if($co == null || $tabela == null || $one == null){
		
		 $_SESSION['error'] = 'Wprowadzono błędne paramtery funkcji "pobierz_wartosc"!';
		 header('Location: error.php');
		 exit();
		
	}
	
	global $connect;
	
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
	
	return $zapytanie;
	
}

function ustal_wartosc($co = null, $ile = null, $tabela = null, $warunki = null, $one = null, $two = null, $three = null, $four = null){
	
	if($co == null || $ile == null || $tabela == null || $one == null){
		
		 $_SESSION['error'] = 'Wprowadzono błędne paramtery funkcji "ustal_wartosc"!';
		 header('Location: error.php');
		 exit();
		
	}
	
	global $connect;
	
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
	
	return $zapytanie;
	
}

function dodaj_wartosc($co = null, $tabela = null, $one = null, $two = null, $three = null, $four = null, $five = null, $six = null){
	
	if($co == null || $tabela == null || $one == null){
		
		 $_SESSION['error'] = 'Wprowadzono błędne paramtery funkcji "dodaj_wartosc"!';
		 header('Location: error.php');
		 exit();
		
	}
	
	global $connect;
	
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
	
	return $zapytanie;
	
}

?>