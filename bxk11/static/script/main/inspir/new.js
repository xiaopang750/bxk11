define(function(require, exports, module) {

	var bodyParse = require('../../lib/http/bodyParse');

	var dataParam = bodyParse() ? bodyParse() : {};

	if(!dataParam.type) dataParam.type = '';
	if(!dataParam.tag) dataParam.tag = '';
	
	
	var global = require('../../lib/global/global');

	var nav_tag = require('../../sub/inspir/nav_tag_banner');

	var monsary = require('../../lib/plugin/dom/monsary');

	var left_nav = require('../../sub/inspir/left_nav');

	var artical = require('../../sub/inspir/artical');

	var saveData =require('../../lib/dom/saveData.js');

	//返回顶部
	oBc.clear();

	oBc.bottom = 73;

	oBc.init(oBc.bookTopTemp);

	//导航
	var oLnav = new left_nav();

	oLnav.init(dataParam.type);	

	//瀑布流
	
	var oWrap = $('[script-role=monsary_wrap]');

	var mon = new monsary({
		oWrap: oWrap,
		url: '/index.php/view/tag/tagnew',
		tplId: 'inspir_artical',
		param: dataParam,
		renderDo: function(data)
		{	
			var aList = oWrap.find('[script-role = content_list_jia178]');

			saveData(aList, data);
		},
		isStartLoadingShow : 'false'
	});

	mon.init();

	artical($('[script-role = monsary_wrap]'));

});