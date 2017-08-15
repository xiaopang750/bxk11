/*
 *description:到店体验
 *author:fanwei
 *date:2014/06/22
 */
define(function(require, exports, module){
	
	var param = require('../../../../global/js/global/getParam');
	var FnDo = require('../../../../global/js/global/fnDo');
	var until = require('../../../../global/js/global/until');
	var url = reqBase + 'vgoods/getlist';
	require('../../../../global/js/global/loading');
	var tip = require('../../../../global/js/global/tip');
	var focus = require('../../../../global/js/widget/focus/focus');

	var loadingTimer;
	$(document).ready(function(){

		clearTimeout( loadingTimer );
		loadingTimer = setTimeout(loading, 500);

	});
	
	//todo
	var url = reqBase + 'vshop/like';
	var todo = new FnDo({
		oWrap: $('[script-role = product_footer]'),
		sTarget: 'fav',
		fnDo: function(oThis) {

			wparam.shop_id = gparam.shop_id;

			if ( !oThis.hasClass('active') ) {

				this.req(url, wparam, function(data){

					oTip.text('已收藏');

					oThis.addClass('active');	

				});

			} else {

				this.req(url, wparam, function(data){

					oTip.text('已取消收藏');

					oThis.removeClass('active');	

				});

			}

		}
	});

	todo.init();

	function Goshop() {



	}

	Goshop.prototype = {

		init: function() {

			this.showPage();

			this.events();
		},
		events: function() {

			

		},
		showMap: function(l, t, name) {

			var map = new BMap.Map("map");            
			map.centerAndZoom(new BMap.Point(l,t),15); 


			var marker1 = new BMap.Marker(new BMap.Point(l, t));  
			map.addOverlay(marker1);       

			var infoWindow1 = new BMap.InfoWindow(name);
			marker1.addEventListener("click", function(){this.openInfoWindow(infoWindow1);}); 

		},
		showPage: function() {

			var oTplShop,
				oShop,
				getDataUrl,
				_this,
				l,
				t,
				name;

			oTplShop = require('../../tpl/build/shop/list');
			oShop = $('[sc = go_shop]');
			getDataUrl = reqBase + 'vshop/info';
			//gparam.shop_id = gparam.shop_id;
			wparam.shop_id = gparam.shop_id;
			_this = this;

			until.show(oTplShop, oShop, getDataUrl, wparam, function(data){

				var foc = new focus({
					cycle: true,
					auto: true,
					oWrap: $('[widget-role = focus-wrap]')
				});

				foc.init();

				l = data.data.shop_longitude;
				t = data.data.shop_latitude;
				name = data.data.shop_address;

				_this.showMap(l, t, name);

			});
		}

	}

	var oGoshop = new Goshop();

	oGoshop.init();



});