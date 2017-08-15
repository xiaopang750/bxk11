/*
 *description:自动回复添加-编辑
 *author:fanwei
 *date:2014/04/04
 */
define(function(require, exports, module){

	var global = require('../global/global');
	var until = require('../lib/until/until');
	var upload = require('../global/upload');
	var ajaxForm = require('../widget/form/ajaxForm');
	var replyCut = require('../sub/cut/cut');

	var oReplyCut = new replyCut();
	oReplyCut.cutUrl = '/lgwx/index.php/upload/crop_service_pic';
	oReplyCut.init();

	var oReplyAdd = until.extend(function(){

			this.editTempId = 'reply-add';
			this.subUrl = '';
			this.oForm = $('[script-bound = form_check]');
			this.getAddData = '/lgwx/index.php/view/information/add';
			this.getEditData = '/lgwx/index.php/view/information/edit';
			this.oLocation = $('[sc = location]');


		}, {

			init: function() {
				
				this.judge();

			},
			showEditor: function(str){


				this.eidtor = UE.getEditor('editor');

				this.eidtor.addListener( 'ready', function( editor ) {
				     
					UE.getEditor('editor').setContent(str);

				});

			},
			submission: function(type, sId) {

				this.aFile = $('[script-role = upload-file]');

				var result;
				var _this = this;
				var name,
					oIsshow;

				oIsshow = $('[sc = isshow]');
				
				var oShopAddForm = new ajaxForm({

					subUrl: this.subUrl,
					otherJude: [

						function() {

							var src = _this.aFile.attr('iamgeurl');

							if( !src ) {

								alert('请上传封面图片');

								return false;

							} else {

								return true;

							}

						}

					],
					fnSumbit: function( data ) {

						if ( type == 'edit' ) {

							data.si_id = sId ? sId : '';

						}

						data.isshow = oIsshow.attr('checked') ? 1 : 0;
						data.si_content = _this.eidtor.getContent();
						data.si_pic = _this.aFile.attr('iamgeurl');
						data.si_desc = data.si_desc.replace(/(\s|\n)/gi, '');
						
					},
					sucDo: function(data) {
						
						alert(data.msg);
						
						window.location = data.data;

					},
					failDo: function(data) {

						alert(data.msg);

					}

				});	

				oShopAddForm.upload();

			},
			judge: function() {

				//判断是否编辑
				var param,
					si_id;

				param = this.parse();

				if( param.type ) {

					//编辑
					this.subUrl = '/lgwx/index.php/post/information/edit';
					si_id = param.si_id;
					this.edit( si_id );

				} else {

					//非编辑
					this.oForm.show();
					this.subUrl = '/lgwx/index.php/post/information/add';
					this.add(  );

				}

			},
			add: function(){

				var _this = this;

				//添加
				this.requestUri = this.getAddData;
				this.load();
				this.suc = function( data ) {

					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.data = data;
					_this.render();
					_this.showEditor('');
					_this.submission('add', '');

				};

				this.fail = function(data) {
					
					alert(data.msg);

				};

			},
			edit: function(seriesId) {

				this.oLocation.html('编辑系列');

				var _this = this;

				//编辑
				this.requestUri = this.getEditData;
				this.param.si_id = seriesId;
				this.load();
				this.suc = function( data ) {

					_this.data = data;
					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.render();
					_this.showEditor( data.data.si_content );
					_this.submission( 'edit', seriesId );

				};

			}

	});	


	oReplyAdd.init();

});