/*
 *description:首页
 *author:fanwei
 *date:2013/12/03
 */
define(function(require, exports, module) {

	var global = require('../../lib/global/global');
	var focus = require('../../lib/plugin/dom/focus');
	var right_info = require('../../sub/index/right_info');
	var left_content = require('../../sub/index/left_content');
	var globalFnDo = require('../../lib/module/globalFnDo');

	var oMain = $('[script-role=index_main_content]');

	var pageDo = new globalFnDo({
		oWrap : oMain
	});

	var _focus = new focus({
		oFocusWrap: $('[script-role = widget-focus-wrap]'),
		getDataUrl: '/static/script/lib/plugin/dom/data.js',
		picArr: [
				"/static/images/banner/xiaopang1.jpg", 
				"/static/images/banner/xiaopang2.jpg", 
				"/static/images/banner/xiaopang3.jpg"
			]
	});

	_focus.init();

	//console.log(focus)

	pageDo.init();

});