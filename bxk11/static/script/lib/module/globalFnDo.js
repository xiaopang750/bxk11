define(function(require, exports, module) {
	
	var request = require('../../lib/http/request.js');

	var arg = require('../../fnc/arg.js');

	var inputTip = require('../../fnc/inputTip.js');

	var oArguments;
	var oInputTip;

	/*
		foc foc_num foc_name
	 */

	function GlobalFnDo(options)
	{
		this.oWrap = options.oWrap;

		this.listName = options.listName || 'content_list_jia178';

		this.favUrl = options.favUrl || '/index.php/posts/content/like';

		this.focUrl = options.focUrl || '/index.php/posts/userset/follow';

		this.useUrl = options.useUrl || '';
	}

	GlobalFnDo.prototype = {

		init: function()
		{
			this.addEvent();	
		},
		addEvent: function()
		{	
			var _this = this;

			this.oWrap.on('click', function(e){

				_this.judge(e);

			});
		},
		judge: function(e)
		{	
			var _this = this;

			var clickType,
					target,
					data,
					key,
					value,
					thisParent,
					role;

				target = $(e.target);

				role = target.attr('script-role');

				if(!role)return;

				var re = /(fav)|(foc)|(use)|(add)|(arg)|(diy)|(carry)|(collect)/gi;

				if(re.test(role))
				{	
					clickType = target.attr('script-role').match(re)[0];
				}
				if (target.attr('dis') == 'true')
				{	
					return;
				}

				if(!clickType)return;

				target.parents().each(function(i){

					if (target.parents().eq(i).attr('script-role') == _this.listName)
					{
						thisParent = target.parents().eq(i);
					}

				});

				data = thisParent.data('info');

				switch(clickType)
				{
					case  'fav':

						_this.fav(thisParent, data);

					break;

					case 'foc':

						_this.foc(thisParent, data);

					break;

					case 'use':

						_this.use(thisParent, data);

					break;

					case 'add':

						_this.add(thisParent, data);

					break;

					case 'arg':

						_this.arg(thisParent, data);

					break;

					case 'book':

						_this.book();

					break;

					case  'diy':

						_this.diy(thisParent, data);

					break;

					case  'carry':

						_this.carry(thisParent, data);

					break;

					case  'collect':

						_this.collect(thisParent, data);

					break;
				}
		},
		link: function(url, data, suc, fail)
		{
			request({
				url: url,
				data: data,
				sucDo: function(data)
				{
					suc && suc(data);	
				}
			});
		},//喜欢
		fav: function(oThis, data)
		{	
			// 如需增加参数在data对象上添加即可; 
			var param = {};

			param.cid = data.cid;

			var oName = oThis.find('[script-role=fav_name]');

			var oNum = oThis.find('[script-role=fav_num]');

			var cancelStr = '取消喜欢';

			var addStr = '喜欢';

			var nNewNum = 0;

			this.link(this.favUrl, param, function(){

				var isLike = data.is_like;

				if(isLike == "0")
				{	
					// 喜欢成功do
					oName.html(cancelStr);

					if(oNum.length)nNewNum = parseInt(oNum.html()) + 1;

					data.is_like = "1";
				}
				else if(isLike == "1")
				{
					//取消喜欢do
					oName.html(addStr);

					if(oNum.length)nNewNum = parseInt(oNum.html()) - 1;	

					data.is_like = "0";			
				}

				if(oNum.length) oNum.html(nNewNum);

			});
		},//关注

		foc: function(oThis, data)
		{	
			var param = {};

			param.uid = data.uid ? data.uid : data.user_id;

			var oTher = $('[script-role='+this.listName+']');

			var cancelStr = '已关注';

			var addStr = '关注TA';

			var nNewNum = 0;

			this.link(this.focUrl, param, function(){		

				var isFollow = data.is_follow;

				oTher.each(function(i){

					if(oTher.eq(i).data('info')['uid'] == data.uid)
					{
						var oName = oTher.eq(i).find('[script-role=foc_name]');

						var oNum = oTher.eq(i).find('[script-role=foc_num]');

						if(isFollow == "0")
						{	
							// 关注成功do
							oName.html(cancelStr);

							oName.attr('dis','true');

							oName.addClass('default');

							if(oNum.length)nNewNum = parseInt(oNum.html()) + 1;

							oTher.eq(i).data('info')['is_follow'] = "1";
						}
						else if(isFollow == "1")
						{
							//取消关注do
							oName.html(addStr);

							if(oNum.length)nNewNum = oNum.html() - 1;	

							oTher.eq(i).data('info')['is_follow'] = "0";			
						}

						if(oNum.length) oNum.html(nNewNum);
						
					}

				});

			});
		},//有用
		use: function(oThis, data)
		{
			var param = {};

			param.cid = data.cid;

			var oName = oThis.find('[script-role=use_name]');

			var oNum = oThis.find('[script-role=use_num]');

			var cancelStr = '取消有用';

			var addStr = '有用';

			var nNewNum = 0;

			this.link(this.useUrl, param, function(){

				var isRecommend = data.is_recommend;

				if(isRecommend == "0")
				{	
					// 喜欢成功do
					oName.html(cancelStr);

					if(oNum.length)nNewNum = oNum.html() + 1;

					data.is_recommend = "1";
				}
				else if(isRecommend == "1")
				{
					//取消喜欢do
					oName.html(addStr);

					if(oNum.length)nNewNum = oNum.html() - 1;	

					data.is_recommend = "0";			
				}

				if(oNum.length) oNum.html(nNewNum);

			});
		},
		add: function(oThis, data)
		{	
			var addUrl = '/index.php/view/album/albumlist';
			var subUrl = '/index.php/posts/album/addtocontent';
			var oSelect = oThis.find('[script-role = select_project_area]');
			var oAddInput = oThis.find('[script-role = add_new_project]');
			var oSelectRaido = oThis.find('[script-role = select_project_type]');
			var oAddNewRadio = oThis.find('[script-role = select_add_type]');
			var oAddBtn = oThis.find('[script-role = add_project_btn]');
			var oNum = oThis.find('[script-role=add_num]');
			var nNewNum = 0;

			if(!oThis.get(0).FIRSTADDPROJECT)
			{	
				oThis.get(0).FIRSTADDPROJECT = true;

				request({
					url: addUrl,
					sucDo: function(data)
					{
						var i,
							num,
							realData;

						realData = data.data;

						num = realData.length;
						
						for(i=0; i<num; i++)
						{	
							var oOption = $('<option id='+ realData[i].album_id +'>'+ realData[i].album_name +'</option>');

							oSelect.append(oOption);
						}
					}
				})

				init();
			}

			oSelectRaido.unbind('click');

			oSelectRaido.click(function(){

				disbale(oAddInput);

				able(oSelect);

				clearData(oAddInput);

			});

			oAddNewRadio.unbind('click');

			oAddNewRadio.click(function(){

				disbale(oSelect);

				able(oAddInput);

				clearData(oSelect);

			});

			submit(oAddBtn, oSelect, oAddInput);

			function init()
			{	
				oSelectRaido.get(0).checked = true;

				oAddInput.attr('disabled','disabled');
			}

			function able(obj)
			{
				obj.removeAttr('disabled');
			}

			function disbale(obj)
			{	
				obj.attr('disabled','disabled');
			}

			function clearData(obj)
			{	
				var domObj = obj.get(0);

				if(domObj.selectedIndex)
				{
					domObj.selectedIndex = 0;
				}
				else
				{
					domObj.value = '';
				}
			}

			function submit(oBtn,oSelect,oInput)
			{	
				oBtn.unbind('click');

				oBtn.click(function(){

					var select_name = oSelect.get(0).options[oSelect.get(0).selectedIndex].text;
					var cid = oBtn.attr('cid');
					var name = oInput.val();

					if(!oSelect.val() && !oInput.val())
					{	
						alert('请至少选择或创建一项');
						return;
					}
					else
					{	
						if(oSelect.val())
						{	
							request({
								url: subUrl,
								data: {name: select_name, cid:cid},
								sucDo: function()
								{	
									alert('加入成功');

									oSelect.get(0).selectedIndex = 0;

									if(oNum.length)nNewNum = parseInt(oNum.html()) + 1;

									oNum.html(nNewNum);
								},
								noDataDo: function(msg)
								{
									alert(msg);
								}
							});	
						}
						else
						{	
							request({
								url: subUrl,
								data: {name:name , cid:cid},
								sucDo: function(data)
								{	
									alert('创建成功');

									var oOption = $('<option id='+ data.data +'>'+ name +'</option>');

									oSelect.append(oOption);

									if(oNum.length)nNewNum = parseInt(oNum.html()) + 1;

									oNum.html(nNewNum);

									oInput.val('');
								},
								noDataDo: function(msg)
								{
									alert(msg);
								}

							});	
						}
					}

				});	
			}			
		},
		arg: function(oThis, data)
		{	
			var oSendBtn = oThis.find('[script-role = pinlun_btn]');
			var oArea = oThis.find('[script-role = pinlun_textarea]');
			var oListWrap = oThis.find('[script-role = pinlun_wrap]');
			var oLoadMore = oThis.find('[script-role = pinlun_more]');
			var oNum = oThis.find('[script-role = pinlun_num]');
			var oTip = oThis.find('[script-role = pinlun_tip]');

			if(!oThis.get(0).FIRSTARGUMENT)
			{	
				oThis.get(0).FIRSTARGUMENT = true;

				oInputTip = new inputTip({
					oArea : oArea,
					oTip : oTip 
				});

				oArguments = new arg({
					oSendBtn : oSendBtn,
					oLoadMore : oLoadMore,
					oListWrap : oListWrap,
					oArea : oArea,
					articalId : data.cid,
					oNum: oNum,
					down: function()
					{
						oInputTip.clear();
					}
				});

				oArguments.init();

				oInputTip.init();
			}
		},
		book: function(oThis)
		{
			var tagId = oThis.attr('tagId');
		},
		diy: function(oThis, data)
		{	
			var getDataUrl = '/index.php/view/scheme/getDiyList';

			var addUrl = '/index.php/posts/room/tomyscheme';

			var oBox = $('#carry_step_box_confirm').get(0);

			var aRadio = $('[script-role = diy_select_type]');

			var oCreate = $('[script-role = diy_create]');

			var oSelect = $('[script-role = diy_select]');

			var oConfirm = $('[script-role = diy_confirm]');

			var param = {};

			var sType = 'select';

			if(!oBox.firstLoad)
			{
				request({

					url: getDataUrl,

					sucDo: function(data)
					{	
						oSelect.html('');

						var i,
							num,
							aList;

						aList = data.data;

						num = aList.length;

						for (i=0; i<num; i++)
						{
							var oOption = $('<option id='+ aList[i].scheme_id +'>'+ aList[i].scheme_name +'</option>');

							oSelect.append(oOption);
						}

						
					}

				});
			}

			aRadio.unbind('click');

			aRadio.on('click', function(){

				sType = $(this).attr('script-type');

				if(sType == 'create')
				{
					oCreate.removeAttr('disabled');

					oSelect.attr('disabled', 'disabled');

					init();
				}
				else if(sType == 'select')
				{
					oSelect.removeAttr('disabled');

					oCreate.attr('disabled', 'disabled');

					init();
				}

			});

			oConfirm.unbind('click');

			oConfirm.on('click', function(){
					
				if(sType == 'select')
				{
					if(!oSelect.val())
					{	
						alert('请选择');

						return;
					}else
					{	
						param.sid = oSelect.get(0).options[oSelect.get(0).selectedIndex].id;

						param.rid = data.rid;

						request({

							url: addUrl,

							data: param,

							sucDo: function(data)
							{
								alert(data.msg);

								init();

								$.fancybox.close();
							},
							noDataDo: function(msg)
							{
								alert(msg);

								init();

								$.fancybox.close();
							}

						});
					}
				}
				else
				{
					if(!oCreate.val())
					{	
						alert('方案名称不能为空');

						return;
					}else
					{	
						param.scheme_name = oCreate.val();

						param.rid = data.rid;

						request({

							url: addUrl,

							data: param,

							sucDo: function(data)
							{
								alert(data.msg);

								init();

								$.fancybox.close();
							},
							noDataDo: function(msg)
							{
								alert(msg);

								init();

								$.fancybox.close();
							}

						});
					}
				}

			});

			function init()
			{
				oSelect.get(0).selectedIndex = 0;

				oCreate.val('');
			}

			$.fancybox({href: '#carry_step_box_confirm'});


		},
		carry: function(oThis, data)
		{	
			var sNeed = data.need_store;
			var sNow = data.user_score;
			var oNeed = $('[script-role = need]');
			var oNow = $('[script-role = now]');
			var oConfirm = $('[script-role = carry_confirm_btn]');
			var oRightTip = $('[script-role = right_tip]');
			var oWrongTip= $('[script-role = wrongtip]');
			var oView = $('[script-role = view_home]');

			oNeed.html(sNeed);
			oNow.html(sNow);
			oView.attr('href', data.userspace);

			oConfirm.unbind('click');

			oConfirm.on('click', function(){

				request({
					url: '/index.php/posts/scheme/tomyhome',

					data: {sid: data.rid},

					sucDo: function(data)
					{
						oRightTip.html(data.msg.info);

						$.fancybox({href:"#carry_step_box_suc"});
						
						oView.attr('href', data.msg.scheme_url);
					},
					noDataDo: function(msg)
					{	
						oWrongTip.html(msg);

						$.fancybox({href:"#carry_step_box_fail"});
					}
				});

			});
			
			$.fancybox({href:"#carry_step_box_confirm"});
		},
		collect: function(oThis, data)
		{	
			var oName = oThis.find('[script-role = collect_name]');
			var oBtn = oName.parents('[script-role = collect]').attr('dis', 'true');

			var url = data.type == 'scheme' ? '/index.php/posts/scheme/like' : '/index.php/posts/room/like';

			var param = data.type == 'scheme' ? {sid: data.rid} : {rid: data.rid}

			request({

				url: url,

				data: param,

				sucDo: function(data)
				{
					oName.html('已收藏');

					oName.attr('dis', 'true');

					oBtn.attr('dis', 'true');

					oBtn.css('cursor', 'default');
				},
				noDataDo: function(msg)
				{
					alert(msg);
				}

			})
		}

	};

	return GlobalFnDo;


});