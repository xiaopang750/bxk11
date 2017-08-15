/*
 *description:我的装修笔记
 *author:fanwei
 *date:2014/06/25
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var scrollLoad = require('../../../../global/js/widget/dom/scrollLoad');
	//var until = require('../../../../global/js/global/until');
	//var FnDo = require('../../../../global/js/global/fnDo');

	//var url = reqBase + 'common/service_like';

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

			this.events();
			
			this.scroller();
		},
		events: function() {

			$(document).on('click', '[sc = diary-list]', function(){

				window.location = $(this).attr('link');

			});

		},
		scroller: function() {

			var oTplDiary,
				oShop;
			var oScroll = new scrollLoad();
			var oTip = $('[sc = monsary-tip]');

			oTplDiary = require('../../tpl/build/info/diary');
			oShop = $('[sc = diary]');
			
			oScroll.requestUrl = reqBase + 'vuser/notelist';
			oScroll.oTpl = oTplDiary;
			oScroll.param = wparam;
			oScroll.param.num = 10;
			oScroll.oDataWrap = oShop;
			oScroll.oTip = oTip;
			oScroll.init();

		}

	}

	var oShop = new Shop();

	oShop.init();

});