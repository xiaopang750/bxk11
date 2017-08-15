define('/static/script/lib/co/getByClass', [], function(require, exports, module) {

	function getByClass(oParent,sClass)
	{
	    var aResult=[];

	    var aEle=oParent.getElementsByTagName("*");

	    var re=new RegExp('\\b'+sClass+'\\b');

	    for (var i=0;i<aEle.length;i++)
	    {
	        if(re.test(aEle[i].className))
	        {
	            aResult.push(aEle[i]);
	        }
	    }
	    return aResult;
	}

	return getByClass;

});