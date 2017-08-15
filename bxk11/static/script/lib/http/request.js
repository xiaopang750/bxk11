define(function(require, exports, module) {
	
	var noLogin = require('../../lib/global/noLogin');

	function request(options)
	{	
		var url,
			data,
			async,
			noDataDo,
			sucDo,
			failDo,
			beforeDo,
			unLoginDo,
			otherStatus,
			callData;

		url = options.url || null;

		_data = options.data || '';

		async = options.async || 'true';

		noDataDo = options.noDataDo || null;

		sucDo = options.sucDo || null;

		failDo = options.failDo || null;

		unLoginDo = options.unLoginDo || null;

		beforeDo = options.beforeDo || null;

		otherStatus = options.otherStatus || null;

		if(!url)
		{
			if(window.console)
			{
				console.log("请传入请求地址");
			}

			return;
		}

		if(async == 'true')
		{	
			var bguo = $.ajax({

				url: url,

				data: _data,

				type: 'post',

				async: eval(async),

				dataType: 'json',

				beforeSend: function()
				{
					beforeDo && beforeDo();
				},
				success: function(data)
				{	
					//debug(_data, data, url);

					successDo(url, data, sucDo, noDataDo, unLoginDo, otherStatus);
				},
				error: function(data)
				{	
					fail(url, data.responseText);

					failDo && failDo();
				}

			});
		}
		else
		{	
			var callBack = $.ajax({

				url: url, 

				data: _data, 

				type:'post',

				async: eval(async), 

				dataType: 'json',

				success:function(data)
				{	
					//debug(_data, data, url);

					successDo(url, data, sucDo, noDataDo, unLoginDo, otherStatus);
				},
				error:function()
				{
				 	fail(url, data.responseText);
				 	failDo && failDo();
				}	
			});

			callData = eval('(' + callBack.responseText + ')');
		}

		return callData;
	}

	function successDo(url, data, suc, noData, unLogin, otherStatus)
	{	
		if(!checkData(data, url))
		{	
			return;
		}

		if(data.err == 0)
		{	//成功

			suc && suc(data);
		}
		else if(data.err == 1)
		{	
			//无数据;
			noData && noData(data.msg);
			
			return;
		}
		else if(data.err == 2)
		{	noLogin();
			//未登录
			unLogin && unLogin(data); 
		}

		// 其他状态
		if(otherStatus)
		{
			for (var i in otherStatus)
			{
				if(i == data.err)
				{
					otherStatus[i](data);
				}
			}
		}
	}

	function debug(param, data, url)
	{	
		if(window.console)
		{
			var str = '';

			for (var i in param)
			{
				str += i + '   :   ' + param[i] + '\n';
			}

			str = '接口'+ url + '\n' +'post:参数' + '\n' + str + '\n' + '\n' + '后台返回数据:' + '\n'

			console.log('%c'+str," text-shadow: 0 1px 0 #ccc,0 2px 0 #c9c9c9,0 3px 0 #bbb,0 4px 0 #b9b9b9,0 5px 0 #aaa,0 6px 1px rgba(0,0,0,.1),0 0 5px rgba(0,0,0,.1),0 1px 3px rgba(0,0,0,.3),0 3px 5px rgba(0,0,0,.2),0 5px 10px rgba(0,0,0,.25),0 10px 10px rgba(0,0,0,.2),0 20px 20px rgba(0,0,0,.15);font-size:14px;color:#f00;");

			console.log(data);

			console.log('=====================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================');

		}
	}

	function fail(url, detail)
	{	
		if(window.console)
		{
			console.log('接口     ' + url + '    接口报错');

			console.log(detail);
		}
	}

	function toDouble(num)
	{
		num=num<10?'0'+num:num;

		return num;
	} 

	function checkData(data, url)
	{	
		var date,
			hour,
			minutes,
			seconds,
			time,
			msg;

		date = new Date();

		hour = date.getHours();

		minutes = date.getMinutes();

		seconds = date.getSeconds();

		time = toDouble(hour) + ':' +toDouble(minutes) + ':' + toDouble(seconds); 

		msg='<< ' + time + ' 接口: ' + url + ' 返回的数据格式不正确 或 后台文件报错';

		if(Object.prototype.toString.apply(data) !== '[object Object]')
		{	
			if(window.console && window.JSON.stringify)
			{
				console.log(msg + '\n' + JSON.stringify(data));
			}

			return false;
		}
		else
		{
			return true;
		}
	}

	return request;

});