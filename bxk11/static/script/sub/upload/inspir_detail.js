define(function(require, exports, module) {
	
	var global = require('../../lib/global/global');

	var com = require('./upload_com');

	var tag = require('../../fnc/tag.js');

	var oTag = new tag({});

	var oUl = $('#upload_list');

	oTag.init();

	oTag.onchange = function()
	{	
		$('[script-role = upload_tag_area]').find('[script-role = wrong_area]').removeClass('wrong');
	};

	/* nav */
	(function(){

		var type,
			aNav,
			activeClass;

		type = $('[script-role = upload_type]').attr('upload_type');
		
		aNav = $('[script-role = upload_nav_list]');

		activeClass = 'actb';

		aNav.each(function(i){

			if(aNav.eq(i).attr('list-type') == type)
			{
				aNav.eq(i).addClass(activeClass);

				aNav.eq(i).find('[script-role = upload_nav_list_logo]').addClass(activeClass);
			}

		});	

	})();

	/* handles */
	var inspir = inspir || {};

	/* 上传后生成的图片容器模板 */
	var str = 
	'<li class="clearfix" script-role="view_list">'+
		'<div class="img_view fl ml_12 inline">'+
		   '<img src="/static/images/lib/global/blank.gif" width="60" height="60"  script-role="holder">'+
		'</div>'+
		'<div class="status ml_10 mt_6 mr_10 fl inline">'+
		  '<img src="/static/images/lib/loading/pic_loading.gif" script-role="status">'+
		'</div>'+
		'<textarea type="text" class="area_type fl" script-role="upload_text"></textarea>'+
		'<a class="close_btn button178" href="javascript:;" onfocus="this.blur()" script-role="close_btn">关闭</a>'+
	'</li>';

	var count = 0;

	/* 获取标签数据的数组 */
	inspir.getTagData = function()
	{
		return oTag.getData();
	}

	/* 图片和标签的验证 */
	inspir.othercheck = 
	{	
		'imgname' : [
			function()
			{	
				if(!oUl.find('[script-role = upload_text]').not(':disabled').length)
				{	
					return false;
				}
				else
				{	
					return true;
				}

			},
			function()
			{
				return true;
			}

		],
		'tag_namelist' : [

			function()
			{	
				var data = oTag.getData();

				if(!data.length)
				{
					return false;
				}
				else
				{
					return true;
				}
			},
			function()
			{
				return true;
			}
		]
	};

	/* 合并提交标签和图片的数据 */
	inspir.concatTagImageData = function(data)
	{
		data.tag_namelist = oTag.getData().join(',');

		data.imgname = com.imageInfoFormat(oUl.find('[script-role = upload_text]').not(':disabled'));
	};

	/* 上传成功 */
	inspir.uploadSuc = function(data)
	{	
		alert('提交成功');

		window.location = data.data;
	};

	/* 上传失败 */
	inspir.uploadFail = function()
	{
		alert('提交失败');
	};

	/* 删除图片 */
	inspir.removeImage = function()
	{
		oUl.on('click', function(e){

			var oTarget = $(e.target);

			if(oTarget.attr('script-role') == 'close_btn')
			{
				oTarget.parents('[script-role = view_list]').remove();

				if(!oUl.children().length)
				{
					oUl.hide();
				}
			}

		});
	};

	/* 获取下拉框数据 */
	inspir.getSelectData = function(oSelect, target, param, fnDo, callBack)
	{	
		com.getSelectData(oSelect, target, param, fnDo, callBack);
	};

	inspir.renderOption = function(oSelect, data, sIdName, sName, sType, ischeck)
	{
		com.renderOption(oSelect, data, sIdName, sName, sType, ischeck);
	};

	inspir.checkCreate = function(oSelect, oCreate, sShowClass)
	{
		com.checkCreate(oSelect, oCreate, sShowClass);
	};

	/* flash上传配置 */
	inspir.baseConfig = {
		srightBgStr: '/static/images/lib/global/right.jpg',
		wrongBgStr: '/static/images/lib/global/wrong.jpg'
	};

	/* flash上传事件 */
	inspir.baseHandler = {

		onSelectError : function()
		{
			alert('一次只能上传6张图片');
		},
		onUploadSuccess : function(file,data)
		{
			var oImage,
				oLoading,
				oArea,
				aList;

			aList = oUl.children('[script-role = view_list]');
			oImage = aList.eq(count).find('[script-role = holder]');
			oLoading = aList.eq(count).find('[script-role = status]');
			oArea = aList.eq(count).find('[script-role = upload_text]');

			oUl.show();
			
			$('[script-role = upload_pic_area]').find('[script-role = wrong_area]').removeClass('wrong');

			if(data.indexOf('default') != -1)
			{	
				oLoading.attr('src', inspir.baseConfig.wrongBgStr);

				oArea.attr('disabled', 'disabled');
			}
			else
			{
				oLoading.attr('src', inspir.baseConfig.srightBgStr);

				oArea.attr('_src', data);
			}

			if(!aList.length)
			{
				oUl.hide();
			}

			oImage.attr('src', data);

			count ++;	
		},
		onUploadError : function()
		{
					
		}
	}



	/* 上传start */
	inspir.swfuploadStart = function()
	{	
		com.upload({
			sRole: 'inspir_upload',
			sId: 'inspir_upload',
			temp: str.replace(/\n+/gi, ''),
			width: 106,
			height: 30,
			btnClass: 'inspir',
			formData: {uid: $CONFIG["uid"]},
			btnbg: 'url("/static/images/lib/button/button.png") no-repeat -205px -260px',
			target: '/index.php/upload/index',
			queueId: 'upload_list',
			onSelectErr: inspir.baseHandler.onSelectError,
			onsuc: function(file, data)
			{	
				inspir.baseHandler.onUploadSuccess(file, data);
			}
		});
	};

	inspir.removeImage();

	module.exports = inspir;

});