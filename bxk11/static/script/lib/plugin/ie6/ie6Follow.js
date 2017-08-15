define('/static/script/lib/plugin/ie6/ie6Follow', [
	'/static/script/lib/css/css',
	'/static/script/lib/css/getInfo',
	'/static/script/lib/css/windowInfo',
	'/static/script/lib/event/resize',
	'/static/script/lib/event/scroll'
	], function(require, exports, module) {

	var css=require('/static/script/lib/css/css');
	var getInfo=require('/static/script/lib/css/getInfo');
	var windowInfo=require('/static/script/lib/css/windowInfo');
	var resize=require('/static/script/lib/event/resize');
	var scroll=require('/static/script/lib/event/scroll');

	function ie6Follow(options)
	{	
		var options=options||{};

		var ele=options.ele||null;

		if(!ele)return;

		var left=options.left||'auto';

		var right=options.right||'auto';

		var top=options.top||'auto';

		var bottom=options.bottom||'auto';

		var boxHeight=0;

		var scrollTop,windowHeight,boxLeft,boxRight,boxTop,boxBottom,changeTop;

		getSize();

		getPosition();

		function getSize()
		{	
		 	boxHeight=getInfo(options.ele).outerHeight;
		}

		function getPosition()
		{	
			scrollTop=windowInfo().scrollTop;
			windowHeight=windowInfo().height;

			boxLeft=left==='auto'?'auto':left+'px';
			boxRight=right==='auto'?'auto':right+'px';
			boxTop=top==='auto'?'auto':top+'px';
			boxBottom=bottom==='auto'?'auto':bottom+'px';
			
			changeTop=top!=='auto'?(parseInt(options.top)+scrollTop+'px'):windowHeight-(parseInt(options.bottom)+boxHeight)+scrollTop+'px';
			
			setStyle(boxLeft,boxRight,changeTop,boxBottom);
		}

		function setStyle(left,right,top,bottom)
		{	
			css(ele,{
				position:'absolute',
				left:left,
				right:right,
				top:top,
				bottom:'auto'
			});
		}

		scroll([window],function(){
			getPosition();
		})

		resize([window],function(){
			getPosition();
		})
		
	}	

	return ie6Follow;

});