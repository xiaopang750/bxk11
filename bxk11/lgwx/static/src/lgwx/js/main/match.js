/*
 *description:商品搭配
 *author:fanwei
 *date:2014/06/16
 */
define(function(require, exports, module){

	var global = require('../global/global');
	var until = require('../lib/until/until');
	var ajaxForm = require('../widget/form/ajaxForm');
	var upload = require('../global/upload');
	var Fenye = require('../widget/dom/fenye');
	var bodyParse = require('../widget/http/bodyParse');
	var Related = require('../widget/dom/related');
	var matchCut = require('../sub/cut/cut');
	var goodsSelect = require('../sub/goods/goods_select');
	var dialog = require('../widget/dom/dialog');

	var oMatchCut = new matchCut();
	oMatchCut.cutUrl = '/lgwx/index.php/upload/crop_service_pic';
	oMatchCut.init();

	var oGoodsSelect = new goodsSelect({
		confirmUrl: '/lgwx/index.php/view/goods/seGoConsole'
	});

	//商品选择弹框
	var goodsBox = new dialog({
		boxSelector: $('[sc = goods-select-box]')
	});


	var oSeries = until.extend(function(){

			this.editTempId = 'info';
			this.goodsTplId = 'goods-list';
			this.subUrl = '';
			this.oForm = $('[sc = data-wrap]');
			this.getAddData = '/lgwx/index.php/view/goods/matchadd';
			this.getEditData = '/lgwx/index.php/view/goods/matchedit';
			this.gid = bodyParse().gm_id;
			this.first = true;
			this.oListWrap = null;
			this.oPrice = null;


		}, {


			init: function() {
				
				this.judge();
				this.events();
			},
			events: function() {

				var _this = this;

				//click添加按钮
				$(document).on('click', '[sc = match-add]', function(){

					_this.showBox();

				});

				//选择商品
				oGoodsSelect.onConfirm = function(data) {

					_this.renderGoodsList(_this.oListWrap, data);
					_this.oPrice.html(data.data.countPrice);
					goodsBox.close();

				};

				//删除商品
				$(document).on('click', '[sc = goods-remove]', function(){

					_this.removeGoods($(this));

				});


				//弹框显示
				goodsBox.onStart = function() {
					oGoodsSelect.matchSelect( oGoodsSelect.save );	
				};

				//弹框关闭时
				goodsBox.onClosed = function() {
					oGoodsSelect.cancel();
				};
			},
			showBox: function() {

				goodsBox.show();

				if( this.first ) {

					this.first = false;

					oGoodsSelect.init();

				}

			},
			removeGoods: function(oThis) {

				var gid,
					price,
					oParent,
					orgPricem,
					nowPrice;

				gid = oThis.attr('gid');
				price = parseInt( oThis.attr('price') );
				oParent = oThis.parents('[sc = goods-item]');

				orgPrice = parseInt( this.oPrice.html() );
				nowPrice = orgPrice - price;

				oGoodsSelect.removeId(gid);
				oParent.remove();
				this.oPrice.html(nowPrice);

			},
			renderGoodsList: function(tplWrap, data) {

				this.tempWrap = tplWrap;
				this.tempId = this.goodsTplId;
				this.data = data;
				tplWrap.html('');
				this.render();

			},
			judge: function() {

				//判断是否编辑
				var param,
					brandId,
					seriesId;

				param = this.parse();

				if( param.type ) {

					//编辑
					this.subUrl = '/lgwx/index.php/post/goods/matchedit';
					gid = param.gm_id;
					this.edit( gid );

				} else {

					//非编辑
					this.oForm.show();
					this.subUrl = '/lgwx/index.php/post/goods/matchadd';
					this.add();

				}

			},
			submission: function(type, gid) {

				var sImage,
					sGoodsId,
					aList,
					numGoods,
					_this,
					nowPrice;


				this.aFile = $('[script-role = upload-file]');
				this.oPrice = $('[sc = org-price]');
				nowPrice = $('[name = gm_price]');
				this.oListWrap = $('[sc = goods-list-show-wrap]');
				_this = this;

				var oMatchForm = new ajaxForm({
					subUrl: this.subUrl,
					otherJude:[

						function() {
							sImage = _this.aFile.eq(0).attr('iamgeurl');
							if(sImage) {
								return true;
							} else {
								alert('请上传套餐封面图');
								return false;
							}
						},
						function() {

							aList = $('[sc = goods-item]');
							numGoods = aList.length;
							if( numGoods < 2  ) {
								alert('请至少添加2种商品搭配');
								return false;
							}else {
								return true;
							}
						},
						function() {

							var sOrgPrice,
								sNowPrice;

							sOrgPrice = parseFloat(_this.oPrice.html());
							sNowPrice = parseFloat(nowPrice.val());

							if( sNowPrice < sOrgPrice ) {
								return true;
							} else {
								alert('套餐价格不能大于原价');
								return false;
							}

						}

					],
					fnSumbit: function( data ) {

						if( type == 'edit' ) {
							data.gm_id = gid;
						}
						data.gm_pic = _this.aFile.eq(0).attr('iamgeurl')
						data.gm_list = oGoodsSelect.save.join(',');
						
					},
					sucDo: function(data) {

						alert(data.msg);

						window.location = data.data;

					},
					failDo: function(data) {

						alert(data.msg);

					}

				});	

				oMatchForm.upload();

			},
			add: function( ){

				var _this = this;

				//添加
				this.requestUri = this.getAddData;
				this.param = this._param;
				this.load();
				this.suc = function( data ) {

					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.data = data;
					_this.render();
					_this.submission( 'add', '');

				};

				this.fail = function(data) {
					
					alert(data.msg);

				};

			},
			edit: function(gid) {

				var _this,
					i,
					num,
					arrId,
					arrId1,
					goodsArr,
					_this;

				//编辑
				arrId = [];
				arrId1 = [];
				_this = this;
				
				this.requestUri = this.getEditData;
				this.param.gm_id = gid;
				this.load();
				this.suc = function( data ) {

					goodsArr = data.data.gm_selection_list;
					num = goodsArr.length;

					for (i=0; i<num; i++) {
						arrId.push( goodsArr[i].goods_id );
						arrId1.push( goodsArr[i].goods_id );
					}
			

					oGoodsSelect.save = arrId;
					oGoodsSelect.lastSave = arrId1;

					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.data = data;
					_this.render();
					_this.submission( 'edit', gid );

				}

			}

	});	


	oSeries.init();

});