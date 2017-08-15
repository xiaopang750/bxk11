define('/static/script/lib/co/getIndex', [], function(require, exports, module) {

	function getIndex(obj)
	{	
		var oParent=obj.parentNode;

		var aChildren=oParent.children;

		var num=aChildren.length;

		for (var i=0;i<num;i++)
		{
			if(aChildren[i]===obj)
			{
				return i;
			}
		}

		return -1;
	}

	return getIndex;

});