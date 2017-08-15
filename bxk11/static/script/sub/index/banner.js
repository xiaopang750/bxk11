define(function(require, exports, module) {

	var template = require('../../lib/template/template.js');

	var tempId = 'banner178_tpl';

	function Banner(options)
	{	
		if(!options)return;

		this.leftBtn = options.leftBtn || null;

		this.rightBtn = options.rightBtn || null;

		this.bannerWrap = options.bannerWrap || null;

		this.bannerOutPutWrap = options.bannerOutPutWrap || null;

		this.iNow = 0;
	}

	Banner.prototype = {

		getData : function()
		{
			var data = {err:0, data:[
				{url:'/application/xiaopang1.jpg'},
				{url:'/application/xiaopang2.jpg'}
			]};

			return data;
		},
		render: function(data)
		{
			var html = template(tempId, data);

			this.bannerOutPutWrap.html(html);

			this.aList = this.bannerOutPutWrap.children();

			this.num = this.aList.length;
		},
		init: function()
		{
			this.aList.css({
				position: 'absolute',
				opacity: 0
			});

			this.aList.eq(0).css({opacity: 1});

			this.leftClick();

			this.rightClick();
		},
		tab: function()
		{	
			this.aList.eq(this.iNow).stop().animate({opacity: 1}).siblings().stop().animate({opacity: 0});
		},
		leftClick: function()
		{
			var _this = this;

			this.leftBtn.click(function(){

				_this.iNow--;

				if(_this.iNow < 0) _this.iNow = _this.aList.length - 1;

				_this.tab();

			});
		},
		rightClick: function()
		{
			var _this = this;

			this.rightBtn.click(function(){

				_this.iNow ++ ;

				if(_this.iNow > _this.aList.length - 1) _this.iNow = 0;

				_this.tab();

			});
		}
	}

	return;

	var oLeftBtn,
		oRightBtn,
		oWrap,
		oUl,
		aList;

	oLeftBtn = $('[script-role=banner_left_btn]');
	oRightBtn = $('[script-role=banner_right_btn]');	
	oWrap = $('[script-role=banner_wrap]');	
	oUl = $('[script-role=banner_output]');

	var banner = new Banner({
		leftBtn : oLeftBtn,
		rightBtn : oRightBtn,
		bannerWrap : oWrap,
		bannerOutPutWrap : oUl
	});

	var data = banner.getData();

	banner.render(data);

	banner.init();

});