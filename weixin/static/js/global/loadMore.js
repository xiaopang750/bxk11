define(function(require, exports, module){

	var template = require('../lib/template/template');

	function LaodMore( opts ) {

		opts = opts || {};

		this.btn = opts.btn || null;

		this.oWrap = opts.oWrap || null;

		this.row = opts.row || null;

		this.reqUrl = opts.reqUrl || null;

		this.sucDo = opts.sucDo || null;

		this.tplId = opts.tplId || null;

		this.p = 1;

		this.param = {};

		this.lock = false;

		this.max = '';
	}

	LaodMore.prototype = {

		init: function() {

			this.addEvent();

			this.req({row: this.row, p:1});

		},
		addEvent: function() {

			var _this = this;

			this.btn.on('click', function(){
				
				if ( !_this.lock ) {

					_this.lock = true;

					_this.p ++ ;

					if ( _this.p > _this.max ) {

						_this.p = _this.max;

						oTip.timeBtn = true;

						oTip.text('暂无更多数据');

						return;
					}

					_this.param.p = _this.p;

					_this.param.row = _this.row;

					_this.req(_this.param);

				}

			});

		},
		req: function(param) {

			var _this = this;

			oTip.timeBtn = false;
			oTip.text('加载中');

			$.post(this.reqUrl, param, function( data ){

				if ( !data.err ) {

					_this.max = Math.ceil( data.data.count / _this.row );

					oTip.hide();

					_this.render(data);

					_this.sucDo && _this.sucDo.call(_this, data);

					_this.lock = false;

				} else {

					oTip.text('暂无更多数据');

				}

			}, 'json');

		},
		render: function(data) {
			
			var html = template(this.tplId, data);

			var oNew = $(html);

			this.oWrap.append(oNew);

		}

	}

	module.exports = LaodMore;

});