define(function(require, exports, module) {
	
	function InputTip(options)
	{
		this.oArea = options.oArea || null;

		this.oTip = options.oTip || null;

		this.max = options.max || 120;
	}

	InputTip.prototype = {

		init: function()
		{
			this.addEvent();
		},
		judge: function()
		{
			var length = this.oArea.val().length;

			if(length >= this.max)this.oArea.val(this.oArea.val().substring(0, this.max));

			this.oTip.html('您还可以输入<span>'+ (this.max - length) +'</span>' + '个字');
		},
		addEvent: function()
		{	
			var _this = this;

			/*this.oArea.unbind('keypress');
			this.oArea.unbind('keyup');
			this.oArea.unbind('keydown');*/

			this.oArea.keypress(function(){

				_this.judge();
			});
			this.oArea.keyup(function(){

				_this.judge();
			});
			this.oArea.keydown(function(){

				_this.judge();
			});
		},
		clear: function()
		{
			this.oTip.html('您还可以输入<span>'+ (this.max) +'</span>' + '个字');
		}

	}

	module.exports = InputTip;

});