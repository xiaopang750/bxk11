/*
 *description:登录
 *author:fanwei
 *date:2014/03/24
 */
define(function(require, exports, module){
	
	var text_ie6 = require('../global/test_ie6');	
	var ajaxForm = require('../widget/form/ajaxForm');
	var enterDo = require('../widget/dom/enterDo');
	var refreshCode = require('../sub/entry/refresh_code');
	var bodyParse = require('../widget/http/bodyParse');
	var placeholder = require('../widget/dom/placeholder');
	var adaptbg = require('../widget/dom/adapt_bg');
	var rnd = require('../widget/tool/rnd');
	var platform = require('../widget/platform/platform');
	var link = require('../sub/entry/link');
	var config = require('../global/jia178config');
	var bg = require('../sub/entry/bg');
	
	function Login() {

		this.oLoginForm = null;
		this.oRefreshBtn = $('[script-role = refesh-btn]');
		this.oRefreshImage = $('[script-role = refesh-image]');

		this.param = bodyParse();
		this.oCode = new refreshCode(this.oRefreshImage);
		this.subUrl = _jia178config.reqBase + 'post/login';

	}

	Login.prototype = {

		init: function(){

			this.createTip();

			this.submission();

			this.entertodo();

			this.events();

			placeholder($('[holder=true]'));

		},
		events: function() {

			var _this = this;

			this.oRefreshBtn.on('click', function(){

				_this.oCode.refresh();

			});

		},
		createTip: function() {

			//移动端提示用pc登录
			if( platform == 'mobile' ) {

				this.oTipWrap = $('<div><div></div></div>');
				this.oTipWrap.css({
					background: 'rgba(0,0,0,0.5)',
					width: '200px',
					height: '120px',
					position: 'fixed',
					zIndex: '5000',
					margin: '-60px 0 0 -100px',
					left: '50%',
					top: '50%',
					borderRadius: '10px'
					
				});

				this.oTip = this.oTipWrap.children('div');
				this.oTip.css({
					width: '200px',
					height: '120px',
					display:'table-cell',
					textAlign: 'center',
					color: '#fff',
					fontSize: '12px',
					verticalAlign:'middle'
				})


				this.oTip.html('<p class="mb_10">请通过电脑访问</p><p class="mb_10">www.jia178.com/lgwx</p><p class="mb_10">完成免费开店</p>')

				$('body').append( this.oTipWrap );
			}

		},
		submission: function(){

			var _this = this;

			//提交
			this.oLoginForm = new ajaxForm({

				subUrl: this.subUrl,
				otherJude: [
					function(){

						//如果是移动端则禁止提交
						if( platform == 'mobile' ) {

							return false;	

						} else {

							return true;

						}


					}
				],
				sucDo: function(data) {

					window.location = data.data;

				},
				failDo: function(data) {

					alert(data.msg);

					_this.oCode.refresh();

				}

			});

			if( platform != 'mobile' ) {

				//如果是移动端则不初始化验证提交方法
				this.oLoginForm.upload();

			}	
		},
		entertodo: function(){

			//回车提交
			var _this,
				sForm;

			_this = this;	

			enterDo($('input[type]'), function(oThis){

				sForm = oThis.parents('[script-bound]').attr('formName');

				_this[sForm].subMit();

			});

		}
	}

	var oLogin = new Login();

	oLogin.init();

});