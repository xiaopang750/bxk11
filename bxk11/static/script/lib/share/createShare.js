define(function(require, exports, module) {

	function createShare(oWrap,content,src)
	{	
		if(!window.bdshare)
		{	
			var oDiv=document.createElement('div');
			var oScript1=document.createElement('script');
			var oScript2=document.createElement('script');

			oDiv.id='bdshare';

			oDiv.style.display='block';

			oDiv.className='bdshare_t bds_tools get-codes-bdshare';

			oDiv.innerHTML=
				'<a class="bds_qzone"></a>'+
				'<a class="bds_tsina"></a>'+
				'<a class="bds_tqq"></a>'+
				'<a class="bds_renren"></a>'+
				'<span class="bds_more"></span>';

			oScript1.id='bdshare_js';
			oScript1.setAttribute('data','type=tools&amp;uid=0');	
			oScript2.id='bdshell_js';

			oWrap.appendChild(oDiv);
			document.body.appendChild(oScript1);
			document.body.appendChild(oScript2);

			window.bdshare=true;
		}
		else
		{	
			var oDiv=document.getElementById('bdshare');

			oWrap.appendChild(oDiv);

		}

		if(!src)
		{
			window.bds_config = {
				'bdText':content
			};
		}
		else
		{
			window.bds_config = {
				'bdText':content,
				'bdPic':src
			};
		}

		var oFan=document.getElementById("bdshare_js");

		var oBguo=oFan.nextElementSibling || oFan.nextSibling;

		var randomCode=parseInt(Math.random()*Math.ceil(new Date()/3600000));
		
		oBguo.src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" +randomCode ;

	}

	return createShare;

});