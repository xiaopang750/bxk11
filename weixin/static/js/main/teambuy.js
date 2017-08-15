define(function(require, exports, module){
	
	var global = require('../global/global');
	var FnDo = require('../global/fnDo');
	var template = require('../lib/template/template');

	var id = _query.actid;
	var url = '/index.php?g=Wap&m=Act&a=gettuan&token='+ token +'&actid=' + id + '&wecha_id=' + wid;

	var oName = $('[script-role = namer]');

	$.post(url, null, function(data){

		var html = template('data_list', data);

		$('[script-role = data_wrap]').html(html);

		oName.html(data.data.act_name);

		loading();

	}, 'json');




	//todo
	var todo = new FnDo({
		oWrap: $('[script-role = data_wrap]'),
		sTarget: 'group',
		fnDo: function(oThis) {
				
			if ( oThis.attr('is_join') == 0 ) {

				var url = oThis.attr('followUrl');

				oThis.html('已参加');

				this.req(url, null, function(){

					oTip.text('报名成功');		

				});

			}
		}
	});

	todo.init();

});