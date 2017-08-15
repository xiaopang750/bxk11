define(function(require, exports, module) {
	
	var request = require('../../http/request');

	var template = require('../../template/template');

	var imageLoad = require('../../img/imageLoad');

	var scrollLoad = require('../../dom/scrollLoad');

	function Monsary(options)
	{	
		this.param = options.param || {};

		this.url = options.url || '';

		this.oWrap = options.oWrap || '';

		this.renderDo = options.renderDo || '';

		this.isStartLoadingShow = options.isStartLoadingShow || 'true';

		this.dataName = options.dataName || '';

		this.preLoadImage = options.preLoadImage || 'false';

		this.items = this.oWrap.children().size();

		this.aUl = this.oWrap.children();

		this.listTagName = options.listTagName || '<li></li>';

		this.effectClass = options.effectClass || 'filter';

		this.showLoading = options.showLoading || 'true';

		this.p = options.p || 1;

		this.param.p = this.p;

		this.tplId = options.tplId;

		this.isFirstLoading = this.isStartLoadingShow == 'true' ? isFirstLoading = true : isFirstLoading = false;

		this.oLoading = null;

	}

	Monsary.prototype = {

		init: function()
		{	
			this.createLoading();

			this.render();

			this.scrollWrap();
		},
		clear: function()
		{	
			this.oWrap.scrollBtn = true;

			this.p = 1;

			this.aUl.html('');

			$(window).unbind('scroll');

			this.oLoading.remove();
		},
		render: function()
		{	
			var _this;

			if(this.showLoading == 'true')
			{
				if(this.isFirstLoading)this.loading();

				this.isFirstLoading = true;	
			}

			_this = this;

			var data = this.load();

			if(data.err == 1)
			{	
				/* 一页的数据都没有 */
				if(this.p == 1)
				{	
					this.oWrap.addClass('noData');

					this.oWrap.html('暂无数据');

					if(this.showLoading == 'true')this.loadOver();

					return;
				}

				if(this.showLoading == 'true')this.end();

				return;
			}

			if(!_this.dataName)
			{	
				show(data.data);
			}
			else
			{	
				show(data.data[_this.dataName]);
			}

			function show(data)
			{	
				if(_this.preLoadImage == 'true')
				{	
					var imageData = _this.concatImageData(data);

					imageLoad(imageData, function(){	

						_this.createDom(data);

						_this.oWrap.scrollBtn = true;

					});
				}
				else
				{
					_this.createDom(data);

					_this.oWrap.scrollBtn = true;
				}	
			}

			this.loadOver();
		},
		scrollWrap: function()
		{	
			var _this;

			_this = this;

			scrollLoad(this.oWrap, function(){

				_this.p ++ ;

				_this.param.p = _this.p;

				_this.oWrap.scrollBtn = false;

				setTimeout(function(){

					_this.render();

				},0);

			});
		},
		load: function()
		{
			/* 使用同步 */

			var callBack = request({
				url: this.url,
				data: this.param,
				async: 'false'
			});

			return callBack;	
		},
		createDom: function(data)
		{	
			var i,
				k,
				num,
				_this;

			num = data.length;

			_this = this;
			
			for(i = 0; i < num; i++)
			{	

				var html = template(this.tplId, data[i]);

				var oList = $(html);

				oList.addClass(this.effectClass);

				//oList.html(html);

				this.aUl.sort(function(oUl1, oUl2){

					return $(oUl1).outerHeight() - $(oUl2).outerHeight();
				});

				$(this.aUl[0]).append(oList);

				oList.stop().animate({opacity:1});
			}

			this.renderDo && this.renderDo(data);
		},
		concatImageData: function(data)
		{	
			var i,
				j,
				num,
				num2,
				result,
				arr;

			num = data.length;
			
			result = [];

			for(i=0; i<num ;i++)
			{	
				num2 = data[i].pic_list.length;

				for(j=0; j<num2; j++)
				{	
					result = result.concat(data[i].pic_list[j].pic_url2);
				}
			}	

			return result;
		},
		createLoading: function()
		{	
			var oDiv,
				left,
				_this;

			oDiv = $('<div></div>');

			oDiv.addClass('monsary_loading');

			this.oLoading = oDiv;

			_this = this;
			
			$('body').append(this.oLoading);

			position();

			$(window).resize(position);

			function position()
			{
				left = _this.getLoadingPosition();

				oDiv.css({left: left});
			}
		},
		getLoadingPosition: function()
		{
			var wrapWidth,
				wrapLeft,
				loadingWidth;
				
			wrapWidth = this.oWrap.width() - 12;

			wrapLeft = this.oWrap.offset().left;

			loadingWidth = this.oLoading.outerWidth();

			loadingLeft = (wrapWidth - loadingWidth)/2 + wrapLeft;

			return loadingLeft;
		},
		loading: function()
		{	
			this.oLoading.html('加载更多灵感......');

			this.oLoading.show();
		},
		loadOver: function()
		{
			this.oLoading.fadeOut();
		},
		end: function()
		{
			var _this = this;

			this.oLoading.html('已经是最后一页');

			this.oLoading.fadeIn();

			setTimeout(function(){

				_this.oLoading.fadeOut();

			},1000);
		}
	}

	module.exports = Monsary;

});