define(function(require, exports, module) {

	var template = require('../../lib/template/template');

	var cookie = require('../../lib/cookie/cookie');

	//M
	function HeaderUserInfoM()
	{	
		this.data = $CONFIG;
	}

	HeaderUserInfoM.prototype.outPut = function()
	{
		return this.data;
	}

	//V
	function HeaderUserInfoV()
	{	
		this.oUserInfo = $('[script-role=header_login]');

		this.tempId = 'header178_info_login_tpl';

		this.sHref = window.location.href;

		this.sLoginOutHref = '/index.php/user/logout';	
	}

	HeaderUserInfoV.prototype = {

		slideList : function()
		{	
			var _this = this;

			var timer = null;

			this.oUserWrap.mouseenter(show);

			this.oUserSlde.mouseenter(show);

			this.oUserSlde.mouseleave(hide);

			this.oUserWrap.mouseleave(hide);

			function show()
			{
				clearTimeout(timer);

				timer = setTimeout(function(){

					_this.oUserSlde.show();

				},200);		
			}

			function hide()
			{
				timer = setTimeout(function(){
					_this.oUserSlde.hide();
				},100);
			}
		},
		showList: function(data)
		{	
			var html = template.render(this.tempId, data);

			this.oUserInfo.html(html);

			this.oUserWrap = $('.user_pic');

			this.oUserSlde = $('[script-role=header_user_list]');
		},
		saveUrl: function(oLogin)
		{	
			oLogin.attr('href','/index.php/user/login#url=' + this.sHref);
		},
		loginOut: function(obj)
		{	
			obj.attr('href', this.sLoginOutHref + '?url=' + this.sHref);
		}
	};

	//C
	var data = new HeaderUserInfoM();
	var view = new HeaderUserInfoV();

	function HeaderUserInfoC()
	{	
		this.model = data.outPut();
	}

	HeaderUserInfoC.prototype.renderDo = function()
	{	
		view.showList(this.model);

		view.slideList();
	}

	var controllers = new HeaderUserInfoC();

	controllers.renderDo();

	view.loginOut($('[script-role = login_out]'));

	view.saveUrl($('[script-role = head_login_btn]'));

});