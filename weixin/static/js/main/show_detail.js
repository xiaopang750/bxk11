define(function(require, exports, module){
	
	var global = require('../global/global');
	var template = require('../lib/template/template');
	var FnDo = require('../global/fnDo');
	var pid = _query.pid;

	var url = '/index.php?g=Wap&m=Rooms&a=getproducts&token=' + token + '&wecha_id=' + wid + '&pid=' + pid;

	var oName = $('[script-role = namer]');
	var oWrap = $('[script-role = data_wrap]');


	$.post(url, null, function(data){

		//oName.html(data.data.product_name);

		var html = template('data_list', data);

		oWrap.html(html);

		loading();

	}, 'json');
	
});