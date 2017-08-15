define(function(require, exports, module){
	
	var sPage = $('body').attr('page-role');
	var aText = $('[script-role = main_nav]').find('[script-role = text]');
	var aPtext = $('[script-role = product_footer]').find('[script-role = product_list]');

	aText.each(function(i){

		if ( sPage == aText.eq(i).text() ) {

			aText.eq(i).addClass('active');

		}

	});

	aPtext.each(function(i){

		if ( sPage == aPtext.eq(i).text() ) {

			aPtext.eq(i).addClass('active');

		}

	});

});