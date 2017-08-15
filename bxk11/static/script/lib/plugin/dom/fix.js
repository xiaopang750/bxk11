define('/static/script/lib/plugin/dom/fix', [
	'/static/script/lib/broswer/test',
	'/static/script/lib/plugin/ie6/ie6Follow',
	'/static/script/lib/css/css'], function(require, exports, module) {
	
	var test=require('/static/script/lib/broswer/test');
	var ie6Follow=require('/static/script/lib/plugin/ie6/ie6Follow');
	var css=require('/static/script/lib/css/css');

	function fix(options)
	{
		var options=options||{};
		var ele=options.ele||null;

		if(!ele)return;

		var left=options.left||'auto';
		var right=options.right||'auto'; 
		var top=options.top||'auto';
		var bottom=options.bottom||'auto'; 
		var boxLeft,boxRight,boxTop,boxBottom;

		boxLeft=left==='auto'?'auto':left+'px';
		boxRight=right==='auto'?'auto':right+'px';
		boxTop=top==='auto'?'auto':top+'px';
		boxBottom=bottom==='auto'?'auto':bottom+'px';

		if(test().ie6)
		{	
			ie6Follow({
				ele:ele,
				top:top,
				left:left,
				right:right,
				bottom:bottom
			});
		}
		else
		{
			css(ele,{
				left:boxLeft,
				right:boxRight,
				top:boxTop,
				bottom:boxBottom,
				position:'fixed'
			})
		}
	}

	return fix;

})