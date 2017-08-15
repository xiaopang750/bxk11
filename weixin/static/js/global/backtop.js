define(function(require, exports, module){

	$('[script-role = backtop]').on('click', function(e){

		document.documentElement.scrollTop = 0;
		document.body.scrollTop = 0;

	});

});