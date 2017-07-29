dialog.dialog({
	autoOpen: true,
	title: "Uwaga",
	draggable: false,
	modal: true,
	hide: {
		effect: "fold",
		duration: 1000
	}
}).css("font-size", "18px");

dialog.effect("pulsate", "slow");

var login = $("#login");

login.dialog({
	autoOpen: false,
	title: "Logowanie",
	draggable: true,
	resizable: false,
	modal: true,
	height: "auto",
	width: "auto",
	hide:{
		effect: "fold",
		duration: 1000
	},
	show:{
		effect: "blind",
		duration: 1000
	}
}).css('font-size', '16px');

$("#log").on("click", function() {
	login.dialog("open");
});

var open = $("#open");
var options = $("#options");
var down2 = false;

open.click(function() {
	if(down2==true){
		options.slideUp("medium");
		open.html("&#9660;");
		down2 = false;
	}
	else{
		options.slideDown("medium");
		open.html("&#9650;");
		down2 = true;
	}
	return false;
});

var moto = $(".moto");
var menu = $("#menu");
var scroll = $("#scroll");
var down = false;
var block = $(".block");
var sortable = $("#sortable");

moto.mouseenter(function() {
	moto.css("opacity","0.5");
	$(this).css("opacity","1");
});

moto.mouseleave(function() {
	moto.css("opacity","1");
});

block.mouseenter(function() {
	block.css("filter","brightness(30%)");
	block.css("opacity",".7");
	$(this).css("filter","brightness(100%)");
	$(this).css("opacity","1");
});

block.mouseleave(function() {
	block.css("filter","brightness(100%)");
	block.css("opacity","1");
});

scroll.click(function() {
	if(down==true){
		menu.hide("slide");
		down = false;
	}
	else{
		menu.show("slide");
		down = true;
	}
	return false;
});

scroll.click(function() {
	scroll.toggleClass("exit");
	return false;
});

if(sortable.innerHeight()>750 && mobile == false){
	sortable.css("max-height","750px");
	sortable.css("overflow-y","scroll");
}
