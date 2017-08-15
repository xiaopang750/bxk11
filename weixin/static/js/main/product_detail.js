define(function(require, exports, module){
	
	var global = require('../global/global');
	var template = require('../lib/template/template');
	var FnDo = require('../global/fnDo');

	var pid = _query.pid;
	var url = '/index.php?g=Wap&m=Products&a=getinfo&token=' + token + '&pid=' + pid + '&wecha_id=' + wid;

	var oName = $('[script-role = namer]');
	var oWrap = $('[script-role = data_wrap]');

	//oName.html('我收藏的商品');

	$.post(url, null, function(data){

		oName.html(data.data.product_name.length > 10 ? data.data.product_name.substring(0,10) + '...' : data.data.product_name);

		var html = template('data_list', data);

		oWrap.html(html);

		loading();	

	}, 'json');

	//todo
	var todo = new FnDo({
		oWrap: $('[script-role = data_wrap]'),
		sTarget: 'fav',
		fnDo: function(oThis) {

			if ( oThis.attr('is_like') == '0' ) {

				var url = oThis.attr('target');

				this.req(url, null, function(data){

					oTip.text('已收藏');

					oThis.attr('is_like', '1');	

					oThis.addClass('active');

				});

			}

		}
	});

	todo.init();

});