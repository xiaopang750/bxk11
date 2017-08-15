/*
 *description:我关注的商家
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var scrollLoad = require('../../../../global/js/widget/dom/scrollLoad');
	//var until = require('../../../../global/js/global/until');
	//var FnDo = require('../../../../global/js/global/fnDo');

	var url = reqBase + 'common/service_like';

	//todo
	/*var todo = new FnDo({
		oWrap: $('[sc = shop]'),
		sTarget: 'foc',
		fnDo: function(oThis) {
			
			if ( oThis.attr('is_follow') == '0' ) {

				this.req(url, wparam, function(data){

					oTip.text('已取消关注');

					oThis.attr('is_follow', '1');

					oThis.html('已取消');	

				});

			}

		}
	});

	todo.init();*/

	
	function Shop() {



	}

	Shop.prototype = {

		init: function() {

			this.scroller();
		},
		showPage: function() {
			/*return;
			var oTplShop,
				oShop,
				getDataUrl;

			oTplShop = require('../../tpl/build/info/shop');
			oShop = $('[sc = shop]');
			getDataUrl = reqBase + 'vuser/shoplikes';

			until.show( oTplShop, oShop, getDataUrl, wparam );*/

		},
		scroller: function() {

			var oTplNew,oNew;
			var oScroll = new scrollLoad();
			var oTip = $('[sc = monsary-tip]');

			oTplNew = require('../../tpl/build/info/shop');
			oNew = $('[sc = shop]');
			
			oScroll.requestUrl = reqBase + 'vuser/shoplikes';
			oScroll.oTpl = oTplNew;
			oScroll.param = wparam;
			oScroll.param.num = 10;
			oScroll.oDataWrap = oNew;
			oScroll.oTip = oTip;
			oScroll.init();

		}

	}

	var oShop = new Shop();

	oShop.init();

});