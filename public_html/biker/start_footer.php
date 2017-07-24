<div style="clear: both;"></div>
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
</script>

<script src="scripts/start.js"></script>

</body>
</html>
