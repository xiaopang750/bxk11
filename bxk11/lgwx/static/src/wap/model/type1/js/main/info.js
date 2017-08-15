/*
 *description:用户中心
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var param = require('../../../../global/js/global/getParam');
	var until = require('../../../../global/js/global/until');
	require('../../../../global/js/global/loading');
	
	var loadingTimer;
	$(document).ready(function(){

		clearTimeout( loadingTimer );
		loadingTimer = setTimeout(loading, 500);

	});

	function Info() {



	}

	Info.prototype = {

		init: function() {

			this.showPage();

			this.events();
		},
		events: function() {


			//back
			/*$('[sc = back]').on('click', function(){

				window.history.back();

			});*/

		},
		showPage: function() {

			var oTplInfo,
				oInfo,
				getDataUrl;

			oTplInfo = require('../../tpl/build/info/list');
			oInfo = $('[sc = info]');
			getDataUrl = reqBase + 'vuser/index';

			until.show( oTplInfo, oInfo, getDataUrl, wparam );

		}

	}

	var oInfo = new Info();

	oInfo.init();

});