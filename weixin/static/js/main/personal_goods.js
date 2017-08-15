define(function(require, exports, module){
	
	var global = require('../global/global');
	var template = require('../lib/template/template');
	var FnDo = require('../global/fnDo');
	var fenye = require('../global/fenye');

	var url = '/index.php?g=Wap&m=User&a=getmyproducts&token=' + token + '&wecha_id=' + wid;
	var oName = $('[script-role = namer]');
	var oWrap = $('[script-role = data_wrap]');

	oName.html('我收藏的商品');

	$('[script-role = about_us]').hide();

	fenye(url, 'data_list', '5');

	/*$.post(url, null, function(data){

		var html = template('data_list', data);

		oWrap.html(html);	

	}, 'json');*/

	//todo
	var todo = new FnDo({
		oWrap: $('[script-role = data_wrap]'),
		sTarget: 'fav',
		fnDo: function(oThis) {

			console.log(oThis.attr('is_like'))

			if ( oThis.attr('is_like') == '1' ) {

				var url = oThis.attr('target');

				this.req(url, null, function(data){

					oTip.text('已取消收藏');

					oThis.attr('is_like', '0');

					oThis.html('已取消收藏');	

				});

			}

		}
	});

	todo.init();

});