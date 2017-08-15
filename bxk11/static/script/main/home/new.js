define(function(require, exports, module) {
	
	var global = require('../../lib/global/global');
	var info = require('../../sub/home/info');
	var mvc = require('../../lib/prototype/prototype');
	var monsary = require('../../lib/plugin/dom/monsary');
	var artical = require('../../sub/inspir/artical');
	var saveData =require('../../lib/dom/saveData.js');

	var _parent = new mvc();
	var _uid = _parent.parse().uid;
	var nType = parseInt($('[script-role = user_head]').attr('level'));
	var New = _parent.extend(function(){

		this.oShowBtn = $('[script-role = start_message]');
		this.oMessageArea = $('[script-role = send_area]');
		this.oArea = $('[script-role = input_area]');
		this.oSendBtn = $('[script-role = message_send]');
		this.oMessageListWrap = $('[script-role = message_list_wrap]');
		this.oDesignWrap = $('[script-role = design_wrap]');
		this.oDesignBot = $('[script-role = design_list]');

	}, {

		message: function()
		{	
			var _this = this, str;

			this.oShowBtn.on('click', function(){

				if(_this.oMessageArea.is(':visible'))
				{
					_this.hideMessage();	
				}
				else
				{
					_this.showMessage();
				}

			});

			this.oSendBtn.on('click', function(){

				str = _this.oArea.val();

				if(!str)return;

				_this.send(str);

			});
		},
		showMessage: function()
		{
			this.oMessageArea.show();
		},
		hideMessage: function()
		{
			this.oMessageArea.hide();
		},
		send: function(str)
		{	
			var _this = this;

			if(_uid == $CONFIG.uid )
			{
				alert('不能跟自己留言');

				return;
			}

			this.param.touid = _uid;
			this.param.uid = $CONFIG.uid || '';
			this.param.msg = str;
			this.requestUri = '/index.php/posts/user/addmsg';
			this.load();
			this.suc = function()
			{	
				_this.clear();

				_this.showList(str);

				_this.hideMessage();
			};
		},
		clear: function()
		{
			this.oArea.val('');
		},
		showList: function(str)
		{	
			$CONFIG.msg = str;
			this.data = $CONFIG;
			this.addWay = 'prepend';
			this.tempWrap = this.oMessageListWrap;
			this.tempStr = 
			'<li script-role="message_list">'+
				'<dl class="clearfix">'+
					'<dt class="fl pr_15 pl_15">'+
						'<a href="{{userspace}}" class="mb_5" target="_blank"><img src="{{userpic}}" width="50" height="50" /></a>'+
						'<p>{{nickname.substring(0,4)+"..."}}</p>'+
					'</dt>'+
					'<dd class="fl">'+
						'<div class="time mb_5"></div>'+
						'<p>{{msg}}</p>'+
					'</dd>'+
				'</dl>'+
			'</li>';
			this.render();
			$('[script-role = message_list]').last().remove();

		},
		showPicList: function()
		{	
			var _this = this;

			if(nType > 10)
			{	
				this.oDesignWrap.show();

				this.param.uid = _uid;
				this.requestUri = '/index.php/view/user/newchemer';
				this.load();
				this.suc = function(data)
				{
					var aPic = data.data;
					var oImage = $('<a href='+ aPic[0].scheme_url +'><img src='+ aPic[0].scheme_pic +' width="557" height="288"></a>');
					
					for (var i=0; i <aPic.length; i++)
					{
						var aA = $('<a href="javascript:;"></a>');

						if(i == 0)aA.addClass('act');

						aA.html(i+1);

						_this.oDesignBot.append(aA);
					}

					_this.oDesignWrap.append(oImage);
					
					_this.oDesignBot.on('mouseenter', 'a', function(){
						
						var index = $(this).index();

						oImage.attr('href', aPic[index].scheme_url);
						oImage.children().eq(0).attr('src', aPic[index].scheme_pic);
						$(this).addClass('act').siblings().removeClass('act');

					});

				};

				this.fail = function(msg)
				{
					alert(msg);
				}

			}
			else
			{
				this.oDesignWrap.hide();
			}
		}

	});

	var oWrap = $('[script-role=monsary_wrap]');

	var mon = new monsary({
		oWrap: oWrap,
		url: '/index.php/view/user/newcontent',
		tplId: 'inspir_artical',
		param: {uid: _uid},
		showLoading: 'false',
		renderDo: function(data)
		{	
			var aList = oWrap.find('[script-role = content_list_jia178]');

			saveData(aList, data);
		},
		isStartLoadingShow : 'false'
	});

	mon.init();

	oWrap.on('click', '[script-role = image_list]', function(){

		//console.log(this.parents('[script-role = content_list_jia178]').data)
		window.open( $(this).attr('_link') );

	});

	artical($('[script-role = monsary_wrap]'),{imageBtn: 'false'});


	/* rightInfo */

	/* m */
	New.param.uid = _uid;
	New.requestUri= '/index.php/view/user/inforight';
	New.load();
	New.suc = function(data)
	{	
		/* v_message */
		New.tempStr =
		'{{each data.msg_list}}'+ 
		'<li script-role="message_list">'+
			'<dl class="clearfix">'+
				'<dt class="fl pr_15 pl_15">'+
					'<a href="{{$value.userspace}}" class="mb_5" target="_blank"><img src="{{$value.user_pic}}" width="50" height="50" /></a>'+
					'<p>{{$value.nikename.substring(0,4)+"..."}}</p>'+
				'</dt>'+
				'<dd class="fl">'+
					'<div class="time mb_5">{{$value.sub_time}}</div>'+
					'<p>{{$value.msg}}</p>'+
				'</dd>'+
			'</dl>'+
		'</li>'+
		'{{/each}}';
		New.tempWrap = New.oMessageListWrap;
		New.data = data;
		New.render();

		/* v_fans */
		New.tempStr =
		'{{each data.fans_list}}' + 
		'<li class="fl inline mr_35">' +
			'<a href="{{$value.userspace}}" target="_blank"><img src="{{$value.user_pic}}" width="50" height="50" /></a>' +
			'<p>{{$value.nikename.substring(0,4)+"..."}}</p>' +
		'</li>' +
		'{{/each}}';
		New.tempWrap = $('[script-role = fans_wrap]');
		New.data = data;
		New.render();

		/* v_focus */
		New.tempStr =
		'{{each data.follow_list}}' + 
		'<li class="fl inline mr_35">' +
			'<a href="{{$value.userspace}}" target="_blank"><img src="{{$value.user_pic}}" width="50" height="50" /></a>' +
			'<p>{{$value.nikename.substring(0,4)+"..."}}</p>' +
		'</li>' +
		'{{/each}}';
		New.tempWrap = $('[script-role = focus_wrap]');
		New.data = data;
		New.render();


		/* v_scheme */
		New.tempStr =
		'{{each data.room_list}}' + 
		'<li class="fl inline mr_35 mb_5">' +
			'<a href="{{$value.room_url}}" target="_blank"><img src="{{$value.room_pic}}" width="50" height="50" /></a>' +
		'</li>' +
		'{{/each}}';
		New.tempWrap = $('[script-role = scheme_wrap]');
		New.data = data;
		New.render();

		/* message */
		New.message();

		New.showPicList();
	};



});