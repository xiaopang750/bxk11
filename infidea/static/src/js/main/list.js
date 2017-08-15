/**
 *description:list
 *author:fanwei
 *date:2014/4/16
 */
define(function(require, exports, module){
	
	var template = require('../lib/template/template');
	var global = require('../global/global');
	var id = window.location.search.split('?')[1];

	$.ajax({

		url:'http://www.jia178.com/lgwx/index.php/api/informationView/readNews',
		dataType:'jsonp',
		jsonp:'cb',
		data:{si_id:id},
		success: function(data) {

			var oWrap = $('[sc = data-wrap]');

			var html = template('info-list', data);

			oWrap.html( html );

		}

	});


});