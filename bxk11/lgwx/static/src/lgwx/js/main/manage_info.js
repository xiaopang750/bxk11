/*
 *description:账号信息
 *author:fanwei
 *date:2014/03/24
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var ajaxForm = require('../widget/form/ajaxForm');
	var upload = require('../global/upload');

	var oRnew = $('[sc = re-new-pass]');


	var oInfo = until.extend(function(){

			this.oInfo = $('[script-bound = form_check]');
			this.subUrl = "/lgwx/index.php/post/service/serviceSet";

		},{

			init: function() {

				this.showPage();

			},
			showPage: function() {

				var _this = this;

				this.requestUri = '/lgwx/index.php/view/service/serviceSet';
				this.load();
				this.suc = function(data){
					
					_this.data = data;
					_this.tempId = 'user-info';
					_this.tempWrap = _this.oInfo;
					_this.render();

					/*if ( data.data.join_status == 0 ) {

						$('input[type=text], textarea').attr('readonly', 'readonly');

						$('[script-role = confirm_btn]').attr('disabled', 'disabled');

						alert('您的企业认证审核暂未完成，在此期间无法修改企业信息哦！')

						return;

					}*/

					_this.submissionInfo();

				}

			},
			submissionInfo: function(sId) {

				this.aFile = $('[script-role = upload-file]');

				var result;
				var _this = this;
				var name;
				
				var oInfoMore = new ajaxForm({

					subUrl: this.subUrl,
					fnSumbit: function( data ) {

						data.service_logo = _this.aFile.eq(0).attr('iamgeurl');
						data.shopid = _this.sid;
					},
					sucDo: function(data) {

						alert(data.msg);

						window.location = data.data;

					},
					failDo: function(data) {

						alert(data.msg);

					}

				});	

				oInfoMore.upload();

			}
		});


	oInfo.init();

});