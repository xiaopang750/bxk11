define(function(require, exports, module) {
	
	var global = require('../../lib/global/global');
	var info = require('../../sub/home/info');
	var mvc = require('../../lib/prototype/prototype');

	var _parent = new mvc();
	var Product = _parent.extend();
	var _uid = _parent.parse().uid;
	var nType = parseInt($('[script-role = user_head]').attr('level'));
	
	/* m */
	Product.param.uid = _uid;
	Product.requestUri = nType > 10 ? '/index.php/view/user/product' : '/index.php/view/user/likeproduct';
	Product.load();
	Product.suc = function(data)
	{
		data.user_level = nType;

		/* v */
		Product.data = data;
		Product.tempId = 'product_list';
		Product.tempWrap = $('[script-role = product_list]');
		Product.render();
	};


});