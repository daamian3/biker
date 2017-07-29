<div style="clear: both;"></div>
</div>
<footer id="footer" class="footer">
	<p>&copy; 2017 | Biker - Miłośnicy motocykli</p>
</footer>

<script src="scripts/loader.js"></script>

<script>
	var dialog = $("#dialog");

	dialog.html("<?php
	if(isset($_SESSION['error'])){
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
	?>");


	  var availableTags = [
	    <?php tagi(); ?>
		 ];
	  $("#szukane").autocomplete({
	    source: availableTags
	  });

</script>

<script src="scripts/start.js"></script>

</body>
</html>
