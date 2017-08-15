/*
 *description:loading
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	window.loading = function(callBack) {

		show();

		var aImage = $('img');
		var count = 0;
		var num = aImage.length;
		var src;

		aImage.each(function( i ){

			var oImage = new Image();

			src = aImage.eq(i).attr('src');

			oImage.onload = function() {

				count ++ ;

				if ( count == num) {

					hide();
					
					callBack && callBack();

				};

			};

			oImage.onerror = function() {

				count ++ ;

				if ( count == num) {

					hide();

					callBack && callBack();

				};

			};

			oImage.src = src;

		});

		function hide() {

			$('#cover').animate({opacity: 0},300,'ease-out',function(){

				$('#cover').hide();

				
			});	

		}

		function show() {

			$('#cover').show();
			$('#cover').css('opacity', '1');
		}

	}

});