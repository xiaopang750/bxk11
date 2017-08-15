define(function(require, exports, module){
	
	var global = require('../global/global');
	var template = require('../lib/template/template');
	var FnDo = require('../global/fnDo');
	var pid = _query.pid;

	var url = '/index.php?g=Wap&m=Act&a=getproductpack&token=' + token + '&pid=' + pid + '&wecha_id=' + wid;

	var oName = $('[script-role = namer]');
	var oWrap = $('[script-role = data_wrap]');

	//oName.html('我收藏的商品');

	$.post(url, null, function(data){

		oName.html(data.data.product_name);

		var html = template('data_list', data);

		oWrap.html(html);

		loading();	

	}, 'json');
});