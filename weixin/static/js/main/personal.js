define(function(require, exports, module){
	
	var global = require('../global/global');
	var template = require('../lib/template/template');

	var url = '/index.php?g=Wap&m=User&a=getindex&token=' + token + '&wecha_id=' + wid;

	$('[script-role = about_us]').hide();

	$.post(url, null, function(data){

		$('[script-role = user_name]').html(data.data.nickname);

		$('[script-role = data_wrap]').html( template('data_list', data) );

		loading();

	}, 'json');

});