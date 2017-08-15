/*
 *description:验证码刷新
 *author:fanwei
 *date:2014/03/24
 */
define(function(require, exports, module){
	
	var rnd = require('../../widget/tool/rnd');

	function RefreshCode(oImage) {

		this.oImage = oImage;

	}

	RefreshCode.prototype = {

		refresh: function() {

			var org,
				nowSrc;

			org = this.oImage.attr('src');
			nowSrc = org + '?' + rnd(20000, 1);
			this.oImage.attr('src', nowSrc);
		}

	}

	module.exports = RefreshCode;

});