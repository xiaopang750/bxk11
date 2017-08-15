define('/static/script/collect/collect', [ 
	'/static/script/lib/selector/selector',
	'/static/script/lib/http/request'
	
	], function(require, exports, module) {
  	

	var $=require('/static/script/lib/selector/selector');
	var request=require('/static/script/lib/http/request');

	var getDataUrl='/index.php/life/life_collect_exec';

	var oBtn=$('#confirm')[0];
	var oImageName=$('#imageName')[0];
	var oImageDec=$('#imageDec')[0];

	oBtn.onclick=function()
	{	
		if(!oImageDec.value)return;

		var newJson={};

		newJson.name=oImageName.value;

		newJson.imgdesc=oImageDec.value;

		request(getDataUrl,function(data){

			var status=parseInt(data.info)

			if(status)
			{	
				alert('发布成功');

				window.close();
			}
			else
			{
				alert('发布失败');
				window.close();
			}

		},newJson)
	}

	
});