/*
 *description:常用工具模块
 *author:fanwei
 *date:2013/11/01
 */
define(function(require, exports, module) {
	
	var request = require('../../lib/http/request');
	var template = require('../../lib/template/template');
	var bodyParse = require('../../lib/http/bodyParse');
	var saveData =require('../../lib/dom/saveData.js');

	function Until()
	{
		this.param = {};
		this.requestUri = '';
		this.tempWrap = null;
		this.tempId = null;
		this.data = null;
		this.async = 'true';
	}

	Until.prototype = {

		parse: function()
		{	
			//解析url参数
			return bodyParse();
		},
		load: function()
		{	
			//request
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
			//模板渲染
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

			this.requestUri = 'aaa.com';
			this.param.id = 2;
			this.laod();
	
		},
		extend: function(Parent, fnChildConstruct, fn)
		{	

			//继承
			function Child()
			{	
				Parent.apply(this, arguments);
				
				fnChildConstruct && fnChildConstruct.apply(this, arguments);
			}

			function clone(child, parent)
			{	
				for (var i in parent) 
				{	
			        var copy = parent[i];

			        if ( child === copy ) continue;

			        if ( typeof copy === "object" )
			        {

			            child.prototype[i] = clone(parent[i] || {}, copy);
			        }
			        else
			        {	
			            child.prototype[i] = copy;
			        }
			    }

			    return child;
			}

			clone(Child, Parent.prototype);

			/*for(var i in Until.prototype)
			{
				Child.prototype[i] = Until.prototype[i];
			}*/

			for(var i in fn)
			{
				Child.prototype[i] = fn[i];
			}

			return Child;
		},
		save: function(oWrap, data)
		{	

			//往dom上缓存数据
			saveData(oWrap, data);
		},
		log: function(str)
		{	

			//打印调试日志
			if(window.console)
			{
				console.log(str);
			}
		}

	};

	module.exports = Until;

});