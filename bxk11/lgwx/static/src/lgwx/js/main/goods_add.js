/*
 *description:商品添加-编辑
 *author:fanwei
 *date:2014/04/09
 */
define(function(require, exports, module){

	var global = require('../global/global');
	var until = require('../lib/until/until');
	var ajaxForm = require('../widget/form/ajaxForm');
	var upload = require('../global/upload');
	var Related = require('../widget/dom/related');
	var goodsCut = require('../sub/cut/cut');
	var dialog = require('../widget/dom/dialog');
	var goodsSelect = require('../sub/goods/goods_select');

	var oGoodsCut = new goodsCut();
	oGoodsCut.cutUrl = '/lgwx/index.php/upload/crop_service_pic';
	oGoodsCut.init();
	
	var oGoodsSelect = new goodsSelect({
		confirmUrl: '/lgwx/index.php/view/goods/goReConsole'
	});
	oGoodsSelect.MIN = 1;

	//商品选择弹框
	var goodsBox = new dialog({
		boxSelector: $('[sc = goods-select-box]')
	});

	var oGoods = until.extend(function(){

			this.editTempId = 'goods-add';
			this.goodsTplId = 'goods-list';
			this.subUrl = '';
			this.oForm = $('[script-bound = form_check]');
			this.aFile = null;
			this.first = true;
			this.getAddData = '/lgwx/index.php/view/goods/add';
			this.getEditData = '/lgwx/index.php/view/goods/edit';
			this.oLocation = $('[sc = location]');

		}, {


			init: function() {
				
				this.judge();

				this.events();
			},
			events: function() {

				var _this = this;

				/*$(document).on('click', '[sc = color-add]', function(){

					_this.tempWrap = _this.colorWrap;
					_this.tempId = 'goods-color';
					_this.data = {data:{color_list:['null']}};
					_this.render();

				});*/

				//裁切保存确定时
				oGoodsCut.onconfirm = function(oFrom, url) {
					_this.addGoods(oFrom, url);
				};

				//删除上传过的图片
				$(document).on('click', '[sc = item-close]', function(){
					_this.removeList( $(this) );
				});


				//click添加按钮
				$(document).on('click', '[sc = match-add]', function(){

					_this.showBox();

				});


				//选择商品
				oGoodsSelect.onConfirm = function(data) {

					_this.renderGoodsList(_this.oListWrap, data);
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
			addGoods: function(oForm, url) {

				var oListWrap,
					
				oListWrap = oForm.parents('[script-role = check_wrap]').find('[sc = item-wrap]');
				
				this.renderList(oForm, oListWrap, url);

			},
			renderGoodsList: function(tplWrap, data) {

				this.tempWrap = tplWrap;
				this.tempId = this.goodsTplId;
				this.data = data;
				tplWrap.html('');
				this.render();

			},
			removeGoods: function(oThis) {

				var gid,
					oParent,

				gid = oThis.attr('gid');
				oParent = oThis.parents('[sc = goods-item]');
				oGoodsSelect.removeId(gid);
				oParent.remove();

			},
			showBox: function() {

				goodsBox.show();

				if( this.first ) {

					this.first = false;

					oGoodsSelect.init();

				}

			},
			removeList: function(oThis) {

				var oList,
					oWrap,
					now,
					max,
					oUp;

				oList = oThis.parents('[sc = item]');
				oWrap = oThis.parents('[sc = item-wrap]');
				max = parseInt( oWrap.attr('max') );
				oUp = oWrap.parents('[script-role = check_wrap]').find('[script-role = upload-file]');
				now = parseInt( oWrap.attr('nowitem') );
				now --;
				oWrap.attr('nowitem', now);
				oList.remove();	

				if( now < max ) {
					oUp.removeAttr('disabled');
				}

			},
			renderList: function(oForm, oWrap, url) {

				var data = {data:{ pic_list:[url] }};
				var now,
					max,
					oFile;

				oFile = oForm.find('[script-role = upload-file]');
				now = parseInt( oWrap.attr('nowitem') );
				max = oWrap.attr('max');

				this.tempWrap = oWrap;
				this.tempId = 'goods-tpl';
				this.data = data;
				this.render();

				now ++;
				oWrap.attr('nowitem', now);

				if( now == max ) {
					oFile.attr('disabled', 'disabled');
				}

			},
			relation: function() {

				this.oBrand = $('[script-role = main-type]');
				this.oSeries = $('[script-role = sub-type]');

				var oRelated = new Related({
					oMain: this.oBrand,
					oSub: this.oSeries,
					MainUrl: '/lgwx/index.php/view/goods/getSonClass',
					SubUrl: '/lgwx/index.php/view/goods/getSonClass',
					firstLoad: false,
					tplMain: '',
					tplSub: '<option value="" id="">请选择子品类</option>'+
					'{{each class_sonlist}}'+
						'<option value="{{$value.class_name}}" id="{{$value.class_id}}">{{$value.class_name}}</option>'+
					'{{/each}}',
					paramName:'class_id'
				});

				oRelated.init();

			},
			showEditor: function(str){

				this.eidtor = UE.getEditor('editor');

				this.eidtor.addListener( 'ready', function( editor ) {
				     
					UE.getEditor('editor').setContent(str);

				});

			},
			getGoods: function(obj) {

				var aFileGoods,
					name,
					arr;
					
				aFileGoods = obj.find('[sc = item]');
				arr = [];

				aFileGoods.each(function(i){

					name = aFileGoods.eq(i).attr('iamgeurl');
					
					if ( name ) {

						arr.push(name);	

					}

				});

				return arr;

			},
			getRec: function() {

				var arr,
					aRec,
					listId;

				aRec = 	$('[sc = goods-item]');
				arr = [];

				aRec.each(function(i){

					listId = aRec.eq(i).attr('gid');
					arr.push(listId);
					
				});

				return arr;

			},
			submission: function(type, sId) {

				var _this,
					isHasGoods,
					isHasRec,
					oIsShow,
					oGoods,
					oRec;

				_this = this;
				oIsShow = $('[sc = is-show]');	
				oGoods = $('[sc = item-wrap]').eq(0);
				oRec = $('[sc = item-wrap]').eq(0);
				this.oListWrap = $('[sc = goods-list-show-wrap]');

				var oShopAddForm = new ajaxForm({

					subUrl: this.subUrl,
					otherJude: [

						/*function() {

							isHasRec = _this.getRec();

							if ( !isHasRec.length ) {

								alert('请添加1-10个商品推荐');

								return false;

							} else {

								return true;

							}

						},*/
						function() {

							isHasGoods = _this.getGoods(oGoods);
						
							if ( !isHasGoods.length ) {

								alert('请至少上传一张商品缩略图');

								return false;

							} else {

								return true;

							}

						}	

					],
					fnSumbit: function( data ) {

						if ( type == 'add' ) {

							data.series_id = sId ? sId : '';

						} else if ( type == 'edit' ) {

							data.goods_id = sId ? sId : '';

						}

						//data.color_list = _this.getColor().join(',');
						data.pic_list = _this.getGoods(oGoods).join('|');
						data.goods_recommend = oGoodsSelect.save.join(',');
						//data.goods_recommend_list = _this.getGoods(oRec).join('|');
						data.goods_price_is_show = oIsShow.attr('checked') ? '1' : '0';
						data.goods_desc = _this.eidtor.getContent();
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
					goodid,
					seriesId;

				param = this.parse();

				if( param.type ) {

					//编辑
					this.subUrl = _jia178config.reqBase + 'post/goods/edit';
					goodid = param.goods_id;
					this.edit( goodid );


				} else {

					//非编辑
					this.oForm.show();
					seriesId = param.series_id;
					this.subUrl = _jia178config.reqBase + 'post/goods/add';
					this.add( seriesId );

				}

			},
			add: function( seriesId ){

				var _this = this;

				//添加
				this.requestUri = this.getAddData;
				this.param.series_id = seriesId;
				this.load();
				this.suc = function( data ) {

					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.data = data;
					_this.render();
					_this.showEditor('');
					_this.colorWrap = $('[sc = goods-color]');
					_this.submission( 'add', seriesId );
					_this.relation();

				};

				this.fail = function(data) {
					
					alert(data.msg);
					window.location = data.data.series_list;

				};


			},
			edit: function(goodid) {

				var _this,
					goodsArr,
					arrId,
					arrId1;

				_this = this;	
				arrId = [];
				arrId1 = [];

				//编辑
				this.requestUri = this.getEditData;
				this.param.goods_id = goodid;
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

					_this.data = data;
					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.render();
					_this.relation();
					_this.colorWrap = $('[sc = goods-color]');
					_this.showEditor(data.data.goods_desc);
					_this.submission( 'edit', goodid );

				};

				this.fail = function(data) {
					
					//如果不存在series_id,则跳转到列表页;
					alert(data.msg);
					window.location = data.data.series_list;

				};

			}

	});	


	oGoods.init();
});