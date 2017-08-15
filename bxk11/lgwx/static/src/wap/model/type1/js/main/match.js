/*
 *description:套餐搭配
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../../../../global/js/global/until');
	var goodsDetail = require('../sub/goods/goods_global');

	
	function Match() {



	}

	Match.prototype = {

		init: function() {

			this.showPage();
		},
		showPage: function() {

			var oTplMatch,
				oMatch,
				getDataUrl;

			oTplMatch = require('../../tpl/build/match/list');
			oMatch = $('[sc = match]');
			getDataUrl = reqBase + 'vgoods/getpacklist';

			until.show( oTplMatch, oMatch, getDataUrl, wparam );

		}

	}

	var oMatch = new Match();

	oMatch.init();

});