/*
 *description:index
 *author:fanwei
 *date:2014/04/25
 */
define(function(require, exports, module){
	

	var global = require('../global/global');
	//var focus = require('../../../../global/js/widget/focus/focus');
	var until = require('../../../../global/js/global/until');
	//var FnDo = require('../../../../global/js/global/fnDo');
	var iscroll = require('../../../../global/js/lib/iscroll/iscroll');
	

	function Index() {

		this.oBg = $('[sc = index-bg]');

	}

	Index.prototype = {

		init: function() {

			//this.showFoc();

			//this.showNew();

			this.showModule();

			this.events();
		},
		moduleScroll: function() {

			var oScroll = new iscroll('module', {
		        hScroll: true,
		        bounce: true
			});
		},
		events: function() {

			var url = reqBase + 'common/service_like';

			//todo
			/*var todo = new FnDo({
				oWrap: $('[sc= index-new]'),
				sTarget: 'foc',
				fnDo: function(oThis) {

					if ( oThis.attr('is_follow') == '0' ) {

						this.req(url, wparam, function(data){

							oTip.text('已关注');

							setTimeout(function(){

								oTip.hide();

							},2000);

							oThis.html('已关注');

							oThis.attr('is_follow', '1');	

						});

					}
				}
			});

			todo.init();*/

			
		},
		showBg: function(src) {

			this.oBg.css('backgroundImage', 'url('+ src +')');

		},
		showNew: function() {

			var oTplNew,
				oNew,
				getDataUrl;

			oTplNew = require('../../tpl/build/index/new');
			oNew = $('[sc = index-new]');
			getDataUrl = reqBase + 'vinformation/newone';

			until.show( oTplNew, oNew, getDataUrl, wparam );

		},
		showModule: function() {

			var oTplModule,
				oModule,
				getDataUrl,
				aModuleList,
				num,
				sumWidth,
				_this;

			_this = this;
			oTplModule = require('../../tpl/build/index/module');
			oModule = $('[sc = module-wrap]');
			getDataUrl = reqBase + 'vindex/diy_menu_list';

			until.show( oTplModule, oModule, getDataUrl, wparam, function(data){

				aModuleList = $('[sc = module-list]');
				num = aModuleList.length;
				sumWidth = ( aModuleList.eq(0).width() + parseInt( aModuleList.eq(0).css('margin-right') ) ) * num;
				oModule.css('width', sumWidth);
				_this.moduleScroll();
				_this.showBg( data.data.index_bg );

			});

		},
		showFoc: function() {

			var foc = new focus({
				param: wparam,
				type:'post',
				oWrap: $('[widget-role = focus-wrap]'),
				url: reqBase + 'vindex/slide'
			});

			foc.init();

		}

	}

	var index = new Index();

	index.init();

});