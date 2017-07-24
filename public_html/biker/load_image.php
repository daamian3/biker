<?php

function load_image($company = null){

	if($company == null){
		$_SESSION['error'] = "Przepraszamy, wystąpił błąd!";
		header("Location: start.php");
		exit();
	}

	switch ($company) {
    case "honda":
			$id = 1;
			$marka = "honda";
			$image = pobierz_wartosc("image", "motocykle", "marka = ?", $marka);
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
	return $image;
}

?>
