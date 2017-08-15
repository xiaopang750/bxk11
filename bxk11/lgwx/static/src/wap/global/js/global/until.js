/*
 *description:tool
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	function Until() {



	}

	Until.prototype = {

		show: function(oTpl, oWrap, url, param, sucDo, failDo, changeData) {

			var html;

			$.ajax({
				url: url,
				data: param,
				dataType: 'json',
				type: 'post',
				async: false,
				success: function( data ) {
					
					changeData && changeData(data);

					if ( !data.err ) {	

						html = oTpl( data );

						oWrap.html( html ); 

						sucDo && sucDo( data ); 

					} else if( data.err == 1 ) {

						oWrap.css('text-align','center');
						oWrap.html( '暂无数据' );

						failDo && failDo( data );

					} else if( data.err == 2 ) {

						alert(data.msg);

						window.location = data.data;
					}

				}
			});

			/*$.post(url, param, function( data ){

				

			},'json');*/

		}

	}

	var _until = new Until();

	module.exports = _until;	

});