define(function(require, exports, module) {
	
	function loadImage(dataImage, sucDo, beforeDo)
	{
		var i,
			num,
			count;

		num = dataImage.length;

		count = 0;

		beforeDo && beforeDo();

		for(i=0 ; i<num; i++)
		{
			var oImage = new Image();

			oImage.onload = function()
			{
				count ++;

				if(count == num)
				{
					sucDo && sucDo();
				}
			};

			oImage.onerror = function()
			{
				count ++;

				if(count == num)
				{
					sucDo && sucDo(num);
				}
			};

			oImage.src = dataImage[i];
		}
	}

	return loadImage;

});