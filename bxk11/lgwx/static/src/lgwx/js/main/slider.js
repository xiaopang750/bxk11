/*
 *description:店铺橱窗设置
 *author:fanwei
 *date:2014/04/14
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var operation = require('../sub/operation/operation');

	var oSlider = until.extend(function(){

			this.dataUrl = _jia178config.reqBase + 'view/service/slide_list';
			this.removeUrl = _jia178config.reqBase + 'post/service/slide_del';
			this.tplId = 'slider';
			this.shop_id = this.parse().shop_id;
			this.first = true;

			this.oWrap = $('[sc = slider-wrap]');
			this.oLay = $('[sc = lay]');
			this.oImage = $('[sc = lay-img]');	

		},{

			init: function() {

				var _this = this;

				this.pageShow();
				this.events();
				this.initLay();
			},
			events: function() {

				var _this,
					oTarget,
					sRole;

				_this = this;	

				//幻灯片预览
				$(document).on('mouseover', '[sc = hoverImage]', function(){

					_this.todo( $(this) );

					_this.oLay.show();

				});


				$(document).on('mouseout', '[sc = hoverImage]', function(){

					_this.todo( $(this) );

					_this.oLay.hide();

				});

				//选择店铺切换列表页
				var sId;
				$(document).on('change', '[sc = shop-search]', function(e){

					sId = $(this).val();

					_this.pageShow(null, sId);

				});	


				//删除
				operation.openBox = function(id, type) {

					switch(type) {

						case 'remove':
							this.reqParam = {slide_id: id};
							this.reqUrl = _this.removeUrl;
						break;

					}

				};

			},
			pageShow: function(cb, shopId) {

				//显示列表页
				shopId = shopId || this.shop_id;

				var _this = this;
				this.requestUri = this.dataUrl;
				this.param = {shop_id: shopId};
				this.load();
				this.suc = function( data ) {
					
					_this.tempWrap = _this.oWrap;
					_this.data = data;
					_this.tempId = _this.tplId;
					_this.tempWrap.html('');
					_this.render(); 
					_this.firstShowSelectShop();
					cb && cb(); 

				};

			},
			todo: function(oThis) {

				//获取幻灯片坐标
				var src,
					left,
					top;

				src = oThis.attr('src');
				left = oThis.offset().left + oThis.width();
				top = oThis.offset().top + oThis.height();

				this.position(left, top, src);	

			},
			initLay: function() {

				//初始化预览层
				this.oLay.css({

					position: 'absolute',
					border: '1px solid #000'

				});

			},
			position: function(left, top, src){

				//定位预览层
				this.oImage.attr('src', src);
				this.oLay.css({
					left: left,
					top: top
				});

			},
			firstShowSelectShop: function() {

				//如果添加幻灯片后的跳转到列表页上的url上有shop_name则选中店铺的select;
				if( this.first ) {

					this.first = false;

					var oSelectShop,
						aOption,
						sId,
						_this;

					oSelectShop = $('[sc = shop-search]');
					aOption = oSelectShop.children();
					_this = this;

					if( this.shop_id ) {

						aOption.each(function(i){

							sId = aOption.eq(i).attr('id');
							
							if( sId == _this.shop_id ) {

								aOption.eq(i).attr('selected', 'selected');
							}

						});

					}


				}

			}

	});


	oSlider.init();


});