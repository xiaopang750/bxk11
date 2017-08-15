define(function(require, exports, module) {
	
	var request = require('../../lib/http/request');

	var swfupload = require('../../lib/swf/upload');

	var upload_com = upload_com || {};

	/* 创建项目 */
	upload_com.getSelectData = function(oSelect, target, param, fnDo, callBack, sType)
	{	
		var num,
			name,
			id,
			_url;

		if(param)
		{
			request({
				url: target,
				data: param,
				sucDo: function(data)
				{	
					fnDo && fnDo(data);
				},
				noDataDo: function(data)
				{	
					upload_com.renderOption(oSelect, {data: []},'','',sType,'yes');
				}
			});
		}
		else
		{
			request({
				url: target,
				sucDo: function(data)
				{		
					fnDo && fnDo(data);
				},
				noDataDo: function()
				{	
					upload_com.renderOption(oSelect, {data: []},'','',sType,'yes');
				}
			});
		}

		oSelect.change(function(){

			num = oSelect.get(0).selectedIndex;
			name = oSelect.get(0).options[num].text;
			id = oSelect.get(0).options[num].id;
			_url = oSelect.get(0).options[num].getAttribute('url');

			if($(this).val())
			{
				callBack && callBack(name, id, _url);
			}

		});

	};

	upload_com.renderOption = function(oSelect, data, sIdName, sName, sType, ischeck)
	{	
		if(ischeck)
		{
			oSelect.html('<option value="">请选择</option>');
		}
		else
		{
			oSelect.html('');
		}

		var i,
			num,
			html,
			oCreateOption,
			url;

		num = data.length;

		for(i=0; i<num; i++)
		{	
			url = data[i].url ? data[i].url : ''; 

			var oPtions = $('<option script-role="option_list" id=' + data[i][sIdName]  + ' url='+ url +'>' + data[i][sName] + '</option>');

			/* 默认选中后台输出 */
			if(data[i].select==1)
			{
				oSelect.selectedIndex = i;
			}

			oSelect.append(oPtions);
		}

		if(sType)
		{	
			oCreateOption = $('<option script-role="create_list">'+ sType +'</option>');	

			oSelect.append(oCreateOption);
		}
	};

	upload_com.checkCreate = function(oSelect, oCreate, sShowClass, sType)
	{
		var sValue = oSelect.val();

		if(sValue == sType)
		{	
			oCreate.attr('ischeck', 'true');

			oCreate.addClass(sShowClass);

			oSelect.attr('no_upload', 'false');
		}
		else
		{	
			oCreate.attr('ischeck', 'false');

			oCreate.removeClass(sShowClass);

			oSelect.attr('no_upload', '');
		}
	};

	/* 拼接上传img数据 */
	upload_com.imageInfoFormat = function(aArea)
	{
		var i,
			num,
			aSrc,
			sValue,
			str,
			lastIndex,
			result

		num = aArea.length;	
		aSrc = [];

		for (i = 0 ; i < num ; i++)
		{	
			sValue = aArea[i].value.replace(/(\^)|(\|)+/gi, '');

			if(!sValue)sValue = " ";

			str = aArea[i].getAttribute('_src');

			lastIndex = str.lastIndexOf('/');

			str = str.substring(lastIndex+1);

			result = str+'^|^'+sValue+'|^|';

			aSrc.push(result);
		}

		return aSrc.join('');	
	};

	/* 上传的公共配置 */
	upload_com.baseConfig = {
		swf_url : '/static/swf/upload.swf',
		limitSize: '10240',
		limitType: '*.gif; *.jpg; *.png *.jpeg',
		text: '',
		oneceLimite: '6',
		buttonUrl : '/static/images/lib/global/blank.gif'
	};

	upload_com.upload = function(options)
	{	
		var temp,
			target,
			queueId,
			queueSizeLimit,
			formData,
			onerr,
			onsuc,
			onSelectErr,
			btnClass,
			width,
			height,
			btnbg,
			sRole,
			sId,
			oForm,
			oFile,
			addWay,
			max,
			start,
			beforeListen,
			text,
			arrEvent;

		temp = options.temp || '';
		target = options.target || '';
		queueId = options.queueId || '';
		queueSizeLimit = options.queueSizeLimit || 6;
		formData = options.formData || {};
		onerr = options.onerr || null;
		onsuc = options.onsuc || null;
		onable = options.onable || null;
		onEnd = options.onEnd || null;
		arrEvent = options.arrEvent || [];
		onSelectErr = options.onSelectErr || null;
		onStart = options.onStart || null;
		onClose = options.onClose || null;
		onReady = options.onReady || null;
		btnClass = options.btnClass || null;
		beforeListen = options.beforeListen || null;
		width = options.width || 0;
		height = options.height || 0;
		max = options.max || '';
		btnbg = options.btnbg || '';
		sRole = options.sRole || '';
		sId = options.sId || '';
		addWay = options.addWay || 'after';
		text = options.text || '',
		sStyle = options.sStyle || '';
		swf = options.swf || '/static/swf/upload.swf';

		oWrap = $('[script-role = '+ sRole +']');
		oForm = $('<form></form>');
		oInput = $('<input>');
		oInput.get(0).type = 'file';
		oInput.get(0).name = sId;
		oInput.get(0).id = sId;
		oInput.get(0).multiple = 'true';
		oInput.css({visibility: 'hidden'});

		oForm.append(oInput);
		oWrap.append(oForm);

			oInput.uploadify({
				'swf'      : swf,
				'uploader' : target,
				'fileSizeLimit' : '10240',
				'fileTypeExts' : '*.gif; *.jpg; *.png; *.jpeg',
				'buttonText': text,
				'queueSizeLimit': queueSizeLimit,
				'button_image_url' : '/static/images/lib/global/blank.gif',
				'itemTemplate' : temp,
				'queueID': queueId,
				'formData' : formData,
				'buttonClass' : btnClass,
				'width' : width,
				'height' : height,
				'addWay' : addWay,
				'uploadLimit': max,
				'removeTimeout': 1000,
				'onEnable': function()
				{
					onable && onable();
				},
				'onDialogClose': function()
				{
					onClose && onClose();
				},
				'onUploadStart': function()
				{
					onStart && onStart();
				},
				'onDialogOpen': function()
				{
					beforeListen && beforeListen();
				},
				'onSelectError': function()
				{
					onSelectErr && onSelectErr();
				},
				'onUploadSuccess': function(file,data)
				{	
					onsuc && onsuc(file,data);
				},
				'onUploadError': function()
				{
					onerr && onerr();
				},
				'onSWFReady' : function()
				{
					onReady && onReady();
				},
				'onQueueComplete': function()
				{
					onEnd && onEnd();
				}/*,
				'debug': 'true'*/
			});

			if(sStyle)
			{
				$('.' + btnClass).get(0).style.cssText = sStyle;	
			}
			else
			{	
				$('.' + btnClass).css({
					background: btnbg,
					width: width,
					height : height,
					overflow: 'hidden'
				});
			}

	}


	module.exports = upload_com;

});
