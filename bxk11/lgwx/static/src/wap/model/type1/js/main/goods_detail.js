/*
 *description:商品详情
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var param = require('../../../../global/js/global/getParam');
	var until = require('../../../../global/js/global/until');
	var FnDo = require('../../../../global/js/global/fnDo');
	var tip = require('../../../../global/js/global/tip');
	var qcode = require('../../../../global/js/widget/code/qcode');
	var jqcode = require('../../../../global/js/widget/code/jqcode');
	var goodsDetail = require('../sub/goods/goods_global');
	var iscroll = require('../../../../global/js/lib/iscroll/iscroll');
	var backTop = require('../global/backTop');
	require('../../../../global/js/global/loading');
	var focus = require('../../../../global/js/widget/focus/focus');

	var loadingTimer;
	$(document).ready(function(){

		clearTimeout( loadingTimer );
		loadingTimer = setTimeout(loading, 500);

	});

	var oTip = new tip();
	oTip.init();
	//todo
	var url = reqBase + 'vgoods/like';

	var todo = new FnDo({
		oWrap: $('[sc = goods_detail]'),
		sTarget: 'fav',
		fnDo: function(oThis) {

			var oFavIcon = oThis.find('[sc = fav-icon]');
			var oFavText = oThis.find('[sc = fav-text]');

			wparam.goods_id = gparam.goods_id;
			wparam.shop_id = gparam.shop_id;

			if ( oThis.attr('is_like') == '0' ) {

				this.req(url, wparam, function(data){

					oTip.text('已收藏');
					$('[script-role = fav]').attr('is_like', '1');	

					if( oFavIcon.length ) {

						$('[ role = text-fav ]').html('已收藏');
						oFavText.html('已收藏');	
						oFavIcon.addClass('active');	

					} else {

						oThis.html('已收藏');
						$('[sc = fav-icon]').addClass('active');
						$('[sc = fav-text]').html('已收藏');
					}

				});

			} else {

				this.req(url, wparam, function(data){

					oTip.text('已取消收藏');
					$('[script-role = fav]').attr('is_like', '0');

					if( oFavIcon.length ) {

						$('[ role = text-fav ]').html('马上收藏');
						oFavText.html('马上收藏');	
						oFavIcon.removeClass('active');

					} else {

						oThis.html('马上收藏');
						$('[sc = fav-icon]').removeClass('active');
						$('[sc = fav-text]').html('马上收藏');
					}

				});

			}

		}
	});

	todo.init();

	
	function GoodsDetail() {



	}

	GoodsDetail.prototype = {

		init: function() {

			this.showPage();

			this.events();
		},
		events: function() {

			var _this = this;

			$(document).on('click', '[sc = slide]', function(){

				_this.slide( $(this) );

			});

		},
		showCode: function(oWrap, text) {

			oWrap.qrcode({
				text: text,
				width: 60,
				height: 60
			});

		},
		slide: function(oBtn) {

			var isSlide,
				oParent,
				oContent;

			oParent = oBtn.parents('[sc = slide-wrap]');
			oContent = oParent.find('[sc = slide-content]');
			isSlide = oBtn.attr('islide');

			if( isSlide == 'yes' ) {
				oContent.hide();
				oBtn.attr('islide', 'no');
				oBtn.html('展开&gt;&gt;');
			} else {
				oContent.show();
				oBtn.attr('islide', 'yes');
				oBtn.html('收起&gt;&gt;');
			}

		},
		showRoll: function() {

			var aRollList,
				i,
				num,
				sinWidth,
				oRollWrap;

			aRollList = $('[sc = roll-list]');
			num = aRollList.length;
			sinWidth = aRollList.eq(0).width() + parseInt( aRollList.eq(0).css('margin-right') );
			sumWidth = sinWidth * num - parseInt( aRollList.eq(0).css('margin-right') );
			oRollWrap = $('[sc = roll-area]');
			oRollWrap.css('width', sumWidth);


			var oScroll = new iscroll('iscroll-wrap', {
		        hScroll: true,
		        bounce: true
			});

		},
		showPage: function() {
			
			var oTplGoodsDetail,
				oGoodsDetail,
				getDataUrl,
				oCode,
				_this,
				info;

			oTplGoodsDetail = require('../../tpl/build/goods/detail');
			oGoodsDetail = $('[sc = goods_detail]');
			getDataUrl = reqBase + 'vgoods/info';
			_this = this;

			wparam.goods_id = gparam.goods_id;
			wparam.shop_id = gparam.shop_id;

			

			until.show( oTplGoodsDetail, oGoodsDetail, getDataUrl, wparam,function(data){

				info = data.data;

				//code
				oCode = $('[sc = qcode]');

				_this.showCode(oCode, info.goods_url);

				_this.oTool = $('[sc = bottom-tool]');
				

				//focus
				var foc = new focus({
					cycle: true,
					auto: true,
					oWrap: $('[widget-role = focus-wrap]')
				});

				foc.init();

				//roll
				if( info.goods_recommend_list ) {
					
					_this.showRoll();	

				}
				

			});

		}

	}


	//diary-装修笔记
	function Diary() {

		this.stauts = [
			'不咋滴',
			'还行',
			'不错',
			'很好',
			'太棒了'
		];

		this.subUrl = reqBase + 'vgoods/addnote';
		this.checkUrl = reqBase + 'vgoods/checkLogin';
		this.first = false;

	}

	Diary.prototype = {

		init: function() {

			this.events();
		},
		events: function() {

			var _this = this;

			$(document).on('touchstart', '[sc = diary-wrap]', function(){

				if( !_this.first ) {

					_this.first = true;

					_this.checkLogin();

				} else {

					_this.showDiary();
				}

			});

			var i,
				num,
				aPoint,
				oParent,
				nowPoint,
				oLevel;

			$(document).on('click', '[sc = point]', function(){

				oParent = $(this).parents('[sc = point-list]');
				aPoint = oParent.find('[sc = point]');
				oLevel = oParent.find('[sc = score]');
				
				_this.clearPoint(aPoint);
				nowPoint = _this.showPoint(aPoint, $(this));
				_this.showLevel( oLevel, oParent, nowPoint );

			});


			var param,
				result;

			$(document).on('click', '[sc = save-btn]', function(){

				result = _this.check();

				if( !result.err ) {

					_this.sub(_this.subUrl, result.param);

				}

				return false;
			});

			//装修笔记滚动到最下面隐藏;
			$(window).on('scroll', function(){

				var top = document.documentElement.scrollTop || document.body.scrollTop;
				var height = $(window).height();
				var scrollHeight = Math.max(document.body.clientHeight, document.documentElement.scrollHeight);

				if( top + height >= scrollHeight ) {
					oDetail.oTool.hide();
				} else {
					oDetail.oTool.show();
				}

			});


		},
		checkLogin: function(noLogin) {

			var _this = this;

			$.post(this.checkUrl, gparam, function(data){

				if( data.err == 2 ) {

					noLogin && noLogin();
					oTip.text(data.msg);
					setTimeout(function(){
						window.location = data.data;
					},500);

				} else {
					_this.showDiary();
				}

			},'json');

		},
		check: function() {

			var aPoint = [];
			var aList,
				nowPoint,
				oContent,
				sVal,
				sTime,
				sDesc,
				sShopName;

			aList = $('[sc = point-list]');
			oContent = $('[sc = save-content]');

			aList.each(function(i){

				nowPoint = aList.eq(i).attr('point');

				if( nowPoint ) {

					aPoint.push( nowPoint );

				}

			});	

			sTime = oContent.attr('time');
			sDesc = oContent.attr('desc');
			sShopName = oContent.attr('shop_name');
			sVal = sDesc + oContent.val();

			if( sVal && aPoint.length ) {

				return data = {
					err: 0,
					param: {
						note_content: sVal,
						note_facade: parseInt(aPoint[0]) + 1,
						note_comfort: parseInt(aPoint[1]) + 1,
						note_price: parseInt(aPoint[2]) + 1,
						service_id: wparam.service_id,
						opendid: wparam.opendid,
						goods_id: gparam.goods_id,
						shop_id: gparam.shop_id,
						shop_name: sShopName
					}
				}

		  	} else {

		  		oTip.text('请完整填写信息');

		  		return data = {
		  			err: 1
		  		}

		  	}
		},
		sub: function(url, param) {

			var _this = this;

			$.post(url, param, function(data){

				oTip.text( data.msg );

				if( !data.err ) {

					_this.clearAll();
					_this.showDiary();

				} else if ( data.err == 2 ) {

					setTimeout(function(){
						window.location = data.data;	
					},500);

				}

			}, 'json');

		},
		clearAll: function() {

			var aPoint,
				aList,
				oContent;

			aPoint = $('[sc = point]');
			aList = $('[sc = point-list]');
			oContent = $('[sc = save-content]');

			aPoint.each(function(i){

				aPoint.eq(i).removeClass('active');

			});	

			aList.each(function(i){

				aList.eq(i).attr('point', '');

			});	

			oContent.val('');

		},
		showLevel: function(oLevel, oParent, index) {

			oParent.attr('point', index);
			oLevel.html( this.stauts[index] );

		},
		clearPoint: function(aPoint) {

			aPoint.each(function(i){

				aPoint.eq(i).removeClass('active');

			});

		},
		showPoint: function(aPoint, oThis) {

			num = aPoint.length;	

			for (i=0;i<num;i++) {

				aPoint.eq(i).addClass('active');

				if( aPoint[i] == oThis[0] ) {

					return i;

					break;

				}

			}

		},
		showDiary: function() {

			var oDiary,
				isShow;

			oDiary = $('[sc = diary-content]');
			isShow = oDiary.attr('is-show') == 'show';

			if( !isShow ) {

				oDiary.show();
				oDiary.attr('is-show', 'show');
				document.documentElement.scrollTop = oDiary.offset().top;
				document.body.scrollTop = oDiary.offset().top;

			} else {
				oDiary.hide();
				oDiary.attr('is-show', 'hide');
			}

		},
	}

	var oDetail = new GoodsDetail();
	var oDiary = new Diary();

	oDetail.init();
	oDiary.init();

});