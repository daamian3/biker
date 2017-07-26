<?php

require "db_functions.php";

function wyswietl_motocykle($marka = null){

	$new = null;
	$connect = db_connect();

	if($marka == null){

		$sql = "SELECT nazwa, image from motocykle ORDER BY ID DESC LIMIT 1";
		$zapytanie = $connect -> prepare($sql);
		$zapytanie -> execute();
		$zapytanie = $zapytanie->fetch();

		echo '
			<li>
				<div class="block">
					<div class="new">Ostatnio dodany</div>
					<img src="images/motorcycles/'.$zapytanie['image'].'">
					<div class="suwak">'.$zapytanie['nazwa'].'</div>
				</div>
			</li>
			<br />
			<li>
				<div class="block">
					<img src="images/user.svg">
					<div class="suwak">Profil użytkownika</div>
				</div>
			</li>
		';
	}

	else{

		$ile = pobierz_wartosc("COUNT(*)", "motocykle", "marka = ?", $marka);

		for($i = 1; $i<=$ile; $i++){

			$sql = "SELECT nazwa, image, data_dodania FROM motocykle WHERE marka = ?";
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
				<li>
					<div class="block">
						'.$new.'
						<img src="images/motorcycles/'.$image[$i].'">
						<div class="suwak">'.$nazwa[$i].'</div>
					</div>
				</li>
			';
		}
		if(!$nazwa[0]){
			echo "<div>Przepraszamy, wystąpił błąd podczas ładowania motocykli!</div>";
		}
	}
	db_disconnect();
}

?>
