/*
 *description:滚动加载
 *author:fanwei
 *date:2014/04/25
 */

 define(function(require, exports, module){

 	var hammer = require('../../lib/hammer/hammer');

 	function ScrollLoad() {
 		this.lock = false;
 		this.param = {};
 		this.oDataWrap = null;
 		this.requestUrl = '';
 		this.oTip = null;
 		this.oTpl = null;
 	}

 	ScrollLoad.prototype = {

 		init: function() {

 			this.initTip();

 			this.events();

 			this.param.p = 1;

 			this.load();

 		},
 		refresh: function(param) {

 			this.oDataWrap.html('');
 			this.param = param;
 			this.param.p = 1;
 			this.lock = false;
 			this.load();

 		},
 		initTip: function() {

 			if( !this.oTip ) {
 				return;
 			}

 			this.oTip.css({
 				width: '100%',
 				textAlign: 'center',
 				height: '20px',
 				lineHeight: '20px',
 				color: '#000'
 			});

 		},
 		events: function() {

 			var _this = this;
 			var top,
 				timer,
 				dir;

			/*$(document).hammer().on('release', function(e){*/

			$(window).on('scroll', function(){

				/*dir = e.gesture.direction;

				if( dir == 'up' ) {

					alert('b')*/

					top = document.body.scrollTop || document.documentElement.scrollTop;
				
					_this.judge( top );

				/*}*/

			});
		
 		},
 		judge: function(top) {

 			var nDocHeight = Math.max(document.documentElement.scrollHeight, document.body.clientHeight);
 			var windowHeight = document.documentElement.clientHeight;

 			if( top + windowHeight + 100 >= nDocHeight && this.lock == false ) {

 				this.load();	

 			}

 		},
 		load: function() {

 			this.lock = true;

 			this.oTip.html('加载中...');

 			this.request();
 		},
 		request: function() {

 			if( !this.requestUrl ) {

 				return;
 			}

 			var _this = this;

 			$.post(this.requestUrl, this.param, function(data){

 				if( !data.err ) {

 					_this.render(_this.oDataWrap, _this.oTpl, data);

	 				_this.lock = false;

	 				_this.param.p ++;

	 				_this.oTip.html('');

 				} else {

 					_this.lock = true;

 					_this.oTip.html('暂无更多数据');

 					//$(document).hammer().unbind('release');

 				}

 			}, 'json');

 		},
 		render: function(oWrap, oTpl, data) {

 			var htmlList = oTpl( data );

 			oWrap.html( oWrap.html() + htmlList );

 		}	

 	};

 	module.exports = ScrollLoad;
 
 });