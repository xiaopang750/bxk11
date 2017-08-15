define(function(require, exports, module){
	
	var global = require('../global/global');
	var fenye = require('../global/fenye');
	var url = '/index.php?g=Wap&m=Act&a=getindex&token=' + token + '&wecha_id=' + wid;


	fenye(url, 'data_list', '5');
									 
});