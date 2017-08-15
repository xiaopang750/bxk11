define('/static/script/lib/json/jsonToStr', [], function(require, exports, module) {

	function jsonToStr(json)
	{	
		var arr = [];
	    var str = "";

	    if(Object.prototype.toString.apply(json)=='[object Array]')
	    {	
	    	var num=json.length;

	    	for (var i=0;i<num;i++)
	    	{
	    		arr.push(jsonToStr(json[i]));

	    		str='['+arr.join(',')+']';
	    	}
	    }

	    if(Object.prototype.toString.apply(json)==='[object Date]')
	    {
	    	str="new Date("+json.getTime()+")";
	    }

	    if(Object.prototype.toString.apply(json)==='[object Function]'||Object.prototype.toString.apply(json)==='[object RegExp]')
	    {
	    	str=json.toString();
	    }

	    if(Object.prototype.toString.apply(json)==='[object Number]')
	    {
	    	str=json;
	    }

	    if(Object.prototype.toString.apply(json)==='[object String]')
	    {
	    	str='"'+json+'"';
	    }

		if(Object.prototype.toString.apply(json)==='[object Object]')
		{		
			for (var i in json) 
			{
				if(typeof (json[i]) === 'string')
				{
					json[i]='"' + json[i] + '"';
				}
				else
				{
					if(typeof (json[i]) === 'object')
					{	
						json[i]=jsonToStr(json[i]);
					}
					else
					{	 
						json[i]=json[i];
					}
				}

		        arr.push(i + ':' + json[i]);
		    }

	        str = '{' + arr.join(',') + '}';
		}

		return str;
	}

	return jsonToStr;

});