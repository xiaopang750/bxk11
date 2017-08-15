/*
 *description:经销网络
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	//var fenye = require('../../../../global/js/widget/dom/fenye');
	var scrollLoad = require('../../../../global/js/widget/dom/scrollLoad');

	function Sale() {



	}

	Sale.prototype = {

		init: function() {

			this.scroller();
		},
		showPage: function() {

			var oTplSale,
				oSale,
				getDataUrl;

			oTplSale = require('../../tpl/build/sale_net/list');
			oSale = $('[sc = sale_net]');
			getDataUrl = reqBase + 'vshop/getlist'

			fenye(oSale, getDataUrl , oTplSale, '10', wparam, function(data){});

		},
		scroller: function() {

			
			var oTplNew,oNew;
			var oScroll = new scrollLoad();
			var oTip = $('[sc = monsary-tip]');

			oTplNew = require('../../tpl/build/sale_net/list');
			oNew = $('[sc = sale_net]');
			
			oScroll.requestUrl = reqBase + 'vshop/getlist';
			oScroll.oTpl = oTplNew;
			oScroll.param = wparam;
			oScroll.param.num = 10;
			oScroll.oDataWrap = oNew;
			oScroll.oTip = oTip;
			oScroll.init();

		}

	}

	var oSale = new Sale();

	oSale.init();

});
