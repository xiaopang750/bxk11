define(function(require, exports, module) {
	
	var request = require('../../lib/http/request');
	var com = require('../../sub/upload/upload_com');
	var updateImage = require('../../lib/img/update');
	var cutImage=require('../../lib/img/cut');

	function CutImage(options)
	{	
		options = options || {};
		/*
			tempImage 需要有增删操作需要及时获取;
		 */
		this.oView = $('[script-role = right_view]').get(0);
		this.oCutArea = $('[script-role = box_type_view]');
		this.oCutWrap = $('[script-role = cutWrap]').get(0);
		this.imgTemp = '<img src="" alt="" / script-role="cut_image">';
		this.oSave = $('[script-role = save_arrange]').get(0);
		this.oRotate = $('[script-role = rotate_btn]');
		this.sRoteUrl = '/index.php/upload/img_rotation';
		this.sCreatUrl = '/index.php/upload/crop_floor_pic1';
		this.sRepeatUrl = '/index.php/upload/floor_pic1_reply';
		this.oNormalClose = $('[script-role = cut_box_close]');
		this.oAddBtn = $('[script-role = type_add_btn]');
		this.nCutAreaWidth = 370;
		this.nCutAreaHeight = 370;
		this.scaleWidth = 27;
		this.scaleHeight = 37;
		this.param = {};
		this.floorMain = $('[script-role = type_upload_inner]');
		this.oViewWidth = 405;
		this.oViewHeight = 555;
		this.pinWidth = 26;
		this.pinHeight = 34;
		this.maxPin = 10;
		this.pinIndex = 0;
		this.maxFloor = 3;
		this.picBox = $('#flat3d');
	}	

	CutImage.prototype = {

		init: function()
		{	
			this.uploadImage();

			this.closeBox();

			this.makePinEvent();

			this.movePinEvent();

			this.clickPinEvent();

			this.reUpLoad();

			this.overPinEvent();

			this.overList();
		},
		uploadImage: function()
		{	
			var _this = this;

			com.upload({
				sRole: 'arrange_btn',
				sId: 'upload_btn_area',
				queueID:'',
				temp:'<li style="display:none"></li>',
				width: 106,
				height: 30,
				btnbg: 'url("/static/images/lib/button/button.png") no-repeat -205px -260px',
				target: '/index.php/upload/floor_pic1',
				queueSizeLimit : 1,
				formData: _this.param,
				btnClass: 'xiaopang1',
				beforeListen: function()
				{	
					var type = _this.floorMain.attr('type');

					if(type == 'create' || !type)
					{
						$('#upload_btn_area').uploadify('settings','target', '/index.php/upload/floor_pic1');
					}
					else
					{
						$('#upload_btn_area').uploadify('settings','target', '/index.php/upload/floor_pic1_reply');
					}

					$('#upload_btn_area').uploadify('settings','formData', _this.floorMain.data('info'));

					/* 监听户型id,和楼层id,打开上传框 */
					/*this.param.scheme_id = '';
					this.param.floor_id = '';*/


				},
				onSelectErr: function()
				{
					
				},
				onsuc: function(file, data)
				{	
					var newJson = eval('('+ data +')');		

					if(newJson.err)
					{	
						_this.oRotate.unbind('click');

						alert(newJson.msg);
					}	
					
					_this.uploadSuc(newJson);	
				}
			});
		},
		uploadSelectErr: function()
		{

		},
		uploadSuc: function(data)
		{	
			var sImageUrl,
				_this;

			sImageUrl = data.data.url;
			_this = this;
			this.saveData(data.data);

			_this.oRotate.attr('source', data.data.source);

			this.update(sImageUrl, function(data){

				_this.cut(data);

				_this.roteteEvent();

			});
		},
		roteteEvent: function()
		{	
			var  _this,
				 src,
				 source;

			_this = this;	

			this.oRotate.unbind('click');

			this.oRotate.click(function(){

				source = $(this).attr('source');

				src = _this.getUri($('[script-role = cut_image]').attr('src'));

				_this.rotate(src, source);

			});
		},
		rotate: function(src, source)
		{	
			var _this = this;

			request({

				url: _this.sRoteUrl,

				async: 'false',

				data: {imgurl: src, source: source},

				sucDo: function(data)
				{
					src = _this.rndSrc(data.data.url);

					/* 转储原图信息 */
					_this.saveData(data.data);

					_this.update(src, function(data){

						_this.cut(data);

					});
				}

			});
		},
		update: function(src, callBack)
		{
			var oCutImage,
				oImage,
				_this,
				oImage;

			oImage = new Image();	
			_this = this;
			this.cutInit();
			src = this.rndSrc(src);

			oImage.onload = function()
			{	
				oCutImage = $('[script-role = cut_image]');

				oCutImage.attr('src', src);

				updateImage({
			        aEle:oCutImage,
			        wrapWidth:_this.nCutAreaWidth,
			        wrapHeight:_this.nCutAreaHeight
		         	},function(data){
	            	
		         	callBack && callBack(data);

	        	});
			};

			oImage.src = src;
		},
		cut: function(data)
		{	
			var _this = this;

			cutImage({
				oWrap: this.oCutWrap,
	            oImage:$('[script-role = cut_image]').get(0),
	            oView:this.oView,
	            oSubmintBtn:this.oSave,
	            width:data[0].width,
	            height:data[0].height,
	            oldWidth:data[0].oldWidth,
	            oldHeight:data[0].oldHeight,
	            left:data[0].left,
	            top:data[0].top,
	            scaleWidth: this.scaleWidth,
	            scaleHeight: this.scaleHeight,
	            fnDo:function(info)
	            { 	
	            	var newJson = _this.floorMain.data('info');
	            	var type = _this.floorMain.attr('type');

	            	for(var i in newJson)
	            	{
	            		info[i] = newJson[i];
	            	}

	            	info.source = $(_this.oSave).attr('img_src');
	            	info.copyimg = $(_this.oSave).attr('copyimg');

	               if($('[script-role = cut_image]').attr('src'))
	               {	
	               		request({

		               		url: _this.sCreatUrl,

		               		data: info,

		               		sucDo: function(data)
		               		{	
		               			var index = parseInt(_this.floorMain.data('info').index);

		               			var aList = _this.floorMain.find('[script-role = type_upload_list]');

		               			_this.showImage(aList.eq(index), data.data, index, type);

		               		},
		               		noDataDo: function(msg)
		               		{	
		               			alert(msg);

		               			_this.endDo();
		               		}

		               });
	               }
	               else
	               {
	               		_this.endDo();
	               }            
	            }

	        });
		},
		cutInit: function()
		{	
			this.oCutArea.html(this.imgTemp);	
			if($('#cover_added'))$('#cover_added').remove();
			if($('#shadow_added'))$('#shadow_added').remove();
			$(this.oView).html('');
		},
		rndSrc: function(src)
		{
			src = src + '?' + new Date().getTime();

			return src;
		},
		getUri: function(src)
		{
			var reOrgPic = new RegExp('http://'+window.location.host,'gi');

			src = src.split('?')[0].replace(reOrgPic, '');

			return src;
		},
		saveData: function(data)
		{	
			$(this.oSave).attr('img_src', data.source);
			$(this.oSave).attr('img_width', data.width);
			$(this.oSave).attr('img_height', data.height);
			$(this.oSave).attr('copyimg', data.copyimg);
		},
		endDo: function()
		{	
			this.cutInit();

			this.oRotate.unbind('click');

			$.fancybox.close();
		},
		closeBox: function()
		{	
			var _this = this;

			this.oNormalClose.click(function(){

				$.fancybox.close();

				_this.cutInit();

				_this.oRotate.unbind('click');

			});
		},
		showImage: function(oList, src, index, type)
		{	
			if(type == 'create' || !type)
			{
				var oImage = new Image();
				var oUpLoadBtn,
					oRpeatBtn,
					oLeft,
					_this,
					width,
					height;

				oLeft = oList.find('[script-role = type_left]');
				oUpLoadBtn = oList.find('[script-role = upload_typebox_btn]');
				oRpeatBtn = oLeft.parents('[script-role = type_upload_list]').find('[script-role = repeat_uploadbox_btn]');

				oRpeatBtn.attr({
					index: index,
					floor_id: oLeft.parents('[script-role = type_upload_list]').attr('floor_id'),
					scheme_id: $('[script-role = project_name]').attr('scheme_id')
				});

				_this = this;
				width = oList.width();
				height = oList.height();

				oImage.onload = function()
				{
					oLeft.append(oImage);

					oUpLoadBtn.hide();
					oRpeatBtn.show();

					if($('[script-role = floor_btn]').size() < _this.maxFloor)
					{
						_this.oAddBtn.show();
					}	

					_this.floorMain.attr('index', parseInt(index) + 1);

					_this.endDo();
				};

				oImage.src = src;
				oImage.width = this.oViewWidth;
				oImage.height = this.oViewHeight;
				oImage.setAttribute('pincount', '0');
				oImage.setAttribute('script-role', 'pin_img');
			}
			else
			{	
				var oImage,
					replyIndex;

				replyIndex = this.floorMain.attr('replyIndex');	

				oImage = $('[script-role = pin_img]').eq(replyIndex);

				oImage.attr('src', src +'?'+ new Date().getTime());

				this.endDo();

			}
		},
		makePinEvent: function()
		{	
			var _this,
				x,
				y,
				count;

			_this = this;	

			this.floorMain.on('click', '[script-role = pin_img]', function(e){
				
				count = $(this).attr('pincount');

				if(count >= _this.maxPin)
				{	
					alert('一层楼最多添加' + _this.maxPin + '房间');

					return;
				}

				x = e.clientX - $(this).parent().offset().left - (_this.pinWidth/2);

				y = e.pageY - $(this).parent().offset().top - _this.pinHeight;

				_this.picBox.data('pinPosition', {

					oImage: $(this),

					left: x,

					top: y
				});

				_this.showPicBox($(this));
				//_this.makePin($(this), x, y);

			});
		},
		clickPinEvent: function()
		{	
			var _this = this;

			this.floorMain.on('click', '[script-role = room_tip]', function(e){

				_this.showEditData($(this));

				_this.showPicBox($(this));

			});
		},
		overPinEvent: function()
		{
			var _this = this;
			var index;

			this.floorMain.on('mouseenter', '[script-role = pic_pin_hased]', function(e){

				index = $(this).attr('pinindex');

				$(this).parents('[script-role = type_upload_list]').find('[script-role = room_list]').find('[script-role = '+ index +']').addClass('act');

			});

			this.floorMain.on('mouseleave', '[script-role = pic_pin_hased]', function(e){

				index = $(this).attr('pinindex');

				$(this).parents('[script-role = type_upload_list]').find('[script-role = room_list]').find('[script-role = '+ index +']').removeClass('act');

			});
		},
		overList: function()
		{
			var _this = this;
			var index;

			this.floorMain.on('mouseenter', '[script-role = room_list] li', function(e){

				index = $(this).attr('script-role');

				$(this).parents('[script-role = type_upload_list]').find('[script-role = type_left]').find('[pinindex = '+ index +'] .pin_dec').addClass('act');

			});

			this.floorMain.on('mouseleave', '[script-role = room_list] li', function(e){

				index = $(this).attr('script-role');

				$(this).parents('[script-role = type_upload_list]').find('[script-role = type_left]').find('[pinindex = '+ index +'] .pin_dec').removeClass('act');

			});
		},
		movePinEvent: function()
		{	
			var disX,
				disY,
				x,
				y,
				_this,
				oThis,
				aAll,
				orgLeft,
				orgTop,
				index,
				oList;

			_this = this;

			this.floorMain.on('mousedown', '[script-role = pic_pin_hased]', function(e){

				oThis = $(this);

				index = oThis.attr('pinindex');

				oList = oThis.parents('[script-role = type_upload_list]').find('[script-role = room_tip][index = '+ index +']');

				disX = e.pageX - $(this).position().left;

				disY = e.pageY - $(this).position().top;

				orgLeft = $(this).position().left;

				orgTop = $(this).position().top;

				$(document).on('mousemove', '[script-role = pin_img]', function(e){

					x = e.pageX - disX;

					y = e.pageY - disY;

					oThis.css({
						left: x,
						top: y
					});

				});

				_this.floorMain.on('mouseup', function(e){

					$(document).unbind('mousemove');

					$(document).unbind('mouseup');

					oList.data('pinData').data.mapx = x;

					oList.data('pinData').data.mapy = y;										
					oThis.get(0).releaseCapture();

					_this.testPin(oThis, orgLeft, orgTop);

				});

				(oThis.get(0).setCapture && (!-[1,])) && oThis.get(0).setCapture();

				return false;

			});
		},
		cdTest: function(obj1, obj2)
		{	
			var l1 = obj1.position().left;
			var r1 = obj1.position().left + obj1.width();
			var t1 = obj1.position().top;
			var b1 = obj1.position().top + obj1.height();

			var l2 = obj2.position().left;
			var r2 = obj2.position().left + obj2.width();
			var t2 = obj2.position().top;
			var b2 = obj2.position().top + obj2.height();

			if(r2 < l1 || l2 > r1 || b2 < t1 || t2 > b1)
			{
				return false;
			}
			else
			{
				return true;
			}
		},
		testPin: function(oThis, disX, disY)
		{	
			var aAll,
				oImage,
				nowCount;

			aAll = oThis.parent().find('[script-role = pic_pin_hased]');

			oImage = oThis.parent().find('[script-role = pin_img]');

			nowCount = parseInt(oImage.attr('pincount'));

			for(var i=0; i<aAll.length; i++)
			{	
				if(aAll[i] != oThis.get(0))
				{	
					if(this.cdTest(oThis, aAll.eq(i)))
					{	

						oThis.css({
							left: disX,
							top: disY
						})

						alert('图钉位置不能重叠');
					}
				}						
			}
		},
		makeList: function(index)
		{

		},
		showPicBox: function(oPin)
		{	
			var floorId,
				room_id;

			room_id = oPin.attr('room_id') || '';
			floorId = oPin.parents('[script-role = type_upload_list]').attr('floor_id');

			this.picBox.attr({'floor_id': floorId, 'room_id': room_id});

			$.fancybox({href:'#flat3d', centerOnScroll:'false'});

		},
		showEditData: function(oThis)
		{
			var data = oThis.data('pinData').data || oThis.data('pinData');
			var index = oThis.attr('index');
			this.picBox.attr('index', index);

			/* 编辑设计思路 */
			$('[script-role = room_thinking]').val(data.room_thinking);

			/* 编辑的时候把坐标给box 编辑 */
			var pData = {};
		
			pData.left = data.mapx;
			pData.top = data.mapy;
			this.picBox.data('pinPosition', pData);
			
			/* 获取系统标签 */
			var dataTagId = data.tags;

			for (var i=0; i<dataTagId.length; i++)
			{
				this.findWhich(dataTagId[i]);
			}

			/* 获取关键词 */
			var keyWord = data.room_keyword.split(',');

			for(var i=3; i<keyWord.length; i++)
			{	
				var temp = 
				'<span class="result_tag" script-role="result_tag">'+
				'<a class="mr_2" href="javascript:;" script-role="result_name" onfocus="this.blur()">'+ keyWord[i] +'</a>'+
				'<span class="gray2 pointer" script-role="tag_close">×</span>'+
				'</span>';

				var oSpan = $(temp);

				$('[script-role = result_wrap]').append(oSpan);
			}

			/* 房间大小 */
			$('[script-role = flat_price]').val(data.room_size);
			$('[script-role = preserve_price]').val(data.room_size);

			/* 图片信xi */

			/* 2d展示图片 */
			if(data.roomcontent)
			{
				var piccontent = data.roomcontent.content;
				var oPicWrap = $('#flat_list');

				for (var i=0; i<piccontent.length; i++)
				{
					var temp = 
					'<li id="" script-role="flat_2d_list">'+
					    '<a class="close_btn button178" href="javascript:;" onfocus="this.blur()" script-role="flat_close_btn" style="display: inline;" data-src='+ piccontent[i].thumb_5 +' data-id="">¹Ø±Õ</a>'+
						'<dl>'+
							'<dt>'+
								'<img class="flat_loading_img" script-role="flat_loading_img" src="/static/images/lib/loading/pic_loading.gif" style="display: none;">'+
								'<img width="154" height="112" script-role="flat_2d_img" alt="" src='+ piccontent[i].thumb_5 +'>'+
							'</dt>'+
							'<dd></dd>'+
						'</dl>'+
					    '<textarea cols="30" script-role="flat_input" _src='+ piccontent[i].thumb_5 +'>'+ piccontent[i].con +'</textarea>'+
					'</li>';

					var oLi = $(temp);

					oPicWrap.append(oLi);
				}
			}	/* 3d图片展示 */
			else
			{
				var piccontent = data.imglist;
				var aImage = $('[script-role = preserve3d_img]');

				for (var i=0; i<piccontent.length; i++)
				{
					aImage[i].src = piccontent[i];
				}
			}
			

		},
		findWhich: function(id)
		{
			//房间功能，设计风格，色系哪个被选中
			var aTag = $('[script-role = flat_tag]');

			aTag.each(function(i){

				if(aTag.eq(i).attr('data-id') == id)
				{
					aTag.eq(i).trigger('click');
				}

			});		
			
		},
		reUpLoad: function()
		{	
			var _this,
				index,
				oImage,
				fid,
				sid;

			_this = this;

			this.floorMain.on('click', '[script-role = repeat_uploadbox_btn]', function(){

				/* type为relpy为重新上传 */
				fid = $(this).attr('floor_id');
				sId = $(this).attr('scheme_id');
				index = parseInt($(this).attr('index'));

				_this.floorMain.data('info').floor_id = fid;
				_this.floorMain.attr({
					type: 'reply',
					replyIndex: index
				});

				$.fancybox({href:'#cutbox', centerOnScroll:false});

				/*request({

					url: _this.repeatUrl,

					data: {floor_id: fid, scheme_id: sId},

					sucDo: function(data)
					{
						console.log(data);

						oImage = _this.floorMain.find('[script-role = type_upload_list]').eq(index).find('[script-role = pin_img]');

						oImage.src = data.data;
					}

				});*/

			});
		}

	};

	var cut = new CutImage();

	cut.init();

});