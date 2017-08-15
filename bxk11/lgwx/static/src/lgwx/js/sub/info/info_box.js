/**
 *description:资讯选择弹框
 *author:fanwei
 *date:2014/06/26
 */
define(function(require, exports, module){
		
	var until = require('../../lib/until/until');
	
	//infobox	
	function InfoBox(otps) {

		otps = otps || {};
		this.getDataUrl = _jia178config.reqBase + 'view/service/slide_information';
		this.fenyeId = 'tpl-info';
		this.paramList = {
			num:5,
			it_id:'',
			p:1,
			keywords:''
		};

	}

	InfoBox.prototype = {

		init: function() {

			this.loadClass();

		},
		events: function() {



		},
		loadClass: function() {

			var _this = this;

			//加载分类列表
			oClassLoad.getClassList(function(){

				_this.renderForm();

			});
		},
		renderForm: function() {

			var _fenye = new Fenye(this.getDataUrl, this.fenyeId, this.paramList, null, null);

   			this.page = _fenye;

		}


	}

	//分类加载
	var oClassLoad = until.extend(function(){

			this.oSelect = $('[sc = user-search]');
			this.tplSelectId = 'tpl-select';
			this.getDataUrl = _jia178config.reqBase + 'view/service/information_type';

		}, {

			getClassList: function(cb) {

				var _this;

				_this = this;
				this.requestUri = this.getDataUrl;
				this.load();

				this.suc = function(data) {

					_this.tempId = _this.tplSelectId;
					_this.tempWrap = _this.oSelect;
					_this.data = data;
					_this.render();
					cb && cb();

				};

				this.fail = function(data) {
					alert(data.msg);
				};

			}

	});

	module.exports = InfoBox;

});