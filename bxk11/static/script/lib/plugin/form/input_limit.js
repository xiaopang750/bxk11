define('/static/script/lib/plugin/form/input_limit', [
	'/static/script/lib/event/keypress'
	], function(require, exports, module) {

	var keypress=require('/static/script/lib/event/keypress')

	function input_limit(obj,max)
	{	
		var num=obj.length;

		for (var i=0;i<num;i++)
		{
			_input_limit(obj[i],max);
		}
	}

	function _input_limit(obj,max)
	{
		keypress([obj],function(){

			var num=obj.value.length;

			if(num>=max)obj.value=obj.value.substring(0,max);

		});
	}

	return input_limit;

});