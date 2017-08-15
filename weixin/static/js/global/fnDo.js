define(function(require, exports, module){
	
	function Fndo( opts ) {

		opts = opts || {};

		this.oWrap = opts.oWrap;

		this.fnDo = opts.fnDo || null;

		this.sTarget = opts.sTarget || '';

		this.lock = false;

	}

	Fndo.prototype = {

		init: function() {

			this.addEvent();

		},
		addEvent: function() {

			var oTarget,
				sName,
				_this;

			_this = this;

			this.oWrap.on('click', function( e ){

				if ( !_this.lock ) {

					this.lock = true;

					oTarget = $(e.srcElement || e.target);

					sName = oTarget.attr('script-role');

					if ( sName == _this.sTarget ) {
						
						_this.fnDo && _this.fnDo.call(_this, oTarget);

					}	

				}

			});

		},
		req: function( url, param, callBack ) {

			var _this = this;

			$.post(url, param, function(data){

				if ( data.err ) {

					oTip.text('操作失败,请重试');

					_this.lock = false;

				} else {

					callBack && callBack( data );

					_this.lock = false;

				}

			}, 'json');

		}

	}

	module.exports = Fndo;

});