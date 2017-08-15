/*
 *description:添加编辑品牌
 *author:fanwei
 *date:2014/03/27
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var ajaxForm = require('../widget/form/ajaxForm');
	var upload = require('../global/upload');
	var calendar = require('../widget/form/calendar');

	var oShopAdd = until.extend(function(){

			this.editTempId = 'brand-add';
			this.subUrl = '';
			this.oForm = $('[script-bound = form_check]');
			this.aFile = null;

			this.getBrandClassUrl = _jia178config.reqBase + 'view/brand/getclass';
			this.getEditUrl = _jia178config.reqBase + 'view/brand/edit';
			this.addUrl = _jia178config.reqBase + 'view/brand/add';

		},{

			init: function() {
				
				this.judge();

			},
			submission: function(sId, type) {

				this.aFile = $('[script-role = upload-file]');

				var result;
				var _this = this;
				var name,oNew,aCheck,oTimeStart,oTimeEnd,oUploadBrand,oUploadLogo,sUploadBrand,sUploadLogo;


				oNew = $('[sc = confirm-pass]');
				aCheck = $('input[type=checkbox]');
				oTimeStart = $('[sc=time-select]').eq(0);
				oTimeEnd = $('[sc=time-select]').eq(1);
				oUploadBrand = this.aFile.eq(0);
				oUploadLogo = this.aFile.eq(1);

				if( type=='edit' || !type ) {

					//如果是编辑或者添加则不验证品牌有效日期;
					oTimeStart.attr('ischeck', false);
					oTimeEnd.attr('ischeck', false);

				}

				var oShopAddForm = new ajaxForm({

					subUrl: this.subUrl,
					otherJude: [
						
						function() {

							//验证是否上传图片
							sUploadBrand = oUploadBrand.attr('iamgeurl');
							sUploadLogo = oUploadLogo.attr('iamgeurl');
							
							//非认证
							if( type=='edit' || !type ) {

								if ( !sUploadLogo ) {

									alert( '请上传品牌logo' );

									return false;

								} else {

									return true;

								}

							} else {

								if ( sUploadBrand && sUploadBrand ) {

									return true;

								} else {

									alert( '请上传品牌logo和品牌资质' );

									return false;

								}

							}

						},
						function() {

							//验证是否选中的多于6个
							var isChecked;
							checkedCount = 0;

							
							aCheck.each(function(i){

								isChecked = aCheck.eq(i).attr('checked');

								if ( isChecked ) {

									checkedCount ++ ;

								}
							});
							
							if ( checkedCount > 6 ) {

								alert('最多选择6个品类');

								return false;

							} else {

								return true;
							}
						},
						function() {

							//验证品牌有效期起始时间是否大于结束时间
							var nStart = parseInt( $('[sc = time-select]').eq(0).attr('time') );
							var nEnd = parseInt( $('[sc = time-select]').eq(1).attr('time') );

							if( nStart && nEnd ) {

								if( nStart > nEnd ) {

									alert("起始时间不能大于结束时间");
									return false;

								} else {

									return true;
								}

							} else {
								return true;
							}

						}	

					],
					fnSumbit: function( data ) {

						data.brand_class = data.brand_class.split(",").join("|")
						data.apply_license_file = _this.aFile.eq(0).attr('iamgeurl');
						data.apply_brand_img = _this.aFile.eq(1).attr('iamgeurl');
						data.apply_id = sId ? sId : '';
						
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

				//根据url的search参数判断提交的地址;
				var param,
					uid,
					type;

				param = this.parse();
				type = param.type;

				if( type ) {

					if( type == 'edit' ) {

						//编辑
						this.subUrl = _jia178config.reqBase + 'post/brand/edit';	

					} else if ( type == 'certified' ) {
						
						//认证
						this.subUrl = _jia178config.reqBase + 'post/brand/certified';

					}
					uid = param.aid;
					this.edit( uid, param.type );

				} else {

					//添加
					this.oForm.show();
					this.subUrl = _jia178config.reqBase + 'post/brand/add';
					this.add();

				}

			},
			add: function(){

				var _this = this;

				//添加
				this.requestUri = this.addUrl;
				this.load();
				this.suc = function( data ) {
					
					_this.data = data;
					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.render();
					_this.showCalendar();
					_this.submission();

				};

				this.fail = function( data ) {

					alert(data.msg);
					window.location = data.data;

				};

			},
			edit: function(sId, type) {

				var _this = this;

				//编辑
				this.requestUri = this.getEditUrl;
				this.param.apply_id = sId;
				this.load();
				this.suc = function( data ) {
					
					_this.data = data;
					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.render();
					_this.showCalendar();
					_this.submission(sId, type);

				}

				this.fail = function( data ) {

					alert(data.msg);
					window.location = data.data;

				};

			},
			showCalendar: function() {

				//calendar控件
				var oThisWrap,
					oThisTip,
					minDate,
					time,
					timeFormat;

				$('[sc= time-select]').calendar({
					onSetDate: function() {

						oThisWrap = $(this.inpE).parents('[script-role = check_wrap]');

						oThisTip = oThisWrap.find("[script-role = wrong_area]");

						oThisWrap.removeClass("has-error");
						oThisTip.removeClass("wrong");
						
						time = this.year + "/" + this.month + "/" + this.day;
						timeFormat = new Date(time).getTime()
						$(this.inpE).attr('time', timeFormat);
						
					}
				});	

			}

	});

	oShopAdd.init();

});