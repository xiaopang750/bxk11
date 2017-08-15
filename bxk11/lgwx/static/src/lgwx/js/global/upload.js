/*
 *description:上传公共模块
 *author:fanwei
 *date:2014/3/24
 */

/*
	上传成功后:
	返回一个imageUrl,imageName到input=file上;
	方便提交的时候去取;
*/

define(function(require, exports, module){
	
	var oForm,
		_this,
		oViewImage;

    window.jia178UploadCb = null;

	$(document).on('change', '[script-role = upload-file]', function(){
		
		_this = $(this);

		oForm = $(this).parents('[script-role = upload-form]');

		window.jia178UpLoadLoading = oForm.find('[script-role = uploadLoading]');

		jia178UpLoadLoading.show();

		oForm.submit();

		_this.attr('disabled', 'disabled');

		window.jia178callBack = function(data) {

			var err = data.err;

			if (!err) {

				window.jia178UpLoadUrl = data.data.url;

				_this.attr('iamgeName', data.data.name);

				_this.attr('iamgeUrl', data.data.url);

				oViewImage = _this.parents('[script-role = upload-form]').find('[script-role = view_image]');

				//如果有预览图片则显示
				if (oViewImage.length) {

					oViewImage.attr('src', data.data.url);

				}

				//全局的回调方法
				jia178UploadCb && jia178UploadCb( oForm, data.data.url );

			} else {

				_this.attr('iamgeName', '');

				_this.attr('iamgeUrl', '');

				alert(data.msg);

			}

			jia178UpLoadLoading.hide();

			_this.removeAttr('disabled', 'disabled');

		}

	});

});