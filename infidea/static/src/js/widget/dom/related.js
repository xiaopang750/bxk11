/*
 *description:联动菜单
 *author:fanwei
 *date:2013/11/03
 */
define(function(require, exports, module){
	
	var template = require('../../lib/template/template');
	var request = require('../../widget/http/request');

	function Related(options){

		this.oMain = options.oMain || null;
		this.oSub = options.oSub || null;
		this.MainUrl = options.MainUrl || '';
		this.SubUrl = options.SubUrl || '';
		this.tplMain = options.tplMain || '';
		this.tplSub = options.tplSub || '';
		this.firstLoad = options.firstLoad ? true : false;

	}

	Related.prototype = {

		init: function(){

			this.events();

		},
		events: function() {

			var _this = this;

			this.load(this.MainUrl, '', function(data){

				if ( _this.firstLoad ) {

					_this.renderSelect(_this.oMain, data.data.province, _this.tplMain);

					_this.renderSelect(_this.oSub, data.data.city, _this.tplSub);

				}

				_this.oMain.on('change', function(e){

					_this.changeDo( $(this) );

				});

			});

		},
		changeDo: function( oThis ) {

			var num = oThis.get(0).selectedIndex;

			var code = oThis.children().eq(num).attr('id');

			var _this = this;

			this.load(this.SubUrl, {district_pcode: code}, function(data){
				
				_this.renderSelect(_this.oSub, data.data, _this.tplSub);

			});


		},
		load: function(url, param, cb){

			request({
				url: url,
				data: param,
				sucDo: function( data ){

					cb && cb( data );

				}
			})

		},	
		renderSelect: function( oSelect, data, tpl ) {

			if (!data){

				return;
			}

			var i,
				num
			
			num = data.length;	

			var render = template.compile(tpl);

			var html = render(data);

			oSelect.html(html);

		}

	}

	module.exports = Related;

});