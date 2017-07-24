<?php

function load_moto($company = null){

	if($company == null){
		$_SESSION['error'] = "Przepraszamy, wystąpił błąd!";
		header("Location: start.php");
		exit();
	}

	switch ($company) {
    case "honda":
			$id = 1;
			$marka = "honda";
			$nazwa = pobierz_wartosc("nazwa", "motocykle", "marka = ? AND ID < ?", $marka, 3);
    break;

    case "yamaha":

    break;

    case "suzuki":

    break;

		case "aprilia":

		break;

		case "bmw":

		break;

		case "ducati":

		break;

		case "ktm":

		break;

		case "triumph":

		break;
}
	return $nazwa;
}

?>
