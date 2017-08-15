define(function(require, exports, module){
	
	function Loading(callBack) {

		var aImage = $('img');
		var count = 0;
		var num = aImage.length;
		var src;

		aImage.each(function( i ){

			src = aImage.attr('src');

			aImage[i].onload = function() {

				count ++ ;

				if ( count == num) {

					callBack && callBack();

				};

			};

			aImage[i].src = src;

		});

	}

});