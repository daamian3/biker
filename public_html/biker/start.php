<?php include "start_header.php"; ?>

		<div class="container">
			<ul id="sortable">

				<?php
					require "moto_functions.php";

					$marka = $_GET['marka'];
					$szukane = $_GET['szukane'];
					wyswietl_motocykle($marka, $szukane);
				?>

			</ul>
			<a href="start"><div id="black" class="back"><div></div></div></a>
		</div>

<?php include "start_footer.php"; ?>
