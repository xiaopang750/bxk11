/*
 *description:添加系列-编辑
 *author:fanwei
 *date:2014/04/09
 */
define(function(require, exports, module){

	var global = require('../global/global');
	var until = require('../lib/until/until');
	var ajaxForm = require('../widget/form/ajaxForm');
	var upload = require('../global/upload');
	var seriesCut = require('../sub/cut/cut');

	var oSeriesCut = new seriesCut();
	oSeriesCut.cutUrl = '/lgwx/index.php/upload/crop_service_pic';
	oSeriesCut.init();

	var oSeries = until.extend(function(){

			this.editTempId = 'series-add';
			this.subUrl = '';
			this.oForm = $('[script-bound = form_check]');
			this.aFile = null;
			this.getAddData = '/lgwx/index.php/view/series/add';
			this.getEditData = '/lgwx/index.php/view/series/edit';
			this.oLocation = $('[sc = location]');


		}, {


			init: function() {
				
				this.judge();

			},
			submission: function(type, sId) {

				this.aFile = $('[script-role = upload-file]');

				var result;
				var _this = this;
				var name;
				
				var oShopAddForm = new ajaxForm({

					subUrl: this.subUrl,
					otherJude: [

						function() {

							result = true;

							_this.aFile.each(function(i){

								name = _this.aFile.eq(i).attr('iamgeurl');

								if ( !name ) {

									result = false;

								}

							});

							if ( result ) {

								return true;

							} else {

								alert('请上传系列缩略图片');

								return false;

							}

						}	

					],
					fnSumbit: function( data ) {

						data.series_img = _this.aFile.eq(0).attr('iamgeurl');
						//data.series_class = data.series_class.split(',').join('|');

						if ( type == 'add' ) {

							data.brand_id = sId ? sId : '';

						} else if ( type == 'edit' ) {

							data.series_id = sId ? sId : '';

						}

					},
					sucDo: function(data) {

						alert(data.msg);
	
						window.location = data.data;

					},
					failDo: function(data) {

						alert(data.msg);

					}

				});	

				oShopAddForm.upload();

			},
			judge: function() {

				//判断是否编辑
				var param,
					brandId,
					seriesId;

				param = this.parse();

				if( param.type ) {

					//编辑
					this.subUrl = '/lgwx/index.php/post/series/edit';
					seriesId = param.seriesid;
					this.edit( seriesId );

				} else {

					//非编辑
					this.oForm.show();
					brandId = param.brandid;
					this.subUrl = '/lgwx/index.php/post/series/add';
					this.add( brandId );

				}

			},
			add: function( brandId ){

				var _this = this;

				//添加
				this.requestUri = this.getAddData;
				this.param.brand_id = brandId;
				this.load();
				this.suc = function( data ) {

					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.data = data;
					_this.render();
					_this.submission( 'add', brandId );

				};

				this.fail = function(data) {
					
					alert(data.msg);

				};

			},
			edit: function(seriesId) {

				this.oLocation.html('编辑系列');

				var _this = this;

				//编辑
				this.requestUri = this.getEditData;
				this.param.series_id = seriesId;
				this.load();
				this.suc = function( data ) {

					_this.data = data;
					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.render();
					_this.submission( 'edit', seriesId );

				}

			}

	});	


	oSeries.init();

});