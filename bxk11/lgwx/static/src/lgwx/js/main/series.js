/*
 *description:品牌系列管理
 *author:fanwei
 *date:2014/04/04
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var dialog = require('../widget/dom/dialog');

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

	var oSeries = until.extend(function(){

			this.reqUrl = "/lgwx/index.php/view/series/getlist";
			this.tplId = "series";
			this.oWrap = $('[sc = series]');

		}, {


			init: function() {

				this.renderPage();

				this.events();
			},
			events: function() {

				var that,
					isSlide,
					oSlide;

				that = this;	

				//展开收起
				this.oWrap.on('click', '[sc = slide]', function(){

					oSlide = $(this).parents('[sc = list-wrap]').find('[sc = slide-content]');

					isSlide = oSlide.is(':visible');

					if ( isSlide ) {

						oSlide.stop(true, true).slideUp();

						$(this).html('展开');

					} else {

						oSlide.stop(true, true).slideDown();

						$(this).html('收起');

					}


				});


				//删除
				var removeUrl = '';
				var removeId = '';

				$(document).on('click', '[sc = remove]', function(){

					var now = $(this);

					removeUrl = now.attr('href');
					removeId = now.attr('removeid');

					confirmBox.show();
					confirmBox.onConfirm = function(){

						var _this = this;

						that.requestUri = removeUrl;
						that.param.series_id = removeId;
						that.load();
						
						that.suc = function() {

							now.parent('[sc = list]').remove();
							_this.close();

						};

					};
					return false;

				});

			},
			renderPage: function() {

				var that = this;

				this.requestUri = this.reqUrl;
				this.load();
				this.suc = function( data ) {

					that.tempWrap = that.oWrap;
					that.tempId = that.tplId;
					that.data = data;
					that.render();

				};
			}	

	});

	oSeries.init();


});