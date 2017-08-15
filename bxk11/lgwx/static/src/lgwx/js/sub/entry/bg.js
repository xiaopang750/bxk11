/**
 *description:登录注册背景处理
 *author:fanwei
 *date:2014/07/02
 */
 define(function(require, exports, module){
 	
 	var config = require('../../global/jia178config');
 	var adaptbg = require('../../widget/dom/adapt_bg');
 	var rnd = require('../../widget/tool/rnd');
 	var platform = require('../../widget/platform/platform');

 	function Bg() {

 		this.oBoxWrap = $('[sc = box-wrap]');
		this.oHead = $('[sc = entry-head]');
 	}

 	Bg.prototype = {
 		
 		init: function() {

 			this.selectBg();

 		},
 		judgeHeightView: function() {

	 		var w_h,
				max,
				headerHeight;

			w_h = $(window).height();
			max = this.oBoxWrap.height();
			headerHeight = this.oHead.outerHeight(true) + 60 + 'px';

			if( max + parseInt( headerHeight ) > w_h ) {
				
				$('body').css('overflow-y', 'hidden');
				this.oBoxWrap.css({paddingTop:headerHeight});
				this.oBoxWrap.addClass('nocenter');

			} else {

				$('body').css('overflow-y', 'hidden');
				this.oBoxWrap.css({paddingTop:0});
				this.oBoxWrap.removeClass('nocenter');

			}
 		},
 		selectBg: function() {

			var bgSrc = _jia178config.staticSys + 'lgwx/login_bg/'+ rnd(5,1) +'.jpg';
			var _this = this;

			if( platform == 'mobile' ) {

				$('body').css('backgroundImage', 'url('+ bgSrc +')');

				$('body,html').css('height', $(document).height());

			} else {	

				$('body,html').css('overflow-x', 'hidden');

				adaptbg( bgSrc );

				this.judgeHeightView();

				$(window).resize(function(){

					_this.judgeHeightView.call(_this);

				});

			}

		}

 	}

 	var oBg = new Bg();

 	oBg.init();
 
 });