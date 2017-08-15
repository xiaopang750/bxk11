/*
 *description:getParam
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var bodyParse = require('./bodyParse');

	var param = bodyParse();

	window.sid = param.service_id;
	window.oid = param.openid;
	window.wparam = {service_id: sid, openid:oid};
	window.gparam = param;
	window.reqBase = '/lgwx/index.php/wap/';

});