/*
 *description:index
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../../../../global/js/global/until');

	
	function Brand() {



	}

	Brand.prototype = {

		init: function() {

			this.showPage();
		},
		showPage: function() {

			var oTplBrand,
				oBrand,
				getDataUrl;

			oTplBrand = require('../../tpl/build/brand/list');
			oBrand = $('[sc = brand-wrap]');
			getDataUrl = reqBase + 'vbrand/getlist';

			until.show( oTplBrand, oBrand, getDataUrl, wparam/*, null, null, function(data){

				data.data = [
					{
						apply_brand_img: 'http://www.baidu.com/img/bdlogo.gif',
						apply_brand_name: 'sdfsdfsdfa',
						apply_brand_ename: 'sdfsdfsadfasdf',
						apply_class: '13114394409',
						apply_brand_seodesc: 'fanwei',
						certified_status: '0'
					}
				]

			} */);

		}

	}

	var brand = new Brand();

	brand.init();

});