/*
 *description:相关案例
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../../../../global/js/global/until');
	var goodsDetail = require('../sub/goods/goods_global');


	function ShowDetail() {



	}

	ShowDetail.prototype = {

		init: function() {

			this.showPage();
		},
		showPage: function() {

			var oTplShowDetail,
				oShowDetail,
				getDataUrl;

			oTplShowDetail = require('../../tpl/build/show/detail');
			oShowDetail = $('[sc = show_detail]');
			getDataUrl = reqBase + 'vgoods/getroomlist';

			until.show( oTplShowDetail, oShowDetail, getDataUrl, wparam );

		}

	}

	var oShowDetail = new ShowDetail();

	oShowDetail.init();

});