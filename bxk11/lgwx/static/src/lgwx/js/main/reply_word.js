/*
 *description:关键词自动回复
 *author:fanwei
 *date:2014/06/13
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var inputTip = require('../widget/dom/inputTip');
	var bodyParse = require('../widget/http/bodyParse');
	var oTip = require('../widget/dom/tip');
	var until = require('../lib/until/until');
	var oTip = require('../widget/dom/tip');
	var dialog = require('../widget/dom/dialog');

	var infoBox = new dialog({
		boxSelector:'[sc = info-box]'
	});

	var oReply = until.extend(function(){

			this.paramList = bodyParse();
			this.oNavWrap = $('[sc = text-nav]');
			this.oListWrap = $('[sc = list-wrap]');
			this.oAdd = $('[sc = add-rule]');
			this.oInfoSave = $('[role = save-btn]');
			this.lock = false;
			this.infoFirstLoad = false;
			this.reply_id = '';
			this.nowPicWrap = null;
			this.paramList = bodyParse();

		}, {

			init: function() {

				this.getPage();
				
				this.events();
			},
			events: function() {

				var _this = this;
				var orgdata = {
					data:{
						reply_text_list: [
							{
				                "reply_id": "",
				                "reply_keyword": "",
				                "reply_type": "1",
				                "reply_type_mes": "",
				                "reply_top_mes": "",
				                "reply_content": ""
				            }
						]
					}
				}

				//add
				var oNewAdd,
					oNewContent;
				this.oAdd.on('click', function(){

					if( !_this.lock ) {

						_this.lock = true;
						_this.addWay = 'prepend';
						_this.showList( orgdata );
						oNewAdd = $('[sc = slide-btn]').eq(0);
						oNewContent = $('[sc = slide-wrap]').eq(0);
						_this.wrapShow( oNewContent, oNewAdd);	

					}

				});

				//slide
				var isSlided,
					oWrap;

				$(document).on('click', '[sc = slide-btn]', function(){

					isSlided = $(this).attr('is-slide');
					oWrap = $(this).parents('[sc = list]').find('[sc = slide-wrap]');

					if( isSlided == 'no' ) {

						_this.wrapShow( oWrap, $(this) );

					} else {


						_this.wrapHide( oWrap, $(this) );
					}

				});


				//select
				$(document).on('click', '[sc = text-add]', function(){

					_this.judeType( $(this) );
				});


				//select
				$(document).on('click', '[sc = pic-add]', function(){

					_this.judeType( $(this) );
				});

				//选择资讯列表
				$(document).on('click', '[sc = info-select-list]', function(){

					_this.selectInfoList( $(this) );

				});


				//saveInfo
				this.oInfoSave.on('click', function(){

					_this.saveInfo( $(this) );

				});

				//remove
				var nowRId,
					nowList;
				$(document).on('click', '[sc = remove]', function(){

					nowRId = $(this).attr('data-id');
					nowList = $(this).parents('[sc = list]');

					if( !nowRId ) {

						nowList.remove();
						_this.lock = false;

					} else {

						var oConfirm = confirm('确认删除吗?');

						if( oConfirm ) {

							_this.requestUri = '/lgwx/index.php/post/weixin/reply_text_img_del';
							_this.param = {reply_id: nowRId};
							_this.load();
							_this.suc = function(data) {

								oTip.say( data.msg );
								window.location = window.location;

							};

							_this.fail = function(data) {

								oTip.say( data.msg );

							}

						}

					}

				});


				//save-list
				$(document).on('click', '[sc = save]', function(){

					_this.saveList( $(this) );

				});

			},
			getPage: function() {

				var _this = this;

				this.requestUri = '/lgwx/index.php/view/weixin/text_reply_list';
				this.param = { service_token: this.paramList.service_token };
				this.load();
				this.suc = function( data ) {

					_this.tempWrap = _this.oNavWrap;
					_this.tempId = 'text-nav';
					_this.data = data;
					_this.render();
					_this.showList(data);				

				};	

			},
			showList: function(data) {

				this.tempWrap = this.oListWrap;
				this.tempId = 'list';
				this.data = data;
				this.render();	

			},
			wrapShow: function(oWrap, oBtn) {

				oBtn.attr('is-slide', 'yes');
				oBtn.html('收起');
				oWrap.show();
			},
			wrapHide: function(oWrap, oBtn) {

				oBtn.attr('is-slide', 'no');
				oBtn.html('展开');
				oWrap.hide();

			},
			judeType: function(oSelectBtn) {

				var _this,
					type,
					nowReplyId,
					nowPicWrap,
					nowSave,
					oParent;

				type = oSelectBtn.attr('type');
				oParent = oSelectBtn.parents('[sc = list]');
				nowReplyId = oSelectBtn.attr('reply_id');
				nowPicWrap = oParent.find('[sc = info-link-wrap]');
				nowSave = oParent.find('[sc = save]');
				nowSave.attr('type', type);

				_this = this;

				if( type == 2 ) {

					if( !this.infoFirstLoad ) {

						this.infoFirstLoad = true;
						this.nowPicWrap = nowPicWrap;
						this.renderInfo(function(){

							infoBox.show();	
							_this.reply_id = nowReplyId;
						});

					} else {

						this.initInfoBox();
						infoBox.show();

					}
				}

				var oContent = oSelectBtn.parents('[sc = list]').find('[sc = show-wrap]').find('[type = '+ type +']');
				oContent.show().siblings().hide();

			},
			renderInfo: function(callBack) {

				var _this = this;

				this.requestUri = '/lgwx/index.php/view/weixin/diy_menu_information_list';
				this.load();
				this.suc = function(data) {

					_this.tempWrap = $('[sc = info-box-wrap]');
					_this.data = data;
					_this.tempId = 'info-box-list';
					_this.render();
					callBack && callBack();

				};

			},
			saveInfo: function() {

				var nowId,
					sValue,
					aInfoList,
					param,
					_this;

				sValue = [];
				_this = this;
				aInfoList = $('[sc = info-select-list]');
				aInfoList.each(function(i){

					if( aInfoList.eq(i).hasClass('active') ) {

						nowId = aInfoList.eq(i).attr('sid');
						sValue.push( nowId );	
					}

				});

				if( !sValue.length ) {

					oTip.say( '请至少选择一条资讯' );

					return;
				}

				sValue = sValue.join(',');
				param = {reply_content:sValue,reply_type:2,reply_id: this.reply_id};


				$.post('/lgwx/index.php/post/weixin/information_selected_list', param , function(data){

					_this.nowPicWrap.attr('idlist', data.data.reply_selected);
					_this.showPicData( _this.nowPicWrap, data.data );
					infoBox.close();

				}, 'json');
			},
			selectInfoList: function(oThis) {

				//选择资讯列表

				var isHasSelect;

				isHasSelect = oThis.hasClass('active');

				isHasSelect ? oThis.removeClass('active') : oThis.addClass('active');

				
			},
			showPicData: function(oWrap, data) {

				oWrap.html('');
				this.tempWrap = oWrap;
				this.data = data;
				this.tempId = 'photo-list';
				this.render();

			},
			initInfoBox: function() {

				var aInfoList;

				aInfoList = $('[sc = info-select-list]');

				aInfoList.removeClass('active');

			},
			saveList: function(oBtn) {

				var oList,
					oKey,
					oTextReply,
					oPicReply,
					sKey,
					sTextReply,
					sPicReply,
					nowType,
					listId,
					param,
					nowId;

				oList = oBtn.parents('[sc = list]');
				oKey = oList.find('[sc = key]');
				oTextReply = oList.find('[sc = area]');
				oPicReply = oList.find('[sc = photo-view]');
				nowType = oBtn.attr('type');
				listId = oList.find('[sc = info-link-wrap]').attr('idlist');
				nowId = oBtn.attr('data-id') ? oBtn.attr('data-id') : '';
				param = {};

				sKey = /^\S{1,30}$/.test( oKey.val() );
				sTextReply = /^(.|\n){1,300}$/.test( oTextReply.val() );
				sPicReply = oPicReply.length;

				if( !sKey ) {

					oTip.say('请填写关键字');

					return;

				} else {

					if( nowType == 1 ) {

						if( !sTextReply ) {

							oTip.say('请填写回复');

							return;

						}

						param.reply_content = oTextReply.val();

					} else if( nowType == 2 ) {

						if( !sPicReply ) {

							oTip.say('请填写回复');

							return;

						}

						param.reply_content = listId;

					}

				}

				param.reply_keyword = oKey.val();
				param.reply_type = nowType;
				param.reply_id = nowId;
				param.service_token = this.paramList.service_token;

				this.requestUri = '/lgwx/index.php/post/weixin/text_imageadd';
				this.param = param;
				this.load();
				this.suc = function(data) {

					oTip.say( data.msg );
					window.location = window.location;

				};

				this.fail = function(data) {

					oTip.say( data.msg );

				};

			}

	});

	oReply.init();

});