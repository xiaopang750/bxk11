/*
 *description:微信回复
 *author:fanwei
 *date:2014/06/13
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var inputTip = require('../widget/dom/inputTip');
	var bodyParse = require('../widget/http/bodyParse');
	var oTip = require('../widget/dom/tip');
	var until = require('../lib/until/until');

	var oReply = until.extend(function(){

			this.oText = $('[sc = text-input]');
			this.oTextTip = $('[sc = text-tip]');
			this.oNavWrap = $('[sc = text-nav]');
			this.oSave = $('[sc = save-text]');
			this.oRemove = $('[sc = remove-text]');
			this.paramList = bodyParse();

		}, {

			init: function() {

				this.getPage();
				this.oInputTip = new inputTip( this.oText, this.oTextTip, 600 );
				this.oInputTip.start();
				this.events();

			},
			events: function() {

				var _this = this;

				this.oSave.on('click', function(){

					if( _this.oText.val() ) {

						_this.requestUri = '/lgwx/index.php/post/weixin/follow_mes_reply';
						_this.param = {
							service_token: _this.paramList.service_token,
							rwfr_type: _this.oText.attr('typed'),
							rwfr_content: _this.oText.val(),
							rwfr_id: _this.oText.attr('type-id')
						}
						_this.load();
						_this.suc = function(data) {
							oTip.say(data.msg);
							_this.showRemove();
							_this.insertId( data.data.rwfr_id );
						};
						_this.fail = function(data) {
							oTip.say(data.msg);
						};

					} else {

						oTip.say('内容不能为空');

					}
					

				});

				this.oRemove.on('click', function(){

					_this.requestUri = '/lgwx/index.php/post/weixin/follow_mes_del';
					_this.param = {
						rwfr_id: _this.oText.attr('type-id')
					}
					_this.load();
					_this.suc = function(data) {
						oTip.say(data.msg);
						_this.oText.val('');
						_this.insertId('');
						_this.hideRemove();
					};
					_this.fail = function(data) {
						oTip.say(data.msg);
					};

				});

			},
			getPage: function() {

				var _this = this;

				this.requestUri = '/lgwx/index.php/view/weixin/msg_reply_list';
				this.param = { service_token: this.paramList.service_token };
				this.load();
				this.suc = function( data ) {

					_this.oText.html( data.data.rwfr_content );
					_this.oText.attr('typed', data.data.rwfr_type);
					_this.insertId( data.data.rwfr_id );

					if( data.data.rwfr_id ) {

						_this.showRemove();
					}
					_this.oInputTip.calc();
					_this.tempWrap = _this.oNavWrap;
					_this.tempId = 'text-nav';
					_this.data = data;
					_this.render();					

				};	

			},
			showRemove: function() {

				this.oRemove.addClass('act');

			},
			hideRemove: function() {

				this.oRemove.removeClass('act');

			},
			insertId: function(id) {

				this.oText.attr('type-id', id);				

			}

	});

	oReply.init();

});