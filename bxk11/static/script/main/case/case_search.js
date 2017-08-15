define(function(require, exports, module) {
	
	var global = require('../../lib/global/global');
	var request = require('../../lib/http/request');
	var bodyParse = require('../../lib/http/bodyParse');
	var template = require('../../lib/template/template');
	var monsary = require('../../lib/plugin/dom/monsary');
	var jsonToUrl = require('../../lib/json/jsonToUrl');
	var saveData =require('../../lib/dom/saveData.js');
	var globalFnDo = require('../../lib/module/globalFnDo');
	
	function CaseSearch()
	{
		this.schemeDataUrl = '/index.php/view/scheme/search';

		this.roomDataUrl = '/index.php/view/room/search'

		this.scheme_temp_id = 'scheme_search';

		this.room_temp_id = 'room_search';

		this.getOptionUrl = this.judePage() == 'scheme' ? '/index.php/view/scheme/option' : '/index.php/view/room/option';

		this.optionTemp =
		'{{each data as $value $key}}' +
			'<div class="tiplist clearfix" type="{{$key}}">'+
			'<span class="pr_20 fl">{{$value.option_name}}</span>'+
			'<ul class="fl">'+
				'<li>'+
					'{{each $value.tag_list}}'+
					'<a href="#" tag_id="{{$value.tag_id}}" script-role="tag" location_type="{{$key}}">{{$value.tag_name}}</a>'+
					'{{/each}}'+
				'</li>'+
			'</ul>'+
			'</div>'+
		'{{/each}}'

		this.oTagWrap = $('[script-role = tag_wrap]');

		this.oInput = $('[script-role = case_search_area]');

		this.oSearchBtn = $('[script-role = case_search_btn]');

		this.oSearchWrap = $('[script-role = search_wrap]');

		this.paramListLength = 4;

		this.actClassName = 'act';

		this.paramData = {};
	}

	CaseSearch.prototype = {

		init: function()
		{	
			var _this = this;

			this.paramData = this.getParam();

			this.load(function(data){

				_this.renderTag(_this.oTagWrap, data);

				_this.showUrlData(_this.paramData);

				_this.location();

			});
		},
		getParam: function()
		{
			var t1,
				t2,
				t3,
				t4,
				keyword,
				sort,
				p,
				dataParam,
				newJson;

			newJson = {};

			dataParam = bodyParse();
			
			if(!dataParam)
			{
				t1 = '0';
				t2 = '0';
				t3 = '0';
				t4 = '0';
				keyword = '';
				sort = '1';
				p = '1';
			}
			else
			{
				t1 = dataParam.t1 ? dataParam.t1 : '0';	
				t2 = dataParam.t2 ? dataParam.t2 : '0';	
				t3 = dataParam.t3 ? dataParam.t3 : '0';	
				t4 = dataParam.t4 ? dataParam.t4 : '0';
				keyword = dataParam.keyword ? dataParam.keyword : '';
				sort = dataParam.sort ? dataParam.sort : '1';
				p = dataParam.p ? dataParam.p : '1';
			}	

			newJson.t1 = t1;
			newJson.t2 = t2;
			newJson.t3 = t3;
			newJson.t4 = t4;
			newJson.keyword = keyword;
			newJson.sort = sort;
			newJson.p = p;

			return newJson;
		},
		showUrlData: function(data)
		{	
			var i,
				num,
				_this;

			i = 0;
			num = this.paramListLength;
			_this = this;

			for (i=0; i<num; i++)
			{
				var aTag = this.oTagWrap.find('[type = t'+ (i+1) +']').find('[script-role = tag]');

				aTag.each(function(k){

					if(aTag.eq(k).attr('tag_id') == data['t' + (i+1)])
					{
						aTag.eq(k).addClass(_this.actClassName);
					}

				});
			}

			this.oInput.val(data.keyword);
		},
		load: function(callBack)
		{
			request({

				url: this.getOptionUrl,

				sucDo: function(data)
				{
					callBack && callBack(data);
				},
				noDataDo: function(msg)
				{
					alert(msg);
				}

			});
		},
		renderTag: function(oWrap, data)
		{
			var render = template.compile(this.optionTemp);

			var html = render(data);

			oWrap.html(html);
		},
		selectTag: function()
		{

		},
		judePage: function()
		{	
			var type;

			type = window.location.href.indexOf('scheme') !=-1 ? 'scheme' : 'room';

			return type;
		},
		location: function()
		{	
			var sType,
				oTarget,
				_this,
				url;

			_this = this;	

			this.oSearchWrap.on('click', function(e){

				oTarget = $(e.target);

				if(typeof(oTarget.attr('location_type')) != 'undefined')
				{
					sType = oTarget.attr('location_type');

					if(sType == 'sort')
					{
						_this.paramData[sType] = oTarget.attr('value');
					}
					else if(sType == 'keyword')
					{
						_this.paramData[sType] = _this.oInput.val();
					}
					else
					{
						_this.paramData[sType] = oTarget.attr('tag_id');
					}

					window.location = window.location.pathname + '?' + jsonToUrl(_this.paramData);
				}

			});
		}
	};

	var search = new CaseSearch();

	search.init();

	var type = search.judePage();
	var aList;

	if(type == 'scheme')
	{
		var mon = new monsary({
			oWrap: $('[script-role=monsary_wrap]'),
			url: search.schemeDataUrl,
			tplId: search.scheme_temp_id,
			param: search.paramData,
			isStartLoadingShow: 'false',
			renderDo: function(data)
			{
				aList = $('[script-role = content_list_jia178]');

				saveData(aList, data);
			}
		});

		mon.init();
	}
	else
	{	
		var mon = new monsary({
			oWrap: $('[script-role=monsary_wrap]'),
			url: search.roomDataUrl,
			tplId: search.room_temp_id,
			param: search.paramData,
			isStartLoadingShow: 'false',
			renderDo: function(data)
			{
				aList = $('[script-role = content_list_jia178]');

				saveData(aList, data);
			}
		});

		mon.init();
	}

	var pageDo = new globalFnDo({
		oWrap : $('[script-role = monsary_wrap]')
	});
	
	pageDo.init();

	
});