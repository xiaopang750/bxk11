/*
 *description:小的操作项如：删除，下架
 *author:fanwei
 *date:2014/04/14
 */
define(function(require, exports, module){
		
	var dialog = require('../../widget/dom/dialog');
	var until = require('../../lib/until/until');

	//确认框
	var confirmBox = new dialog({
		title:"删除",
		content:"确定要删除该内容么？"
	});

	var oOperation = until.extend(function(){

			this.reqParam = {};
			this.reqUrl = '';
			this.openBox = null;
			this.closeBox = null;

		}, {


			init: function() {

				this.events();

			},
			events: function() {

				var _this = this;

				$(document).on('click', function(e){

					oTarget = $(e.target);
					sRole = oTarget.attr('sc');

					switch( sRole ) {

						case 'remove':

							//删除
							_this.todo( oTarget, 'remove' );
							return false;
						break;

						case 'down':

							//下架
							_this.todo( oTarget, 'down' );
							return false;
						break;

						case 'closeshop':

							//停业
							_this.todo( oTarget, 'closeshop' );
							return false;
						break;

					}

				});	

			},
			todo: function(oTarget, type) {

				var scid,
					that;

				scid = oTarget.attr('scid');
				that = this;

				switch(type) {

					case 'remove':
						confirmBox.boxTitle().html('删除');
						confirmBox.boxContent().html('确定要删除该内容么？');
					break;

					case 'down':
						confirmBox.boxTitle().html('下架');
						confirmBox.boxContent().html('确定要将该品牌下架么？');
					break;

					case 'closeshop':
						confirmBox.boxTitle().html('停业');
						confirmBox.boxContent().html('确定要将该门店停业么？');
					break;
				}

				confirmBox.show();
				confirmBox.onConfirm = function(){

					var _this = this;
					that.openBox && that.openBox.call(that, scid, type);
					that.requestUri = that.reqUrl;
					that.param = that.reqParam;
					that.load();
					that.suc = function( data ) {

						switch(type) {

							case 'remove':
								window.location = window.location;
							break;

							case 'down':
								oTarget.html('上架');
								oTarget.attr('href',data.data);
								oTarget.removeAttr('sc');
							break;

							case 'closeshop':
								oTarget.html('开业');
								oTarget.attr('href', data.data);
								oTarget.removeAttr('sc');
							break;
						}

						_this.close();

					};

					that.fail = function (data) {

						alert( data.msg );

					};

				}

			}	
	});

	oOperation.init();

	module.exports = oOperation;

});