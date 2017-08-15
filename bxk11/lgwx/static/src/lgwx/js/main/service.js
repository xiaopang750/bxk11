/*
 *description:增值服务
 *author:fanwei
 *date:2014/04/04
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var Fenye = require('../widget/dom/fenye');
	var until = require('../lib/until/until');


	var oTextReply = until.extend(function(){

		this._param = {};

		this._param.type = 'vas';

		this.tplId = 'service-list';

		this.getDataUrl = '/lgwx/index.php/view/service/vas_list';

		this._param.num = 5;

		this.page = null;

		this.btnStr = '<button class="btn btn-sm btn-primary ml_1 mr_1" sc="pagebtn"></button>';

	   }, {

	   	init: function() {

	   		this.render();

	   		this.events();

	   	},
	   	events: function() {

	   		var _this = this;

	   		$(document).on('click', '[sc = select-type]', function(){

	   			_this.changeType( $(this), 'acitve' );

	   		});
	   	},
	   	changeType: function( oThis ) {

	   		var	type;

	   		type = oThis.attr('select-type');

	   		this._param.type = type;
	   		this.page.refresh( this._param );


	   	},
	   	render: function() {

	   		var _fenye = new Fenye(this.getDataUrl, this.tplId, this._param, function(data){

	   			if ( data.err ) {

	   				alert(data.msg);

	   				window.location = data.data;

	   			}


	   		}, this.btnStr);

	   		this.page = _fenye;

	   	}

	});

	oTextReply.init();

});