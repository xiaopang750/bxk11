/*
 *description:回到顶部
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){

	$(document).on('click', '[sc = backtop]', function(e){

		document.documentElement.scrollTop = 0;
		document.body.scrollTop = 0;

	});

});