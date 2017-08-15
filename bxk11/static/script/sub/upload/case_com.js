define(function(require, exports, module) {
	
	var global = require('../../lib/global/global');

	var request = require('../../lib/http/request');

	/* nav */
	(function(){

		var sType,
			aBtn,
			aText;

		sType = $('[script-role = upload_type]').attr('step_type');
		aBtn = $('[script-role = step_btn]');
		aText = $('[script-role = step_text]');

		switch(sType)
		{
			case '1':
				aBtn.eq(0).addClass('cur1');
				aText.eq(0).addClass('act');
			break;

			case '2':
				aBtn.eq(0).addClass('suc1');
				aBtn.eq(1).addClass('cur2');
				aText.eq(1).addClass('act');
			break;

			case '3':
				aBtn.eq(0).addClass('suc1');
				aBtn.eq(1).addClass('suc2');
				aBtn.eq(2).addClass('cur3');
				aText.eq(2).addClass('act');
			break;
		}

	})();

});