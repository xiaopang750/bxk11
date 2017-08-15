define(function(require, exports, module) {

	var bodyParse = require('../../lib/http/bodyParse');

	var dataParam = bodyParse() ? bodyParse() : {};

	if(!dataParam.type) dataParam.type = '';
	if(!dataParam.tag) dataParam.tag = '';
	
	var global = require('../../lib/global/global');

	var nav_tag = require('../../sub/inspir/nav_tag_banner');

	var monsary = require('../../lib/plugin/dom/monsary');

	var left_nav = require('../../sub/inspir/left_nav');

	//返回顶部
			
	oBc.clear();

	oBc.bottom = 73;

	oBc.init(oBc.bookTopTemp);

	//导航
	var oLnav = new left_nav();

	oLnav.init(dataParam.type);	

	//瀑布流
	var mon = new monsary({
		oWrap: $('[script-role=monsary_wrap]'),
		url: '/index.php/view/tag/index',
		tplId: 'inspir_monsary',
		param: dataParam,
		dataName: 'contentlist',
		preLoadImage: 'true'
	});

	mon.init();

});