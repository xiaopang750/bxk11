define(function(require, exports, module){
	
	var global = require('../global/global');
	var fenye = require('../global/fenye');
	var FnDo = require('../global/fnDo');

	var seriesid = _query.series_id;
	var url = '/index.php?g=Wap&m=Products&a=getseriesinfo&token=' + token + '&series_id=' + seriesid + '&wecha_id=' + wid;
	var oName = $('[script-role = namer]');

	fenye(url , 'data_list', '5', function(data){

		oName.html( data.data.series_name );		

	});

	

	//todo
	var todo = new FnDo({
		oWrap: $('[script-role = data_wrap]'),
		sTarget: 'fav',
		fnDo: function(oThis) {
			
			if ( !oThis.hasClass('active') ) {

				var url = oThis.attr('target');

				this.req(url, null, function(data){

					oTip.text('添加喜欢成功');

					oThis.addClass('active');	

				});

			}

		}
	});

	todo.init();
});