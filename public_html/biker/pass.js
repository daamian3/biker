var haslo = document.getElementById("haslo");
var vhaslo = document.getElementById("vhaslo");

vhaslo.addEventListener("keyup", function(){

	if(haslo.value==0) vhaslo.classList.remove('bad');
	if(haslo.value!=vhaslo.value && haslo.value!=0) vhaslo.classList.add('bad');
	else if(haslo.value!=0){

		vhaslo.classList.remove('bad');
		vhaslo.classList.add('good');

	}
}, false);

var calculateComplexity = function (password) {

	var complexity = 0;

	var regExps = [

		/[a-z]/,
		/[A-Z]/,
		/[0-9]/,
		/.{8}/,
		/[!-//:-@[-`{-ÿ]/

	];

	regExps.forEach(function (regexp) {

		if (regexp.test(password)) {

			complexity++;

		}
	});

	return {

		value: complexity,
		max: regExps.length

	};
};

var checkPasswordStregth = function (password) {

	var progress = document.querySelector('#passwordComplexity'),
	complexity = calculateComplexity(this.value);

	progress.value = complexity.value;
	progress.max = complexity.max;

};

haslo.addEventListener('keyup', checkPasswordStregth);
