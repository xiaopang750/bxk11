define(function(require, exports, module) {
	
	var request = require('../lib/http/request');
	var template = require('../lib/template/template');

	/* 标签 */
	function Tag(options)
	{
		this.oInput = options.oInput || $('[script-role = tag_input]');
		
		this.oTipName = options.oTipName || $('[script-role = tip_name]');

		this.oChange = options.oChange || $('[script-role = change_btn]');

		this.oRelatedClose = options.oRelatedClose || $('[script-role = close_related_btn]');

		this.oRelatedWrap = options.oRelatedWrap || $('[script-role = relate_wrap]');

		this.oResultWrap = options.oResultWrap || $('[script-role = result_wrap]');

		this.oRelatedBox = options.oRelatedBox || $('[script-role = tag_wrap]');

		this.changeMax = options.changeMax || 15;

		this.maxTag = options.maxTag || 10;

		this.reqUrl = options.reqUrl || '/index.php/post/tagbyhot';

		this.frontDo = options.frontDo || null;

		this.BackDo = options.BackDo || null;

		this.addWay = options.addWay || null;

		this.temp = options.temp || '';

		this.limitLength = 10;

		this.errDo = options.errDo || null;

		this.data = [];

		this.pinyin = [];

		this.rndArr = [];

		this.result = [];
	}

	Tag.prototype = {

		init: function()
		{	
			var _this = this;

			this.loadData();

			this.addChageEvent();

			this.firstLoad();

			this.addRelatedEvent();

			this.clickSelect();

			this.addCloseEvent();

			this.removeEvent();

			this.blurEvent();
		},
		loadData: function()
		{	
			var _this = this;
			var result,
				pinyin,
				rnd,
				i,
				num;

			result = [];

			pinyin = [];

			rnd = [];

			request({

				url: this.reqUrl,

				async: 'false',

				sucDo: function(data)
				{	
					num = data.data.length;

					for(i=0; i<num; i++)
					{	
						result.push(data.data[i].name);	

						pinyin.push(data.data[i].pinyin);

						rnd.push(data.data[i].name);	
					}

					_this.pinyin = pinyin;

					_this.data = result;

					_this.rndArr = rnd;
				}
			});
		},
		addChageEvent: function()
		{
			var _this = this;

			this.oChange.click(function(){

				var newData = _this.rndData();

				_this.renderRecData(newData);

				return false;

			});
		},
		rndData: function()
		{	
			var newArr = [];
			var max = this.rndArr.length;
			var realLength;

			this.rndArr = this.rndArr.sort(function(){

				return Math.random() > 0.5 ? 1 : -1;

			});

			realLength = max > this.changeMax ? this.changeMax : max;

			for(var i=0; i<realLength; i++)
			{
				newArr.push(this.rndArr[i]);
			}

			return newArr;
		},
		renderRecData: function(newData)
		{	
			var html = '';
			var i;
			var num = newData.length;

			for(i=0; i<num; i++)
			{
				html += '<a script-role="relate_tag" href="javascript:;">' + newData[i] + '</a>';
			}

			this.oRelatedWrap.html(html);				
		},
		firstLoad: function()
		{
			this.oChange.trigger('click');
		},
		addRelatedEvent: function()
		{
			var _this = this;

			this.oInput.keyup(function(e){

				$(this).get(0).value = $(this).get(0).value.replace(/\s+/g,"");

				_this.related();

				_this.cutStr();
			});

			this.oInput.keydown(function(e){

				$(this).get(0).value = $(this).get(0).value.replace(/\s+/g,"");

				_this.inputSend(e.keyCode);

				_this.related();

				_this.cutStr();

			});
		},
		cutStr: function()
		{
			if(this.oInput.val().length > this.limitLength)
			{
				this.oInput.val(this.oInput.val().substring(0, this.limitLength));
			}
		},
		related: function()
		{
			var str = this.oInput.val();

			var i,
				num,
				result,
				sType;

			num = this.data.length;

			result = [];

			if(str)
			{	
				sType = 'relate';

				this.oRelatedWrap.html('');

				for(i=0; i<num; i++)
				{	
					if(this.pinyin[i].indexOf(str)!=-1 || this.data[i].indexOf(str)!=-1)
					{	
						result.push(this.data[i]);
					}
				}

				if(!result.length)
				{	
					this.wrapHide();
				}
				else
				{	
					this.wrapShow();

					this.renderRecData(result);	
				}
			}
			else
			{
				sType = 'rec';
			}

			this.changeType(sType);
		},
		changeType: function(sType)
		{
			if(sType == 'relate')
			{
				this.oTipName.html('是否想输入的是');

				this.oChange.hide();

				this.oRelatedClose.show();
			}
			else if(sType == 'rec')
			{
				this.oTipName.html('热门标签(每次15个热门标签)');

				this.oChange.show();

				this.oRelatedClose.hide();

				this.oChange.trigger('click');
			}
		},
		addCloseEvent: function()
		{	
			var _this = this;

			this.oRelatedClose.click(function(){

				_this.wrapHide();

			});
		},
		wrapHide: function()
		{
			this.oRelatedBox.hide();
		},
		wrapShow: function()
		{
			this.oRelatedBox.show();
		},
		inputSend: function(code)
		{	
			var _this = this;

			var str = this.oInput.val();

			if(code == 32 && str)
			{
				_this.makeReulst(str);
			}
		},
		clickSelect: function()
		{	
			var _this = this;

			this.oRelatedWrap.on('click', function(e){

				var oThis = $(e.target);

				if(oThis.attr('script-role') == 'relate_tag')
				{
					_this.makeReulst(oThis.html());
				}

			});
		},
		makeReulst: function(name)
		{	
			if(this.result.length >= this.maxTag )
			{

				this.errDo && this.errDo(this.maxTag, this.oInput);

				return;
			}

			var result = this.jude(name);

			var oSpan = $('<span script-role="result_tag" class="result_tag"></span>');

			if(result === true)
			{	
				if(this.temp)
				{
					var newJson = {};
					var str;
					var render;

					newJson.name = name;

					render = template.compile(this.temp);

					str = render(newJson);
				}
				else
				{
					var str =
					'<span script-role="result_name">'+ name +'</span>'+
					'<a class="tag_close button178" href="javascript:;" onfocus="this.blur()" script-role="tag_close" title="删除">删除</a>';
				}

				oSpan.html(str);

				if(this.addWay == 'normal')
				{
					this.oResultWrap.append(oSpan);
				}
				else
				{
					this.oResultWrap.prepend(oSpan);
				}

				this.oInput.val('');

				this.result.unshift(name);

				this.onchange && this.onchange();
			}
			else
			{	
				this.repeatDo(result);
			}
		},
		jude: function(name)
		{
			var i,
				num;

			num = this.result.length;

			for(i=0; i<num; i++)
			{
				if(this.result[i] == name)
				{	
					return i;
				}
			}

			return true;	
		},
		repeatDo: function(num)
		{
			this.shine(num);

			this.oInput.val('');
		},
		shine: function(index)
		{	
			var timer = null;
			var count = 0;
			var fps = 30;
			var max = 11;
			var front = '#f00';
			var back = '#ccc';
			var obj = $('[script-role = result_tag]').eq(index);
			var _this = this;

			timer = setInterval(function(){

				count ++ ;

				if(count%2 == 0)
				{	
					if(_this.frontDo)
					{	
						_this.frontDo(obj);
					}
					else
					{
						obj.css({background: front});
					}
				}
				else
				{	
					if(_this.BackDo)
					{	
						_this.BackDo(obj);
					}
					else
					{
						obj.css({background: back});
					}
					
				}

				if(count == max)
				{
					clearInterval(timer);
				}

			},fps);
		},
		removeEvent: function()
		{	
			var _this = this;

			this.oResultWrap.on('click', function(e){

				var oThis = $(e.target);

				if(oThis.attr('script-role') == 'tag_close')
				{	
					_this.deleteList(oThis);
				}

			});
		},
		deleteList: function(oThis)
		{
			var name = oThis.parents('[script-role = result_tag]').find('[script-role = result_name]').html();

			var num = this.result.length;

			for(var i=0; i<num; i++)
			{	
				if(this.result[i] == name)
				{	
					this.result.splice(i, 1);
				}
			}

			oThis.parent('[script-role = result_tag]').remove();			
		},
		blurEvent: function()
		{	
			var _this = this;

			/*this.oInput.blur(function(){

				_this.wrapHide();

			});*/
		},
		getData: function()
		{	
			return this.result;
		}

	}

	module.exports = Tag;

});