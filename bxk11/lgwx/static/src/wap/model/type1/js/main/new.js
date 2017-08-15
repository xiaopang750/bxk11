/*
 *description:最新资讯
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	//var fenye = require('../../../../global/js/widget/dom/fenye');
	//var scrollLoad = require('../../../../global/js/widget/dom/scrollLoad');
	var until = require('../../../../global/js/global/until');

	function New() {



	}

	New.prototype = {

		init: function() {

			this.showPage();

			//this.scroller();
		},
		showPage: function() {
			//return;
			var oTplNew,
				oNew,
				getDataUrl;

			oTplNew = require('../../tpl/build/new/list');
			oNew = $('[sc = new-wrap]');
			getDataUrl = reqBase + 'vinformation/getlist'

			//fenye(oNew, getDataUrl , oTplNew, '10', wparam, function(data){});

			until.show( oTplNew, oNew, getDataUrl, wparam );

		},
		scroller: function() {

			
			var oTplNew,oNew;
			var oScroll = new scrollLoad();
			var oTip = $('[sc = monsary-tip]');

			oTplNew = require('../../tpl/build/new/list');
			oNew = $('[sc = new-wrap]');
			
			oScroll.requestUrl = reqBase + 'vinformation/getlist';
			oScroll.oTpl = oTplNew;
			oScroll.param = wparam;
			oScroll.param.num = 10;
			oScroll.oDataWrap = oNew;
			oScroll.oTip = oTip;
			oScroll.init();

		}

	}

	var oNew = new New();

	oNew.init();

});
