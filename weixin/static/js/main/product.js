define(function(require, exports, module){
	
	var global = require('../global/global');
	var template = require('../lib/template/template');
	var FnDo = require('../global/fnDo');

	var roomid = _query.room;
	var url = '/index.php?g=Wap&m=Project_room_bill_item&a=getindex&token=' + token + '&room=' + roomid + '&wecha_id=' + wid;
	var oName = $('[script-role = namer]');
	var oWrap = $('[script-role = data_wrap]');
	var oTitle = $('[script-role = data_title]');

	//oName.html('我收藏的商品');

	$.post(url, null, function(data){

		var html = template('data_list', data);

		oWrap.html(html);

		oTitle.html( template('data_title', data) );

		oName.html(data.data.room_name);

		loading();	

	}, 'json');

	//todo
	/*var todo = new FnDo({
		oWrap: $('[script-role = data_wrap]'),
		sTarget: 'fav',
		fnDo: function(oThis) {

			console.log(oThis.attr('is_like'))

			if ( oThis.attr('is_like') == '1' ) {

				var url = oThis.attr('target');

				this.req(url, null, function(data){

					oTip.text('已取消收藏');

					oThis.attr('is_like', '0');

					oThis.html('已取消');	

				});

			}

		}
	});

	todo.init();*/
	
});