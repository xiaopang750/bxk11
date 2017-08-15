/*
 *description:login
 *author:fanwei
 *date:2014/06/21
 */
define(function(require, exports, module){
	
	require('../../../../global/js/global/loading');
	var tip = require('../../../../global/js/global/tip');
	var loadingTimer;
	$(document).ready(function(){

		clearTimeout( loadingTimer );
		loadingTimer = setTimeout(loading, 500);

	});

	var oTip = new tip();
	oTip.init();

	function Login (){
		this.oLoginForm = $('[sc = login-form]');
		this.oWeixinArea = $('[sc = weixin]');
		this.oNormalArea = $('[sc = not-weixin]');
		this.oName = $('[sc = name]');
		this.oPass = $('[sc = pass]');
		this.subUrl = 'aaa.php';
	}

	Login.prototype = {

		init: function() {

			this.events();

			this.judge();
		},	
		judge: function() {

			var _this = this;


			var ua = window.navigator.userAgent.toLowerCase(); 
			if(ua.match(/MicroMessenger/i) == 'micromessenger'){ 
			 	_this.oNormalArea.addClass('hide');
			    _this.oWeixinArea.removeClass('hide');
			}else{ 
				_this.oNormalArea.removeClass('hide');
			   _this.oWeixinArea.addClass('hide');
			} 

		},
		events: function() {

			var _this = this;

			this.oLoginForm.on('submit', function(){

				//_this.todoSub();

				return false;

			});

			$('[sc = back]').on('click', function(){

				window.history.back();

			});

		},
		todoSub: function() {

			var result;

			result = this.check();

			if( !result.err ) {

				this.sub( result.data );

			}

		},
		check: function() {

			var sName = this.oName.val();
			var sPass = this.oPass.val();

			if( sName && sPass ) {

				return {err:0, data:{name:sName, pass:sPass}};

			}

		},
		sub: function(param) {

			$.post(this.subUrl, param, function(data){

				oTip.text( data.msg );

				if( !data.err ) {	

					setTimeout(function(){

						window.location = data.data;

					},1000);
	
				}

			},'json');

		}

	}

	var oLogin = new Login();
	oLogin.init();

});