/*
 *description:limit-text
 *author:fanwei
 *date:2013/08/29
 */

/*
	文本框，文本域字数提示:

	@param:
	oInput: object 监听的文本框
	oTip: obejct 提示框
	max: number 最大字数限制
*/

define(function(require, exports, module){
	
	function InputTip(oInput, oTip, max ) {

		this.oInput = oInput;
		this.oTip = oTip;
		this.max = max;

		oTip.html(max);	
		
	}

	InputTip.prototype = {

		start: function() {

			this.oTip.html( this.max );
			this.events();

		},
		events: function() {

			var _this = this;

			this.oInput.on('keypress', function(){

				_this.calc();

			});

			this.oInput.on('keyup', function(){

				_this.calc();

			});

		},
		calc: function() {

			var sValue,
				num;
			
			sValue = this.oInput.val();
			num = sValue.length;

			if( num >= this.max ) {

				this.oInput.val( this.oInput.val().substring(0, this.max) );

			}

			this.oTip.html( this.max - num );

		}

	}	

	module.exports = InputTip;

});