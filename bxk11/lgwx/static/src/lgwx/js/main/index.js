/**
 *description:平台中心首页
 *author:fanwei
 *date:2014/04/05
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var dialog = require('../widget/dom/dialog');
	var copyText = require('../widget/dom/copyText');
	var until = require('../lib/until/until');

	var oIndex = until.extend(function(){

			this.oShareBox = null;
			this.oCopyedInput = $('[sc = copyed-input]');
			this.getDataUrl = _jia178config.reqBase + 'view/index/desktop';

			this.oModule = $('[sc = module]');	
			this.oInfo = $('[sc = news-info]');
			this.oAct = $('[sc = news-act]');
			this.oBanner = $('[sc = banner]');
			this.oBtn = $('[sc = copy]');

			this.tplModuleId = 'module';
			this.tplInfoId = 'info';
			this.tplActId = 'act';
			this.tplBannerId = 'banner';

		}, {


			init: function (){

				var _this = this;

				this.loadPage(function(data){

					_this.initShareBox(data);

					_this.renderPage(_this.tplModuleId, _this.oModule, data);
					_this.renderPage(_this.tplInfoId, _this.oInfo, data);
					_this.renderPage(_this.tplActId, _this.oAct, data);
					_this.renderPage(_this.tplBannerId, _this.oBanner, data);

					_this.insertShare(data);

				});

				this.events();

			},
			events: function() {

				var _this;

				_this = this;

				$(document).on('click', '[sc = show-share]', function(){

					_this.oShareBox.show();

				});

				this.oBtn.on('click', function(){

					_this.copy();

				});

			},
			copy: function() {

				//复制到剪贴版
				copyText(this.oCopyedInput);

			},
			initShareBox: function(data) {

				//初始化弹框dialog;
				this.oShareBox = new dialog({
					boxSelector: $('[sc = share-box]')
				});

				this.oCopyedInput.val(data.data.spread.text);

			},
			loadPage: function(cb) {

				//读取数据
				var _this = this;

				this.requestUri = this.getDataUrl;
				this.load();
				this.suc = function(data) {

					cb && cb(data);

				};

			},
			renderPage: function (tplId, oWrap, data){

				//渲染页面
				this.tempWrap = oWrap;
				this.tempId = tplId;
				this.data = data;
				this.render();

			},
			insertShare: function(data) {

				//@param data.data.spread.text 分享字段 此处调用百度分享代码

				window._bd_share_config={
					"common":{
						"bdSnsKey":{},
						"bdText": data.data.spread.text,
						"bdMini":"2",
						"bdMiniList":false,
						"bdPic":"",
						"bdStyle":"0",
						"bdSize":"32"
					},
					"share":{}
				};
				with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];

			}


	});

	oIndex.init();

});