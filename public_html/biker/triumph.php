<?php include "start_header.php"; ?>

		<div class="container">
			<ul id="sortable">

				<?php

					require "config.php";
					require "functions.php";

					$marka = "triumph";

					wyswietl_motocykle($marka);
				?>

			</ul>
			<a href="start.php"><div id="black" class="back"><div></div></div></a>
		</div>

<?php include "start_footer.php"; ?>
