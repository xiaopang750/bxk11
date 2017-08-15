/*
 *description:我喜欢的商品
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../../../../global/js/global/until');
	var FnDo = require('../../../../global/js/global/fnDo');
	var tip = require('../../../../global/js/global/tip');

	var oTip = new tip();
	oTip.init();

	//todo
	var url = reqBase + 'vgoods/like';

	var todo = new FnDo({
		oWrap: $('[sc = goods]'),
		sTarget: 'fav',
		fnDo: function(oThis) {

			var gid = oThis.attr('gid');
			wparam.goods_id = gid;

			if ( oThis.attr('is_like') == '1' ) {

				this.req(url, wparam, function(data){
					oTip.text('已取消收藏');
					oThis.attr('is_like', '0');
					oThis.html('收藏');
				});

			} else {

				this.req(url, wparam, function(data){
					oTip.text('已收藏');
					oThis.attr('is_like', '1');
					oThis.html('取消收藏');
				});
			}	

		}
	});

	todo.init();

	
	function Goods() {



	}

	Goods.prototype = {

		init: function() {

			this.showPage();
		},
		showPage: function() {

			var oTplGoods,
				oGoods,
				getDataUrl;

			oTplGoods = require('../../tpl/build/info/goods');
			oGoods = $('[sc = goods]');
			getDataUrl = reqBase + 'vgoods/likelist';

			until.show( oTplGoods, oGoods, getDataUrl, wparam );

		}

	}

	var oGoods = new Goods();

	oGoods.init();

});