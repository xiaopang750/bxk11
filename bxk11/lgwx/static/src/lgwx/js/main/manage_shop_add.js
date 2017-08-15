/*
 *description:添加门店
 *author:fanwei
 *date:2014/03/26
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var ajaxForm = require('../widget/form/ajaxForm');
	var Related = require('../widget/dom/related');
	var upload = require('../global/upload');
	var dialog = require('../widget/dom/dialog');
	var shopCut = require('../sub/cut/cut');

	var oShopCut = new shopCut();
	oShopCut.cutUrl = '/lgwx/index.php/upload/crop_service_pic';
	oShopCut.init();

	//map
	var oMap = new dialog({
		boxSelector: $('[sc = map]')
	});

	var oShopAdd = until.extend(function(){
			
			this.oBrandAdd = $('[sc = brand_add]');
			this.editTempId = 'shop-add';
			this.oBrandWrap = $('[sc = brand-wrap]');
			this.oForm = $('[script-bound = form_check]');
			this.subUrl = '';
			this.aFile = null;

			this.getBranUrl = _jia178config.reqBase + 'view/shop/getbrandlist';
			this.getEditUrl = _jia178config.reqBase + 'view/shop/edit';
			this.addUrl = _jia178config.reqBase + 'view/shop/add';

		},{

			init: function() {
				
				this.judge();

				this.showMap();

				this.events();

			},
			related: function(firstLoad) {

				//省市联动
				var oRelated = new Related({
					oMain: $('[script-role = province]'),
					oSub: $('[script-role = city]'),
					MainUrl: '/lgwx/index.php/view/area/index',
					SubUrl: '/lgwx/index.php/view/area/getdistrict',
					firstLoad: firstLoad,
					tplMain: 
					'<option value="">省</option>'+
					'{{each}}'+
						'<option id={{$value.district_code}}>{{$value.district_name}}</option>'+
					'{{/each}}',
					tplSub: 
					'<option value="">市</option>'+
					'{{each}}'+
						'<option id={{$value.district_code}}>{{$value.district_name}}</option>'+
					'{{/each}}'
				});

				oRelated.init();

			},
			events: function() {

				//showMap;
				$(document).on('click','[sc = map-btn]', function(){

					oMap.show();

				});

			},
			showMap: function() {

				//默认坐标北京天安门;
				var map = new BMap.Map("map");           
				var point = new BMap.Point(116.404, 39.915);  
				map.centerAndZoom(point,15);                    
				map.enableScrollWheelZoom(); 
				

				var marker1,
					oLng,
					oLat,
					oLngParent,
					oLngWrong;

				map.addEventListener("click", function(e){

				   map.clearOverlays();

				   oLng = $('[sc = lng]');
				   oLat = $('[sc = lat]');
				   oLngParent = oLng.parents('[script-role = check_wrap]');
				   oLngWrong = oLngParent.find('[script-role = wrong_area]');

				   marker1 = new BMap.Marker(new BMap.Point(e.point.lng , e.point.lat)); 

				   map.addOverlay(marker1);

				   oLng.val( e.point.lng );
				   oLat.val( e.point.lat );

				   oLngParent.removeClass("has-error");
				   oLngWrong.removeClass("wrong");
				});

			},
			getPicList: function() {

				//拼接图片数组
				var aFileGoods,
					name,
					arr;
					
				aFileGoods = $('[script-role = upload-file]');
				arr = [];

				aFileGoods.each(function(i){

					name = aFileGoods.eq(i).attr('iamgeurl');
					
					if ( name ) {

						arr.push(name);	

					}

				});

				return arr;

			},
			submission: function(sId, type) {

				this.aFile = $('[script-role = upload-file]');

				var result;
				var _this = this;
				var name;
				
				var oShopAddForm = new ajaxForm({

					subUrl: this.subUrl,
					otherJude: [

						function() {

							if ( type == 'certified' ) {

								result = [];

								_this.aFile.each(function(i){

									name = _this.aFile.eq(i).attr('iamgeurl');

									if ( name ) {

										result.push( name );

									}

								});

								if ( result.length ) {

									return true;

								} else {

									alert('请至少上传一张门店实景图');

									return false;

								}

							} else {

								return true;

							}
						}	

					],
					fnSumbit: function( data ) {

						data.pic_list = _this.getPicList().join('|');
						data.shopid = sId ? sId : '';
						
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
					shopId,
					type;

				param = this.parse();
				type = param.type;

				if( type ) {

					
					if ( type == 'edit' ) {

						//编辑
						this.subUrl = _jia178config.reqBase + 'post/shop/edit';

					} else if ( type == 'certified' ) {

						//认证
						this.subUrl = _jia178config.reqBase + 'post/shop/certified';
					}

					shopId = param.shopid;
					this.edit( shopId, type );

				} else {

					//非编辑
					this.oForm.show();
					this.subUrl = _jia178config.reqBase + 'post/shop/add';
					this.add();

				}

			},
			add: function(){

				var _this = this;

				//添加
				this.requestUri = _this.addUrl;
				this.load();
				this.suc = function(data) {

					_this.data = data;
					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.render();
					_this.related(true);
					_this.submission();

				}

				this.fail = function( data ) {

					alert(data.msg);
					window.location = data.data;

				};

			},
			edit: function(sId, type) {

				var _this = this;

				//编辑
				this.requestUri = this.getEditUrl;
				this.param.shopid = sId;
				this.load();
				this.suc = function( data ) {

					_this.data = data;
					_this.tempId = _this.editTempId;
					_this.tempWrap = _this.oForm;
					_this.render();
					_this.related(false);
					_this.submission(sId, type);

				}

				this.fail = function( data ) {

					alert(data.msg);
					window.location = data.data;

				};

			}

	});

	oShopAdd.init();


});