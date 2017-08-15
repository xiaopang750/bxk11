/*
 *description:检测是否审核通过
 *author:fanwei
 *date:2014/05/07
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	
	$.post('/lgwx/index.php/view/join/join_status', function(data){

		var info,
			type,
			oSuc,
			oClose,
			oReason,
			oReasonUrl;


		info = data.data;	
		type = info.show_type;
		oSuc = $('[sc = suc]');
		oFail = $('[sc = fail]');
		oClose = $('[sc = close]');

		if ( info.is_redirect == "1" ) {

			window.location = info.join_url;

		} else {

			if ( type == 1 ) {

				oSuc.show();
				oClose.attr('href', info.join_url);

			}  else {

				oReason = $('[sc = fail-text]');
				oReasonUrl = $('[sc = fail-link]');

				oFail.show();

				oReason.html( info.join_laudit_desc );
				oReasonUrl.attr('href', info.join_url);

			}

		}	

	}, 'json');

});