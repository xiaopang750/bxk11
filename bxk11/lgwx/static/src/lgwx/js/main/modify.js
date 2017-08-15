/*
 *description:用户信息设置
 *author:fanwei
 *date:2014/05/27
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var dialog = require('../widget/dom/dialog');
	var ajaxForm = require('../widget/form/ajaxForm');

	//pass
	var oPass = new dialog({
		boxSelector: $('[sc = modify-pass-lay]')
	});

	var oModify = until.extend(function(){

			this.subInfoUrl = '/lgwx/index.php/post/user/setServiceUserinfo';
			this.passUrl = '/lgwx/index.php/post/user/password';

		}, {

			init: function() {

				this.showPage();

				this.events();

				this.submissionPass();

			},
			events: function() {

				var _this = this;

				$(document).on('click', '[sc = modify-pass]', function(){

					oPass.show();

				});

			},
			submissionPass: function() {

				var oNew = $('[sc = pass-new]');
				var oRnew = $('[sc = re-new-pass]');	


				var oModifyPass = new ajaxForm({

					subUrl: this.passUrl,
					btnName:'pass_btn',
					boundName: 'pass_modify',
					otherCheck:{

						reNewPassWord:[
							function(ele){

								if ( !ele.val() ) {

									return false;

								} else {

									return true;	
								}
								
							},
							function(ele){

								if ( ele.val() != oNew.val() ) {

									return false;

								} else {


									return true;
								}

							}
						]
					},
					fnSumbit: function( data ) {

						data.reNewPassWord = oRnew.val();	
					},
					sucDo: function(data) {

						alert(data.msg);

						window.location = data.data;

					},
					failDo: function(data) {

						alert(data.msg);

					}

				});

				oModifyPass.upload();

			},
			submissionInfo: function() {

				var modify = new ajaxForm({

					subUrl: this.subInfoUrl,
					sucDo: function(data) {

						alert(data.msg);

						window.location = data.data;

					},
					failDo: function(data) {

						alert(data.msg);

					}

				});	

				modify.upload();

			},
			showPage: function() {

				var _this = this;

				this.requestUri = '/lgwx/index.php/view/user/userinfo';
				this.load();
				this.suc = function(data) {

					_this.tempId = 'user-info';
					_this.tempWrap = $('[script-bound = form_check]');
					_this.data = data;
					_this.render();
					_this.submissionInfo();

				};


			}

	});

	oModify.init();

});