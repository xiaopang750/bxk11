/**
 *description:常用工具模块
 *author:fanwei
 *date:2013/11/01
 */

/**
	until模块提供
	1.解析search参数;
	  this.parse();

	2.ajaxload;
	  this.requestUri = '地址';
	  this.param = {}参数;
	  this.load();发送请求;
	  this.suc = function() {}成功回调;约定err:0是成功;
	  this.fail = function() {}失败回调;约定err:1是失败;

	3.模板渲染;
	  this.tempWrap = ele;
	  this.tempId = 'xxx'
	  this.data = data;
	  this.render();

	4.继承;
	  var oIndex = until.extend(构造函数,{});
	  第一个参数为function(){};
	  第二个参数为json;

	5.日志打印;
	  this.log('xxxx');

	bug:
	1.同时执行this.suc 异步回调suc事件会被覆盖;  
	2.继承的构造函数不能传参;
*/

define(function(require, exports, module) {
	
	var request = require('../../widget/http/request');
	var template = require('../template/template');
	var bodyParse = require('../../widget/http/bodyParse');

	function Until() {

		this.param = {};
		this.requestUri = '';
		this.tempWrap = null;
		this.tempId = null;
		this.data = null;
		this.async = 'true';
	}

	Until.prototype = {

		parse: function() {

			//解析url参数
			return bodyParse();
		},
		load: function(){	

			//request
			var _this = this;

			var data = request({

				url: this.requestUri,

				data: this.param,

				async: this.async,

				sucDo: function(data) {

					_this.suc && _this.suc(data);
				},
				noDataDo: function(data) {

					_this.fail && _this.fail(data);
				}

			});

			return data;
		},
		render: function() {	

			//模板渲染
			if(!this.tempStr) {	
				var oDom = $(template(this.tempId, this.data));	
			}
			else if(!this.tempId) {

				var render = template.compile(this.tempStr);
				var str = render(this.data);
				var oDom = $(str);
			}

			this.addWay ? this.tempWrap.prepend(oDom) : this.tempWrap.append(oDom);
	
		},
		extend: function(fnChildConstruct, fn) {	

			//继承
			function Child() {	

				Until.apply(this, arguments);
				
				fnChildConstruct && fnChildConstruct.apply(this, arguments);
			}

			function clone(child, parent) {

				for (var i in parent) {

			        var copy = parent[i];

			        if ( child === copy ) continue;

			        if ( typeof copy === "object" ) {

			            child.prototype[i] = clone(parent[i] || {}, copy);
			        }
			        else {	

			            child.prototype[i] = copy;
			        }
			    }

			    return child;
			}

			clone(Child, Until.prototype);

			for(var i in fn) {
				
				Child.prototype[i] = fn[i];
			}

			return new Child();
		},
		log: function(str) {	

			//打印调试日志
			if(window.console) {

				console.log(str);
			}
		}

	};

	module.exports = new Until();

});