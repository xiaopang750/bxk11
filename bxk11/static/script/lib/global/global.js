/*
 *description:global_module
 *author:fanwei
 *date:2013/12/02
 */
define(function(require, exports, module) {
	
	var nav = require('./nav');
	var header_info = require('./header_info');
	var header_search = require('./header_search');
	var header_upload = require('./header_upload');
	var Tool = require('./tool');
	var fancybox = require('../plugin/box/fancybox');
	var login = require('../../lib/global/box_Login.js');


	/* fix工具栏 */
	window.oBc = new Tool();

	oBc.init(oBc.backTopTemp);

});