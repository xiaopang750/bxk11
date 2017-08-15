/*
 *description:点击导航上的首页,把flg参数传到infidea;
 *author:fanwei
 *date:2014/06/11
 */
define(function(require, exports, module){
	
	var bodyParse = require('../../widget/http/bodyParse');
	var param = bodyParse();
	
	if( param ) {

		$(document).on('click', '[sc = extend-btn]', function(){

			if( param.flg ) {

				window.open( $(this).attr('href') + '?' + param.flg );

			}

			return false;

		});

	}
});