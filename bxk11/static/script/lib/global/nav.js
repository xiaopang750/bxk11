define(function(require, exports, module) {
	
	var sPage = $('body').attr('main_type');

	var aHeadNav = $('[script-role = head_nav_list]');

	aHeadNav.each(function(i){

		if(aHeadNav.eq(i).html() == sPage)
		{
			aHeadNav.eq(i).addClass('actb');
		}

	});

});