define(function(require, exports, module){
	

	var param = require('../../../../global/js/global/getParam');
	var until = require('../../../../global/js/global/until');
	var url = reqBase + 'vgoods/getlist';
	var select = require('../../../../../lgwx/js/widget/form/select');
	var scrollLoad = require('../../../../global/js/widget/dom/scrollLoad');


	require('../../../../global/js/global/loading');
	var tip = require('../../../../global/js/global/tip');

	var loadingTimer;
	$(document).ready(function(){

		clearTimeout( loadingTimer );
		loadingTimer = setTimeout(loading, 500);

	});
	

	function GoodsSelect() {

		this.initParam = {brand_id: '',class_id: '', series_id: '', num: 10, p: 1, service_id: gparam.service_id, openid:gparam.openid };
		this.relatedUrl = '/lgwx/index.php/wap/vshop/getShopSeriesByBrand';

	}

	GoodsSelect.prototype = {

		init: function() {

			this.selectShow();

			this.scroller();

			this.events();

		},
		events: function() {

		},
		calcImageWidth: function() {

			
			
		},
		selectShow: function() {

			var oTplSelect,
				oSelect,
				getDataUrl;

			oTplSelect = require('../../tpl/build/mall/search_list');
			oSelect = $('[sc = select-wrap]');
			getDataUrl = reqBase + 'vgoods/searchoptions';

			until.show( oTplSelect, oSelect, getDataUrl, wparam );

			this.beautySelect();

		},
		beautySelect: function() {

			var nowId,
				type,
				_this,
				sRole;

			_this = this;
			this.aSelect = $('[sc = beauty-select]').select({
				width: '90%',
				onselect: function(oNow) {

					sRole = oNow.attr('role');
					nowId = oNow.attr('lid');
					type = oNow.attr('type');

					if(sRole == 'main' && nowId) {

						_this.relatedSelect(nowId);
						_this.initParam['class_id'] = '';
						_this.initParam['series_id'] = '';		
					}

					_this.initParam[type] = nowId;
					_this.oScroll.refresh( _this.initParam );
				}
			});
		},
		relatedSelect: function(nid) {

			var _this = this;

			this.relatedRequest(nid, function(data){

				_this.relatedTodo(data);

			});
		    
		},
		relatedRequest: function(nid,cb) {

			wparam.brand_id = nid

			$.post(this.relatedUrl, wparam, function(data){

				if( !data.err ) {
	
					cb && cb(data);

				}

			}, 'json');

		},
		relatedTodo: function(data) {

			var classTpl = 
			'<option value="" ui-html="请选择品类" type="class_id" lid="">请选择品类</option>'+
		    '{{each data.classlist}}'+
				'<option value="{{$value.class_name}}" ui-html="{{$value.class_name}}" type="class_id" lid="{{$value.class_id}}" lead-text="请选择品类">{{$value.class_name}}</option>'+
			'{{/each}}';

		    var serTpl = 
		    '<option value="" ui-html="请选择系列" type="class_id" lid="">请选择系列</option>'+
		    '{{each data.series}}'+
				'<option value="{{$value.series_name}}" ui-html="{{$value.series_name}}" type="series_id" lid="{{$value.series_id}}" lead-text="请选择系列">{{$value.class_name}}</option>'+
			'{{/each}}';

			this.aSelect[1].render(classTpl, data);
			this.aSelect[1].getList();

			this.aSelect[2].render(serTpl, data);
			this.aSelect[2].getList();

		},
		scroller: function() {

			var oTplNew,oNew;
			this.oScroll = new scrollLoad();
			var oTip = $('[sc = monsary-tip]');

			oTplNew = require('../../tpl/build/mall/list');
			oNew = $('[sc = goods]');
			
			this.oScroll.requestUrl = reqBase + 'vgoods/getlist';
			this.oScroll.oTpl = oTplNew;
			this.oScroll.param = this.initParam;
			this.oScroll.oDataWrap = oNew;
			this.oScroll.oTip = oTip;
			this.oScroll.init();

		}	

	}

	var goods = new GoodsSelect();

	goods.init();
});