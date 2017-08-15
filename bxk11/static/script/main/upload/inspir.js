define(function(require, exports, module) {
	
	var inspir_detail = require('../../sub/upload/inspir_detail');

	var formcheck = require('../../lib/plugin/form/formCheck');

	var com = require('../../sub/upload/upload_com');

	/* 获取灵感辑 */
	var oSelect,
		url,
		oCreate;

	oSelect = $('select[form_check = sys]');
	url = '/index.php/view/album/albumlist';
	oCreate = $('[script-role = create_inspir]');

	//inspir_detail.checkCreate(oSelect, oCreate, 'show');

	com.getSelectData(oSelect, url, null, function(data){

		com.renderOption(oSelect, data.data, 'album_id', 'album_name', '创建项目灵感辑', 'check');

	}, function(name, id){

		com.checkCreate(oSelect, oCreate, 'show', '创建项目灵感辑');

	}, '创建项目灵感辑');


	/* swf上传 */
	inspir_detail.swfuploadStart();

	/* 验证加提交 */
	var oFormcheck = new formcheck({
		subUrl: '/index.php/post/design_add_exec',
		otherCheck: inspir_detail.othercheck,
		btnName: 'upload_confirm_btn',
		boundName: 'inspir_check',
		fnSumbit: function(data)
		{	
			inspir_detail.concatTagImageData(data);
		},
		sucDo: function(data)
		{
			inspir_detail.uploadSuc(data);
		},
		failDo: inspir_detail.uploadFail
	});

	oFormcheck.check();

});
