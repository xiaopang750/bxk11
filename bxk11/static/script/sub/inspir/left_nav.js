define(function(require, exports, module) {
	
	var template = require('../../lib/template/template');

	var request = require('../../lib/http/request');

	function Leftnav()
	{	

		this.oContent  = $('[script-role = left_nav]');

		this.render();

		
		this.aTitle = $('[script-role=click_title]');
		this.aContent = $('[script-role=click_content]');
		this.aTag = $('[script-role=click_tag]');
		this.aBg  =$('[script-role=click_bg]');
		this.sBgActClass = 'actb';
		this.sTitleActClass = 'slide';
		
	}

	Leftnav.prototype = {

		init: function(str)
		{	
			var _this = this;

			this.aTag.each(function(i){

				if(str == _this.aTag.eq(i).html())
				{		
					_this.aTag.eq(i).addClass(_this.sBgActClass);

					_this.aTag.eq(i).parents('[script-role=click_content]').show();

					_this.aTag.eq(i).parents('[script-role=list_wrap]').find('[script-role=click_bg]').addClass(_this.sBgActClass);
				}

			});

			this.addEvent();
		},
		render: function()
		{
			var tempId,
				reqUrl,
				oLeftNav,
				html,
				_this;

			tempId = 'inspir_leftnav';
			reqUrl = '/index.php/view/tag/classlist';
			_this = this;

			request({
				url: reqUrl,
				async:'false',
				sucDo: function(data)
				{
					html = template.render(tempId, data);

					_this.oContent.html(html);
				}
			});
		},
		addEvent: function()
		{	
			var _this = this;

			this.oContent.on('click', '[script-role = list_head]', function(){

				show($(this), $(this).attr('tab-index'));

			});

			function show(oThis, i)
			{	
				var aBg,
					aTitle,
					aBgNow,
					aTitleNow,
					aContent;
	
				aBg = _this.oContent.find('[script-role = click_bg]');
				aTitle = _this.oContent.find('[script-role = click_title]');
				aBgNow = aBg.eq(i);					
				aTitleNow = aTitle.eq(i);
				aContent = _this.oContent.find('[script-role = click_content]');

				if(aTitleNow.hasClass(_this.sTitleActClass))return;

				aBg.removeClass(_this.sBgActClass);
				aTitle.removeClass(_this.sTitleActClass);

				aBgNow.addClass(_this.sBgActClass);
				aTitleNow.addClass(_this.sTitleActClass);

				aContent.stop(true).slideUp();
				aContent.eq(i).stop(true).slideDown();
			}
		}
	}

	module.exports = Leftnav;

});

