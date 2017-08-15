/*
 *description:global
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var param = require('../../../../global/js/global/getParam');
	var until = require('../../../../global/js/global/until');
	var tip = require('../../../../global/js/global/tip');
	require('../../../../global/js/global/loading');

	var pageIndex = $('body').attr('page-index');

	if( pageIndex ) {

		var oTplNav,
		oNav,
		getDataUrl,
		level;

		level = gparam.levelpage;
		oNav = $('[sc = nav-list]');

		oTplNav = require('../../tpl/build/nav/level1');
		getDataUrl = reqBase + 'common/topmenu';	
		until.show( oTplNav, oNav, getDataUrl, gparam );

	}

	var loadingTimer;

	$(document).ready(function(){

		clearTimeout( loadingTimer );
		loadingTimer = setTimeout(function(){

			loading();

		},500);

	});

});