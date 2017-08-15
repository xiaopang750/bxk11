define(function(require, exports, module){
	

	var global = require('../global/global');
	var template = require('../lib/template/template');
	var FnDo = require('../global/fnDo');

	var url = '/index.php?g=Wap&m=User&a=getmytuan&token=' + token + '&wecha_id=' + wid;
	var oName = $('[script-role = namer]');
	var oWrap = $('[script-role = data_wrap]');

	oName.html('我参加的团购');

	$('[script-role = about_us]').hide();

	$.post(url, null, function(data){

		var html = template('data_list', data);

		oWrap.html(html);

		loading();	

	}, 'json');


});