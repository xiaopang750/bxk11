/*
 *description:登录框
 *author:fanwei
 *date:2013/12/02
 */
define(function(require, exports, module) {
			
	var Entry = require('../../main/entry/entry');
	var Login = new Entry();
	var sHref = window.location.href;

	Login.HOME_URL = sHref;

	Login.init();

});