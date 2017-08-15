/*
 *description:相册管理
 *author:fanwei
 *date:2014/05/26
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var dialog = require('../widget/dom/dialog');
	var Fenye = require('../widget/dom/fenye');
	var upload = require('../global/upload');

	var confirmBox = new dialog({
		title:"删除",
		content:"确定要删除该内容么？"
	});


	var oPhoto = until.extend(function(){

			this.getDataUrl = '/lgwx/index.php/view/wap/album';
			this.tplId = 'photo';
			this.btnStr = '<button class="btn btn-sm btn-primary ml_1 mr_1" sc="pagebtn"></button>';
			this._param = {};
			this._param.num = 16;
			this.removeUrl = '/lgwx/index.php/post/wap/delalbum';

		}, {

			init: function() {

				this.showPage();

				this.events();
			},
			events: function() {

				var oLayer,
					oList,
					removeParam,
					_this;

				_this = this;	

				$(document).on('mouseenter','[sc = data-list]', function(){

					oLayer = $(this).find('[sc = func]');

					oLayer.show();


				});


				$(document).on('mouseleave','[sc = data-list]', function(){

					oLayer = $(this).find('[sc = func]');

					oLayer.hide();

				});


				$(document).on('click', '[del-url]', function(){

					oList = $(this).parents('[sc = data-list]');
					removeParam = $(this).attr('del-url');

					_this.removePic(oList, removeParam);

				});


				//上传即时刷新view接口
				jia178UploadCb = function() {

					_this.page.refresh( {p:1,num:16} );

				}

			},
			showPage: function() {

				var _this = this;

				var _fenye = new Fenye(this.getDataUrl, this.tplId, this._param, null, this.btnStr, null, function(data){

					return _this.joinData(data);

				});

	   			this.page = _fenye;

			},
			joinData: function(data) {

				//补全16条数据,若不满16条后面补空数据
				var list = data.data.album_list;
				var num = list.length;
				var max = 16;
		
				for (var i=num; i<max; i++) {

					var newJson = {};
					newJson.pic_url = '';
					list.push( newJson );

				}

				return data;
			},
			removePic: function(oList, url) {

				var _this = this;

				confirmBox.show();
				confirmBox.onConfirm = function() {

					var that = this;

					_this.requestUri = _this.removeUrl;
					_this.param.pic_url = url;
					_this.load();
					_this.suc = function() {

						_this.page.refresh( {p:1,num:16} );
						oList.html('');
						that.close();

					};

					_this.fail = function(data) {

						alert(data.msg);

					};

				};


				

			}

	});

	oPhoto.init();

});