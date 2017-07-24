$( "#dialog" ).dialog({
	autoOpen: true,
	title: "Uwaga",
	draggable: false,
	modal: true,
	hide: {
		effect: "fold",
		duration: 1000
	}
}).css('font-size', '18px');

$( "#dialog" ).effect( "pulsate", "slow" );

$( "[title]" ).tooltip({
		position: {
			my: "left top",
			at: "right+5 top-5",
			collision: "none"
		}
});

var here2 = $("#here2");
var rejestracja = $("#rejestracja");
var logowanie = $("#logowanie");
var przypomnij = $("#for");
