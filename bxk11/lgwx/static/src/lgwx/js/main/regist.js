/*
 *description:加盟注册
 *author:fanwei
 *date:2014/03/24
 */
define(function(require, exports, module){
	
	var text_ie6 = require('../global/test_ie6');
	var upload = require('../global/upload');
	var Related = require('../widget/dom/related');
	var ajaxForm = require('../widget/form/ajaxForm');
	var enterDo = require('../widget/dom/enterDo');
	var refreshCode = require('../sub/entry/refresh_code');
	var adaptbg = require('../widget/dom/adapt_bg');
	var placeholder = require('../widget/dom/placeholder');
	var platform = require('../widget/platform/platform');
	var bodyParse = require('../widget/http/bodyParse');
	var link = require('../sub/entry/link');
	var bg = require('../sub/entry/bg');
	var config = require('../global/jia178config');

	function Join() {

		this.oRegistForm = null;
		this.oRgBtn = $('[sc = org]');
		this.oRefreshBtn = $('[script-role = refesh-btn]');
		this.oRefreshImage = $('[script-role = refesh-image]');

		this.urlParam = bodyParse();
		this.oCode = new refreshCode(this.oRefreshImage);
		this.subUrl = _jia178config.reqBase + 'post/login/reg';

	}

	Join.prototype = {

		init: function() {

			this.enterTodo();

			this.submission();

			this.events();

			placeholder($('[holder=true]'));

		},
		events: function() {

			var _this = this;

			this.oRefreshBtn.on('click', function(){

				_this.oCode.refresh();

			});

		},
		enterTodo: function() {

			var _this = this;

			//回车加盟
			enterDo($('input[type = text]'), function(){

				_this.oRegistForm.subMit();

			});
		},
		submission: function(){

			var oNew,
				oRnew,
				oRegistBtn,
				_this;

			_this = this;
			oNew = $('[sc = pass]');
			oRnew = $('[sc = re-pass]');
			oRegistBtn = $('[script-role = confirm_btn_regist]');

			this.oRegistForm = new ajaxForm({

				subUrl: this.subUrl,
				boundName: 'form_check_regist',
				btnName: 'confirm_btn_regist',
				otherCheck:{

					//验证两次密码一致
					reply_password:[
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

					//如果有邀请码则传给后台,如果没有则传空
					if( _this.urlParam && _this.urlParam.flg ) {
						data.flg = _this.urlParam.flg;
					} else {
						data.flg = '';
					}

					//提交重复密码
					data.reply_password = oRnew.val();	
				},
				sucDo: function(data) {

					//倒计时3s跳转
					var count,
						timer;

					count = 3;
					oRegistBtn.attr('disabled', 'disabled');
					_this.oRgBtn.hide();

					timer = setInterval(function(){

						oRegistBtn.html(count + '   系统正在为您生成用户中心');

						if ( count == 0 ) {

							clearInterval( timer );

							window.location = data.data;

						}

						count --;

					},1000);

				},
				failDo: function(data) {

					alert(data.msg);

					_this.oCode.refresh();

				}

			});	

			this.oRegistForm.upload();

		}

	}

	var oJoin = new Join();

	oJoin.init();


});