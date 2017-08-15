/*
 *description:子账号管理
 *author:fanwei
 *date:2014/03/27
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');

	var oManageSub = until.extend(function(){

			this.oInfo = $('[sc = user-sub]');
			this.oAdd = $('[sc = sub-add]');
			this.tplId = 'user-sub';
			this.getDataUrl = '/lgwx/index.php/view/user/getlist';
			this.addUrl = '/lgwx/index.php/view/user/addurl';

		},{

			init: function() {
					
				this.showAdd();

			},
			show: function() {

				var _this = this;

				this.requestUri = this.getDataUrl;
				this.load();
				this.suc = function(data){
						
					_this.data = data;
					_this.tempId = _this.tplId;
					_this.tempWrap = _this.oInfo;
					_this.render();

				}

			},
			showAdd: function() {

				var _this = this;

				this.requestUri = this.addUrl;
				this.load();
				this.suc = function(data){ 
					
					_this.oAdd.attr('href', data.data);	

					_this.show();

				};

			}

		});

	oManageSub.init();

});