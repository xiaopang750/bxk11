define(function(require, exports, module) {
	
	var template = require('../../lib/template/template.js');
	var request = require('../../lib/http/request.js');
	var saveData =require('../../lib/dom/saveData.js');
	var monsary = require('../../lib/plugin/dom/monsary');

	var tempId = 'indexContent178_tpl';
	var oContentWrap = $('[script-role=index_content_wrap]');
	
	var mon = new monsary({
		oWrap: oContentWrap,
		url: '/index.php/view/wish/explore_design',
		tplId: tempId,
		renderDo: function(data)
		{	
			var aList = oContentWrap.find('[script-role = content_list_jia178]');

			saveData(aList, data);
		},
		isStartLoadingShow : 'false'
	});

	mon.init();

});