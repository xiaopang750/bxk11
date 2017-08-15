/*
 *description:bodyParse
 *author:fanwei
 *date:2013/10/04
 */
define(function(require, exports, module) {
	
	function bodyParse()
	{	
		var str,
			arr,
			newArr,
			num,
			num2,
			i,
			j,
			newJson;

		if(window.location.search)
		{
			str = decodeURIComponent(window.location.search.split('?')[1]);

			arr = str.split('&');

			num = arr.length;

			newJson = {};

			for (i=0; i<num; i++)
			{	
				newArr = arr[i].split('=');

				num2 = newArr.length;

				newJson[newArr[0]] = newArr[1];
			}

			return newJson;
		}
		else
		{
			return null;
		}

	}

	return bodyParse;

});