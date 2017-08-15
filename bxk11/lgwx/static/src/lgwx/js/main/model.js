/*
 *description:模板管理
 *author:fanwei
 *date:2014/05/24
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var upload = require('../global/upload');

	var oModel = until.extend(function(){

			this.oDataWrap = $('[sc = data-wrap]');
			this.pageTempId = 'model';

			this.pageUrl = _jia178config.reqBase + 'view/wap/template_list';
			this.subUrl = _jia178config.reqBase + 'post/wap/template_apply';
			this.reductionUrl = _jia178config.reqBase + 'post/wap/template_reset';

		},{

			init: function() {

				var _this = this;

				this.showPage(function(){

					_this.subBtn = $('[script-role = confirm_btn]');
					_this.reductionBtn = $('[script-role = reduction]');
					_this.oViewImage = $('[sc = view-img]');
					_this.oViewName = $('[sc = view-name]');

					_this.events();

				});
			},
			events: function() {

				var _this,
					nowId;

				_this = this;

				//点击提交
				this.subBtn.on('click', function(){

					nowId = $(this).attr('tmpId');
					
					_this.submit(nowId, _this.subUrl, function(data){

						alert(data.msg);
						window.location = data.data;

					});

				});

				//点击还原
				this.reductionBtn.on('click', function(){

					nowId = $(this).attr('tmpId');

					_this.submit(nowId, _this.reductionUrl, function(data){

						var info,
							name,
							src;

						info = data.data;	
						name = info.template_name;
						src = info.template_cover;
						_this.changeView(name, src);

					});

				});

				//点击view
				$(document).on('click', '[sc = model-select]', function(){

					var name,
						viewImageSrc;

					name = $(this).attr('temp-name');
					viewImageSrc = 	$(this).attr('temp-img');
					_this.changeView(name, viewImageSrc);
					_this.subBtn.attr('tmpId', $(this).attr('temp-id'));
					_this.reductionBtn.attr('tmpId', $(this).attr('temp-id'));

				});

				//上传切换背景;
				jia178UploadCb = function(oForm, url){

					_this.oViewImage.attr('src', url);

				};

			},
			changeView: function(name, src) {

				//切换预览模板显示
				this.oViewName.html(name);
				this.oViewImage.attr('src', src);	

			},
			submit: function(tempId, reqUrl, fnSuc, fnFail) {

				if( !tempId ) {

					alert('请选择模板');

				} else {

					this.requestUri = reqUrl;
					this.param.template_id = tempId;
					this.load();

					this.suc = function(data){
					
						fnSuc && fnSuc(data);

					};

					this.fail = function(data){

						alert(data.msg);

						fnFail && fnFail(data);

					};

				}

			},
			showPage: function(callBack) {

				var _this = this;

				this.requestUri = this.pageUrl;
				this.load();
				this.suc = function(data) {

					_this.tempId = _this.pageTempId;
					_this.tempWrap = _this.oDataWrap
					_this.data = data;
					_this.render();
					callBack && callBack();

				};

			}

	});

	oModel.init();
	
});



