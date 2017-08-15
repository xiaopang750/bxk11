/*
 *description:注册登录公用模块
 *author:fanwei
 *date:2013/12/01
 */
define(function(require, exports, module){
	
	var placeholder = require('../../lib/plugin/ui/placeholder');
	var formBeauty = require('../../lib/plugin/form/formbeauty');
	var formcheck = require('../../lib/plugin/form/formCheck');
	var autoComplete = require('../../lib/plugin/form/autoComplete');
	var enterDo = require('../../lib/plugin/form/enter_do');
	var cookie = require('../../lib/cookie/cookie');
	var until = require('../../lib/prototype/until');

	var _until = new until();

	var Entry = _until.extend(until, function(){

			this.oIsSave = $('[script-role=issave]');
			this.oName = $('input[name = user_name]');
			this.oWeibo = $('[script-role = weibo_btn]');
			this.oQq = $('[script-role = renren_btn]');
			this.oTipFirst = null;
			this.oAutoTip = null;
			this.oFormcheck = null;
			this.aEnterInput = $('[script-role = enterLogin]');
			this.sLoginedName = cookie.getCookie('jia178_name');
			this.sTarget = '';

			this.NAME_SAVE_TIME = '30day';
			this.SUB_URL = '/index.php/posts/user/login_on';
			this.HOME_URL = '/index.php/user/home';
			this.COOKIE_NAME = 'jia178_name';
			this.TIP_ARR = ['qq.com','163.com','126.com','sina.com','sina.cn','sohu.com'];
			this.TIP_INDEX = 1000;

		},{

			init: function()
			{	
				this.showLoginedName && this.showLoginedName();

				this.formBeauty();

				this.formTip();

				this.nameAutoComplete();

				this.formCheckSub();

				this.enterSub();

				this.unionLogin();
			},
			showLoginedName: function()
			{	

				//显示最新一次的登录用户名;
				if( this.sLoginedName )
				{
					this.oName.val( this.sLoginedName );
				}
			},
			formBeauty: function()
			{	

				//表单美化(checkbox)
				var oFormBeauty = new formBeauty({
					itemCheckClass: 'actbcheck'
				});

				oFormBeauty.init();
			},
			formTip: function()
			{	

				//表单提示
				placeholder($('[holder=true]'));
			},
			nameAutoComplete: function()
			{

				//用户名自动补全
				autoComplete({
					ele: this.oName,
					sClass: 'autoTip',
					data: this.TIP_ARR,
					zIndex: this.TIP_INDEX
				});

				//oAutoTip 要等autoComplete方法执行之后才能获取;
				this.oAutoTip = $('[script-role = autoTipWrap]');
			},
			formCheckSub: function()
			{	

				//验证加提交
				var _this = this;

				this.oFormcheck = new formcheck({
					subUrl: this.SUB_URL,
					fnSumbit: function(data)
					{	

						//提交时监听是否记住了密码
						data.save_cookie = _this.oIsSave.attr('checked') == 'checked' ? 1 : 0;
					},
					sucDo: function(){

						//如果登录成功则记录最新一次的登录用户名;
						cookie.setCookie(_this.COOKIE_NAME, _this.oName.val(), _this.NAME_SAVE_TIME);

						//如果是从别的页面跳过来，登录后则返回刚才的页面; 如果不是则返回首页
						if(window.location.hash)
						{
							_this.sTarget = window.location.hash.replace('#url=', '');
							
							window.location = _this.sTarget;	
						}
						else
						{	
							window.location = _this.HOME_URL;
						}

					},
					failDo: function(msg){
						
						_this.oFormcheck.tipWrong(_this.oName, _this.oTipFirst ,msg);

					}
				});

				this.oFormcheck.check();

				//先调用formchek的  check方法才能生成 oTipFirst;
				this.oTipFirst = $('[script-role = wrong_area]').eq(0);
			},
			enterSub: function()
			{	
				var _this = this;

				enterDo(this.aEnterInput, function(){
			
					if(!_this.oAutoTip.is(':visible'))
					{
						_this.oFormcheck.subMit();
					}

				});
			},
			unionLogin: function()
			{	
				var _this = this;

				/*this.oQq.on('click', function(){

					window.location = "/login/qq/example/oauth/index.php","TencentLogin","width=450,height=320,menubar=0,scrollbars=1, resizable=1,status=1,titlebar=0,toolbar=0,location=1";

				});

				this.oWeibo.on('click', function(){

					_this.requestUri = '/index.php/view/userset/sina_login';

					_this.load();

					_this.suc = function(data)
					{	
						window.location = data.data.sina_url;
					}

				});*/
			} 

	});

	module.exports = Entry;

});