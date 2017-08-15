define(function(require, exports, module) {
	
	var request = require('../../lib/http/request');

	var template = require('../../lib/template/template');

	function Guessfav(options)
	{	
		options = options || {};

		this.url = options.url || '/index.php/view/content/guessYourLike';

		this.param = options.param || {};

		this.height = options.height || '238';

		this.itemTemp = options.itemTemp || '{{each data}}<li class="fav_list" script-role="fav_list"><dl><dt><a href="{{$value.url}}"><img src="{{$value.pic_url}}"></a></dt><dd>{{$value.title}}</dd></dl></li>{{/each}}';

		this.leftBtn = options.leftBtnTemp || $('<a class="fav_left_btn favBtn" script-role ="fav_left_btn" href="javascript:;" onfocus="this.blur()"></a>');

		this.rightBtn = options.rightBtnTemp || $('<a class="fav_right_btn favBtn" script-role ="fav_right_btn" href="javascript:;" onfocus="this.blur()"></a>');

		this.oUl = $('<ul></ul>');

		this.page = 1;

		this.iNow = 0;

		this.lock = true;

		this.upLock = true;

		this.colseLock = true;

		this.sumWidth = 0;
	}

	Guessfav.prototype = {

		init: function()
		{	
			var _this = this;

			this.makeBgWrap();

			this.makeRollWrap();

			this.makeFavwrap();

			this.renderData();

			this.resize();

			this.ie6Position();

			this.left();

			this.right();

			this.addRollEvent();

			this.addCloseEvent();
		},
		getData: function(callBack)
		{	
			request({
				url: this.url,
				async: 'false',
				data: {p: this.page},
				sucDo: function(data)
				{	
					callBack && callBack(data);
				}
			});
		},
		makeFavwrap: function()
		{	
			this.bottomWrap = $('<div script-role="fav_wrap"></div>');

			this.bottomWrap.append(this.bg);

			this.bottomWrap.append(this.oWrap);

			this.bottomWrap.css({

				width: '100%',

				height: this.height,

				position: 'fixed',

				left: 0,

				bottom: 0,

				display: 'none'

			});

			$('body').append(this.bottomWrap);
		},
		makeBgWrap: function()
		{
			this.bg = $('<div script-role="bottom_fav_bg"></div>');

			this.bg.css({
				height:this.height,

				width:'100%',

				opacity:'0.7',

				background:'#000',

				position:'absolute',

				zIndex:1,

				left:'0',

				top: this.height+ 'px',

				overflow:'hidden'
			});

			$('body').append(this.bg);
		},
		makeRollWrap: function()
		{	
			var oText = $('<div class="fav_title fl">猜你喜欢</div>');

			var oClose = $('<div class="fav_close fr favBtn" script-role="fav_close">关闭</div>');

			this.oWrap = $('<div script-role="bottom_fav"></div>');

			this.oRollWrap = $('<div script-role="roll_wrap" class="roll_wrap"></div>');

			this.oWrap.append(this.oRollWrap);

			this.oWrap.append(this.leftBtn);

			this.oWrap.append(this.rightBtn);

			this.oRollWrap.css({position: 'absolute', left:0, top:'43px'});

			this.oWrap.append(oText);

			this.oWrap.append(oClose);

			this.oWrap.css({

				height:this.height,

				width:'100%',

				position:'absolute',

				zIndex:2,

				left:'0',

				top: this.height+ 'px',

				overflow:'hidden'
			});

			$('body').append(this.oWrap);
		},
		makeListWrap: function(html)
		{
			this.oUl.html(this.oUl.html() + html);

			this.getSize(this.oUl);

			this.oRollWrap.append(this.oUl);
		},
		renderData: function()
		{	
			var _this = this;

			this.getData(function(data){

				var render = template.compile(_this.itemTemp);

				var html = render(data);

				_this.makeListWrap(html);

				_this.judge();

			});
		},
		testIe6: function()
		{
			if(!window.XMLHttpRequest)
			{
				return true;
			}
			else
			{
				return false;
			}
		},
		getSize: function(oWrap)
		{	
			var _this = this;

			var aLi = oWrap.children();

			var sinWidth = aLi.eq(0).width() + 5;

			var num = aLi.size();

			var sumWidth = sinWidth * num;

			this.sumWidth = sumWidth;

			this.oRollWrap.css({width: this.sumWidth});

			oWrap.css({width:sumWidth, float:'left'});
		},
		judge: function()
		{	
			var windowWidth = $(window).width();

			if(this.sumWidth < windowWidth)
			{			
				this.page++;

				this.renderData();
			}
			else
			{	
				this.dataNo();
			}
		},
		dataNo: function()
		{
			if(this.copyUl)this.copyUl.remove();

			this.copy();

			this.oRollWrap.append(this.copyUl);

			this.rollWrapCopyWidth();

			return;
		},
		rollWrapCopyWidth: function()
		{
			this.oRollWrap.css({

				width: parseInt(this.oUl.css('width')) * 2
			})
		},
		copy: function()
		{
			this.copyUl = this.oUl.clone();

			this.sumWidth = 0;

			this.sumWidth = parseInt(this.oUl.css('width')) * 2;
		},
		resize: function()
		{	
			var _this = this;

			$(window).resize(function(){

				_this.judge();

				_this.oRollWrap.css({left: 0});

			});
		},
		left: function()
		{	
			var _this = this;
			
			this.leftBtn.click(function(){

				var place = _this.oRollWrap.position().left;

				if(place - 205 < ( $(window).width() - _this.oRollWrap.width() ))
				{
					_this.oRollWrap.css({left: 0 });
				}

				_this.tab('left');

			});
		},
		right: function()
		{	
			var _this = this;

			this.rightBtn.click(function(){

				var place = _this.oRollWrap.position().left;
				
				if(place + 205 > 0)
				{
					_this.oRollWrap.css({left: ( $(window).width() - _this.oRollWrap.width() ) });
				}

				_this.tab('right');

			});
		},
		tab: function(sType)
		{	
			if(sType == 'right')
			{
				this.oRollWrap.stop().animate({left: this.oRollWrap.position().left + 205});	
			}
			else
			{
				this.oRollWrap.stop().animate({left: this.oRollWrap.position().left - 205});
			}
			
		},
		addRollEvent: function()
		{	
			var  _this = this;
			var windowTop;

			$(window).scroll(function(){
				
				if(_this.colseLock)
				{
					windowTop = $('body').scrollTop() || $('html').scrollTop();

					if(windowTop + $(window).height() + 10 >= $(document).height() && _this.lock)
					{	
						_this.moveUp(_this.bg);

						_this.moveUp(_this.oWrap);
					}
					else
					{	
						if(!_this.lock && _this.upLock)
						{	
							_this.upLock = false;

							_this.moveDown(_this.bg);

							_this.moveDown(_this.oWrap);
						}
					}
				}
			});
		},
		moveUp: function(obj)
		{	
			var _this = this;

			this.bottomWrap.show();

			obj.stop().animate({top: 0},function(){

				_this.lock = false;
			});
		},
		moveDown: function(obj)
		{
			var _this = this;

			obj.stop().animate({top: this.height},function(){

				_this.bottomWrap.hide();

				_this.lock = true;

				_this.upLock = true;

			});
		},
		ie6Position: function()
		{	
			var scrollTop,
				_this;

			_this = this;	

			if(this.testIe6())
			{	
				this.bottomWrap.css({top: $(window).height() - _this.height, position: 'absolute'});

				$(window).scroll(function(){

					scrollTop = $('html,body').scrollTop();

					_this.bottomWrap.css({top: scrollTop + ( $(window).height() - _this.height )});

				});
			}
		},
		addCloseEvent: function()
		{	
			var _this = this;

			$('[script-role = fav_close]').click(function(){

				_this.bottomWrap.hide();

				_this.colseLock = false;	
						
			});
		}

	}

	module.exports = Guessfav;
});