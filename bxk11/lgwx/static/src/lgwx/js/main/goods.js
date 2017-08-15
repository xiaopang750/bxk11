/*
 *description:商品列表
 *author:fanwei
 *date:2014/04/04
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var Fenye = require('../widget/dom/fenye');
	var bodyParse = require('../widget/http/bodyParse');
	var dialog = require('../widget/dom/dialog');
	var until = require('../lib/until/until');
	var Related = require('../widget/dom/related');

	//确认框
	var confirmBox = new dialog({
		title:"删除",
		content:"确定要删除该内容么？"
	});

	//关闭框
	var closeBox = new dialog({
		title:"删除",
		content:"删除成功！",
		type:'close'
	});

	var oGoods = until.extend(function(){

		this._param = {};

		if ( !this._param ) return;

		this.tplId = 'goods-list';

		this.getDataUrl = '/lgwx/index.php/view/goods/getlist';

		this.garam = this.parse();

		this._param.num = 5;

		this._param.series_id = this.garam.series_id;

		this._param.brand_id = this.garam.brand_id;

		this.page = null;

		this.oCode = null;

		this.btnStr = '<button class="btn btn-sm btn-primary ml_1 mr_1" sc="pagebtn"></button>';

		this.oBack = $('[sc = back]');

		this.firsted = false;

	   }, {

	   	init: function() {

	   		this.render();

	   		this.events();

	   	},
	   	relation: function() {

			this.oBrand = $('[sc = brand]');
			this.oSeries = $('[sc = series]');

			var oRelated = new Related({
				oMain: this.oBrand,
				oSub: this.oSeries,
				MainUrl: '/lgwx/index.php/view/series/brandToSeries',
				SubUrl: '/lgwx/index.php/view/series/brandToSeries',
				firstLoad: false,
				tplMain: '',
				tplSub: '<option value="">选择系列</option>'+
				'{{each series_list}}'+
					'<option value="{{$value.series_id}}" id="{{$value.series_id}}">{{$value.series_name}}</option>'+
				'{{/each}}',
				paramName:'brand_id'
			});

			oRelated.init();

		},
	   	events: function() {

	   		//删除
	   		var that,
	   			removeUrl,
	   			removeId,
	   			nowList;

	   		that = this;	

	   		$(document).on('click', '[sc = remove]', function(){

				removeUrl = $(this).attr('href');
				removeId = $(this).attr('removeid');
				nowList = $(this).parents('[sc = list]');

				confirmBox.show();
				confirmBox.onConfirm = function(){

					var _this = this;

					that.requestUri = '/lgwx/index.php/post/goods/del';
					that.param.goods_id = removeId;
					//that.param.series_id = that._param.series_id;
					that.load();
					that.suc = function() {

						that._param.code = '';

						that.page.refresh( that._param );

						nowList.remove();
						_this.close();
						//closeBox.show();

					};

				};
				return false;

			});


	   		//查询
	   		var sCode;

			$(document).on('click', '[sc = search]', function(){

				that.oBrand = $('[sc = brand]');
	   			that.oSeries = $('[sc = series]');

				that._param.brand_id = that.oBrand.val();
				that._param.series_id = that.oSeries.val();
				that.page.refresh( that._param );

			});


	   	},
	   	render: function() {

	   		var _this = this;

	   		var _fenye = new Fenye(this.getDataUrl, this.tplId, this._param, function(){

	   			if( !_this.firsted ) {

	   				_this.firsted = true;
	   				
	   				_this.relation();
	   			}

	   		}, this.btnStr);
	   		
	   		this.page = _fenye;

	   	}

	});

	oGoods.init();


});