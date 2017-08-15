/*
 *description:微信公众号管理
 *author:fanwei
 *date:2014/04/04
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var bodyParse = require('../widget/http/bodyParse');
	var dialog = require('../widget/dom/dialog');
	var until = require('../lib/until/until');


	//确认框
	var confirmBox = new dialog({
		title:"删除",
		content:"确定要删除该内容么？"
	});

	//关闭框
	var closeBox = new dialog({
		title:"删除",
		content:"删除成功！",
		type:'close'
	});

	var oWeixinManage = until.extend(function(){

		this._param = bodyParse();

		if ( !this._param ) return;

		this.tplId = 'weixin-manage-list';
		this.getDataUrl = '/lgwx/index.php/view/weixin/getlist';
		this.removeUrl = '/lgwx/index.php/post/weixin/del';
		this.setUrl = '/lgwx/index.php/post/weixin/set_default';
		this.oWrap = $('[script-role = data_wrap]');

	   }, {

	   	init: function() {

	   		this.showPage();

	   		this.events();

	   	},
	   	events: function() {

	   		//删除
	   		var that,
	   			oTarget,
	   			sRole;

	   		that = this;	

	   		$(document).on('click', function(e){

	   			oTarget = $(e.target);
	   			sRole = oTarget.attr('sc');

	   			switch( sRole ) {

	   				case 'remove':

	   					that.remove( oTarget );

	   					return false;
	   				break;

	   				case 'set':
	   					that.set( oTarget );
	   				break;

	   			}

			});

	   	},
	   	showPage: function() {

	   		var _this = this;

	   		this.requestUri = this.getDataUrl;
	   		this.load();
	   		this.suc = function(data) {

	   			_this.tempId = _this.tplId;
	   			_this.tempWrap = _this.oWrap;
	   			_this.data = data;
	   			_this.render();

	   		};
	   	},
	   	set: function(oTarget) {

	   		var setid,
	   			isSet,
	   			aSet;

	   		setid = oTarget.attr('setid');
	   		isSet = oTarget.attr('is_set');
	   		aSet = $('[sc = set]');

	   		if ( isSet != '1' ) {

	   			unset( aSet );

	   			this.requestUri = this.setUrl;
	   			this.param.wid = setid;
	   			this.load();
	   			this.suc = function() {

	   				set( oTarget );

	   			};

	   		}

	   		function set(obj) {
	   			obj.attr('is_set', '1');
	   			obj.html('已默认');
	   		}

	   		function unset(obj) {
	   			obj.attr('is_set', '0');
	   			obj.html('设为默认');
	   		}

	   	},
	   	remove: function(oTarget) {

	   		var	removeId,
	   			nowList,
	   			that;

	   		that = this;
			removeId = oTarget.attr('removeid');
			nowList = oTarget.parents('[sc = list]');

			confirmBox.show();
			confirmBox.onConfirm = function(){

				var _this = this;

				that.requestUri = that.removeUrl;
				that.param.wid = removeId;
				that.load();
				that.suc = function() {
					
					nowList.remove();
					_this.close();
					closeBox.show();

				};

				that.fail = function(data) {

					alert(data.msg);

					_this.close();

				};

			};	

	   	}

	});

	oWeixinManage.init();


});