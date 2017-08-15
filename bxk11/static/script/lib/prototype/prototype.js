define(function(require, exports, module) {
	
	var request = require('../../lib/http/request');
	var template = require('../../lib/template/template');
	var bodyParse = require('../../lib/http/bodyParse');
	var saveData =require('../../lib/dom/saveData.js');

	function Mvc()
	{
		this.param = {};
		this.requestUri = '';
		this.tempWrap = null;
		this.tempId = null;
		this.data = null;
		this.async = 'true';
	}

	Mvc.prototype = {

		parse: function()
		{
			return bodyParse();
		},
		load: function()
		{	
			var _this = this;

			var data = request({

				url: this.requestUri,

				data: this.param,

				async: this.async,

				sucDo: function(data)
				{	
					_this.suc && _this.suc(data);
				},
				noDataDo: function(msg)
				{	
					_this.fail && _this.fail(msg);
				}

			});

			return data;
		},
		render: function()
		{	
			if(!this.tempStr)
			{
				var oDom = $(template(this.tempId, this.data));	
			}
			else if(!this.tempId)
			{	
				var render = template.compile(this.tempStr);
				var str = render(this.data);
				var oDom = $(str);

			}

			this.addWay ? this.tempWrap.prepend(oDom) : this.tempWrap.append(oDom);
	
		},
		extend: function(fnChildConstruct, fn)
		{	
			function Child()
			{
				Mvc.apply(this, arguments);
				
				fnChildConstruct && fnChildConstruct.apply(this, arguments);
			}

			for(var i in Mvc.prototype)
			{
				Child.prototype[i] = Mvc.prototype[i];
			}

			for(var i in fn)
			{
				Child.prototype[i] = fn[i];
			}

			return new Child();
		},
		save: function(oWrap, data)
		{
			saveData(oWrap, data);
		}

	};

	module.exports = Mvc;

});