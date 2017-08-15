/*
 *description:about_us
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../../../../global/js/global/until');

	function About() {



	}

	About.prototype = {

		init: function() {

			this.showPage();

			
		},
		showMap: function(l, t, name) {

			var map = new BMap.Map("map");            
			map.centerAndZoom(new BMap.Point(116.404,39.915),15); 


			var marker1 = new BMap.Marker(new BMap.Point(116.404, 39.915));  
			map.addOverlay(marker1);       

			var infoWindow1 = new BMap.InfoWindow(name);
			marker1.addEventListener("click", function(){this.openInfoWindow(infoWindow1);}); 

		},
		showPage: function() {

			var oTplAbout,
				oAbout,
				getDataUrl,
				_this,
				l,
				t,
				name;

			_this = this;
			oTplAbout = require('../../tpl/build/about/detail');
			oAbout = $('[sc = about_us]');
			getDataUrl = reqBase + 'vshop/index';

			until.show( oTplAbout, oAbout, getDataUrl, wparam , function( data ){

				/*l = data.data.shop_longitude;
				t = data.data.shop_latitude;
				name = data.data.shop_address;

				_this.showMap(l, t, name);*/

			});

		}

	}

	var oAbout = new About();

	oAbout.init();

});