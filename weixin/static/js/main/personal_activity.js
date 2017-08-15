define(function(require, exports, module){
	
	var global = require('../global/global');
	var template = require('../lib/template/template');
	var FnDo = require('../global/fnDo');

	var url = '/index.php?g=Wap&m=User&a=getmyacts&token=' + token + '&wecha_id=' + wid;
	var oName = $('[script-role = namer]');
	var oWrap = $('[script-role = data_wrap]');

	oName.html('我关注的活动');

	$('[script-role = about_us]').hide();

	$.post(url, null, function(data){

		var html = template('data_list', data);

		oWrap.html(html);	

		loading();

	}, 'json');

	//todo
	var todo = new FnDo({
		oWrap: $('[script-role = data_wrap]'),
		sTarget: 'foc',
		fnDo: function(oThis) {

			if ( oThis.attr('is_follow') == '1' ) {
				
				var url = oThis.attr('target');
				var type = oThis.attr('type');

				var _this = this;

				this.req(url, {type: type}, function(data){

					oTip.text('已取消关注');

					oThis.attr('is_follow', '0');

					oThis.html('已取消');

				});

			}

		}
	});

	todo.init();

});