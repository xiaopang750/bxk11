define('/static/script/lib/co/getStyle', [], function(require, exports, module) {

	function getStyle(obj,attr)
	{	
		if(obj.currentStyle)
	    {	
	        return obj.currentStyle[attr]||0;
	    }
	    else
	    {	
	        return getComputedStyle(obj,false)[attr]||0;
	    }
	}

	return getStyle;

});