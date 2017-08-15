/*
 *description:咨询管理
 *author:fanwei
 *date:2014/04/04
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var Fenye = require('../widget/dom/fenye');
	var bodyParse = require('../widget/http/bodyParse');
	var dialog = require('../widget/dom/dialog');
	var until = require('../lib/until/until');


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

		this._param = bodyParse();

		if ( !this._param ) return;

		this.tplId = 'info-list';

		this.getDataUrl = '/lgwx/index.php/view/information/getlist';

		this.removeUrl = '/lgwx/index.php/post/information/del';

		this._param.num = 5;

		this._param.keywords = '';

		this.page = null;

		this.oCode = null;

		this.btnStr = '<button class="btn btn-sm btn-primary ml_1 mr_1" sc="pagebtn"></button>';

		this.oBack = $('[sc = back]');

	   }, {

	   	init: function() {

	   		this.render();

	   		this.events();

	   	},
	   	events: function() {

	   		//删除
	   		var that,
	   			removeUrl,
	   			removeId,
	   			nowList;

	   		that = this;	

	   		$(document).on('click', '[sc = remove]', function(){

				removeUrl = that.removeUrl;
				removeId = $(this).attr('removeid');
				nowList = $(this).parents('[sc = list]');

				confirmBox.show();
				confirmBox.onConfirm = function(){

					var _this = this;

					that.requestUri = removeUrl;
					that.param.si_id = removeId;
					that.load();
					that.suc = function() {

						that._param.keywords = '';

						that.page.refresh( that._param );

						nowList.remove();
						_this.close();
						closeBox.show();

					};

				};
				return false;

			});


	   		//查询
	   		var sCode,
	   			infoId;

			$(document).on('click', '[sc = search]', function(){

				that._param.keywords = '';

				sCode = $('[sc = search-input]').val();
				infoId = $('[sc = info-search]').val();
				
				that._param.keywords = sCode;
				that._param.it_id = infoId;

				that.page.refresh( that._param );

			});


			//返回
			this.oBack.on('click', function(){

				window.history.back();

			});

	   	},
	   	render: function() {

	   		var _fenye = new Fenye(this.getDataUrl, this.tplId, this._param, null, this.btnStr);

	   		this.page = _fenye;

	   	}

	});

	oGoods.init();


});