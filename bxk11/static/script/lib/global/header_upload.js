define(function(require, exports, module) {
	
	var noLogin = require('./noLogin.js');

	var oUpLoadWrap = $('[script-role=upload_wrap]');
	var oUploadLogo = $('[script-role=upload_icon]');
	var addedClass = 'actw';
	var btnedClass = 'actb';
	var aList = $('[script-role = header178]').find('[script-role = header_upload_btn]');
	var timer = null;

	oUpLoadWrap.mouseenter(function(){

		var oThis = $(this);

		clearTimeout(timer);

		timer = setTimeout(function(){

			oThis.addClass(addedClass);
			oUploadLogo.addClass(btnedClass);

		},200);		
		
	});

	oUpLoadWrap.mouseleave(function(){

		var _this = $(this);

		timer = setTimeout(function(){
			_this.removeClass(addedClass);
			oUploadLogo.removeClass(btnedClass);
		},100);

	});

	/* 点击检测是否登录 */
	aList.click(function(){

		if($CONFIG["islogin"] == 0)
		{	
			noLogin();

			return false;
		}

	});

});