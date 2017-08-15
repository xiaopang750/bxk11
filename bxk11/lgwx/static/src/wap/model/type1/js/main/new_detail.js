/*
 *description:最新详情
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../../../../global/js/global/until');

	function New() {



	}

	New.prototype = {

		init: function() {

			this.showPage();
		},
		showPage: function() {

			var oTplNew,
				oNew,
				getDataUrl;

			wparam.si_id = gparam.si_id;

			oTplNew = require('../../tpl/build/new/detail');
			oNew = $('[sc = new_detail]');
			getDataUrl = reqBase + 'vinformation/info';

			until.show( oTplNew, oNew, getDataUrl, wparam );

		}

	}

	var oNew = new New();

	oNew.init();

});
