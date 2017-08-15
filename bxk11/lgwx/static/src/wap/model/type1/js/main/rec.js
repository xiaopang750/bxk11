define(function(require, exports, module){
	
	var param = require('../../../../global/js/global/getParam');
	var FnDo = require('../../../../global/js/global/fnDo');
	var until = require('../../../../global/js/global/until');
	var url = reqBase + 'vgoods/getlist';
	require('../../../../global/js/global/loading');
	var tip = require('../../../../global/js/global/tip');
	var focus = require('../../../../global/js/widget/focus/focus');

	var loadingTimer;
	$(document).ready(function(){

		clearTimeout( loadingTimer );
		loadingTimer = setTimeout(loading, 500);

	});
	

	//todo
	var url = reqBase + 'vshop/like';
	var todo = new FnDo({
		oWrap: $('[script-role = product_footer]'),
		sTarget: 'fav',
		fnDo: function(oThis) {

			wparam.shop_id = gparam.shop_id;

			if ( !oThis.hasClass('active') ) {

				this.req(url, wparam, function(data){

					oTip.text('已收藏');

					oThis.addClass('active');	

				});

			} else {

				this.req(url, wparam, function(data){

					oTip.text('已取消收藏');

					oThis.removeClass('active');	

				});

			}

		}
	});

	todo.init();


	function Rec() {



	}

	Rec.prototype = {

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
		showPage: function() {

			var oTplRec,
				oRec,
				getDataUrl;

			oTplRec = require('../../tpl/build/rec/list');
			oRec = $('[sc = rec]');
			getDataUrl = reqBase + 'vshop/recommend';
			wparam.shop_id = gparam.shop_id;



			until.show( oTplRec, oRec, getDataUrl, wparam, function(data){

				var foc = new focus({
					cycle: true,
					auto: true,
					oWrap: $('[widget-role = focus-wrap]')
				});

				foc.init();

			} );
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

		}

	}

	var oRec = new Rec();

	oRec.init();

});