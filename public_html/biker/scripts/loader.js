$( window ).on( "load", function() {
	// Po poprawnym załadowaniu strony wyłącza przyciemnienie
	$("#przyciemnienie").fadeOut('fast');
	// Po poprawnym załadowaniu strony wyłącza loading
	$("#loading").fadeOut('fast');
	return false;
});
