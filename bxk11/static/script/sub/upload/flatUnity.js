define(function(require, exports, module) {
	
	var request = require('../../lib/http/request');
	var template = require('../../lib/template/template');
	var com = require('../../sub/upload/upload_com');
	var tag = require('../../fnc/tag.js');

	/* 2d图 */
	function UploadFlatUnity(options)
	{	
		options = options || {};

		this.loadUrl = options.loadUrl || '/index.php/view/room/typelist';
		this.removePicUrl = options.removePicUrl || '/index.php/posts/room/delRoomPic';
		this.createUrl = options.createUrl || '/index.php/posts/room/uproom';
		this.cancelUrl = options.cancelUrl || '/index.php/posts/room/delroom';

		this.oBox = options.oBox || $('#flat3d');
		this.tagArea = options.tagArea || $('[script-role = flat_area]');
		this.oSelfInput = options.oSelfInput || $('[script-role = tag_input]');
		this.oSelfArea = options.oSelfArea || $('[script-role = result_wrap]');
		this.oResult = options.oResult || $('[script-role = flat_tag_result]');
		this.oSquare = options.oSquare || $('[script-role = flat_price]');
		this.oPicList = options.oPicList || $('#flat_list');
		this.oSubmitBtn = options.oSubmitBtn || $('[script-role = flat_confirm_btn]');
		this.oCancelBtn = options.oCancelBtn || $('[script-role = flat_cancel_btn]');
		this.oWrong = options.oWrong || $('[script-role = flat_wrong]');
		this.oFloorMain = $('[script-role = type_upload_inner]');
		this.oThink = $('[script-role = room_thinking]');


		this.oSelfTag = null;

		this.oTempResult = [];
		this.oTempId = [];

		this.tagTemp = 
		'{{each data}}'+
		'<div class="tag_list clearfix" line="{{$index}}" script-role="tag_line">'+
			'<span class="fl name">{{$value.bname}}:</span>'+
			'<div class="tag_main fl pl_10" script-role="tag_main">'+
				'{{each $value.sname}}'+
				'<a href="javascript:;" script-role="flat_tag" onfocus="this.blur()" data-id={{$value.tag_id}}>{{$value.tag_name}}</a>'+
				'{{/each}}'+
			'</div>'+
			'<div class="slide fl mt_10" script-role="tag_slide">↓</div>'+
		'</div>'+
		'{{/each}}';

		this.swfTemp = options.swfTemp || 
		'<li script-role="flat_2d_list" id=${fileID}>'+
			'<a class="close_btn button178" script-role="flat_close_btn" onfocus="this.blur()" href="javascript:;">¹Ø±Õ</a>'+
			'<dl>'+
				'<dt>'+
					'<img src="/static/images/lib/loading/pic_loading.gif" / script-role="flat_loading_img" class="flat_loading_img">'+
					'<img src="/static/images/lib/global/blank.gif" alt="" width="154" height="112" / script-role="flat_2d_img">'+
				'</dt>'+
				'<dd>'+	
				'</dd>'+
			'</dl>'+
			'<textarea script-role="flat_input" cols="30" disabled="disabled"></textarea>'+
		'</li>';

		this.sucCount = 0;
		this.max = 6;
		this.maxPin = 10;
		this.pinIndex = 0;
		this.param = {};
		this.lock = false;
		this.swfId = options.swfId || 'flat_upload_btn';
		this.swfqueueId = options.swfqueueId || 'flat_list';
		this.swfText = options.swfText || '上传效果图';
		this.swfTarget = options.swfTarget || '/index.php/upload/room_2d';
		this.swfSuc = options.swfSuc || null;
	}

	UploadFlatUnity.prototype = {

		init: function()
		{	
			if(!this.firstLoadSelfTag)
			{	
				this.loadTag();

				this.clickEvent();

				this.closeResult();

				this.uploadPic();

				this.closeList();

				this.changeArea();

				this.submitEvent();

				this.cancelEvent();

				this.firstLoadSelfTag = true;

				this.getSelfTag();

				this.removePinEvent();
			}
			else
			{
				this.boxInit();
			}
		},
		loadTag: function()
		{	
			var _this = this;

			request({

				url: this.loadUrl,

				sucDo: function(data)
				{
					_this.renderTag(data);

					_this.judeslideTag(_this.tagArea.children());
				}
			});			
		},
		renderTag: function(data)
		{	
			var render = template.compile(this.tagTemp);

			var html = render(data);

			this.tagArea.html(html);
		},
		judeslideTag: function(aList)
		{	
			var nowHeight,
				orgHeight,
				dis,
				_this,
				oSlide,
				oMain;

			_this = this;	

			aList.each(function(i){

				oMain = aList.eq(i).find('[script-role = tag_main]');
				orgHeight = aList.eq(i).height();
				nowHeight = oMain.get(0).scrollHeight;

				if(nowHeight > orgHeight)
				{	
					oSlide = aList.eq(i).find('[script-role = tag_slide]');

					oSlide.show();

					_this.addSlideEvent(aList.eq(i), oMain, oSlide, nowHeight, orgHeight);
				}
			});
		},
		addSlideEvent: function(oList, oMain, oBtn, nowHeight, orgHeight)
		{	
			oBtn.toggle(function(){

				oList.stop().animate({height: nowHeight});
				oMain.stop().animate({height: nowHeight});
				oBtn.html('↑');

			},function(){

				oList.stop().animate({height: orgHeight});
				oMain.stop().animate({height: orgHeight});
				oBtn.html('↓');

			});
		},
		clickEvent: function()
		{	
			var _this,
				index,
				id;

			_this = this;	

			this.tagArea.on('click','[script-role = flat_tag]', function(){

				_this.selectTag($(this));

				index = $(this).parents('[script-role = tag_line]').attr('line');

				id = $(this).attr('data-id');

				_this.makeList($(this).text(), index, id);

				_this.judge();

			});
		},
		selectTag: function(oTag)
		{
			oTag.addClass('actb').siblings().removeClass('actb');
		},
		makeList: function(str, index, id)
		{	
			var i,
				num;

			this.oTempResult[index] = str;
			this.oTempId[index] = id;

			num = this.oTempResult.length;

			if(this.oBox.find('[script-role = flat_sys_tag]')) this.oBox.find('[script-role = flat_sys_tag]').remove();

			for(i=0; i<num; i++)
			{	
				if(this.oTempResult[i])
				{
					var oA = $('<a href="javascript:;" class="mr_5" script-role="flat_sys_tag" onfocus="this.blur()">'+ this.oTempResult[i] +'<span script-role="flat_tag_close" index='+ i +' name='+ this.oTempResult[i] +'>×</span></a>');

					this.oResult.append(oA);	
				}
			}
		},
		closeResult: function()
		{	
			var _this,
				index,
				name,
				oOrgTag;

			_this = this;	

			this.oResult.on('click', '[script-role = flat_tag_close]', function(){

				index = $(this).attr('index');

				name = $(this).attr('name');

				oOrgTag = $('[line = '+ index +']').find('a:contains(' + name + ')');

				oOrgTag.removeClass('actb');

				_this.oTempResult[index] = '';

				$(this).parent().remove();

			});
		},
		uploadPic: function()
		{	
			var _this = this;

			com.upload({
				swf: '/static/swf/upload.swf',
				sRole: _this.swfId,
				sId: _this.swfId,
				queueId: _this.swfqueueId,
				temp: _this.swfTemp,
				width: 157,
				height: 31,
				target: _this.swfTarget,
				queueSizeLimit : 6,
				btnClass: 'xiaopang2',
				text: _this.swfText,
				formData: _this.param,
				sStyle: 'line-height:31px;text-align:center;background:#ff6600;color:#fff;',
				onStart: function()
				{	
					_this.lock = false;

					if(_this.oThink.length) _this.disableViewBtn();
				},
				onEnd: function()
				{	
					_this.lock = true;

					if(_this.oThink.length) _this.view3d();
				},
				onReady: function()
				{	
					_this.judge();
				},
				beforeListen: function()
				{	
					/* 监听户型id,和楼层id,打开上传框 */
					/*this.param.scheme_id = '';
					this.param.floor_id = '';*/
					_this.getPicData();

					$('#' + _this.swfId).uploadify('settings','formData', _this.param);
				},
				onSelectErr: function()
				{
					alert('一次最多上传六张图片');
				},
				onable: function()
				{	
					var roomId = _this.getPicData().room_id;
					var index = _this.oBox.attr('index');

					if(!roomId && !index)
					{
						request({

							url: '/index.php/posts/room/addroom',

							async: 'false',

							data: _this.param,

							sucDo: function(data)
							{	
								_this.oBox.attr('room_id', data.data.room_id);

								if(_this.oThink.length)
								{
									_this.oViewBtn.attr('_href', data.data.preview3d);
								}
							},
							noDataDo: function(msg)
							{	
								_this.illegal(msg);
							}
						});
					}

				},
				onsuc: function(file, data)
				{	
					var newJson = eval('('+ data +')');

					if(!_this.swfSuc)
					{
						var aList,
							aImage,
							oNow;	

						oNow = $('#'+ file.id);

						if(!newJson.err)
						{	
							oNow.find('[script-role = flat_2d_img]').attr('src', newJson.data);
							oNow.find('[script-role = flat_loading_img]').hide();
							oNow.find('[script-role = flat_close_btn]').show();
							oNow.find('[script-role = flat_close_btn]').attr({
								'data-src': newJson.data,
								'data-id': file.id
							});
							oNow.find('[script-role = flat_input]').attr('_src', newJson.data);
							oNow.find('[script-role = flat_input]').removeAttr('disabled');
						}
						else
						{	/* 上传失败就移除 */
							alert(newJson.msg);

							oNow.remove();
						}
					}
					else
					{	
						if(newJson.err)
						{	
							alert(newJson.msg);

							return;
						}
						else
						{
							var aImage = $('[script-role = preserve3d_list]').find('[script-role = preserve3d_img]');

							var url = newJson.data.url;

							var n = url.lastIndexOf('.');

							var type = url.substring(n-1,n);

							//var type = newJson.data.url.split('_')[1].split('.')[0];

							_this.swfSuc(url, aImage, type);
						}
					}
				}

			});
		},
		closeList: function()
		{	
			var _this = this;
			var param = {};
			var id;

			$('#flat_list').on('click', '[script-role = flat_close_btn]', function(){

				param.room_id = _this.oBox.attr('room_id');
				param.pic_md5 = $(this).attr('data-src');
				id = $(this).attr('data-id');
				var oThis = $(this);

				request({

					url: _this.removePicUrl,

					data: param,

					sucDo: function(data)
					{	
						//$('#flat_upload_btn').uploadify('cancel', id);

						oThis.parents('[script-role = flat_2d_list]').remove();
					},
					noDataDo: function(msg)
					{
						alert(msg);
					}
				});
			});
		},
		judge: function()
		{		
			var i,
				result;

			result = true;	

			if(this.oTempResult.length == 3)
			{	
				for(i=0; i<3; i++)
				{
					if(!this.oTempResult[i])
					{
						result = false;
					}
				}

				if(result)
				{
					this.noOverDo();
				}
			}
			else
			{	
				this.overDo();
			}
		},
		overDo: function()
		{	
			var oSwfUpload,
				oSwfReplace;

			oSwfUpload = $('#'+ this.swfId);
			oSwfReplace = $('#'+ this.swfId + '-button');

			oSwfReplace.css({background:'#ccc'});

			oSwfUpload.uploadify('settings','buttonCursor', 'arrow');

			oSwfUpload.uploadify('settings','buttonText', '请先选择功能,色系，风格');

			oSwfUpload.uploadify('disable', true);
		},
		noOverDo: function()
		{	
			var oSwfUpload,
				oSwfReplace;

			oSwfUpload = $('#'+ this.swfId);
			oSwfReplace = $('#'+ this.swfId + '-button');

			oSwfReplace.css({background:'#ff6600'});

			oSwfUpload.uploadify('settings','buttonCursor', 'hand');

			oSwfUpload.uploadify('settings','buttonText', '上传效果图');

			oSwfUpload.uploadify('disable', false);
		},
		getPicData: function()
		{	
			var data = this.oBox.data('info');

			this.param.tag_idlist  = this.oTempId.join(',');
			this.param.room_size  = this.oSquare.val();
			this.param.room_keyword = this.oSelfTag.getData().concat(this.oTempResult).join(',');
			this.param.scheme_id = data.scheme_id || '';
			this.param.floor_id = this.oBox.attr('floor_id') ||  '';
			this.param.room_type = data.scheme_type || '';
			this.param.room_id = this.oBox.attr('room_id') || '';
			this.param.room_name = this.oTempResult[1] + '风格' + this.oSquare.val() + '平米' + this.oTempResult[0];
			this.param.room_thinking = this.oThink.val() == undefined ? '' : this.oThink.val();
			this.param.mapx = this.oBox.data('pinPosition').left;
			this.param.mapy = this.oBox.data('pinPosition').top;

			return {name: this.oTempResult[0], allname: this.param.room_name, num: this.oPicList.find('[script-role = flat_input]').not(':disabled').size(), room_id: this.param.room_id}
		},
		changeArea: function()
		{	
			var _this = this;
			var timer = null;
			var oThis;

			// 让高度变长
			$('#flat_list').on('focus', '[script-role = flat_input]', function(){

				oThis = $(this);

				clearInterval(timer);

				timer = setInterval(function(){

					_this.resizeArea(oThis.get(0));

				},1000/60);

			});

			$('#flat_list').on('blur', '[script-role = flat_input]', function(){

				clearInterval(timer);

			});
		},
		resizeArea: function(oArea,row)
		{	
			if(!oArea){return}
		    if(!row)
		        row=2;
		    var b=oArea.value.split("\n");
		    var c=(!-[1,])?1:0;
		    c+=b.length;
		    var d=oArea.cols;
		    if(d<=20){d=40}
		    for(var e=0;e<b.length;e++){
		        if(b[e].length>=d){
		            c+=Math.ceil(b[e].length/d)
		        }
		    }
		    c=Math.max(c,row);
		    if(c!=oArea.rows){
		        oArea.rows=c;
		        oArea.style.height = c*15 + 'px';
		    }
		},
		submitEvent: function()
		{	
			var _this = this;

			this.oSubmitBtn.unbind('click');

			this.oSubmitBtn.click(function(){

				_this.submit();

			});
		},
		submit: function()
		{
			var _this = this;

			if(!this.lock)
			{
				this.oWrong.html('请先上传图片，或等待当前上传完成再提交');

				return;
			}

			if(!(/^\d{1,5}$/gi.test(this.oSquare.val())))
			{
				this.oWrong.html('请填写格式正确房间大小');

				return;
			}

			if(this.oThink.length)
			{	
				if(!(/^.{1,200}$/gi).test(this.oThink.val()))
				{	
					this.oWrong.html('请填写200字以内的设计思路');

					return;
				}

				if(!this.judgeImage())
				{
					this.oWrong.html('您上传的图片顺序有误,或图片数量少于6张');

					return;
				}

			}
			else
			{
				var sImage = this.oPicList.children().eq(0).find('[script-role = flat_2d_img]').attr('src');

				if(!sImage)
				{
					this.oWrong.html('请至少上传一张图片');

					return;
				}	
			}
			
				var newJson = {};
				var dataPin,
					pinLeft,
					pinTop,
					oImage;

				dataPin = this.oBox.data('pinPosition');
				pinLeft = dataPin.left;
				pinTop = dataPin.top;
				oImage = dataPin.oImage;

				newJson.room_id = this.oBox.attr('room_id');

				newJson.tag_idlist = this.oTempId.join(',');

				newJson.room_size = this.oSquare.val();

				newJson.room_keyword = this.oTempResult.concat(this.oSelfTag.getData()).join(',')

				newJson.imgname = com.imageInfoFormat(this.oPicList.find('[script-role = flat_input]').not(':disabled'));

				newJson.mapx = this.oBox.data('pinPosition').left;

				newJson.mapy = this.oBox.data('pinPosition').top;

				newJson.room_name = this.getPicData().allname;

				newJson.floor_id = this.oBox.attr('floor_id');

				newJson.room_thinking = this.oThink.length ? this.oThink.val() : '';

				newJson.mapx = pinLeft;

				newJson.mapy = pinTop;

				request({

					url: this.createUrl,

					data: newJson,

					sucDo: function(data)
					{	
						_this.confirmSuc(data, oImage, pinLeft, pinTop);

					},
					noDataDo: function(msg)
					{
						_this.illegal(msg);
					}

				});
		},
		confirmSuc: function(data, oImage, left, top)
		{	
			var dataPin,
				name,
				index,
				oLi;

			name = this.oTempResult[0];
			index = this.oBox.attr('index');
			oLi = $('[script-role = room_list]').find('[script-role = '+ index +']');
			
			if(index)
			{	
				oLi.find('[script-role = room_tip]').data('pinData', data);
			}
			else
			{	
				this.makePin(oImage, left, top, name);

				this.makeRightList(data);	
			}

			this.boxInit();

			this.closeBox();
		},
		removePinEvent: function()
		{	
			var _this,
				room_id,
				oImage,
				count;

			_this = this;

			this.oFloorMain.on('click', '[script-role = room_close]', function(){

				oImage = $(this).parents('[script-role = type_upload_list]').find('[script-role = pin_img]');

				count = parseInt(oImage.attr('pincount'));

				room_id = $(this).attr('room_id');

				_this.cancel(room_id, $(this), oImage, count);

			});
		},
		cancelEvent: function()
		{	
			var _this = this;
			var room_id = '';
			var index;

			this.oCancelBtn.unbind('click');

			this.oCancelBtn.click(function(){

				room_id = _this.oBox.attr('room_id');

				index = _this.oBox.attr('index');

				if(room_id && !index)
				{
					request({

						url: _this.cancelUrl,

						data: {room_id: room_id},

						sucDo: function(data)
						{	
							_this.boxInit();

							_this.closeBox();
						}
					})
				}
				else
				{	
					_this.boxInit();

					_this.closeBox();
				}
			});
		},
		cancel: function(roomId, oThis, oImage, count)
		{	
			var _this = this;

			request({

				url: this.cancelUrl,

				data: {room_id: roomId},

				sucDo: function(data)
				{	
					count -- ;

					oImage.attr('pincount', count);

					_this.removePin(oThis);

					_this.boxInit();
				},
				noDataDo: function(msg)
				{	
					/*_this.removePin(oThis);

					_this.boxInit();*/

					alert(msg);
				}
			})
		},
		boxInit: function()
		{
			this.oSquare.val('');

			this.oThink.val('');

			this.oTempId.length = 0;

			this.oTempResult.length = 0;

			this.oSelfInput.val('');

			this.oResult.html('');

			this.oSelfArea.html('');

			this.overDo();

			this.oBox.find('[script-role = tag_line]').find('a').removeClass('actb');

			this.oWrong.html('');

			this.oBox.removeAttr('room_id');

			this.oBox.data('pinPosition', '');

			this.oBox.attr('index','');

			this.oSelfTag.result = [];

			if(this.oThink.length)
			{	
				var aImage = $('[script-role = preserve3d_img]')

				aImage.each(function(i){

					aImage.eq(i).attr('src', '/static/images/lib/global/blank.gif');

				});	

				this.oViewBtn.removeAttr('_href');

				this.oViewBtn.attr('href', 'javascript:;');

				this.oViewBtn.removeClass('act');

				this.oViewBtn.removeAttr('target');
			}
			else
			{	
				this.oPicList.html('');
			}

			this.param = {};
		},
		getSelfTag: function()
		{
			this.oSelfTag = new tag({
				temp: 
				'<a onfocus="this.blur()" class="mr_2" script-role="result_name" href="javascript:;">{{name}}'+
				'</a>'+
				'<span script-role="tag_close" class="gray2 pointer">×</span>',
				frontDo: function(oThis)
				{
					
				},
				BackDo: function(oThis)
				{
					
				},
				maxTag: 3,
				errDo: function(max, oInput)
				{
					alert('最多添加' + (max) + '个自定义关键词');

					oInput.val('');
				},
				addWay: 'normal'
			});

			this.oSelfTag.init();
		},
		closeBox: function()
		{
			$.fancybox.close();
		},
		getNowList: function()
		{
			var floorId,
				index,
				oImage,
				oList,
				oRightList,
				oRoomTip,
				oNum,
				nCount,
				oPin,
				room_id;

			floorId = this.oBox.attr('floor_id');
			index = this.oBox.attr('index');
			room_id = this.oBox.attr('room_id');

			oList = this.oFloorMain.find('[floor_id = '+ floorId +']');	
			oImage = oList.find('[script-role = pin_img]');
			oRightList = oList.find('[script-role = room_list]');
			oRoomTip = oRightList.find('[script-role = '+ index +']');

			oNum = oList.find('[script-role = room_count]');
			oPin = oList.find('[pinindex = '+ index +']');
			nPin = oList.find('[script-role = pic_pin_hased]').size();
			nCount = parseInt(oImage.attr('pincount'));

			return {
				nowImg: oImage,
				nowList: oRightList,
				nowPin: oPin,
				nowNum: oNum,
				nowCount: nCount,
				nowPinCount: nPin,
				nowRoom: oRoomTip,
				nowIndex: index,
				nowRoomId: room_id
			}
		},
		removePin: function(oThis)
		{	
			var index,
				oList,
				oPin,
				oRightNum,
				nNum;

			index = oThis.attr('index');
			oList = oThis.parents('[script-role = '+ index +']');
			oPin = oList.parents('[script-role = type_upload_list]').find('[pinindex = '+ index +']');
			oRightNum = oList.parents('[script-role = type_right]').find('[script-role = room_count]');

			nNum = parseInt(oRightNum.html());
			nNum --;

			oList.remove();
			oPin.remove();
			oRightNum.html(nNum);

		},
		makePin: function(oImage, x, y, name)
		{

			var count = parseInt(oImage.attr('pincount'));

			count ++ ;

			if(count > this.maxPin)
			{
				alert('一张布置图，只能添加10个图钉');

				return;
			}

			var oParent = oImage.parent();
			var oDec = $('<div class="pin_dec">'+ name +'</div>');
		
			var oPin = $('<div script-role="pic_pin_hased"><span class="pic_pin icon178" href="javascript:;"></span></div>');

			oPin.append(oDec);

			this.pinIndex ++ ;

			oPin.attr({'pinIndex': this.pinIndex});

			this.oBox.attr('index', this.pinIndex);

			oImage.attr('pincount', count);

			oParent.css({position:'relative'});

			oPin.css({

				position: 'absolute',

				left: x+'px',

				top: y+'px',

				zIndex: 3
			});

			oParent.append(oPin);

			var left = -((oDec.outerWidth() - 26)/2);

			oDec.css({marginLeft: left});

			oPin.css({textIndent:'0'});

		},
		makeRightList: function(savedData)
		{
			var data,
				data2,
				oNum,
				nPin,
				index,
				sName,
				sAllName,
				nPic,
				oLi,
				oRightList,
				room_id,
				oPin;

			data = this.getNowList();
			data2 = this.getPicData();
			nPin = data.nowPinCount;
			oNum = data.nowNum;
			index = data.nowIndex;
			oRightList = data.nowList;
			oPin = data.nowPin;

			sName = data2.name;
			sAllName = data2.allname;
			nPic = data2.num;
			room_id = data2.room_id;

			oLi = $('<li script-role='+ index +'><a class="room_tip ml_5" href="javascript:;" script-role="room_tip" index='+ index +' room_id='+ room_id +'>'+ sAllName + '('+ nPic +'图)' + '</a><a class="upload_close button178" script-role="room_close" href="javascript:;" index='+ index +' room_id='+ room_id +'>关闭</a></li>');

			oNum.html(nPin);
			oRightList.append(oLi);
			oPin.attr('room_id', room_id);
			oLi.find('[script-role = room_tip]').data('pinData', savedData);

		},
		saveData: function()
		{

		},
		illegal: function(msg)
		{
			alert(msg);

			this.boxInit();

			this.closeBox();
		},
		judgeImage: function()
		{
			var aImage = $('[script-role = preserve3d_list]').find('[script-role = preserve3d_img]');

			var result = true;

			var checkArr = ['u','d','l','r','f','b'];

			var str,
				n;

			aImage.each(function(i){

				str = aImage.eq(i).attr('src');

				n = aImage.eq(i).attr('src').lastIndexOf('.');

				str = str.substring(n-1, n);

				if(str != checkArr[i])
				{
					result = false;
				}

			});

			if(!result)
			{
				return false;
			}
			else
			{
				return true;
			}
		}

	}

	/* 3d */
	function preserver3d(options)
	{	
		UploadFlatUnity.call(this, options);

		this.oBox = $('#flat3d');
		/*this.tagArea = $('[script-role = preserve_area]');
		this.oSelfInput = $('[script-role = result_wrap2]');
		this.oResult = $('[script-role = preserve_tag_result]')
		*/
		this.oViewBtn = $('[script-role = preserve_view_btn]');
		this.oSquare = $('[script-role = preserve_price]');
		this.oPicList = $('[script-role = preserve3d_list]');
		this.oSubmitBtn = $('[script-role = preserve_confirm_btn]');
		this.oCancelBtn = $('[script-role = preserve_cancel_btn]');
		this.oWrong = $('[script-role = preserve_wrong]');

		this.swfTemp = '<li></li>';
		this.swfId = 'preserve_upload_btn';
		this.swfqueueId = '';
		this.swfText = '上传场景';
		this.swfTarget = '/index.php/upload/room_3d';
		this.viewUrl = '/index.php/view/room/getRoomPreview';

		this.swfSuc = function(url, aImage, type)
		{	
			aImage.each(function(i){

				if(aImage.eq(i).attr('img_type') == type)
				{
					aImage.eq(i).attr('src', url);
				}

			});
		}
	}

	preserver3d.prototype.view3d = function()
	{	
		if(this.oBox.attr('room_id') != '' && this.judgeImage())
		{	
			this.oViewBtn.addClass('act');

			this.oViewBtn.attr('href', this.oViewBtn.attr('_href'));

			this.oViewBtn.attr('target', '_blank');
		}
	};
	preserver3d.prototype.disableViewBtn = function()
	{
		this.oViewBtn.removeClass('act');

		this.oViewBtn.attr('href', 'javascript:;')

		this.oViewBtn.removeAttr('target');
	}

	for(var i in UploadFlatUnity.prototype)
	{
		preserver3d.prototype[i] = UploadFlatUnity.prototype[i];
	}
	
	var sType = $('[script-role = upload_type]').attr('type');

	if(sType === '2d')
	{	
		var upload2d = new UploadFlatUnity();

		upload2d.init();
	}
	else if(sType === '3d')
	{	
		var upload3d = new preserver3d();

		upload3d.init();
	}

});
