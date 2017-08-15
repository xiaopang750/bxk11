define(function(require, exports, module) {
	
	var global = require('../../lib/global/global');
	var request = require('../../lib/http/request');
	var bodyParse = require('../../lib/http/bodyParse');
	var template = require('../../lib/template/template');
	var roll = require('../../lib/plugin/dom/roll');
	var globalFnDo = require('../../lib/module/globalFnDo');
	var saveData =require('../../lib/dom/saveData.js');

	function Product()
	{
		this.getDataUrl = '/index.php/view/product/info';
		this.getBrandListUrl = '/index.php/view/product/service';
		this.collectUrl = '/index.php/posts/product/like';
		this.roomUrl = '/index.php/view/product/room';

		this.urlInfo = bodyParse();
		this.pid = this.urlInfo ? this.urlInfo.pid : '';

		this.oDetailWrap = $('[script-role = product_detail_wrap]');
		this.oRoom = $('[script-role = scheme_list_wrap]');

		this.detailTplId = 'tpl_product_detail';
		this.brandTplId = 'tpl_brand_list';
		this.roomTplId = 'room_search';

	}

	Product.prototype = {

		init: function()
		{	
			var _this = this;

			this.load(this.getDataUrl, {pid: this.pid}, function(data){

				/* render detail */
				var arr = [];

				arr.length = data.data.product_hot;

				data.data.product_hot = arr;

				_this.render(_this.oDetailWrap, _this.detailTplId, data.data);

				_this.load(_this.getBrandListUrl, {pid: _this.pid, city:''}, function(data){

					/* render branList */
					_this.render($('[script-role = brand_list_wrap]'), _this.brandTplId, data);

					/* roll */
					_this.roll();

					/* collect */
					_this.collect($('[script-role = collect]'));	

				});	

			});

			this.load(this.roomUrl, {pid: this.pid}, function(data){
				
				/* render room */
				_this.loadRoom(data.data, _this.oRoom, _this.roomTplId);	

			});
			
		},
		roll: function()
		{	
			var oImage,
				oMain,
				sBigUrl;

			oRoll.oUl = $('[script-role = roll_main]');
			oRoll.oLeft = $('[script-role = left_btn2]');;
			oRoll.oRight = $('[script-role = right_btn2]');;
			oRoll.listName = 'roll_list';
			oRoll.start();

			oMain = $('[script-role = main_pic]');

			oRoll.clickDo = function(oThis)
			{
				oImage = oThis.find('img');

				sBigUrl = oImage.attr('_src');

				oMain.attr('src', sBigUrl)
			};	
		},
		load: function(url, param, callBack)
		{
			request({

				url: url,

				data: param,

				async: false,

				sucDo: function(data)
				{
					callBack && callBack(data);
				},
				noDataDo: function(msg)
				{
					//alert(msg);
				}
			});
		},
		render: function(oWrap, tplId, data)
		{
			var html = template.render(tplId, data);
			
			var orgHtml = oWrap.html();

			oWrap.html(orgHtml + html);
		},
		collect: function(oBtn)
		{	
			var _this = this,
				oThis;

			oBtn.on('click', function(){

				if($(this).attr('dis') == 'true')return;

				oThis = $(this);

				request({

					url: _this.collectUrl,

					data: {pid: _this.pid},

					sucDo: function(data)
					{	
						oThis.attr('dis', 'true');

						oThis.unbind('click');

						oThis.css({cursor:'default'});

						oThis.find('[script-role = collect_name]').html('已收藏');
					},
					noDataDo: function(msg)
					{
						alert(msg);
					}


				});

			});
		},
		loadRoom: function(data, oWrap, tplId)
		{
			var i,
				num,
				html,
				oList,
				oLi;

			num = data.length;

			html = '';

			for (i=0; i<num; i++)
			{	
				sNow = template(tplId, data[i]);

				oList = $(sNow);

				oWrap.append(oList);

				saveData(oList, data[i]);
			}
		}

	}

	var oProduct = new Product();

	var oRoll = new roll();

	var pageDo = new globalFnDo({
		oWrap : $('[script-role = scheme_list_wrap]')
	});
	
	pageDo.init();

	oProduct.init();
});