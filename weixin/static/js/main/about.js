define(function(require, exports, module){
	
	var global = require('../global/global');	
	var focus = require('../widget/focus/focus');
	var oName = $('[script-role = namer]');

	oName.html('关于我们');

	//foc
	var foc = new focus({
		oWrap: $('[widget-role = focus-wrap]'),
		url: '/index.php?g=Wap&m=Index&a=getSlideIndex&token=' + token + '&wecha_id=' + wid
	});

	foc.init();

	window.onload = function() {

		loading();

	};

});