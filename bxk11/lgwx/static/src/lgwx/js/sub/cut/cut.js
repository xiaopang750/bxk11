/*
 *description:整站图片裁切
 *author:fanwei
 *date:2014/06/23
 */
define(function(require, exports, module){
	
	var updateImage = require('../../widget/dom/update');
	var cutImage=require('../../widget/dom/cut');
	var dialog = require('../../widget/dom/dialog');
	var rnd = require('../../widget/tool/rnd');
	require('../../../css/widget/cutbox/cutbox.css');

	var oCutBox = new dialog({
		boxSelector: $('[script-role = cut_box]')
	});

	function CutImage(options) {

		options = options || {};
		this.oView = $('[script-role = right_view]').get(0);
		this.oCutArea = $('[script-role = box_type_view]');
		this.oCutWrap = $('[script-role = cutWrap]').get(0);
		this.imgTemp = '<img src="" alt="" / script-role="cut_image">';
		this.oSave = $('[script-role = save_arrange]').get(0);
		this.oRotate = $('[script-role = rotate_btn]');
		this.cutUrl = 'aaa.php';
		this.oNormalClose = $('[script-role = cut_box_close]');
		this.oAddBtn = $('[script-role = type_add_btn]');
		this.oNowView = null;
		this.oNowInput = null;
		this.nCutAreaWidth = 370;
		this.nCutAreaHeight = 370;
		this.scaleWidth = 30;
		this.scaleHeight = 20;
		this.param = {};
		this.onconfirm = options.onconfirm || null;
	}	

	CutImage.prototype = {

		init: function()
		{	
			this.uploadImage();
		},
		uploadImage: function() {	
			
			var _this = this;

			jia178UploadCb = function(oForm, url) {

				_this.oNowView = oForm.find('[script-role = view_image]');
				_this.oNowInput = oForm.find('[script-role = upload-file]');
				_this.oForm = oForm;

				oCutBox.show();	

				_this.update(url, function(data){

					_this.saveData(data[0]);

					_this.cut(data);

				});
					
			};

			oCutBox.onClosed = function() {

				_this.cutInit();

			};

		},
		update: function(src, callBack) {

			var oCutImage,
				oImage,
				_this,
				oImage;

			oImage = new Image();	
			_this = this;
			this.cutInit();
			src = this.rndSrc(src);

			oImage.onload = function() {

				oCutImage = $('[script-role = cut_image]');

				oCutImage.attr('src', src);

				updateImage({
			        aEle:oCutImage,
			        wrapWidth:_this.nCutAreaWidth,
			        wrapHeight:_this.nCutAreaHeight
		         	},function(data){
	            	
		         	callBack && callBack(data);

	        	});
			};

			oImage.src = src;
		},
		cut: function(data) {

			var _this = this;
			var param;
			param = {};

			cutImage({
				oWrap: this.oCutWrap,
	            oImage:$('[script-role = cut_image]').get(0),
	            oView:this.oView,
	            oSubmintBtn:this.oSave,
	            width:data[0].width,
	            height:data[0].height,
	            oldWidth:data[0].oldWidth,
	            oldHeight:data[0].oldHeight,
	            left:data[0].left,
	            top:data[0].top,
	            scaleWidth: this.scaleWidth,
	            scaleHeight: this.scaleHeight,
	            fnDo:function(info) {

	            	param.x = info.x;
	            	param.y = info.y;
	            	param.cutwidth = info.cutwidth;
	            	param.cutheight = info.cutheight;
	            	param.source = info.tmpimg;

	            	$.post(_this.cutUrl, param, function(data){

	            		if( !data.err ) {

	            			_this.cutInit();
	            			oCutBox.close();

	            			_this.oNowView.attr('src', data.data +'?'+ rnd(9999,1));
	            			_this.oNowInput.attr('iamgeurl', data.data);
	            			_this.oNowInput.attr('iamgename', data.data);
	            			_this.onconfirm && _this.onconfirm(_this.oForm, data.data);

	            		} else {

	            			alert(data.msg);
	            		}

	            	}, 'json');
	            		
	            }

	        });
		},
		cutInit: function() {

			this.oCutArea.html(this.imgTemp);	
			if($('#cover_added'))$('#cover_added').remove();
			if($('#shadow_added'))$('#shadow_added').remove();
			$(this.oView).html('');
		},
		rndSrc: function(src) {

			src = src + '?' + new Date().getTime();

			return src;
		},
		saveData: function(data) {

			$(this.oSave).attr('img_width', data.oldWidth);
			$(this.oSave).attr('img_height', data.oldHeight);
		}

	};

	module.exports = CutImage;

});