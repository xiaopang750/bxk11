define(function(require, exports, module){
		
	var focus = require('../widget/focus/focus');
	var global = require('../global/global');
	var FnDo = require('../global/fnDo');
	var loadMore = require('../global/loadMore');
	var template = require('../lib/template/template');

	//foc
	var foc = new focus({
		oWrap: $('[widget-role = focus-wrap]'),
		url: '/index.php?g=Wap&m=Index&a=getSlideIndex&token=' + token + '&wecha_id=' + wid
	});

	foc.init();

	// loadMores
	var loader = new loadMore({
		oWrap: $('[script-role = data_wrap]'), 
		btn: $('[script-role = loadBtn]'),
		row: 3,
		reqUrl: '/index.php?g=Wap&m=Index&a=getwapIndex&token='+ token + '&wecha_id=' + wid,
		tplId: 'data_list',
		sucDo: function() {

			loading();

		}
	});

	loader.init();


	//rec
	var url = '/index.php?g=Wap&m=Index&a=isfollowserver&token=' + token + '&wecha_id=' + wid;

	$.post(url, function(data){	

		var html = template('data_title', data);

		$('[script-role = data_title]').html(html);

	},'json');


	//todo
	var todo = new FnDo({
		oWrap: $('[script-role = data_title]'),
		sTarget: 'foc',
		fnDo: function(oThis) {
			
			if ( oThis.attr('is_follow') == '0' ) {

				var url = oThis.attr('target');

				this.req(url, null, function(data){

					oTip.text('已关注');

					setTimeout(function(){

						oTip.hide();

					},2000);

					oThis.html('已关注');

					oThis.attr('is_follow', '1');	

				});

			}
		}
	});

	todo.init();

});