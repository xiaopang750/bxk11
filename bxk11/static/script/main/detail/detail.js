define(function(require, exports, module) {
	
	var bodyParse = require('../../lib/http/bodyParse');

	var global = require('../../lib/global/global');

	var request = require('../../lib/http/request');

	var template = require('../../lib/template/template');

	var saveData =require('../../lib/dom/saveData.js');

	var artical = require('../../sub/inspir/artical');

	var guess_fav = require('../../sub/detail/guess_fav');

	/* 判定url是否规范 */
	(function(){

		if(!bodyParse())
		{
			goHome();
		}
		else
		{
			if(!bodyParse().cid)
			{
				 goHome();
			}
			else
			{	
				var re = /^[0-9]+$/i;
				
				if(!re.test(bodyParse().cid))
				{
					 goHome();
				}
			}
		}

		function goHome()
		{
			window.location = '/index.php/user/home';
		}

	})();


	/* recent_view */
	(function(){

		var recentId,
			reqUrl,
			oRecnentWrap,
			html;

		oRecnentWrap = $('[script-role = recent_list]');
		recentId = 'recent_view';	
		reqUrl = '/index.php/view/content/recentlyView';

		request({
			url: reqUrl,
			sucDo: function(data)
			{	
				html = template.render(recentId, data);

				oRecnentWrap.html(html);
			}
		});

	})();

	/* detail */
	(function(){

		var contentId,
			headId,
			reqUrl,
			cid,
			headHtml,
			contentHtml,
			oHead,
			oContent,
			oList,
			guessFav;

		contentId = 'detail_content';
		headId = 'detail_head';
		reqUrl = '/index.php/view/content/design';
		cid = bodyParse().cid;
		oHead = $('[script-role = detail_head]');
		oList = $('[script-role = content_list_jia178]');
		oContent = $('[script-role = monsary_wrap]');
		guessFav = new guess_fav();

		request({
			url: reqUrl,
			data: {cid: cid},
			sucDo: function(data)
			{	
				saveData(oList, data.data);

				headHtml = template.render(headId, data.data);

				contentHtml = template.render(contentId, data.data);

				oHead.html(headHtml);

				oContent.html(contentHtml);

				artical($('[script-role = content_list_jia178]'));

				$('[effect-role = show_slide]').eq(1).trigger('click');

				guessFav.init();
			}
		});

	})();

});