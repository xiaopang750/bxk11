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

			this.oWrap.on('touchstart', '[script-role = '+ _this.sTarget +']', function( e ){

				if ( !_this.lock ) {

					this.lock = true;

					/*oTarget = $(e.srcElement || e.target);

					sName = oTarget.attr('script-role');

					if ( sName == _this.sTarget ) {*/
						
					_this.fnDo && _this.fnDo.call(_this, $(this));

					/*}*/	

				}

			});

		},
		req: function( url, param, callBack ) {

			var _this = this;

			$.post(url, param, function(data){

				if ( data.err == 1 ) {

					oTip.text(data.msg);

					_this.lock = false;

				} else if( data.err == 2 ) {

					oTip.text(data.msg);

					setTimeout(function(){

						window.location = data.data;

					},1000);

				} else {

					callBack && callBack( data );

					_this.lock = false;

				}

			}, 'json');

		}

	}

	module.exports = Fndo;

});