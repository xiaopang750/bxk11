/*
 *description:手动添加公众号
 *author:fanwei
 *date:2014/04/20
 */
define(function(require, exports, module){

	var global = require('../global/global');
	var until = require('../lib/until/until');
	var ajaxForm = require('../widget/form/ajaxForm');
	var upload = require('../global/upload');
	var dialog = require('../widget/dom/dialog');
	var oTip = require('../widget/dom/tip');

	//map
	var oConfirmBox = new dialog({
		boxSelector: $('[sc = confirm-box]')
	});

	var oGoods = until.extend(function(){

			this.addTempId = 'hand-add';
			this.editTempId = 'hand-edit';
			this.subUrl = '';
			this.oForm = $('[script-bound = form_check]');
			this.aFile = null;
			this.getAddData = '/lgwx/index.php/view/weixin/add';
			this.getEditData = '/lgwx/index.php/view/weixin/edit';
			this.oLocation = $('[sc = location]');
			this.oStatus = $('[sc = test-status]');

		}, {


			init: function() {
				
				this.judge();

			},
			events: function(){

				var oTarget,
					sRole,
					oAppId,
					oAppSec,
					_this;

				oAppId = $('[sc = appid]');
				oAppSec = $('[sc = appsec]');
				_this = this;

				$(document).on('click', function(e){

					oTarget = $(e.target);
					sRole = oTarget.attr('sc');

					switch( sRole ) {

						//select
						case 'radio-type':
							_this.selectType( oAppId, oAppSec, oTarget.val() );
						break;

						case 'test-btn':

							oConfirmBox.show();

						break;

						case 'check-btn':
							_this.checkCode( oTarget );
						break;

						case 'copy-btn':
							_this.copy( oTarget );
						break;
					}

				});

			},
			selectType: function(oAppId, oAppSec, type){

				/*
					1为服务号,2为订阅号
				*/

				if ( type == 1 ) {

					oAppId.attr({
						ischeck: true
					});

					oAppSec.attr({
						ischeck: true
					});

					oAppId.removeAttr('disabled');
					oAppSec.removeAttr('disabled');

					this.nowType = '1';

				} else if ( type == 2 ) {

					oAppId.attr({
						ischeck: false,
						disabled: 'disabled'
					});

					oAppSec.attr({
						ischeck: false,
						disabled: 'disabled'
					});

					this.nowType = '2';

					/*oAppId.val('');
					oAppSec.val('');*/

				}

			},
			submission: function(type, sId) {

				var _this,
					oUrl,
					oToken;

				_this = this;
				oUrl = $('[sc = url]');
				oToken = $('[sc = token]');	

				var oForm = new ajaxForm({

					subUrl: this.subUrl,
					fnSumbit: function(data){

						if( _this.nowType == '2' ) {

							data.wx_appid = '';
							data.wx_appsecret = '';
						}

						data.wid = sId;						

					},
					sucDo: function(data) {

						if ( type!= 'edit' ) {

							//add
							_this.wid = data.data.wid;
							oUrl.val( data.data.api_url );
							oToken.val( data.data.api_token );
							oConfirmBox.show();

						} else {

							//edit
							window.location = data.data;

						}

					},
					failDo: function(data) {

						alert(data.msg);

					}

				});	

				oForm.upload();

			},
			checkCode: function( oThis ){

				var oCode,
					sCode,
					_this;

				oCode = $('[sc = code]');
				sCode = oCode.val();
				_this = this;

				if ( sCode && this.wid ) {

					this.requestUri = '/lgwx/index.php/post/weixin/auth';
					this.param.wid = this.wid;
					this.param.wx_rand = sCode;
					this.load();
					this.suc = function( data ){

						oThis.attr('disabled', 'disabled');

						_this.oStatus.removeClass('no');

						_this.oStatus.removeClass('wrong');

						_this.oStatus.addClass('right');

						oConfirmBox.onClosed = function() {

							window.location = data.data;

						};

					};

					this.fail = function( data ) {
					
						_this.oStatus.removeClass('no');

						_this.oStatus.addClass('wrong');
					}	

				}
			},
			judge: function() {

				//判断是否编辑
				var _this,
					status;

				//添加
				_this = this;
				this.requestUri = this.getAddData;
				this.param.wid = this.parse().wid;
				this.load();
				this.suc = function( data ) {

					status = data.data.wx_status;

					//非编辑
					if( status == '0' || status == '' ) {

						_this.subUrl = '/lgwx/index.php/post/weixin/add';
						_this.tempId = _this.addTempId;
						_this.tempWrap = _this.oForm;
						_this.data = data;
						_this.render();
						_this.submission( 'add', data.data.wid );
						_this.events();

					} else {



						_this.subUrl = '/lgwx/index.php/post/weixin/add_edit';
						_this.data = data;
						_this.tempId = _this.editTempId;
						_this.tempWrap = _this.oForm;
						_this.render();
						_this.submission( 'edit', data.data.wid );

					}

				};

				this.fail = function(data) {
					
					alert(data.msg);

				};

			},
			copy: function(oTarget) {

				var oInput = oTarget.parents('[script-role = check_wrap]').find('[copy-role]');
				var sValue = oInput.val();
				var oJsInput = oInput[0];

				if( window.clipboardData ) {

					window.clipboardData.setData('text', sValue);

					oTip.say( '已复制到剪贴版' );

				} else {

					oTip.say( '复制失败，请按ctrl+c复制' );

					if( oJsInput.setSelectionRange ) {

						oJsInput.setSelectionRange( 0, sValue.length );

					}

				}

			}

	});	


	oGoods.init();
});