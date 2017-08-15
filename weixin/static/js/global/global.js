define(function(require, exports, module){

	var backtop = require('../global/backtop');
	var bodyParse = require('../global/bodyParse');
	var tip = require('../global/tip');
	require('../global/fnDo');
	require('../global/navhilight');

	window._query = bodyParse();
	window.token = _query.token;
	window.wid = _query.wecha_id;


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