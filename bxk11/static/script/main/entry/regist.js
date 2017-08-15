/*
 *description:注册
 *author:fanwei
 *date:2013/12/02
 */
define(function(require, exports, module) {
		
	var Entry = require('./entry');
	var rnd = require('../../lib/co/rnd');
	var formBeauty = require('../../lib/plugin/form/formbeauty');
	var formcheck = require('../../lib/plugin/form/formCheck');
	var cookie = require('../../lib/cookie/cookie');
	var until = require('../../lib/prototype/until');
	var _until = new until();

	var Regist = _until.extend(Entry, function(){

			this.oName = $('input[name = reguser_name]');
			this.oTipFirst = null;
			this.oFresh = $('[script-role = refresh_btn]');
			this.oCodeImage = $('[script-role = check_image]');
			this.oAgree = $('[script-role = agree]');
			this.oCode = $('[name = check_code]');
			this.aEnterInput = $('[script-role = enterRegist]');

			this.CODE_IMAGE_URI = '/images.php';
			//this.SUB_URL = '/index.php/posts/user/regist';
			this.SUB_URL = '';

		},{

			showLoginedName: null,
			formBeauty: function()
			{
				var oFormBeauty = new formBeauty({
					itemRadioClass: 'actbradio',
					itemCheckClass: 'actbcheck'
				});

				oFormBeauty.init();
			},
			formCheckSub: function()
			{	
				var _this = this;

				this.oFormcheck = new formcheck({
					subUrl: this.SUB_URL,
					otherJude: [
						function(){

							if(_this.oAgree.attr('checked') == 'checked')
							{	
								return true;
							}
							else
							{	
								_this.oFormcheck.tipWrong(_this.oName, _this.oTipFirst ,'请同意注册协议');

								return false;
							}

						}
					],
					sucDo: function(){
						
						cookie.setCookie(_this.COOKIE_NAME, _this.oName.val(), _this.NAME_SAVE_TIME);

						window.location = _this.HOME_URL;
					},
					failDo: function(msg){

						_this.oFormcheck.tipWrong(_this.oName, _this.oTipFirst ,msg);

						_this.refreshCode();

						_this.oCode.val('');

					}
				});

				this.oFormcheck.check();

				//先调用formchek的  check方法才能生成 oTipFirst;
				this.oTipFirst = $('[script-role = wrong_area]').eq(0);
			},
			refreshEvent: function()
			{	
				var _this = this;

				this.oFresh.on('click', function(){

					_this.refreshCode();
					

				});
			},
			refreshCode: function()
			{	
				var _this = this;

				// 解决ie6刷新问题 (ie6下点击太快刷不出来)
				setTimeout(function(){

					_this.oCodeImage.attr('src', _this.CODE_IMAGE_URI + '?' + rnd(9999, 1));

				},30);
			}

	});

	var _Regist = new Regist();

	_Regist.init();

	_Regist.refreshEvent();	

});
