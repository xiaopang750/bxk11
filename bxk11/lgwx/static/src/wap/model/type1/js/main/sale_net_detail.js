/*
 *description:index
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../../../../global/js/global/until');

	function Sale() {



	}

	Sale.prototype = {

		init: function() {

			this.showPage();

			
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

			var oTplNet,
				oNet,
				getDataUrl,
				_this,
				l,
				t,
				name;

			_this = this;
			oTplNet = require('../../tpl/build/sale_net/detail');
			oNet = $('[sc = sale_net_detail]');
			getDataUrl = reqBase + 'vshop/info';
			wparam.shop_id = gparam.shop_id;

			until.show( oTplNet, oNet, getDataUrl, wparam , function( data ){

				l = data.data.shop_longitude;
				t = data.data.shop_latitude;
				name = data.data.shop_address;

				_this.showMap(l, t, name);

			});

		}

	}

	var oSale = new Sale();

	oSale.init();

});