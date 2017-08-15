/**
 *description:商品选择弹框
 *author:fanwei
 *date:2014/06/26
 */
define(function(require, exports, module){

	var Fenye = require('../../widget/dom/fenye');
	var Related = require('../../widget/dom/related');
	var bodyParse = require('../../widget/http/bodyParse');

	function GoodsSelect(opts) {

		opts = opts || {};
		this.gparam = bodyParse();
		this.gid = this.gparam.goods_id || '';
		this.getDataUrl = '/lgwx/index.php/view/goods/selection_list';
		this.initParam = {p:1, num:5, series_id:'', brand_id: '', goods_id: this.gid};
		this.fenyeId = 'goods-tpl-info';
		this.oDataWrap = $('[sc = goods-list-wrap]');
		this.save = [];
		this.lastSave = [];
		this.confirmUrl = opts.confirmUrl || '';
		this.onConfirm = opts.onConfirm || null;
		this.MAX = 10;
		this.MIN = 2;

	}

	GoodsSelect.prototype = {

		init: function() {

			this.renderBox();

			this.events();

		},
		events: function() {


			var _this = this;

			//查询
			$(document).on('click', '[sc = goods-search-btn]', function(){

				_this.search();

			});

			//选择
			$(document).on('click', '[sc = goods-select-item]', function(){

				var nowId;

				nowId = $(this).attr('scid');

				if( _this.gid == nowId ) {
					
					alert('不能选择当前商品');
					return false;
				}

				_this.select($(this));

			});

			//确定
			$(document).on('click', '[sc = goods-confirm-select]', function(){

				_this.confirm($(this));

			});

		},
		search: function() {

			//查询方法
			var brand_id,
				series_id;

			brand_id = this.oBrand.val();
			series_id = this.oSeries.val();
			this.initParam.series_id = series_id;
			this.initParam.brand_id = brand_id;
			this.page.refresh( this.initParam );
		},
		select: function(oThis) {

			//选择
			var sTtype,
				sId,
				isChecked,
				i,
				num;

			sTtype = oThis.attr('type');
			sId = oThis.attr('scid');
			switch( sTtype ) {

				case 'radio':
					this.save[0] = sId;
				break;

				case 'checkbox':

					num = this.save.length;

					isChecked = oThis.attr('checked');

					if( isChecked ) {

						this.save.push(sId);

					} else {

						this.removeId(sId);

					}

				break;
			}
		},
		removeId: function(targetId) {

			var num;

			num = this.save.length;

			for (i=0; i<num; i++) {

				if( this.save[i] == targetId ) {

					this.save.splice(i, 1);
					this.lastSave.splice(i, 1);

				}

			}

		},
		confirm: function(oThis) {

			var _this,
				type,
				result;

			type = oThis.attr('type');
			result = this.check(type);

			if( result ) {
				this.upload();
			}
		},
		upload: function() {

			var param,
				_this;
			_this = this;
			param = {};
			param.goods_id = this.save.join(',');

			$.post(this.confirmUrl, param, function(data){

				if( !data.err ) {

					_this.copySave();
					_this.onConfirm && _this.onConfirm( data );

				} else {

					alert(data.msg);
				}

			}, 'json');

		},
		cancel: function() {

			this.copyLastSave();
			this.matchSelect( this.save );

		},
		copyLastSave: function(oArr) {

			var i,
				num;

			this.save = [];
			num = this.lastSave.length;

			for (i=0; i<num; i++) {
				this.save[i] = this.lastSave[i];
			}

		},
		copySave: function() {

			var i,
				num;

			this.lastSave = [];
			num = this.save.length;

			for (i=0; i<num; i++) {
				this.lastSave[i] = this.save[i];
			}

		},	
		check: function(type) {

			var num;

			num = this.save.length;

			if( type == 'single' ) {

				if( !num ) {
					alert('请选择');
					return false;
				} else {
					return true;
				}

			} else if( type == 'multi' ) {

				if( num < this.MIN || num > this.MAX ) {
					alert('请选择'+ this.MIN +'-'+ this.MAX +'个商品');
					return false;
				} else {
					return true;
				}

			}

		},
		renderBox: function() {

			var _this = this;

			var _fenye = new Fenye(this.getDataUrl, this.fenyeId, this.initParam, function(){

				_this.relation();
				_this.matchSelect(_this.save);

			}, null, this.oDataWrap);

	   		this.page = _fenye;

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
					'<option value="{{$value.series_id}}" id="{{$value.series_id}}" {{if $value.select == 1}}selected="selected"{{/if}}>{{$value.series_name}}</option>'+
				'{{/each}}',
				paramName:'brand_id'
			});

			oRelated.init();

		},
		matchSelect: function(vId) {

			//切换分页时匹配选中
			var aSid,
				nowInputSid,
				dataSid,
				arrId,
				k,
				num;

			aSid = $('[sc = goods-select-item]');
			num = vId.length;

			aSid.each(function(i){
				aSid.eq(i).removeAttr('checked');
			});	

			aSid.each(function(i){

				nowInputSid = aSid.eq(i).attr('scid');
				
				for (k=0; k<vId.length; k++) {

					dataSid = vId[k];

					if( nowInputSid == dataSid ) {
						aSid.eq(i).attr('checked', 'checked');
					}

				}

			});



		}

	};

	module.exports = GoodsSelect;

});