/*
 *description:backTop
 *author:fanwei
 *date:2013/11/02
 */
define(function(require, exports, module) {

	function Tool(options)
	{	
		options = options || {};

		this.oDiv = $('<div></div>');

		this.ie6 = !window.XMLHttpRequest;

		this.right = parseInt(options.right) || 100;

		this.bottom = parseInt(options.bottom) || 30;

		this.moveTime = 300;
	}

	Tool.prototype = {

		init: function(str)
		{
			this.create(str);

			this.addEvent(this.oDiv);

			this.back(this.oDiv.find('[script-role = back_top]'));
		},
		clear: function()
		{
			this.oDiv.remove();
		},
		create: function(str)
		{
			this.set();

			this.oDiv.html(str);

			$('body').append(this.oDiv);	
		},
		set: function()
		{	
			this.oDiv.attr('id','backTop178');

			this.oDiv.css({
				right: this.right,
				bottom: this.bottom
			});

			if(this.ie6)
			{	
				this.oDiv.css({
					position:'absolute'
				});
			}
			else
			{
				this.oDiv.css({
					position:'fixed'
				});
			}
		},
		back: function(obj)
		{
			obj.click(function(){

				$('body,html').stop().animate({scrollTop: 0}, 0);

			});
		},
		addEvent: function(obj)
		{	
			var windowTop;
			var _this = this;
			var timer = null;

			$(window).scroll(function(){

				windowTop = $('html').scrollTop()||$('body').scrollTop();

				if(windowTop == 0)
				{
					obj.fadeOut(_this.moveTime);
				}		
				else
				{
					obj.fadeIn(_this.moveTime);
				}

				if(_this.ie6)ie6Postion();

			});


			if(this.ie6)
			{
				$(window).resize(function(){

					clearTimeout(timer);

					timer = setTimeout(ie6Postion, 30);

				});
			}

			function ie6Postion()
			{	
				var windowHeight,
					windowTop,
					top;

				windowHeight = $(window).height();
				windowTop = $('html').scrollTop()||$('body').scrollTop();
				top = windowHeight - _this.bottom - obj.outerHeight();

				obj.css({
					top: top + windowTop
				});
			}	
		},
		backTopTemp: 
		'<div class="inner" script-role="back_top">'+
			'<span class="back_top icon178">back_top</span>'+
			'<span class="text" style="border:none">顶部</span>'+
		'</div>',
		bookTopTemp:
		'<div class="inner mb_1" script-role="book">'+
			'<a href="javascript:;">'+
				'<span class="book icon178">book</span>'+
				'<span class="text" script-role="book_text">订阅</span>'+
			'</a>'+
		'</div>'+
		'<div class="inner" script-role="back_top">'+
			'<span class="back_top icon178">back_top</span>'+
			'<span class="text" style="border:none">顶部</span>'+
		'</div>'

	}

	module.exports = Tool;
	
});