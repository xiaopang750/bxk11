define(function(require, exports, module) {
	
	var global = require('../../lib/global/global');
	var info = require('../../sub/home/info');
	var mvc = require('../../lib/prototype/prototype');

	var _parent = new mvc();
	var Scheme = _parent.extend();
	var _uid = _parent.parse().uid;
	var nType = parseInt($('[script-role = user_head]').attr('level'));
	
	/* m */
	Scheme.param.uid = _uid;
	Scheme.requestUri = nType > 10 ? '/index.php/view/user/scheme' : '/index.php/view/user/project';
	Scheme.load();
	Scheme.suc = function(data)
	{	
		data.user_level = nType;

		/* v */		
		Scheme.data = data;
		Scheme.tempId = 'scheme_list';
		Scheme.tempWrap = $('[script-role = scheme_wrap]');
		Scheme.render();
	};

});