$("#down").click(function() {
	$('html, body').animate({
		scrollTop: $("#here").offset().top
	}, 1000);
	return false;
});

$("#up").click(function() {
	$('html, body').animate({
		scrollTop: 0
	}, 1000);
	return false;
});

$("#reg").click(function() {
	$('html, body').animate({
		scrollTop: here2.offset().top
	}, 1000);
	schowaj();
	setTimeout(function(){
		rejestracja.slideDown( "slow" );
	}, 1000);
	here2.css('min-height', '600px');
	return false;
});

$("#reg2").click(function() {
	$('html, body').animate({
		scrollTop: here2.offset().top
	}, 500);
	schowaj();
	setTimeout(function(){
		rejestracja.slideDown( "slow" );
	}, 500);
	here2.css('min-height', '600px');
	return false;
});

$("#forgot").click(function() {
	$('html, body').animate({
		scrollTop: here2.offset().top
	}, 500);
	schowaj();
	setTimeout(function(){
		przypomnij.slideDown( "slow" );
	}, 500);
	here2.css('min-height', '600px');
	return false;
});

$("#log").click(function() {
	if(zalogowany==true) window.location.href = "start.php";
	$('html, body').animate({
		scrollTop: here2.offset().top
	}, 1000);
	schowaj();
	setTimeout(function(){
		logowanie.slideDown( "slow" );
	}, 1000);
	here2.css('min-height', '600px');
	return false;
});

var menu = $("#menu");

$("#scroll").click(function() {
	if(down==true){
		menu.slideUp( "slow" );
		down = false;
	}
	else{
		menu.slideDown( "slow" );
		down = true;
	}
	return false;
});

$("#close").click(function() {
	rejestracja.hide( "clip" );
	here2.css('min-height', '250px');
	return false;
});

$("#close2").click(function() {
	logowanie.hide( "clip" );
	here2.css('min-height', '250px');
	return false;
});

$("#close3").click(function() {
	przypomnij.hide( "clip" );
	$('#here2').css('min-height', '250px');
	return false;
});

$("#scroll").click(function() {
	$("#scroll").toggleClass( "exit" );
	return false;
});
