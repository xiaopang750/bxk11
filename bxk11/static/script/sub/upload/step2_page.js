define(function(require, exports, module) {
	
	var relatedInput = require('../../lib/plugin/form/relatedInput');
	var bodyParse = require('../../lib/http/bodyParse');
	var formcheck = require('../../lib/plugin/form/formCheck');
	var request = require('../../lib/http/request');
	var template = require('../../lib/template/template');

	function CaseStepPage()
	{	
		this.locationPage = '/index.php/project/addproject';

		this.addFloorUrl = '/index.php/posts/floor/addfloor';

		this.editFloorUrl = '/index.php/view/scheme/info';

		this.sendUrl = '/index.php/posts/scheme/release';

		this.cancePageUrl = '/index.php/posts/scheme/delScheme';

		this.aRadio = $('[script-role = select_way]');

		this.oUpLoadArea = $('[script-role = type_upload_area]');

		this.oAddBtn = $('[script-role = type_add_btn]');

		this.floorList = $('[script-role = floor_list]');

		this.floorMain = $('[script-role = type_upload_inner]');

		this.oScheme = $('[script-role = project_name]');

		this.oPrice = $('[script-role = price]');

		this.oThink = $('[script-role = need]');

		this.oTop = $('[script-role = form_top]');

		this.oCreate = $('[script-role = create_confirm]');

		this.oName = $('[script-role = show_project_name]');

		this.oNameWrap = $('[script-role = show_project_wrap]');

		this.oSaveBtn = $('[script-role = project_save_btn]');

		this.oSendBtn = $('[script-role = send_btn]');

		this.oSavePageBtn = $('[script-role = save_page_btn]');

		this.oCanelPageBtn = $('[script-role = cancel_page_btn]');

		this.floorTemp = 
		'<div class="type_upload_list clearfix" script-role="type_upload_list">'+
			'<div class="type_left_wrap">'+
				'<div class="type_left" script-role="type_left">'+
					'<a class="upload_btn_text button178 type_upload_btn" script-role="upload_typebox_btn" onfocus="this.blur()" href="javascript:;">'+
						'<span>上传平面布置图</span>'+
					'</a>'+
				'</div>'+
				'<div class="repeat_upload_btn" script-role="repeat_uploadbox_btn">'+
					'重新上传平面布置图'+
				'</div>'+
			'</div>'+
			'<div class="type_right_wrap">'+
				'<div class="type_right" script-role="type_right">'+
					'<div class="right_head mt_10 mb_10">' + 
						'已添加房间（<span script-role="room_count">0</span>/10)' +
					'</div>'+
					'<ul class="room_list" script-role="room_list">'+

					'</ul>'+
				'</div>'+
			'</div>'+
		'</div>';

		this.EdiTemp = 
		'{{each data.floor}}'+
		'<div class="type_upload_list clearfix" script-role="type_upload_list" index="{{$index}}" floor_id="{{$value.floorinfo.floor_id}}" {{if $index==0}}style="display:block"{{else}}style="display:none"{{/if}}>'+
			'<div class="type_left_wrap">'+
				'<div class="type_left" script-role="type_left">'+
					'<img width="405" height="555" src="{{$value.floorinfo.pic1_1}}" pincount="{{$value.floorinfo.room_num}}" script-role="pin_img">'+
					'{{each $value.room}}'+
						'<div script-role="pic_pin_hased" pinindex="{{$index}}" style="position: absolute; left: {{$value.mapx}}px; top: {{$value.mapy}}px; z-index: 3; text-indent: 0px;" room_id="{{$value.id}}">'+
							'<span class="pic_pin icon178" href="javascript:;"></span>'+
							'<div class="pin_dec" style="margin-left: -5px;">{{$value.name}}</div>'+
						'</div>'+
					'{{/each}}'+
				'</div>'+
				'<div class="repeat_upload_btn" script-role="repeat_uploadbox_btn" floor_id="{{$value.floorinfo.floor_id}}" scheme_id="{{data.schemeinfo.scheme_id}}" style="display:block">'+
					'重新上传平面布置图'+
				'</div>'+
			'</div>'+
			'<div class="type_right_wrap">'+
				'<div class="type_right" script-role="type_right">'+
					'<div class="right_head mt_10 mb_10">' + 
						'已添加房间（<span script-role="room_count">{{$value.floorinfo.room_num}}</span>/10)' +
					'</div>'+
					'<ul class="room_list" script-role="room_list">'+
						'{{each $value.room}}'+
						'<li script-role="{{$index}}">'+
							'<a class="room_tip ml_5" room_id="{{$value.room_id}}" index="{{$index}}" script-role="room_tip" href="javascript:;">{{$value.room_name}}({{$value.roomcontent.room_pics}}图)</a>'+
							'<a class="upload_close button178" room_id="{{$value.room_id}}" index="{{$index}}" href="javascript:;" script-role="room_close">关闭</a>'+
						'</li>'+
						'{{/each}}'+
					'</ul>'+
				'</div>'+
			'</div>'+
		'</div>'+
		'{{/each}}';

		this.layList = '<li class="floor_btn act" script-role="floor_btn">一层</li>';

		this.count = 0;

		this.maxFloor = 3;

		this.picBox = $('#flat3d');

	}

	CaseStepPage.prototype = {

		init: function()
		{	
			this.getPid();

			this.judgePage();

			this.judeType();

			//this.projectName();

			this.createInit();

			this.uploadEvent();

			this.addFloor();

			this.tabEvent();

			this.pageEvent();
		},
		getPid: function()
		{	
			if(!bodyParse())
			{
				window.location = '/index.php/user/home';
			}
			else
			{
				this.pid = bodyParse().pid;
			}

			return bodyParse().pid;
		},
		judgePage: function()
		{
			this.pageType = $('[script-role = upload_type]').attr('type');

			if(this.pageType == '2d')
			{
				this.aRadio.eq(0).attr('checked', 'checked');
			}
			else
			{
				this.aRadio.eq(1).attr('checked', 'checked');
			}

			return this.pageType;
		},	
		judeType: function()
		{	
			var sTarget,
				sType,
				_this;

			_this = this;

			this.aRadio.on('click', function(){

				sTarget = $(this).attr('target');

				sType = $(this).attr('role-type');

				if(sType != _this.pageType)
				{
					window.location = sTarget + '?pid=' + _this.pid;
				}
			});
		},
		projectName: function()
		{	
			var _this = this;

			var type = this.pageType == '2d' ? 1 : 2;

			var related = new relatedInput({
				oWrap: $('[script-role = project_name]'),
				param: {pid: this.pid, scheme_type: type},
				postName: 'house',
				wrapClass: 'project_namer',
				url: '/index.php/view/scheme/getlist',
				press: 'no',
				onchange: function(param)
				{	
					//param.house_city = oCity.get(0).options[oCity.get(0).selectedIndex].id;
				},
				getValue: function(oLi,oInput)
				{	
					_this.oPrice.val(oLi.attr('scheme_cost'));
					_this.oThink.val(oLi.attr('scheme_thinking'));

					oInput.attr('scheme_id', oLi.attr('scheme_id'));
				},
				fnDo: function(data, oWrap)
				{	
					var i,
						num,
						oLi;

					num = data.data.length;
					
					for(i=0; i<num; i++)
					{
						oLi = $('<li scheme_id='+ data.data[i].scheme_id +' scheme_cost='+ data.data[i].scheme_cost +' scheme_thinking='+ data.data[i].scheme_thinking +'><span></span></li>');

						oLi.children(0).html(data.data[i].scheme_name);

						oWrap.append(oLi);
					}
				},
				blur: function(sName, aLi, oInput)
				{	
					var result = false;

					if(aLi.length)
					{
						aLi.each(function(i){

							if(aLi.eq(i).text() == sName)
							{	
								//编辑
								_this.edit(aLi.eq(i).attr('scheme_id'));

								result = true;
							}

						});

						if(!result)
						{
							//创建
							_this.create();

							oInput.attr('scheme_id', '');
						}
					}
				}
			});

			related.addEvent();
		},
		judgeEditer: function()
		{
			var type = this.oUpLoadArea.attr('upload_type');

			if(type == 'create' || type == '')
			{
				this.create();
			}
			else if(type == 'edit')
			{
				this.edit();
			}
		},
		clearHasedValue: function()
		{	
			// 创建清空

			this.oPrice.val('');

			this.oThink.val('');
		},
		create: function()
		{	
			oFormcheck.noSub = null;

			this.oSaveBtn.html('创建方案');

			this.createInit();
		},
		createInit: function()
		{	
			this.oCreate.show();

			this.oAddBtn.hide();

			this.clearHasedValue();

			this.floorList.html(this.layList);

			this.floorMain.html(this.floorTemp);

			this.oPrice.removeAttr('disabled');

			this.oThink.removeAttr('disabled');
		},
		uploadEvent: function()
		{	
			var nowData,
				_this,
				oList;

			_this = this;

			this.floorMain.on('click', '[script-role = upload_typebox_btn]', function(){

				/* type为create */

				oList = $(this).parents('[script-role = type_upload_list]');

				nowData = _this.getNowFloorData(oList);

				_this.saveBox(nowData);

				_this.floorMain.data('info', nowData);

				_this.floorMain.attr('type', 'create');

				$.fancybox({href:'#cutbox', centerOnScroll:false});

			});
		},
		getNowFloorData: function(oWrap)
		{	
			if(!oWrap)oWrap = null;

			/* 获取创建或者方案信息 */
			var param = {};

			var type = this.pageType == '2d' ? '1' : '2';

			param.pid = this.pid;

			param.scheme_id = this.oScheme.attr('scheme_id');

			param.floor_id = oWrap ? oWrap.attr('floor_id') : '';

			param.scheme_type = type;

			param.scheme_cost = this.oPrice.val();

			param.scheme_thinking = this.oThink.val();

			param.scheme_name = this.oScheme.val();

			param.index = oWrap ? oWrap.attr('index') : '';

			return param;
		},
		addFloor: function()
		{
			var _this,
				aList,
				aContent,
				index;

			_this = this;	

			this.oAddBtn.click(function(){

				_this.judgeFloor($(this))

			});
		},
		judgeFloor: function(oThis)
		{
			var aList,
				_this,
				index,
				oNowList;

			_this = this;

			aList = $('[script-role = floor_btn]');

			if(aList.size() >= this.maxFloor)
			{	
				this.oAddBtn.hide();

				alert('最多添加三个楼层');

				return false;
			}
			else
			{	
				request({

					url: this.addFloorUrl,

					data: {scheme_id: this.floorMain.data('info').scheme_id},

					sucDo: function(data)
					{
						index = _this.makeFloor();

						oNowList = _this.makeContent();

						oNowList.attr({floor_id: data.data, index: index});

						_this.tab(index);

						oThis.hide();
					}

				});

				return true;
			}
		},
		tab: function(index)
		{	
			var aList,
				aContent;

			aList = $('[script-role = floor_btn]');

			aContent = $('[script-role = type_upload_list]');

			aList.eq(index).addClass('act').siblings().removeClass('act');

			aContent.eq(index).show().siblings().hide();
		},
		makeContent: function()
		{
			var oDiv = $(this.floorTemp);

			this.floorMain.append(oDiv);

			return oDiv;
		},
		makeFloor : function()
		{	
			var aLast,
				nFloor,
				lay,
				layBack,
				oNewLi;

			lay = {
				'一': 1,
				'二': 2,
				'三': 3
			};

			layBack = {
				'1': '一',
				'2': '二',
				'3': '三'
			};

			aLast = this.floorList.find('[script-role = floor_btn]').last();

			nFloor = lay[aLast.text().substring(0,1)] + 1 + '';

			oNewLi = $('<li class="floor_btn" script-role="floor_btn">' + layBack[nFloor] + '层</li>');

			this.floorList.append(oNewLi);

			return lay[aLast.text().substring(0,1)];
		},
		tabEvent: function()
		{	
			var _this,
				index;

			_this = this;	

			this.floorList.on('click', '[script-role = floor_btn]' ,function(){

				index = $(this).index();

				_this.tab(index);
			});
		},
		edit: function(id)
		{	
			var _this = this;

			this.oSaveBtn.html('编辑方案');

			oFormcheck.noSub = function()
			{	
				var id = _this.oScheme.attr('scheme_id');

				_this.editLoad(id, function(data){
			
					_this.editFloor(data);

					var render = template.compile(_this.EdiTemp);

					var html = render(data);

					_this.floorMain.html(html);

					_this.editSaveData(data);

					_this.picBox.data('info', data.data.schemeinfo);

					_this.showAddFloor();

				});
			}
		},
		editLoad: function(id, callBack)
		{
			request({
				url: this.editFloorUrl,

				data: {scheme_id: id},

				sucDo: function(data)
				{
					callBack && callBack(data);
				}
			})
		},
		editFloor: function(data)
		{	
			this.floorList.html('');

			var num = data.data.floor.length;
			var oLi;
			var arr= ['一', '二', '三'];

			num >=3 ? this.oAddBtn.hide() : this.oAddBtn.show();

			for (var i=0; i<num; i++)
			{	
				oLi = $('<li class="floor_btn" script-role="floor_btn">'+ arr[i] +'层</li>');

				if(i == 0 )oLi.addClass('act');

				this.floorList.append(oLi);
			}
		},
		editSaveData: function(data)
		{
			var aRightListWrap = $('[script-role = room_list]');

			var num = aRightListWrap.length;

			for (var i=0; i<num; i++)
			{
				var aList = aRightListWrap.eq(i).find('[script-role = room_tip]');

				var num2 = aList.length;

				for (var k=0; k<num2; k++)
				{
					aList.eq(k).data('pinData', data.data.floor[i].room[k]);
				}
			}
		},
		showFloor: function(data)
		{
			var dataInfo = data.floor;
			var temp;

			for (var i=0; i<dataInfo.length; i++)
			{

			}
		},
		showAddFloor: function()
		{
			this.oTop.slideUp();

			this.oUpLoadArea.slideDown();

			this.showName();
		},
		showName: function()
		{
			this.oNameWrap.show();

			this.oName.html(this.oScheme.val());
		},
		saveBox: function(data)
		{
			this.picBox.data('info', data);
		},
		clearWrong: function()
		{
			$('[script-role = wrong_area]').removeClass('wrong');
		},
		clearValue: function()
		{
			this.oScheme.val('');

			this.oPrice.val('');

			this.oThink.val('');
		},
		sendPage: function()
		{	
			var _this = this;

			request({

				url: this.sendUrl,

				data: {scheme_id: this.oScheme.attr('scheme_id'), scheme_status: 1},

				sucDo: function()
				{
					window.location = _this.locationPage;
				},
				noDataDo: function(msg)
				{
					alert(msg);
				}
			});

		},
		savePage: function()
		{	
			var _this = this;

			request({
				url: this.sendUrl,

				data: {scheme_id: this.oScheme.attr('scheme_id'), scheme_status: 21},

				sucDo: function()
				{
					window.location = _this.locationPage;
				},
				noDataDo: function(msg)
				{
					alert(msg);
				}
			});
		},
		cancelPage: function()
		{
			var _this = this;

			request({
				url: this.cancePageUrl,

				data: {scheme_id: this.oScheme.attr('scheme_id')},

				sucDo: function()
				{
					window.location = '/index.php/user/home';
				},
				noDataDo: function(msg)
				{
					alert(msg);
				}
			});
		},
		pageEvent: function()
		{	
			var _this = this;

			$('[script-role = page_btn_area]').on('click', function(e){

				var oTarget = $(e.target);

				var sRole = oTarget.attr('script-role');

				if(sRole == 'send_btn')
				{	
					_this.sendPage();
				}
				else if(sRole == 'save_page_btn')
				{	
					_this.savePage();
				}
				else if(sRole == 'cancel_page_btn')
				{	
					_this.cancelPage();
				}

			});
		}

	};

	var page2 = new CaseStepPage();

	page2.init();

	/* 验证加提交 */
	var oFormcheck = new formcheck({
		subUrl: '/index.php/posts/scheme/addscheme',
		btnName: 'project_save_btn',
		boundName: 'step2_check',
		fnSumbit: function(data)
		{	
			data.pid = page2.getPid();

			data.scheme_type = page2.judgePage() == '2d' ? 1 : 2;
		},
		sucDo: function(data)
		{	
			$('[script-role = type_upload_list]').eq(0).attr('floor_id', data.data.floor_id);

			$('[script-role = type_upload_list]').eq(0).attr('index','0');

			page2.oScheme.attr('scheme_id', data.data.scheme_id);

			page2.showAddFloor();
		},
		failDo: function(msg)
		{	
			page2.clearValue();

			alert(msg);
		}
	});

	oFormcheck.check();

});