define(function(require, exports, module){
	
	function rnd(m ,n) {

		return parseInt(Math.random() * ( (m + 1) -n) + n);

	}

	return rnd;

});