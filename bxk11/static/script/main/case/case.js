define(function(require, exports, module) {
	
	var global = require('../../lib/global/global');
	var request = require('../../lib/http/request');
	var template = require('../../lib/template/template');

	function CaseIndex()
	{
		this.getDataUrl = '/index.php/view/scheme/index';

		this.param = '';

		this.oMain = $('[script-role = case_main]');

		this.tempId = 'case_index';
	}

	CaseIndex.prototype = {

		init: function()
		{
			var _this = this;

			this.load(function(data){

				_this.render(_this.oMain, data);

				_this.tab();

				_this.rank();

			});
		},
		load: function(callBack)
		{	
			request({

				url: this.getDataUrl,

				sucDo: function(data)
				{
					callBack && callBack(data);
				}
			});
		},
		render: function(oWrap, data)
		{	
			var str = template(this.tempId, data);

			oWrap.html(str);
		},
		tab: function()
		{	
			var index,
				aRightWrap,
				aContent,
				aList;

			aRightWrap = $('[script-role = right_list_wrap]');
			aContent = $('[script-role = main_tab_content]');	
			aList = $('[script-role = list]');

			aContent.eq(0).show();
			aList.eq(0).addClass('act');

			aRightWrap.on('mouseenter', '[script-role = list]', function(){	

				index = $(this).index();

				$(this).addClass('act').siblings('[script-role = list]').removeClass('act');

				aContent.eq(index).show().siblings('[script-role = main_tab_content]').hide();

			});
		},
		rank: function()
		{
			var oRankWrap = $('[script-role = rank_wrap]');
			var aList = $('[script-role = rank_list]');
			aList.eq(0).addClass('act');
			aList.eq(0).find('[script-role = num_bg]').addClass('actb');

			oRankWrap.on('mouseenter', '[script-role = rank_list]', function(){

				$(this).addClass('act').siblings().removeClass('act');

				$(this).find('[script-role = num_bg]').addClass('actb').parents($(this)).siblings().find('[script-role = num_bg]').removeClass('actb');

			});
		}

	};

	var oCase = new CaseIndex();

	oCase.init();	

});