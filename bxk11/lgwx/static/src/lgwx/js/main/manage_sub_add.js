/*
 *description:添加编辑子账号
 *author:fanwei
 *date:2014/03/27
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var ajaxForm = require('../widget/form/ajaxForm');
	var upload = require('../global/upload');

	var oShopAdd = until.extend(function(){

			this.editTempId = 'sub-add';
			this.subUrl = '';
			this.getShopUrl = '/lgwx/index.php/view/user/getShopList';
			this.getModuleUrl = '/lgwx/index.php/view/user/getModule';
			this.getEditUrl = '/lgwx/index.php/view/user/edit';

			this.oShopAdd = $('[sc = shop_add]');
			this.oBrandWrap = $('[sc = brand-wrap]');
			this.oForm = $('[script-bound = form_check]');
			this.oPass = $('[sc = confirm-pass]');
			this.oReplyPass = $('[sc = confirm-reply-pass]');
			this.aFile = null;


		},{

			init: function() {
				
				this.judge();

			},
			submission: function(sId) {

				this.aFile = $('[script-role = upload-file]');

				var result;
				var _this = this;
				var name,oNew,sNew

				oNew = $('[sc = confirm-pass]');
				this.oPass = $('[sc = confirm-pass]');
				this.oReplyPass = $('[sc = confirm-reply-pass]');

				var oShopAddForm = new ajaxForm({

					subUrl: this.subUrl,
					otherCheck:{

						reply_password:[
							function(ele){

								sNew = oNew.val();
								
								if (sId) {

									if ( sNew ) {

										if ( !ele.val() ) {

											return false;

										} else {

											return true;

										}

									} else {

										return true;

									}

								
								} else {

									if ( !ele.val() ) {

										return false;

									} else {

										return true;	
									}	

								}

							},
							function(ele){
								
								sNew = oNew.val();

								if (sId) {

									if( ele.val() != sNew ) {

										return false;

									} else {

										return true;

									}

								}else{

									if ( ele.val() != sNew ) {

										return false;

									} else {

										return true;
									}

								} 
							}
						]
					},
					otherJude: [

						function() {

							result = true;

							_this.aFile.each(function(i){

								name = _this.aFile.eq(i).attr('iamgeurl');

								if ( !name ) {

									result = false;

								}

							});

							if ( result ) {

								return true;

							} else {

								alert('请上传用户头像')

								return false;

							}

						}	

					],
					fnSumbit: function( data ) {

						data.user_photo = _this.aFile.eq(0).attr('iamgeurl');
						data.service_user_id = sId ? sId : '';

						if ( sId ) {

							data.user_password = _this.oPass.val();
						
						}

						data.reply_password = _this.oReplyPass.val();
						
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
					uid;

				param = this.parse();

				if( param.type ) {

					//编辑
					this.subUrl = '/lgwx/index.php/post/user/edit';
					uid = param.uid;
					this.edit( uid );



				} else {

					//非编辑
					this.oForm.show();
					this.subUrl = '/lgwx/index.php/post/user/add';
					this.add();

				}

			},
			add: function(){

				var _this = this;

				//添加
				this.requestUri = this.getShopUrl;
				this.load();
				this.suc = function( dataShop ) {

					_this.requestUri = _this.getModuleUrl;
					_this.load();
					_this.suc = function(dataManager){

						_this.data = {
							data:{
								user_name:"",
								user_photo:"",
								user_realname: "",
								user_shop: dataShop.data,
								user_module: dataManager.data
							}
						};

						_this.tempId = _this.editTempId;
						_this.tempWrap = _this.oForm;
						_this.render();
						_this.submission();

					};

				};

				this.fail = function(data) {
					
					_this.oShopAdd.show();

					_this.oShopAdd.attr('href', data.data);

					_this.oForm.html(data.msg);

				};

			},
			edit: function(sId) {

				var _this = this;

				//编辑
				this.requestUri = this.getEditUrl;
				this.param.service_user_id = sId;
				this.load();
				this.suc = function( data ) {
					
					_this.data = data;
					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.render();
					_this.submission(sId);

				}

			}

	});

	oShopAdd.init();


});