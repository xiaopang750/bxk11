define(function(require, exports, module){
	
	var global = require('../global/global');
	var bodyParse = require('../global/bodyParse');
	var FnDo = require('../global/fnDo');
	var template = require('../lib/template/template');

	var id = _query.actid;
	var url = '/index.php?g=Wap&m=Act&a=getact&token='+ token +'&actid=' + id + '&wecha_id=' + wid;

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
		sTarget: 'foc',
		fnDo: function(oThis) {
				
			if ( oThis.attr('is_follow') == 0 ) {

				var url = oThis.attr('focUrl');

				oThis.html('已关注');

				this.req(url, null, function(){

					oTip.text('关注成功');		

				});

			}
		}
	});

	todo.init();

});