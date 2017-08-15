define('/static/script/lib/co/isChild', [], function(require, exports, module) {

	function isChild(oParent,obj)
	{
		while(obj)
		{
			if(oParent===obj)
			{	
				return true;
			}

			obj=obj.parentNode;
		}

		return false;
	}

	return isChild;

});