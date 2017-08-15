/*
 *description:企业认证
 *author:fanwei
 *date:2014/05/06
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var upload = require('../global/upload');
	var ajaxForm = require('../widget/form/ajaxForm');
	var calendar = require('../widget/form/calendar');
	var Related = require('../widget/dom/related');
	var dialog = require('../widget/dom/dialog');

	//map
	var oMap = new dialog({
		boxSelector: $('[sc = map]')
	});

	var oReg = until.extend(function(){}, {


		init: function(){

			this.hilightNav();

			this.events();
			
		},
		events: function(){

			var _this = this;

			//showMap;
			$(document).on('click','[sc = map-btn]', function(){

				oMap.show();

			});

			$(document).on('change','[sc = select]', function(){

				if( _this.step == 2 ) {

					_this.selectBrand( $(this), '/lgwx/index.php/post/join/selectBrand', 'apply_id' );	

				} else if( _this.step == 3 ) {

					_this.selectBrand( $(this), '/lgwx/index.php/post/join/selectShop', 'shop_id' );

				}


			});

		},
		selectBrand: function(oSelect, url, paramName) {

			var sId,
				oSelected;

			oSelected = oSelect.children().eq( oSelect.get(0).selectedIndex );
			sId = oSelected.attr('id');

			if( sId ) {

				this.requestUri = url;
				this.param[paramName] = sId;
				this.load();
				this.suc = function(data){

					window.location = data.data;

				}

			}

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
		showMap: function() {

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
		hilightNav: function() {

			var aNav,
				oNavWrap,
				aPageName,
				nowNav,
				nowPage,
				_this,
				oWrap,
				now;
				
			_this = this;
			oNavWrap = $('[sc = step-nav-wrap]');
			aNav =  $('[sc = step-nav]');
			oWrap = $('[script-bound = form_check]');
			now = oNavWrap.attr('now');

			//step4:第四步没有导航
			if ( !aNav.length ) {

				var oBind,
					oApply,
					oAfter,
					info;

				oBind = $('[sc = bind_link]');
				oApply = $('[sc = apply]');	
				oAfter = $('[sc = after-btn]');

				this.requestUri = '/lgwx/index.php/view/join/step4';
				this.load();
				this.suc = function( data ) {

					info = data.data;

					oBind.attr('href', info.add_weixin);
					oApply.attr('href', info.reg_weixin);
					oAfter.attr('href', info.skip);

				};

				this.fail = function( data ) {

					alert( data.msg );

					window.location = data.data;

				};

			}

			aNav.each(function(i){

				nowNav = aNav.eq(i);
				aPageName = nowNav.attr('key');

				if ( aPageName == now ) {

					nowNav.addClass('active');

					switch( i ) {

						//step1
						case 0:
							_this.showPage('/lgwx/index.php/view/join/step1', 'tpl-step1', oWrap, function(){

								_this.step = 1;
								_this.submissionStep1();
							
							});
						break;

						//step2
						case 1:
							_this.showPage('/lgwx/index.php/view/join/step2', 'tpl-step2', oWrap, function(){

								_this.step = 2;
								_this.showCalendar();
								_this.submissionStep2();


							});


						break;

						//step3
						case 2:

							_this.showMap();

							_this.showPage('/lgwx/index.php/view/join/step3', 'tpl-step3', oWrap, function(){
								_this.step = 3;
								_this.related();
								_this.submissionStep3();

							});

							var regCut = require('../sub/cut/cut');

							var oRegCut = new regCut();
							oRegCut.cutUrl = '/lgwx/index.php/upload/crop_service_pic';
							oRegCut.init();
						break;

					}

				}

			});

		},
		showCalendar: function() {

			var oThisWrap,
				oThisTip;

			$('[sc= time-select]').calendar({
				onSetDate: function(e) {

					oThisWrap = $(this.inpE).parents('[script-role = check_wrap]');

					oThisTip = oThisWrap.find("[script-role = wrong_area]");

					oThisWrap.removeClass("has-error");
					oThisTip.removeClass("wrong");

				}
			});	

		},
		showPage: function(url, tplId, oWrap, cb) {

			var _this = this;

			//添加
			this.requestUri = url;
			this.load();
			this.suc = function( data ) {

				_this.tempId = tplId;
				_this.tempWrap = oWrap;
				_this.data = data;
				_this.render();
				cb && cb();

			};

			this.fail = function(data) {
				
				alert(data.msg);

				window.location = data.data;

			};
		},
		submissionStep1: function() {

			var _this,
				joinLicense,
				oLicense;

			_this = this;
			oLicense = $('[script-role = upload-file]');

			var oForm = new ajaxForm({

				subUrl: '/lgwx/index.php/post/join/step1',
				otherJude: [

					//验证营业执照
					function() {

						joinLicense = oLicense.attr('iamgeurl');

						if ( !joinLicense ) {

							alert('请上传营业执照');

							return false;

						} else {

							return true;

						}

					}
				],
				fnSumbit: function( data ){

					data.join_license = oLicense.attr('iamgeurl');

				},
				sucDo: function(data) {
					
					//alert(data.msg);

					window.location = data.data;

				},
				failDo: function(data) {

					alert(data.msg);

				}

			});	

			oForm.upload();

		},
		submissionStep2: function() {

			var _this,
				aUpLoad,
				aCheck,
				checkedCount;

			_this = this;
			
			aUpLoad = $('[script-role = upload-file]');	
			aCheck = $('input[type=checkbox]');

			var oForm = new ajaxForm({

				subUrl: '/lgwx/index.php/post/join/step2',
				otherJude: [
					function(){

						//验证是否上传了logo
						if ( !aUpLoad.eq(1).attr('iamgeurl') ) {

							return false;

							alert('请上传品牌logo');

						} else {

							return true;

						}

					},
					function() {

						var isChecked;
						checkedCount = 0;

						//验证是否选中的多于6个
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

					}
				],
				fnSumbit: function( data ){

					data.apply_license_file = aUpLoad.eq(0).attr('iamgeurl');
					data.apply_brand_img = aUpLoad.eq(1).attr('iamgeurl');

				},
				sucDo: function(data) {
					
					//alert(data.msg);
					
					window.location = data.data;

				},
				failDo: function(data) {

					alert(data.msg);

				}

			});	

			oForm.upload();

		},
		submissionStep3: function() {

			var _this,
				aUpload,
				oLicense,
				result,
				shopUrl;

			_this = this;
			aUpload = $('[script-role = upload-file]');

			var oForm = new ajaxForm({

				subUrl: '/lgwx/index.php/post/join/step3',
				otherJude: [

					//验证门店实景图
					function() {

						result = [];

						aUpload.each(function(i){

							shopUrl = aUpload.eq(i).attr('iamgeurl');

							if ( shopUrl ) {

								result.push( shopUrl );

							}

						});

						if ( !result.length ) {

							alert('请至少上传一张门店实景图');

							return false;

						} else {

							return true;

						}

					}
				],
				fnSumbit: function( data ){

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

					data.pic_list = arr.join('|');

				},
				sucDo: function(data) {
					
					//alert(data.msg);

					window.location = data.data;

				},
				failDo: function(data) {

					alert(data.msg);

				}

			});	

			oForm.upload();

		}

	});

	oReg.init();


});