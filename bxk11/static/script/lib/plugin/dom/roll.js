define(function(require, exports, module) {
	
	function Roll(options)
	{	
		options = options || {};
		this.oUl = options.oUl || null;
		this.oLeft = options.oLeft || null;
		this.oRight = options.oRight || null;
		this.listName = options. listName || '';

		this.clickDo = options.clickDo || null;
	}

	Roll.prototype = {

		start: function()
		{
			this.roll(this.oUl, this.oLeft, this.oRight, this.listName);

			this.clickList(this.oUl, this.listName);
		},
		clickList: function(oUl, listName)
		{	
			var _this = this;

			oUl.on('click', '[script-role = '+ listName +']', function(){

				_this.clickDo($(this));

			});
		},
		roll: function(oUl, oLeft, oRight, listName)
		{	
			var aList,
				num;

			aList = oUl.find('[script-role = '+ listName +']');
			
			num = aList.length;	

			this.sinWidth = aList.eq(0).outerWidth(true);

			this.sumWidth = num * this.sinWidth;

			oUl.css({width: this.sumWidth});

			oUl.attr('iNow', '0');

			this.clickChange(oUl, oLeft, oRight, this.sinWidth, this.sumWidth, listName);
		},
		tab: function(oUl, n, dis)
		{	
			oUl.stop().animate({left: n * dis});
		},
		clickChange: function(oUl, oLeft, oRight, sinWidth, sumWidth, listName)
		{
			var n,
				num,
				_this,
				max;

			num = oUl.find('[script-role = '+ listName +']').length;

			_this = this;

			max = Math.floor((sumWidth - oUl.parent().width())/sinWidth);

			if(max <= 0)
			{
				oLeft.hide();

				oRight.hide();
			}

			oLeft.on('click', function(){

				n = oUl.attr('iNow');

				n ++ ;

				if(n > max) n = max;

				oUl.attr('iNow', n);

				_this.tab(oUl, -n ,sinWidth);
			});

			oRight.on('click', function(){

				n = oUl.attr('iNow');

				n -- ;

				if(n < 0) n = 0;

				oUl.attr('iNow', n);

				_this.tab(oUl, -n ,sinWidth);
			});
		}

	};

	module.exports = Roll;

});