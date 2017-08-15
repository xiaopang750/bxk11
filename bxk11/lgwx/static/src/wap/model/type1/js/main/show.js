/*
 *description:全景展厅
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	
	var param = require('../../../../global/js/global/getParam');
	var until = require('../../../../global/js/global/until');
	require('../../../../global/js/global/loading');
	var iscroll = require('../../../../global/js/lib/iscroll/iscroll');


	var loadingTimer;
	$(document).ready(function(){

		clearTimeout( loadingTimer );
		loadingTimer = setTimeout(loading, 500);

	});

	function Show() {



	}

	Show.prototype = {

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
			
			var oTplShow,
				oShow,
				getDataUrl,
				_this;

			oTplShow = require('../../tpl/build/show/list');
			oShow = $('[sc = show]');
			getDataUrl = reqBase + 'vbrand/info';
			_this = this;
			wparam.brand_id = gparam.brand_id;

			until.show(oTplShow, oShow, getDataUrl, wparam, function(){

				_this.showRoll();

			});

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

	var oShow = new Show();

	oShow.init();

});