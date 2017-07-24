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

if(mobile == false){
	$(function() {
		var sortableList = $('#sortable');
		sortableList.sortable({
			revert: "200",
			scroll: false,
			cursor: 'move',
			handle: ".handle",
			placeholder: 	'sortable-placeholder',
			start: function(event, ui) {
				ui.placeholder.html(ui.item.html(	));
			}
		});
		sortableList.disableSelection();
	});
}
else{
	var handle = document.getElementsByClassName("handle");
	handle[0].style.display = "none";
	handle[1].style.display = "none";
	handle[2].style.display = "none";
	handle[3].style.display = "none";
}

var moto = $(".moto");
var menu = $("#menu");
var scroll = $("#scroll");
var down = false;
var block = $(".block");

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
		menu.slideUp("slow");
		down = false;
	}
	else{
		menu.slideDown("slow");
		down = true;
	}
	return false;
});

scroll.click(function() {
	scroll.toggleClass("exit");
	return false;
});
