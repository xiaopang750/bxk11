/*
 *description:幻灯片-添加-编辑
 *author:fanwei
 *date:2014/06/26
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var bodyParse = require('../widget/http/bodyParse');
	var upload = require('../global/upload');
	var Fenye = require('../widget/dom/fenye');
	var ajaxForm = require('../widget/form/ajaxForm');
	var dialog = require('../widget/dom/dialog');
	var sliderCut = require('../sub/cut/cut');
	var goodsSelect = require('../sub/goods/goods_select');
	var infoSelect = require('../sub/info/info_box');

	//初始化商品选择弹框
	var oGoodsSelect = new goodsSelect({
		confirmUrl: _jia178config.reqBase + 'view/goods/slGoConsole'
	});


	var oInfoSelect = new infoSelect({

	});

	//oInfoSelect.loadClass();


	//选择资讯弹框
	var selectBox = new dialog({
		boxSelector: $('[sc = select-box]')
	});

	//商品选择弹框
	var goodsBox = new dialog({
		boxSelector: $('[sc = goods-select-box]')
	});

	var oSliderEdidt = until.extend(function(){

			this.editTempId = 'tpl-slider';
			this.subUrl = '';
			this.first = true;
			this.goodsFirst = true;
			this.fenyeId = 'tpl-info';
			this.paramList = {num:5,it_id:'',p:1,keywords:''};
			this.infoId = '';
			this.allType = null;

			this.oForm = $('[script-bound = form_check]');
			this.oSelect = $('[sc = user-search]');
			this.oKey = $('[sc = key]');

			this.getAddData = _jia178config.reqBase + 'view/service/slide_add';
			this.getEditData = _jia178config.reqBase + 'view/service/slide_edit';
			this.getDataUrl = _jia178config.reqBase + 'view/service/slide_information';
	

		}, {

			init: function() {

				this.judge();

				this.events();

				this.showCut();

			},
			showCut: function() {

				//初始化裁切功能
				var oSliderCut = new sliderCut();
				oSliderCut.cutUrl = _jia178config.reqBase + 'upload/crop_service_pic';
				oSliderCut.init();

			},
			events: function() {

				var oTarget,
					sRole,
					_this,
					oSearchBtn,
					oConfirm,
					type,
					aType;

				_this = this;	
				oSearchBtn = $('[sc = user-btn]');
				oConfirm = $('[sc = confirm-select]');

				//选择指向类型
				$(document).on('click','[sc = select-type]', function(e){

					_this.aType.removeClass('active');
					$(this).addClass('active');

					type = $(this).attr('type');

					switch( type ) {

						case '1':
							_this.loadSelectBox();
						break;

						case '2':
							_this.loadGoodsBox();
						break;

					}

				});


				$(document).on('click','[sc = info-select]', function(e){

					_this.infoId = $(this).attr('scid');

				});

				oSearchBtn.on('click', function(){

					_this.search();

				});

				oConfirm.on('click', function(){

					_this.getSliderUrl( _this.infoId );

				});

				//商品选框确认
				oGoodsSelect.onConfirm = function(data) {

					var sUrl,
						sView,
						sImage;

					sUrl = data.data.slide_url;
					sView = data.data.slide_thumb;
					sImage = data.data.slide_pic;
					_this.showAressView(sUrl, sView, sImage, 2);
					goodsBox.close();

				};

			},
			submission: function(type, slide_id, shopId) {

				this.aFile = $('[script-role = upload-file]');
				this.aType = $('[sc = select-type]');

				var result;
				var _this = this;
				var name;
				var oPic,
					oAddress,
					sPicUrl,
					shopName;
				
				oPic = $('[sc = slider_pic]');
				oAddress = $('[sc = slider-address]');
				shopName = $('[sc = shop-name]').html();

				var oSliderAddForm = new ajaxForm({

					subUrl: this.subUrl,
					otherJude:[

						function() {

							sPicUrl = oPic.attr('iamgeurl');

							if( sPicUrl ) {

								return true;

							} else {

								alert('请上传幻灯片图片');

								return false;

							}

						}

					],
					fnSumbit: function( data ) {

						data.slide_id = slide_id ? slide_id : '';
						data.slide_pic = oPic.attr('iamgeurl');
						data.slide_type = oAddress.attr('select-type');
						data.shop_id = shopId;
						
					},
					sucDo: function(data) {

						alert(data.msg);

						window.location = data.data; 

					},
					failDo: function(data) {

						alert(data.msg);

					}

				});	

				oSliderAddForm.upload();

			},
			judge: function() {

				//判断是否编辑
				var param,
					slide_id,
					shopId;

				param = this.parse();
				shopId = param.shop_id;

				if( param.type ) {
					
					//编辑
					this.subUrl = _jia178config.reqBase + 'post/service/slide_edit';
					slide_id = param.slide_id;
					
					this.edit( slide_id, shopId );

				} else {

					//非编辑
					this.oForm.show();
					this.subUrl = _jia178config.reqBase + 'post/service/slide_add';
					this.add(shopId);

				}

			},
			add: function(shopId){


				var _this = this;

				//添加
				this.requestUri = this.getAddData;
				this.param.shop_id = shopId;
				this.load();
				this.suc = function( data ) {

					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.data = data;
					_this.render();
					_this.submission('add', '', shopId);
					_this.getAdrressView();

				};

				this.fail = function(data) {
					
					alert(data.msg);

				};

			},
			edit: function(slide_id, shopId) {

				var _this = this;

				//编辑
				this.requestUri = this.getEditData;
				this.param.slide_id = slide_id;
				this.param.shop_id = shopId;
				this.load();
				this.suc = function( data ) {

					_this.data = data;
					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.render();
					_this.submission( 'edit', slide_id, shopId );
					_this.getAdrressView();

				};

			},
			loadSelectBox: function() {

				selectBox.show();

				if( this.first ) {

					this.first = false;

					//this.loadTypeSelect();

				}

			},
			loadGoodsBox: function() {

				goodsBox.show();

				if( this.goodsFirst ) {

					this.goodsFirst = false;

					oGoodsSelect.init();
				}	

			},
			loadTypeSelect: function() {
				
				var _this;

				_this = this;
				this.requestUri = _jia178config.reqBase + 'view/service/information_type';
				this.load();

				this.suc = function(data) {

					_this.tempId = 'tpl-select';
					_this.tempWrap = _this.oSelect;
					_this.data = data;
					_this.render();
					_this.renderForm();
				};

				this.fail = function(data) {

					alert(data.msg);
				};

			},
			renderForm: function() {

				var _fenye = new Fenye(this.getDataUrl, this.fenyeId, this.paramList, null, null);

	   			this.page = _fenye;

			},
			search: function() {

				var typeId,
					nowIndex,
					nowOption,
					nowKeyWords;

				nowIndex = this.oSelect[0].selectedIndex;
				nowOption = this.oSelect.children().eq(nowIndex);
				typeId = nowOption.attr('id') || '';
				nowKeyWords = this.oKey.val();

				this.paramList.it_id = typeId;
				this.paramList.keywords = nowKeyWords;

				this.page.refresh( this.paramList );
			},
			getSliderUrl: function(id, fnSuc) {

				if( !id ) return;

				var sUrl,
					sView,
					sImage,
					_this;

				_this = this;	

				this.requestUri = _jia178config.reqBase + 'post/service/slide_information_select';
				this.param.si_id = id;
				this.load();
				this.suc = function(data) {

					sUrl = data.data.slide_url;
					sView = data.data.slide_thumb;
					sImage = data.data.slide_pic;
					_this.showAressView(sUrl, sView, sImage, 1);

					selectBox.close();
				};

				this.fail = function(data) {

					alert( data.msg );

				};

			},
			getAdrressView: function() {

				this.oSliderTile = $('[sc = slider-address]');
				this.oSliderView = $('[script-role = view_image]');
				this.oFile = $('[script-role = upload-file]');

			},
			showAressView: function(sUrl, sPic, sImage, sType) {

				//显示幻灯片指向地址
				this.oSliderTile.val( sUrl );
				this.oSliderView.attr('src', sPic);
				this.oSliderTile.attr('select-type', sType);
				this.oFile.attr('iamgeurl', sImage);

			}

	});

	oSliderEdidt.init();

});