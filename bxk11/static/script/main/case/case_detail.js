define(function(require, exports, module) {
	
	var global = require('../../lib/global/global');
	var request = require('../../lib/http/request');
	var bodyParse = require('../../lib/http/bodyParse');
	var template = require('../../lib/template/template');
	var arg = require('../../fnc/arg.js');
	var inputTip = require('../../fnc/inputTip.js');
	var globalFnDo = require('../../lib/module/globalFnDo');
	var saveData =require('../../lib/dom/saveData.js');
	var share = require('../../lib/share/createShare.js');
	
	function CaseDetail()
	{
		this.sType = this.judePage();

		this.urlData = bodyParse();

		this.getDataUrl = this.sType == 'scheme' ? '/index.php/view/scheme/info' : '/index.php/view/room/info';

		this.productUrl = '/index.php/view/room/bill';

		this.dataId = this.urlData ? (this.sType == 'scheme' ? this.urlData.sid : this.urlData.rid) : '';

		this.param = this.sType == 'scheme' ? {sid: this.dataId} : {rid: this.dataId};

		this.tplDetailId = this.sType == 'scheme' ? 'scheme_detail' : 'room_detail';

		this.tplFlashId = 'case_flash';

		this.tplProId = 'case_product';

		this.tplArgId = 'arg';

		this.oFlash = $('[script-role = case_flash]');

		this.oDetail = $('[script-role = detail_main]');

		this.oProduct = $('[script-role = product_wrap]');

		this.oArgWrap = $('[script-role = arg_wrap]');

		this.sinWidth = '';

		this.sumWidth = '';

		this.fail = null;
	}

	CaseDetail.prototype = {

		constructor: CaseDetail,
		init: function()
		{
			this.showDetail();
		},
		showDetail: function()
		{	
			var _this = this;

			this.load(this.getDataUrl, this.param, function(data){

				// showFlash
				_this.render(_this.oFlash, _this.tplFlashId, data.data);

				//showDetail
				_this.render(_this.oDetail, _this.tplDetailId, data.data);

				data.data.rid = data.data.rid || _this.dataId;

				data.data.type = _this.sType;

				saveData(_this.oDetail, data.data);

				//arg
				_this.render(_this.oArgWrap, _this.tplArgId, {});

				//room图片展示
				if(_this.sType == 'room')
				{
					var oUl,
						oLeft,
						oRight;

					oUl = $('[script-role = room_list_wrap]');
					oLeft = $('[script-role = room_left_btn]');
					oRight = $('[script-role = room_right_btn]');

					_this.roll(oUl, oLeft, oRight, 'room_list');
				}

				//showPin 
				_this.showPin();

				//showProduct
				_this.showProductList(data.data.rid);

				//showPinLun 
				
				_this.showPinLun();

				//share
				share($('[script-role = share_wrap]').get(0), data.data.room_thinking);
			});

		},
		changeRoom: function(name, dec)
		{	
			var oName = $('[script-role = room_name]');

			var oThink = $('[script-role = room_thinking]');

			oName.html(name);

			oThink.html(dec);
		},
		showProductList: function(rid)
		{	
			var _this = this;
			var oUl,
				oLeft,
				oRight;

			this.load(this.productUrl, {rid: rid}, function(data){

				_this.render(_this.oProduct, _this.tplProId, data.data);

				oUl = $('[script-role = product_roll_wrap]');

				oLeft = $('[script-role = product_left_btn]');

				oRight = $('[script-role = product_right_btn]');

				_this.roll(oUl, oLeft, oRight, 'product_roll_list');

				_this.oProduct.show();

			});

			this.fail = function()
			{
				this.oProduct.hide();
			};
		},
		roll: function(oUl, oLeft, oRight, listName)
		{	
			var aList,
				num;

			aList = oUl.find('[script-role = '+ listName +']');
			
			num = aList.length;	

			this.sinWidth = aList.eq(0).outerWidth(true);

			this.sumWidth = num * this.sinWidth;

			oUl.css({width: this.sumWidth});

			oUl.attr('iNow', '0');

			this.clickChange(oUl, oLeft, oRight, this.sinWidth, this.sumWidth, listName);
		},
		tab: function(oUl, n, dis)
		{	
			oUl.stop().animate({left: n * dis});
		},
		clickChange: function(oUl, oLeft, oRight, sinWidth, sumWidth, listName)
		{
			var n,
				num,
				_this,
				max;

			num = oUl.find('[script-role = '+ listName +']').length;

			_this = this;

			max = Math.floor((sumWidth - oUl.parent().width())/sinWidth);

			if(max <= 0)
			{
				oLeft.hide();

				oRight.hide();
			}

			oLeft.on('click', function(){

				n = oUl.attr('iNow');

				n ++ ;

				if(n > max) n = max;

				oUl.attr('iNow', n);

				_this.tab(oUl, -n ,sinWidth);
			});

			oRight.on('click', function(){

				n = oUl.attr('iNow');

				n -- ;

				if(n < 0) n = 0;

				oUl.attr('iNow', n);

				_this.tab(oUl, -n ,sinWidth);
			});
		},
		showPin: function()
		{	
			var oPinText = $('[script-role = pin_text]');
			var oPin = $('[script-role = pin]');

			var nWidth = oPinText.outerWidth(true) - oPin.outerWidth(true);

			oPinText.css({marginLeft: -(nWidth/2)});
		},
		showPinLun: function()
		{
			var oSendBtn = $('[script-role = pinlun_btn]');
			var oArea = $('[script-role = pinlun_textarea]');
			var oListWrap = $('[script-role = pinlun_wrap]');
			var oLoadMore = $('[script-role = pinlun_more]');
			var oNum = $('[script-role = pinlun_num]');
			var oTip = $('[script-role = pinlun_tip]');
			var getUrl = this.sType == 'scheme' ? '/index.php/view/scheme/getdiscu' : '/index.php/view/room/getdiscu';
			var pinLunUrl = this.sType == 'scheme' ? '/index.php/posts/scheme/adddiscu' : '/index.php/posts/room/adddiscu';
			var replyUrl = this.sType == 'scheme' ? '/index.php/posts/scheme/addreply' : '/index.php/posts/room/addreply';
			var data = {};
			this.sType == 'scheme' ? data.sid = this.dataId : data.rid = this.dataId;

			oInputTip = new inputTip({
				oArea : oArea,
				oTip : oTip 
			});

			oArguments = new arg({
				oSendBtn : oSendBtn,
				oLoadMore : oLoadMore,
				oListWrap : oListWrap,
				sUrl: getUrl,
				answerUrl: pinLunUrl,
				replyUrl: replyUrl,
				param: data,
				answerParam: data,
				oArea : oArea,
				articalId : 638,
				oNum: oNum,
				down: function()
				{
					oInputTip.clear();
				}
			});

			oArguments.init();

			oInputTip.init();
		},
		load: function(url, param, callBack)
		{	
			var _this = this;

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
					_this.fail && _this.fail();
				}
			});
		},
		render: function(oWrap, tplId, data)
		{
			var html = template.render(tplId, data);

			//var orgHtml = oWrap.html();

			oWrap.html(html);
		},
		judePage: function()
		{	
			var type;

			type = window.location.href.indexOf('scheme') !=-1 ? 'scheme' : 'room';

			return type;
		}

	};

	var oDetail = new CaseDetail();

	oDetail.init();

	window.getFlashData = function(value)
	{	
		if(oDetail.first)
		{
			var sName,
				sDec,
				sId,
				arr;

			arr = value.split(':');	

			sId = arr[0];
			sName = arr[1];
			sDec = arr[2];

			oDetail.changeRoom(sName, sDec);

			oDetail.showProductList(sId);
		}

		oDetail.first = true;
	}


	var pageDo = new globalFnDo({
		oWrap : $('[script-role = detail_main]'),
		listName: 'detail_main'
	});
	
	pageDo.init();


});