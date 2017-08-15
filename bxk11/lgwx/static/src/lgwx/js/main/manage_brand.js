/*
 *description:品牌管理
 *author:fanwei
 *date:2014/03/28
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var operation = require('../sub/operation/operation');

	var oMangeBrand = until.extend(function(){

			this.oInfo = $('[sc = user-brand]');
			this.oSelect = $('[sc = user-search]');
			this.oBtn = $('[sc = user-btn]');
			this.oAdd = $('[sc = user-add]');

			this.pageTempId = 'user-brand';
			this.pageSearchTempId = 'user-search';

			this.getDataUrl = _jia178config.reqBase + 'view/brand/getlist';
			this.searchUrl = _jia178config.reqBase + 'view/brand/getlist';
			this.addUrl = _jia178config.reqBase + 'view/brand/brandurl';
			this.removeUrl = _jia178config.reqBase + 'post/brand/del';
			this.downUrl = _jia178config.reqBase + 'post/brand/down';

		},{

			init: function() {
					
				this.showAdd();

				this.events();

			},
			events: function(){

				var id,
					_this,
					that,
					oTarget,
					sRole;
				
				_this = this;
				that = this;	

				//change-select-赋值
				this.oSelect.on('change', function(){

					id = $(this).children().eq($(this).get(0).selectedIndex).attr('id');

					_this.confirmId( id );

				});	

				//点击查询
				this.oBtn.on('click', function(){

					id = $(this).attr('search-id');

					_this.search( id );

				});
				
				//下架,删除
				operation.openBox = function(id, type) {

					switch(type) {

						case 'down':
							this.reqParam = {aid: id};
							this.reqUrl = _this.downUrl;
						break;

						case 'remove':
							this.reqParam = {aid: id};
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

					_this.show();	


				};

			},
			showPage: function( data ) {

				this.data = data;
				this.tempId = this.pageTempId;
				this.tempWrap = this.oInfo;
				this.tempWrap.html('');
				this.render();

			},
			showSearch: function( data ){

				this.data = data;
				this.tempId = this.pageSearchTempId;
				this.tempWrap = this.oSelect;
				this.render();
				

			},
			confirmId: function( id ) {
				
				this.oBtn.attr('search-id', id); 			

			},
			search: function( id ) {

				if(!id) {

					alert('请选择查询类别');
					
					return;
				}

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


		oMangeBrand.init();	

});
