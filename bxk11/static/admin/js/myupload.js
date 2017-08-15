function upload(options)
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
			start;

		temp = options.temp || '';
		target = options.target || '';
		queueId = options.queueId || '';
		queueSizeLimit = options.queueSizeLimit || 6;
		formData = options.formData || {};
		onerr = options.onerr || null;
		onsuc = options.onsuc || null;
		onSelectErr = options.onSelectErr || null;
		onStart = options.onStart || function(){};
		btnClass = options.btnClass || null;
		width = options.width || 0;
		height = options.height || 0;
		max = options.max || '';
		btnbg = options.btnbg || '';
		sRole = options.sRole || '';
		sId = options.sId || '';
		addWay = options.addWay || 'after';

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
				'swf'      : '/static/swf/upload.swf',
				'uploader' : target,
				'fileSizeLimit' : '10240',
				'fileTypeExts' : '*.gif; *.jpg; *.png *.jpeg',
				'buttonText': '',
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
				'onUploadStart': onStart,
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
				}
				//'debug': 'true'
			});

			$('.' + btnClass).css({
				background: btnbg,
				width: width,
				height : height,
				overflow: 'hidden'
			});

	}