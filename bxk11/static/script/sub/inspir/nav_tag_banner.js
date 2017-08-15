define(function(require, exports, module) {
	
	var bodyParse = require('../../lib/http/bodyParse');

	var template = require('../../lib/template/template');

	var request = require('../../lib/http/request');

	var param,
		type,
		tag;

	param = bodyParse() ?  bodyParse() : {};
	type = param.type ? param.type : '';
	tag = param.tag ? param.tag : '';

	//nav;
	(function(){

		var aNav,
			sPageType

		aNav = $('[script-role=inspir_nav]');
		sPageType = $('[script-role=page_type]').attr('page_type');
		
		//当前导航高亮
		aNav.each(function(i){

			if(aNav.eq(i).html() == sPageType)
			{
				aNav.eq(i).addClass('actb');
			}

		});

		//点击跳转
		aNav.click(function(){
			
			var sHref;

			if(!tag)
			{
				sHref = $(this).attr('href') + '?type=' + type;
			}
			else
			{
				sHref = $(this).attr('href') + '?type=' + type + '&tag=' + tag;
			}

			$(this).attr('href', sHref);

		});

	})();

	//tag_banner
	(function(){

		function Tag()
		{
			this.tmpId = 'inspir_tag';
			this.reqUrl = '/index.php/view/tag/taginfo';
			this.oWrap = $('[script-role=tag_wrap]');
			this.html = '';
			this.bannerhtml = '';
			this.oDataWrap = null;
			this.oShowAll = null;
			this.aTag = null;

			this.bannerTempId = 'inspir_banner';
			this.oBanner = $('[script-role=inpir_banner]');
		}

		Tag.prototype = {

			init: function()
			{	
				var _this = this;

				this.load(function(data){

					_this.renderTag(data);
					
					_this.renderBanner(data.data.taginfo);

					_this.addShowAllEvent();

					_this.matchTag();

				});
			},
			load: function(callBack)
			{
				request({
					url: this.reqUrl,
					data: {type:type, tag:tag},
					sucDo: function(data)
					{
						callBack && callBack(data);
					}
				});
			},
			renderTag: function(data)
			{	
				this.html = template.render(this.tmpId, data.data);

				this.oWrap.html(this.html);
			},
			renderBanner: function(data)
			{	
				var oBook = $('[script-role = book]');
				var target = '/index.php/posts/tag/take';

				this.bannerhtml  = template.render(this.bannerTempId, data);

				this.oBanner.html(this.bannerhtml);

				/* 订阅 */
				if(data.id)
				{
					oBook.show();

					if(data.is_take == '0')
					{
						oBook.click(function(){

							request({
								url: target,
								data: {tid: data.id},
								sucDo: function()
								{	
									alert('订阅成功');
									oBook.unbind('click');
									oBook.find('[script-role = book_text]').text('已订阅');
								}
							})

						});
					}
					else
					{
						oBook.find('[script-role = book_text]').text('已订阅');
						oBook.find('a').css({cursor: 'default'});
					}
				}
				else
				{
					oBook.hide();
				}

			},
			addShowAllEvent: function()
			{
				var _this = this;

				this.oShowAll = $('[script-role=show_all]');

				this.oShowAll.click(function(){

					$(this).hide();

					_this.showAllTag();

				});
			},
			showAllTag: function()
			{	
				var afterHeight,
					oWrapHeight,
					orgHeight,
					dis;

				this.oDataWrap = $('[script-role=data_wrap]');

				orgHeight = this.oDataWrap.outerHeight();

				afterHeight = this.oDataWrap.get(0).scrollHeight;

				dis = afterHeight - orgHeight;

				oWrapHeight = this.oWrap.outerHeight();

				this.oDataWrap.stop().animate({height: afterHeight});

				this.oWrap.stop().animate({height: oWrapHeight + dis});
			},
			matchTag: function()
			{	
				var _this = this;

				this.aTag = $('[script-role=tag]');

				this.aTag.each(function(i){

					if(_this.aTag.eq(i).html() == tag)
					{	
						_this.aTag.eq(i).prependTo($('[script-role=data_wrap]'));

						_this.aTag.eq(i).addClass('actb');
					}

				});
			}
		}

		var oTag = new Tag();

		oTag.init();

	})();

});