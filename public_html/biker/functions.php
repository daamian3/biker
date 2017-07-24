<?php

function zakoncz_polaczenie(){

	global $connect;

	$connect = null;
	return $connect;

}

function pobierz_wartosc($co = null, $tabela = null, $warunki = null, $one = null, $two = null, $three = null, $four = null){

	global $connect;
	global $moto;

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

function wyswietl_motocykle($marka = null){

	$new = null;
	global $connect;

	if($marka == null){
		$_SESSION['error'] = "Przepraszamy, wystąpił błąd!";
		header("Location: start.php");
		exit();
	}

	$ile = pobierz_wartosc("COUNT(*)", "motocykle", "marka = ?", $marka);

	for($i = 1; $i<=$ile; $i++){

		$sql = "SELECT nazwa, image, data_dodania from motocykle WHERE marka = ?";
		$zapytanie = $connect -> prepare($sql);

		$zapytanie -> bindValue(1, $marka, PDO::PARAM_STR);
		$zapytanie -> execute();

		while ($row = $zapytanie->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
      $nazwa[] = $row[0];
			$image[] = $row[1];
			$data_dodania[] = $row[2];
    }

		$datetime1 = date_create($data_dodania[$i]);
		$datetime2 = date_create(date("Y-m-d"));
		$interval = date_diff($datetime1, $datetime2);
		$interval = $interval->format('%d');
		if($interval < 5) $new = '<div class="new">Ostatnio dodany</div>';

		echo '
			<li><div class="block">
			'.$new.'
				<img src="images/motorcycles/'.$image[$i].'">
				<div class="handle">&#xf047;</div>
				<div class="suwak">'.$nazwa[$i].'</div>
				</div></li>
		';
	}
}

function wyswietl_glowna(){

		global $connect;

		$sql = "SELECT nazwa, image from motocykle ORDER BY ID DESC LIMIT 1";
		$zapytanie = $connect -> prepare($sql);

		$zapytanie -> execute();
		$zapytanie = $zapytanie->fetch();

		echo '
			<li><div class="block">
			<div class="new">Ostatnio dodany</div>
				<img src="images/motorcycles/'.$zapytanie['image'].'">
				<div class="handle">&#xf047;</div>
				<div class="suwak">'.$zapytanie['nazwa'].'</div>
				</div></li>
		';

}

?>
