/*
 *description:产品页公共模块
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var pageName = $('body').attr('page-name');

	var aList = $('[script-role=product_list]');

	var nowName;

	aList.each(function(i){

		nowName = aList.eq(i).attr('sname');
		
		if ( nowName ==  pageName ) {

			aList.eq(i).addClass('active');

		}

	});

});