define(function(require, exports, module) {
	
	var sum = [];

	function saveData(aList, data)
	{	
		// 传入数组
		if(!aList && !data)
		{	
			if(window.console)
			{
				console.log("请传入列表对象，和缓存数据");
			}

			return;
		}

		//json
		if(Object.prototype.toString.apply(data) == '[object Object]')
		{	
			aList.each(function(i){

				$(aList[i]).data('info', data);
				
			});

		}//array
		else
		{	
			sum = sum.concat(data);
			
			aList.each(function(i){

				$(aList[i]).data('info', sum[i]);

			});
		}

		
	}

	return saveData;

});