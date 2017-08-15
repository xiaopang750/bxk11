define(function(require, exports, module){
	
	var global = require('../global/global');
	var template = require('../lib/template/template');
	
	var room = _query.room;
	var url = '/index.php?g=Wap&m=Rooms&a=getroompic&token='+ token +'&room=' + room + '&wecha_id=' + wid;

	$.post(url, null, function(data){

		var html = template('data_list', data);

		$('[script-role = data_wrap]').html(html);

		loading();

	}, 'json');

});