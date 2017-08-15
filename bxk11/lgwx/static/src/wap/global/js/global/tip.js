/*
 *description:tip
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	function Tip( opts ) {

		opts = opts || {};

		this.oWrap = null;

		this.bottom = opts.bottom || '100px';

		this.delay = opts.delay || 2000;

		this.timeBtn = opts.timeBtn ? true : false || true;

		this.timer = null;

	}

	Tip.prototype = {

		init: function( ) {

			this.create();

			this.setStyle( this.oWrap );

		},
		create: function() {

			this.oWrap = $('<div></div>');

			$('body').append(this.oWrap);

		},
		setStyle: function( obj ) {

			obj.css({

				position: 'fixed',

				bottom: this.bottom,

				borderRadius: '5px',

				boxShadow: '1px 1px 1px solid #000',

				padding: '0.5rem 1.25rem',

				background: 'rgba(0, 0, 0 ,0.8)',

				color: '#fff',

				display: 'block',

				left:'50%',

				zIndex: 2000,

				opacity: 0

			});
		},
		transition: function() {

			$.css3(this.oWrap, {
				'transition': 'opacity .8s'
			});

		},
		removeTranstion: function() {

			$.css3(this.oWrap, {
				'transition': 'none'
			});

		},
		calc: function() {

			var _width = this.oWrap.get(0).offsetWidth;

			this.oWrap.css('marginLeft', -_width/2);
		},
		show: function() {

			this.oWrap.css('opacity', '1');

		},
		hide: function() {

			this.oWrap.css('opacity', '0');

		},
		text: function(str) {

			var _this = this;

			clearTimeout( this.timer );

			this.removeTranstion();

			this.hide();

			this.transition();

			this.oWrap.html(str);

			this.show();

			this.calc();

			if ( this.timeBtn ) {

				this.timer = setTimeout(function(){

					_this.hide();

				}, this.delay);	

			}
		}

	}

	window.oTip = new Tip();
	oTip.init();

	module.exports = Tip;

});