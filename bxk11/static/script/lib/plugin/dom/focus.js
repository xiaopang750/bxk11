/*
 *description:焦点图模块
 *author:fanwei
 *date:2013/11/04
 */
define(function(require, exports, module){
	
	var until = require('../../prototype/until');
	var _until = new until();

	var Focus = _until.extend(until, function(options){

			options = options || {};

			this.oFocusWrap = options.oFocusWrap || null;
			this.oFocusLeft = this.oFocusWrap .find('[script-role = widget-focus-left]') || null;
			this.oFocusRight = this.oFocusWrap .find('[script-role = widget-focus-right]') || null;
			this.oFocusOuter = this.oFocusWrap .find('[script-role = widget-focus-outer]') || null;
			this.oFocusInner = this.oFocusWrap .find('[script-role = widget-focus-inner]') || null;

			this.picArr = options.picArr || null;
			this.linArr = options.linArr || null;
			this.getDataUrl = options.getDataUrl || null;
			this.btnLeftIndex = this.oFocusLeft.attr('widget-index') || 0;
			this.btnRightIndex = this.oFocusRight.attr('widget-index') || 0;
			this.wrapWidth = this.oFocusWrap .attr('widget-width');
			this.wrapHeight = this.oFocusWrap .attr('widget-height');
			this.auto = this.oFocusWrap .attr('widget-auto') || true;
			this.roundTime = this.oFocusWrap .attr('widget-round-time') || 3000; //(ms)
			this.speed = options.speed || 800; //(ms)
			this.tmp = '<li></li>';

			this.iNow = 0;
			this.timer = null;
			this.last = '';
			this.num = 0;
			this.lock = false;
			this.startLock = false;

			//webkit内核支持蒙版效果
			typeof( this.oFocusWrap.get(0).style.WebkitMask ) == 'string' ? this.webkit = true : this.webkit = false; 
			this.WEBKIT_MARK_MAX = '300%';
			this.WEBKIT_MARK_LEFT = '50%';
			this.WEBKIT_MARK_TOP = '50%';
			this.WEBKIT_MARK_ANIMATION_NAME = 'radi';
			this.WEBKIT_MARK_IMAGE = '/static/images/lib/global/circle_mask.png';

		},{

			init: function()
			{	
				this.judeLoad();
			},
			judeLoad: function()
			{	
				var _this = this;

				if(this.picArr)
				{	
					//_this.requestPic();
					_this.start(this.picArr);	
				}
				else if(this.getDataUrl)
				{
					_this.requestPic();
				}
			},
			requestPic: function()
			{	
				var _this = this;

				this.requestUri = this.getDataUrl;

				this.load();

				this.suc = function(data)
				{
					_this.start(data.data);
				};
			},
			start: function(data)
			{	
				this.picList = data;

				this.num = this.picList.length;

				this.last = this.picList[0];

				this.widgetInit(data);

				this.clickEvent();

				this.hoverEvent();

				this.play();
			},
			widgetInit: function(data)
			{		
				var i,
					num,
					arr,
					_this;

				arr = [];	
				_this = this;

				this.oFocusOuter.css({
					position: 'relative',
					width: this.wrapWidth,
					height: this.wrapHeight
				});

				this.oFocusLeft.css('zIndex', this.btnLeftIndex);
				this.oFocusRight.css('zIndex', this.btnRightIndex);

				this.renderList();

				num = data.length >= 2 ? 2 : data.length;

				for (i=0; i<num; i++)
				{	
					arr.push(data[i]);
					//this.renderBg($('[script-role = widget_list]').eq(i), data[i]);		
				}

				this.loadImage(arr, function(){

					_this.startLock = true;

					if( num >=2 )
					{
						_this.renderBg(_this.front, arr[0]);
						_this.renderBg(_this.back, arr[1]);	
					}
					else
					{
						_this.renderBg(_this.front, arr[0]);
					}

				});
			},
			renderList: function()
			{
				var i,
					num,
					arrName;

				num = 2;
				arrName = ['front', 'back'];	

				for (i=0; i<num; i++)
				{
					var oLi = $(this.tmp);

					oLi.attr('script-role', 'widget_list');

					this[ arrName[i] ] = oLi;

					oLi.css({
						zIndex: num - i,
						width: this.wrapWidth,
						height: this.wrapHeight,
						position: 'absolute',
						left: '0',
						top: '0'
					});

					this.oFocusInner.append(oLi);
				}
			},
			clickEvent: function()
			{
				var num,
					_this;

				num = this.num;
				_this = this;

				this.oFocusLeft.on('click', function(){

					if( !_this.lock && _this.startLock )
					{	
						_this.iNow --;

						if( _this.iNow < 0 )
						{
							_this.iNow = _this.num-1;
						}

						_this.tab();
					}

				});

				this.oFocusRight.on('click', function(){

					if( !_this.lock && _this.startLock )
					{	
						_this.iNow ++;

						if( _this.iNow > _this.num-1 )
						{
							_this.iNow = 0;
						}

						_this.tab();
					}
				});
			},
			hoverEvent: function()
			{	
				var _this = this;

				this.oFocusWrap.on({

					mouseover: function(){

						_this.stop();
					},

					mouseleave: function(){

						_this.play();
					}

				})
			},
			tab: function()
			{	
				this.lock = true;

				var _this,
					arr;

				_this = this;
				arr = [];				

				arr.push(this.last);
				arr.push(this.picList[this.iNow]);

				this.loadImage(arr, function(){

					_this.effect(arr);	

					_this.effectDown(arr);	

				});
				
			},
			effect: function(arr)
			{	
				var _this = this;

				if( this.webkit )
				{
					this.front.css({
						WebkitMask: 'url('+ this.WEBKIT_MARK_IMAGE +') no-repeat '+ this.WEBKIT_MARK_LEFT +' '+this.WEBKIT_MARK_TOP,
						WebkitMaskSize: this.WEBKIT_MARK_MAX,
						WebkitAnimation: this.WEBKIT_MARK_ANIMATION_NAME+' '+ this.speed +'ms'
					});

					this.renderBg(this.front, arr[1]);

					this.renderBg(this.back, this.last);
				}
				else
				{	
					this.renderBg(this.front, this.last);

					this.renderBg(this.back, arr[1]);
				}
			},
			effectDown: function(arr)
			{	
				var _this = this;

				if( _this.webkit )
				{
					setTimeout(function(){

						_this.front.css({
							WebkitMask: '',
							WebkitMaskSize: '',
							WebkitAnimation: ''
						});

						_this.renderBg(_this.front, arr[1]);

						_this.last = arr[1];

						_this.lock = false;
						
					}, this.speed);
				}
				else
				{
					this.front.stop().animate({opacity: 0}, this.speed, function(){

						_this.renderBg(_this.front, arr[1]);

						_this.front.css('opacity', '1');

						_this.last = arr[1];

						_this.lock = false;

					});
				}

			},
			renderBg: function(obj, src)
			{	
				obj.css('background', 'url('+ src +') no-repeat 0 0');
			},
			loadImage: function(arr, callBack)
			{	
				var i,
					num,
					count;

				num = arr.length;

				count = 0;
				
				for(i=0; i<num; i++)
				{
					var oImage = new Image();

					oImage.onload = function()
					{	
						count ++ ;

						if(count == num)
						{
							callBack && callBack();	
						}
						
					};

					oImage.src = arr[i];
				}	
				
			},
			play: function()
			{	
				var _this = this;

				this.stop();

				this.timer = setInterval(function(){

					if(_this.startLock)
					{
						_this.iNow ++ ;

						if( _this.iNow>_this.num-1 )
						{
							_this.iNow = 0;
						}

						_this.tab();
					}

				}, this.roundTime);
			},
			stop: function()
			{
				clearInterval(this.timer);
			}


	});

	module.exports = Focus;

});