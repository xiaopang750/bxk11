define(function(require, exports, module) {
	
	var request = require('../../http/request');

	function RelatedInput(options)
	{
		this.url = options.url || '';

		this.param = options.param || {};

		this.postName = options.postName || '';

		this.oWrap = options.oWrap || '';

		this.wrapClass = options.wrapClass || 'related';

		this.fnDo = options.fnDo || null;

		this.blur = options.blur || null;

		this.onchange = options.onchange || null;

		this.getValue = options.getValue || null;

		this.oUl = $('<ul></ul>');

		this.height = this.oWrap.outerHeight();

		this.borderWidth = parseInt(this.oWrap.css('borderLeftWidth'));

		this.borderColor = this.oWrap.css('borderLeftColor');

		this.left = this.oWrap.position().left - this.oWrap.parent().position().left;

		this.top = this.oWrap.position().top - this.oWrap.parent().position().top + this.height + 5;

		this.zIndex = options.zIndex || 2;

		this.innerWidth = this.oWrap.innerWidth();

		this.iNow = -1;

		this.press = options.press || 'yes';

		this.setListWrap();

		this.setWrap();

		this.wrapEvent();

		this.blurEvent();

	}

	RelatedInput.prototype = {

		setWrap: function()
		{	
			this.oWrap.parent().css({

				position: 'relative'
			});

			this.oWrap.parent().append(this.oUl);
		},
		setListWrap: function()
		{	
			this.oUl.css({
				zIndex: this.zIndex,
				display: 'none',
				position: 'absolute',
				left: this.left+'px',
				top: this.top+'px',
				border: this.borderWidth + 'px solid ' + this.borderColor,
				width: this.innerWidth
			});

			this.oUl.attr('class', this.wrapClass);
		},
		addEvent: function()
		{	
			var str,
				_this,
				dataList,
				code,
				aLi;

			_this = this;	

			this.oWrap.keyup(function(e){

				code = e.keyCode;

				aLi = _this.oUl.children();

				if(code === 38)
				{	
					_this.up(aLi);
				}
				else if(code === 40)
				{	
					_this.down(aLi);	
				}
				else if(code === 13)
				{	
					_this.enterDo(aLi, _this.iNow);
				}
				else
				{	
					if(_this.press == 'yes')
					{
						str = _this.oWrap.val();

						_this.onchange && _this.onchange(_this.param);
						
						_this.getData(str, function(data){

							_this.render(data);

						});
					}
					else
					{
						str = _this.oWrap.val();

						_this.onchange && _this.onchange(_this.param);

						if(!_this.firstLoad)
						{
							_this.firstLoad = true;

							_this.getData(str, function(data){

								_this.render(data);

							});
						}
					}					
				}

			});

			this.oWrap.blur(function(){

				var haha = $(this);

				setTimeout(function(){

					_this.blur && _this.blur(haha.val(), _this.oUl.children(), _this.oWrap);

				},100)

			});

			if(this.press == 'no')
			{	
				var _this = this;

				this.oWrap.click(function(){

					if(_this.oUl.children().size())
					{
						_this.show();
					}

					return false;

				});
			}

			
		},
		getData: function(str, fnDo)
		{	
			var _this = this;

			this.param[this.postName] = str;

			request({

				url: this.url,

				data: this.param,

				sucDo: function(data)
				{
					fnDo && fnDo(data);
				},
				noDataDo: function()
				{
					_this.hide();
				}

			});
		},
		render: function(data)
		{	
			this.oUl.html('');

			this.show();

			this.fnDo && this.fnDo(data, this.oUl);	

			this.iNow = -1;
		},
		show: function()
		{
			this.oUl.show();
		},
		hide: function()
		{
			this.oUl.hide();
		},
		up: function(aLi)
		{	
			this.iNow --;

			if(this.iNow < 0)
			{
				this.iNow = aLi.length - 1;
			}

			this.tab(aLi, this.iNow);
		},
		down: function(aLi)
		{
			this.iNow ++;

			if(this.iNow > aLi.length -1)
			{
				this.iNow = 0;
			}

			this.tab(aLi, this.iNow);
		},
		enterDo: function(aLi, iNow)
		{
			this.oWrap.val(aLi.eq(iNow).text());

			this.hide();

			this.blur && this.blur(aLi.eq(iNow).text(), aLi, this.oWrap);

			this.getValue && this.getValue(aLi.eq(iNow), this.oWrap);
		},
		tab: function(aLi, iNow)
		{	
			aLi.eq(iNow).addClass('act').siblings().removeClass('act');
		},
		wrapEvent: function(aLi)
		{	
			var _this = this;

			this.oUl.on('click', 'li', function(){

				_this.oWrap.val($(this).text());

				_this.hide();

				_this.getValue && _this.getValue($(this), _this.oWrap);

			});

			this.oUl.on('mouseover', 'li', function(){

				var index = $(this).index();

				_this.iNow = index;

				$(this).addClass('act').siblings().removeClass('act');

			});
		},
		blurEvent: function()
		{	
			var _this = this;

			$(document).click(function(){

				_this.hide();

			});
		}

	};


	module.exports = RelatedInput;
});