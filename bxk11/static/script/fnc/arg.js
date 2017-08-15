define(function(require, exports, module) {
	
	var request = require('../lib/http/request');

	var template = require('../lib/template/template');

	function Arg(options)
	{
		this.oArea = options.oArea || null;

		this.oSendBtn = options.oSendBtn || null;

		this.oLoadMore = options.oLoadMore || null;

		this.oListWrap = options.oListWrap || null;

		this.sUrl = options.sUrl || '/index.php/view/content/getdiscu';

		this.answerUrl = options.answerUrl || '/index.php/posts/content/adddiscu';

		this.replyUrl = options.replyUrl || '/index.php/posts/content/addreply';

		this.tempId = options.tempId || 'arg_list';

		this.cid = options.cid || '';

		this.str = '';

		this.send_type = '';

		this.articalId = options.articalId || '';

		this.isLoadMore = options.isLoadMore || 'true';

		this.oNum = options.oNum || null;

		this.down = options.down || null;

		this.param = options.param || null;

		this.answerParam = options.answerParam || null;

		this.replyParam = options.replyParam || null;

		this.page = 1;
	}

	Arg.prototype = {

		init: function()
		{	
			this.loadList(this.page);

			this.initType();

			this.changeReplyType();

			this.judeType();

			this.loadMore();

			this.showReplyBtn();

			this.addSubEvent();
		},
		loadList: function(page)
		{	
			var _this = this;

			this.load(page, function(data){

				_this.render(data);

			});
		},
		load: function(page,callBack)
		{	
			var _this = this;

			if(!this.param)
			{
				this.param = {};

				this.param.cid = this.articalId;
			}

			this.param.p = page;

			request({
				url: this.sUrl,
				data: this.param,
				sucDo: function(data)
				{	
					callBack && callBack(data)
				},
				noDataDo: function()
				{	
					//alert('暂无更多数据');
					_this.oLoadMore.html('沙发等着你');

					_this.isLoadMore = 'false';

					_this.oLoadMore.css({cursor: 'default'})
				}
			});
		},
		render: function(data)
		{
			var html = template.render(this.tempId, data);

			var orgHtml = this.oListWrap.html();

			this.oListWrap.html(orgHtml + html);
		},
		loadMore: function()
		{	
			var _this = this;

			this.oLoadMore.unbind('click');

			this.oLoadMore.click(function(){

				if(_this.isLoadMore == 'true')
				{
					_this.page ++ ;

					_this.loadList(_this.page);	
				}
			});
		},
		answer: function(id, str)
		{	
			var _this = this;

			if(!this.answerParam)
			{
				this.answerParam = {};

				this.answerParam.cid = id;
			}

			this.answerParam.disc_con = str;

			request({
				url: this.answerUrl,
				data: this.answerParam,
				sucDo: function(data)
				{	
					data.data = [data.data];

					_this.initType();

					_this.doSuc(data);

					if(_this.oNum && _this.oNum.length)
					{
						_this.oNum.html(parseInt(_this.oNum.html()) + 1);
					}

					_this.down && _this.down();

					alert('评论成功');
				},
				noData: function()
				{
					alert('评论失败');
				}
			});
		},
		reply: function(id, str)
		{	
			var _this = this;

			request({
				url: this.replyUrl,
				data: {did:id, reply_str:str},
				sucDo: function(data)
				{	
					data.data = [data.data];

					_this.initType();

					_this.doSuc(data);

					if(_this.oNum && _this.oNum.length)
					{
						_this.oNum.html(parseInt(_this.oNum.html()) + 1);
					}

					_this.down && _this.down();

					alert('回复成功');
				},
				noData: function()
				{
					alert('回复失败');
				}
			});
		},
		doSuc: function(data)
		{
			var html = template.render(this.tempId, data);

			var oRghtml = this.oListWrap.html();

			this.oListWrap.html(html + oRghtml);
		},
		addSubEvent: function()
		{	
			var _this = this;

			this.oSendBtn.unbind('click');

			this.oSendBtn.click(function(){

				_this.send_type = _this.oArea.attr('send_type');

				if(_this.send_type == 'answer')
				{
					if(!_this.oArea.val())
					{	
						alert('请输入评论内容');

						return;
					}
					else
					{
						_this.cid = $(this).attr('cid');

						_this.str = _this.oArea.val();

						_this.answer(_this.cid, _this.str);
					}
				}
				else if (_this.send_type == 'reply')
				{
					if(_this.oArea.val().length == _this.oArea.attr('replyprelength'))
					{
						alert('请输入回复内容');

						return;
					}
					else
					{
						var cutLength = parseInt(_this.oArea.attr('replyprelength'));

						var allLength = _this.oArea.val().length;

						_this.str = _this.oArea.val().substring(cutLength, allLength);

						_this.reply(_this.cid, _this.str);
					}	
				}

			});
		},
		initType: function()
		{
			this.oArea.attr({
				'send_type': 'answer',
				'replyPreLength': ''
			});

			this.oArea.val('');
			
			this.oSendBtn.html('发表评论');
		},
		judeType: function()
		{	
			var type,
				_this,
				checkLength,
				nowLength;

			_this = this;

			this.oArea.unbind('keyup');

			this.oArea.keyup(function(){

				type = _this.oArea.attr('send_type');
				
				if(type == 'reply')
				{	
					checkLength = _this.oArea.attr('replyPreLength');

					nowLength = $(this).val().length;

					if(nowLength < checkLength)
					{	
						_this.initType();
					}
				}
			});
		},
		changeReplyType: function()
		{	
			var name,
				str,
				length,
				_this;

			_this = this;

			if(!this.oListWrap.FIRSTADDEVENT)
			{
				this.oListWrap.FIRSTADDEVENT = true;

				this.oListWrap.on('click', function(e){

					var oTarget = $(e.target);

					var role = oTarget.attr('script-role');

					if(role == 'arg_reply')
					{
						_this.oArea.attr('send_type', 'reply');

						_this.oSendBtn.html('回复');

						name = oTarget.attr('name');

						str = '回复 ' + name + ':';

						length = str.length;

						_this.oArea.attr('replyPreLength', length);

						_this.oArea.val(str);

						_this.selectAll(_this.oArea);

						_this.cid = oTarget.attr('disc_id');

					}

				});
			}	
		},
		selectAll: function(oArea)
		{	
			var domOarea = oArea.get(0);

			var length = domOarea.value.length;

			var ie = !-[1,];

			if(!ie)
			{	
				domOarea.selectionStart = length;

				domOarea.selectionEnd = length;
			}
			else
			{
				var oSel = domOarea.createTextRange();

				oSel.moveStart("character",length);

				oSel.move("character",length); 

				oSel.select();
			}

			oArea.focus();
		},
		showReplyBtn: function()
		{	
			var role,
				_this;

			_this = this;	

			this.oListWrap.on('mouseover', '[script-role = pinglun_list]', function(e){
				
				

					_this.oListWrap.find('[script-role = arg_reply]').hide();

					$(this).find('[script-role = arg_reply]').show();
					
			});

			

			this.oListWrap.mouseleave(function(){

				$(this).find('[script-role = arg_reply]').hide();

			});

			function findTarget(e,callBack)
			{
				var oTarget = $(e.target);

				var role = oTarget.attr('script-role');

				if(role == 'pinglun_list')
				{
					callBack && callBack(oTarget);
				}
			}


		}
	}

	module.exports = Arg;

});