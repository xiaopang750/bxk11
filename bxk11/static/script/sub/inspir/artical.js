define(function(require, exports, module) {
	
	var globalFnDo = require('../../lib/module/globalFnDo');

	var imageLoad = require('../../lib/img/imageLoad');

	function artical(oMainWrap, options)
	{	
		var options = options || {};
		var clickBtn = options.imageBtn || 'true';

		/* smallDo */
		(function(){

			var pageDo = new globalFnDo({
				oWrap : oMainWrap
			});

			pageDo.init();

		})();

		/* show_head */
		(function(){

			var oWrap = $('[script-role=monsary_wrap]');

			oWrap.on('mouseover', function(e){

				showHideInfo(e, 'over');

			});

			oWrap.on('mouseout', function(e){

				showHideInfo(e, 'out');

			});

			function showHideInfo(e, type)
			{
				var oThis,
					oInfo,
					timer,
					delay,
					effectTime;

				oThis = $(e.target);

				timer = null;

				delay = 300;

				effectTime = 300;	

				if(oThis.attr('script-role') == 'user_head_area')
				{
					oInfo = oThis.parents('[script-role=content_list_jia178]').find('[script-role=user_head_list]');

					if(type == 'over')
					{	
						oInfo.stop(true,true).slideDown(effectTime);
					}
					else if(type == 'out')
					{
						timer = setTimeout(function(){

							oInfo.stop(true,true).slideUp(effectTime);

						},delay)

						oInfo.mouseover(function(){

							clearTimeout(timer);

						});

						oInfo.mouseleave(function(){

							$(this).stop(true,true).slideUp(effectTime);

						});	
					}
				}
			}

		})();

		/* show_image */
		(function(){

			var oWrap = $('[script-role = monsary_wrap]');
			var lock = false;

			oWrap.on('click', function(e){

				if( !lock )
				{
					lock = true;

					if(clickBtn != 'true')return;

					var oThis = $(e.target);

					if(oThis.attr('script-role') == 'image_list' || oThis.attr('script-role') == 'slide_up')
					{	
						var oList = oThis.parents('[script-role = content_list_jia178]');

						var oOrgTop = oList.offset().top;

						var oThisWrap = oThis.parents('[script-role = image_wrap]');

						var data = oList.data('info');

						var oLoading = oList.find('[script-role = pic_load]');

						if(!oList.attr('height'))oList.attr('height', oList.height());

						if(!oThisWrap.get(0).loaded)
						{	
							oThisWrap.get(0).loaded = true;

							showImage(data, oLoading, function(dataInfo){

								oLoading.hide();

								append(oThisWrap, dataInfo);

								oThisWrap.addClass('actw');

								oList.find('[script-role = slide_up]').html('收起全文');

							});
						}
						else
						{	
							lock = false;
							
							var oImageList = oThisWrap.find('[script-role = image_list_wrap]');

							var aNextAll = oImageList.eq(0).nextUntil('[script-role = slide_up]');

							var oSlide = oList.find('[script-role = slide_up]');

							var disTop = $(window).height() - parseInt(oList.attr('height'));

							if(oThisWrap.hasClass('actw'))
							{	
								oThisWrap.removeClass('actw');

								aNextAll.css({opacity:0});

								aNextAll.hide();

								oSlide.html('展开全文');

								$('body,html').stop().animate({scrollTop: oOrgTop - disTop});
							}
							else
							{	
								oThisWrap.addClass('actw');

								aNextAll.show();

								aNextAll.stop().animate({opacity:1});

								oSlide.html('收起全文');
							}
						}
					}

				}

			});

			function showImage(data, oLoading, callBack)
			{	
				var dataImage = data.pic_list;

				var num = dataImage.length;

				var arrImage = [];

				var arrAll = [];

				for (var i=0; i<num; i++)
				{	
					var newJson = {};

					newJson.url = dataImage[i].pic_url1;

					newJson.content = dataImage[i].pic_content;

					arrAll.push(newJson);

					arrImage.push(dataImage[i].pic_url1);
				}

				imageLoad(arrImage, function(){

					callBack && callBack(arrAll);

					lock = false;

				}, function(){

					oLoading.show();

				});
			}

			function append(oWrap, data)
			{	
				var i,
					num,
					oDiv,
					str,
					oA;

				oWrap.html('');

				num = data.length;

				oA = $('<a class="fr blue" href="javascript:;" script-role="slide_up">收起全文</a>');
				
				for (i=0; i<num ;i++)
				{
					oDiv = $('<div script-role="image_list_wrap"></div>');

					str = 
					'<img script-role="image_list" src='+ data[i].url +'>'+
					'<p>'+ data[i].content +'</p>';

					oDiv.html(str);

					oDiv.hide();

					oDiv.fadeIn();

					oWrap.append(oDiv);
		
				}

				oWrap.append(oA);
			}

		})();


		/* show_inspir */
		(function(){

			var oWrap = $('[script-role = monsary_wrap]');
			
			oWrap.on('click', function(e){

				var oThis = $(e.target);
				var left,
					width,
					reLeft,
					oList,
					oBot,
					oDot,
					aArea,
					aBtn,
					tabIndex;

				oList = oThis.parents('[script-role=content_list_jia178]');

				oBot = oList.find('[script-role=artical_bot]');

				oDot = oList.find('[script-role=artical_dot]');

				aBtn = oList.find('[effect-role=show_slide]');

				aArea = oList.find('[select-role=artical_fn]');

				if(oThis.attr('effect-role') == 'show_slide')
				{
					left = oThis.position().left;

					width = oThis.width();

					reLeft = parseInt(left + width/2);

					tabIndex = oThis.attr('tab-index');

					if(oThis.attr('down') == 'no')
					{	
						aBtn.each(function(i){

							if(aBtn.eq(i).get(0) == oThis.get(0))
							{	
								oThis.attr('down','yes')
							}
							else
							{	
								aBtn.eq(i).attr('down', 'no');
							}

						});

						showBot(oBot, oDot, reLeft, aArea, tabIndex);
					}
					else if(oThis.attr('down') == 'yes')
					{	
						oThis.attr('down', 'no');

						hideBot(oBot);
					}

				}	

			});

			function showBot(oBot, oDot, left, aArea, tabIndex)
			{	
				oBot.fadeIn();

				oDot.stop().animate({left: left},function(){

					aArea.eq(tabIndex).fadeIn().siblings().hide();

				});

			}

			function hideBot(oBot)
			{
				oBot.stop(true, true).slideUp(500)
			}

		})();

	}

	return artical;

});