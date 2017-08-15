define(function(require, exports, module) {
	
	function scrollLoad(oWrap, fnDo)
	{	
		var windowHeight,
			scrollTop,
			docHeight;

		$(window).scroll(function(){
				
			windowHeight = document.documentElement.clientHeight;
			scrollTop = document.documentElement.scrollTop||document.body.scrollTop;
			docHeight = Math.max(document.documentElement.clientHeight,document.documentElement.scrollHeight);

			if(windowHeight + scrollTop >= docHeight && oWrap.scrollBtn)
			{	
				fnDo && fnDo();	
			}
		});
	}

	return scrollLoad;

});