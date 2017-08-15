/*
 *description:焦点图模块
 *author:fanwei
 *date:2013/11/04
 */
define(function(require, exports, module){
	
	function Focus( options ) {

		options = options || {};

		this.oWrap = options.oWrap || null;
		this.oLeft = this.oWrap.find('[script-role = widget-focus-left]');
		this.oRight = this.oWrap.find('[script-role = widget-focus-right]');
		this.aList = this.oWrap.find('[script-role = banner-list]');
		this.oClock = this.oWrap.find('[script-role = banner-clock]');
		this.max = this.aList.length;

		this.iNow = 0;
		this.timer = null;
		this.speed = options.speed || 4000;

	}

	Focus.prototype = {

		init: function() {

			this.calcWidth();

			this.clock();

			this.widgetInit();

			this.events();

			this.auto();

		},
		widgetInit: function() {

			this.tab( this.iNow );	

		},
		events: function() {

			var _this = this;

			this.oLeft.on('click', function(){

				_this.iNow--;

				if ( _this.iNow < 0 ) {

					_this.iNow = _this.max - 1;

				}

				_this.tab( _this.iNow );

			});

			this.oRight.on('click', function(){

				_this.iNow++;

				if ( _this.iNow > _this.max - 1 ) {

					_this.iNow = 0;

				}

				_this.tab( _this.iNow );

			});

			this.oWrap.on('mouseenter', function(){

				_this.stop();
				_this.btnShow();

			});

			this.oWrap.on('mouseleave', function(){

				_this.auto();
				_this.btnHide();

			});

			var timer = null;

			$(window).resize(function(){

				clearTimeout(timer);

				timer = setTimeout(function(){

					_this.calcWidth();
					_this.oClock.stop();
					_this.initClock();

				},100);

			});

		},
		tab: function(iNow) {

			this.aList.fadeOut();

			this.aList.eq( iNow ).fadeIn();

		},
		auto: function() {

			var _this = this;

			clearInterval( this.timer );

			this.timer = setInterval(function(){

				_this.iNow ++ ;

				if ( _this.iNow > _this.max - 1 ) {

					_this.iNow = 0;

				}

				_this.tab( _this.iNow );

				_this.clock();

			}, this.speed);

		},
		stop: function() {

			clearInterval( this.timer );

			this.oClock.stop();

			this.initClock();

		},
		btnShow: function() {

			this.oLeft.stop(true, true).fadeIn();
			this.oRight.stop(true, true).fadeIn();

		},
		btnHide: function() {

			this.oLeft.stop(true, true).fadeOut();
			this.oRight.stop(true, true).fadeOut();

		},
		calcWidth: function() {

			this.w_w = $(window).width();	

		},
		clock : function(cb) {

			var _this = this;

			this.oClock.stop(true,true).animate({width: this.w_w}, this.speed, function(){

				_this.initClock();

				cb && cb();

			});

		},
		initClock: function() {

			this.oClock.css('width', 0);

		}

	};

	module.exports = Focus;

});