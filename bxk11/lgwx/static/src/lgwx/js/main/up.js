/*
 *description:升级
 *author:fanwei
 *date:2014/6/10
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');


	var oUp = until.extend(function(){

			this.oUpGradeBtn = $('[sc = upgrade]');
			this.nowScore = $('[sc = get-score]');
			this.nowLevelName = $('[sc = level-name]');
			this.upgradeUrl = 'aa';

		}, {

			init: function() {

				this.events();

			},
			events: function() {

				var _this = this;

				this.oUpGradeBtn.on('click', function(){

					_this.requestUri = _this.upgradeUrl;
					_this.load();

					_this.suc = function(data) {

						_this.nowScore.html( data.data );
						_this.nowLevelName.html( data.data );

					};

					_this.fail = function(data) {

						alert(data.msg);

					}

				});	

			}

	});

	oUp.init();
});