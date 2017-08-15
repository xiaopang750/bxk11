/**
 *description:solve
 *author:fanwei
 *date:2014/4/16
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var Roll = require('../widget/dom/roll');

	var aList = $('[sc = price-list]');

	var index,
		mid;

	mid = Math.ceil(aList.length/2);	

	$(document).on('mouseenter', '[sc = price-list]', function(){

		aList.removeClass('active-l');
		aList.removeClass('active-r');

		index = $(this).index();

		if( index<mid ) {

			$(this).addClass('active-l');

		} else {

			$(this).addClass('active-r');
		}

	});


	//roll
	var roll = new Roll({
		oWrap: $('[script-role = widget-roll-container]')
	});

	roll.init();
	
});