/*
 *description:账号信息
 *author:fanwei
 *date:2014/03/24
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var dialog = require('../widget/dom/dialog');
	var operation = require('../sub/operation/operation');


	var oInfo = until.extend(function(){

			this.oInfo = $('[sc = user-shop]');
			this.oSelect = $('[sc = user-search]');
			this.oBtn = $('[sc = user-btn]');
			this.oAdd = $('[sc = user-add]');

			this.getDataUrl = _jia178config.reqBase + 'view/shop/getlist';
			this.searchUrl = _jia178config.reqBase + 'post/shop/search';
			this.addUrl = _jia178config.reqBase + 'view/shop/addurl';
			this.removeUrl = _jia178config.reqBase + 'post/shop/del';
			this.downUrl = _jia178config.reqBase + 'post/shop/down';

		},{

			init: function() {
						
				this.showAdd();

				this.events();

			},
			events: function(){

				var id,
					_this;
				
				_this = this;	

				this.oSelect.on('change', function(){

					id = $(this).children().eq($(this).get(0).selectedIndex).attr('id');

					_this.confirmId( id );

				});	

				this.oBtn.on('click', function(){

					id = $(this).attr('search-id');

					if ( !id ) {

						alert('请选择查询类别')

					} else {

						_this.search( id );

					}

				});

				//下架,删除
				operation.openBox = function(id, type) {

					switch(type) {

						case 'closeshop':
							this.reqParam = {shopid: id};
							this.reqUrl = _this.downUrl;
						break;

						case 'remove':
							this.reqParam = {shopid: id};
							this.reqUrl = _this.removeUrl;
						break;

					}

				};

			},
			show: function() {

				var _this = this;

				this.requestUri = this.getDataUrl;
				this.load();
				this.suc = function(data){
					
					_this.showPage( data );
				}

			},
			showAdd: function() {
				
				var _this = this;

				this.requestUri = this.addUrl;
				this.load();
				this.suc = function(data){ 
					
					_this.showSearch( data );

					_this.oAdd.attr('href', data.data.shop_add);

					_this.show();	


				};

			},
			showPage: function( data ) {

				this.data = data;
				this.tempId = 'user-shop';
				this.tempWrap = this.oInfo;
				this.tempWrap.html('');
				this.render();

			},
			showSearch: function( data ){

				this.data = data;
				this.tempId = 'user-search';
				this.tempWrap = this.oSelect;
				this.render();
				

			},
			confirmId: function( id ) {
				
				this.oBtn.attr('search-id', id); 			

			},
			search: function( id ) {

				var _this = this;

				this.requestUri = this.searchUrl;
				this.param.status = id;
				this.load();
				this.suc = function(data){
					
					_this.showPage( data );

				};

				this.fail = function(data){

					alert(data.msg);

				};

			}

		});


	oInfo.init();

});
