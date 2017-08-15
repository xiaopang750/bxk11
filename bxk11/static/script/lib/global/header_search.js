define(function(require, exports, module) {
	
	var placeholder = require('../plugin/ui/placeholder');

	var oSearchWrap,
		oSearchLogo,
		oSearchInput,
		oSearchBtn,
		addedClass,
		btnedClass,
		sTip,
		sValue;

	oSearchWrap = $('[script-role=header_search_wrap]');
	oSearchLogo = $('[script-role=search_icon]');
	oSearchInput = $('[script-role=header_search_input]');
	oSearchBtn = $('[script-role=header_search_mirror]');
	addedClass = 'actw178';
	btnedClass = 'actb178';
	sTip = '搜索家居博文、产品、装修问题';

	/* 搜索 */
	placeholder(oSearchInput,{name: sTip});

	oSearchBtn.click(function(){

		if(oSearchInput.val() == sTip || oSearchInput.val() == '')
		{
			return;
		}
		else
		{
			sValue = oSearchInput.val();


		}

	});

});