define(function(require, exports, module) {
	
	var global = require('../../lib/global/global');
	var info = require('../../sub/home/info');
	var mvc = require('../../lib/prototype/prototype');

	var _parent = new mvc();
	var oTempWrap = $('[script-role = inspir_wrap]');

	var Inspir = _parent.extend(function(){

			this.oBox = $('[script-role = inspir_box]');
			this.oClose = $('[script-role = inspir_close_btn]');
			this.oMainPic = $('[script-role = detail_pic]');
			this.oDec = $('[script-role = dec]');
			this.oName = $('[script-role = pic_name]');
			this.oNum = $('[script-role = pic_num]');
			this.oPrev = $('[script-role = prev_btn]');
			this.oNext = $('[script-role = next_btn]');
			this.oKey = $('[script-role = keyword]');
			this.oNexPage = $('[script-role = down_btn]');
			this.oPrevPage = $('[script-role = up_btn]');
			this.oFav = $('[script-role = fav]');
			this.oFavName = $('[script-role = fav_name]');
			this.oViewWrap = $('[script-role = pic_list_wrap]');
			this.aViewImage = $('[script-role = img_list]');
			this.lock = false;
			this.iNow = 0;
			this.page = 1;
		},
			{	
			addEvent: function()
			{	
				var aid,
					_this;

				_this = this;

				this.fav();	

				oTempWrap.on('click', '[script-role = img_list]', function(){

					if(!_this.lock)
					{	
						_this.lock = true;

						aid = $(this).attr('album_id');

						_this.mainLoad(aid, this.page);
					}
				});

				this.oClose.on('click', function(){

					_this.hideBox();

					_this.page = 1;

				});
			},
			mainLoad: function(aid, p)
			{	
				var _this = this;

				this.loadBoxData(aid, p, function(data){

					_this.showBox();

					_this.renderBox(data.data, 0 ,0);

					_this.changePicEvent();

					_this.changeAblumEvent(data.data);

					_this.changePage(aid);

				});	
			},
			loadBoxData: function(aid, p, callBack)
			{	
				var _this = this;

				this.param.aid = aid;
				this.param.p = p;
				this.requestUri = '/index.php/view/album/info';
				this.load();
				this.suc = function(data)
				{	
					_this.lock = false;

					callBack && callBack(data);
				}
			},
			showBox: function()
			{
				this.oBox.show();
			},
			hideBox: function()
			{
				this.oBox.hide();
			},
			renderBox: function(arr, p, iNow)
			{
				var picData,
					sBigPic,
					sDec,
					sName,
					sKey,
					sCount,
					i,
					num,
					_this,
					oLi;

				sBigPic = arr[p].pic_list[0].pic;	
				sDec = arr[p].pic_list[0].pic_content;
				sName = arr[p].content_title;
				sKey = arr[p].tag_list;
				sCount = arr[p].pic_count;
				_this = this;
				num = arr.length;

				this.oMainPic.attr('src', sBigPic);
				this.oDec.html(sDec);
				this.oName.html(sName);
				this.oKey.html(sKey);
				this.oFav.attr('cid', arr[p].content_id);
				this.showNowPage(sCount, iNow);
				this.oNext.attr('max', sCount);
				this.oNext.data('info', '');
				this.oNext.data('info', arr[p].pic_list);
				arr[p].is_like == "1" ? this.oFavName.html('已喜欢') : this.oFavName.html('喜欢');

				this.oViewWrap.html('');

				for (i=0; i<num ;i++)
				{
					var oLi = $('<li><img src='+ arr[i].content_pic +' width="98" height="98" script-role="img_list" /></li>');

					this.oViewWrap.append(oLi);
				}
			},
			showNowPage: function(sum, iNow)
			{	
				this.oNum.html('('+(iNow+1) + '/' + sum+')');
			},
			changePic: function(arr, iNow)
			{	
				this.oMainPic.attr('src', arr[iNow].pic);
				this.oDec.html(arr[iNow].pic_content);
			},
			changePicEvent: function()
			{	
				var _this = this;
				var max = parseInt(this.oNext.attr('max'));
				var data = this.oNext.data('info');

				this.oPrev.unbind('click');
				this.oNext.unbind('click');

				this.oPrev.on('click', function(){

					_this.iNow -- ;

					if(_this.iNow < 0) _this.iNow = max - 1;

					_this.changePic(data, _this.iNow);

					_this.showNowPage(max, _this.iNow);

				});

				this.oNext.on('click', function(){

					_this.iNow ++ ;

					if(_this.iNow > max - 1) _this.iNow = 0

					_this.changePic(data, _this.iNow);

					_this.showNowPage(max, _this.iNow);

				});
			},
			changeAblumEvent: function(arr)
			{	
				var _this = this;

				this.oViewWrap.unbind('click');

				this.oViewWrap.on('click', '[script-role = img_list]', function(){

					var index = $(this).parent().index();

					_this.renderBox(arr, index, 0);

					_this.changePicEvent();

				});
			},
			changePage: function(aid)
			{	
				var _this = this;

				this.oPrevPage.unbind('click');
				this.oNexPage.unbind('click');

				this.oPrevPage.on('click', function(){

					_this.page -- ;

					if(_this.page < 1) return;

					_this.mainLoad(aid, _this.page);

				});

				

				this.oNexPage.on('click', function(){

					_this.page ++ ;

					_this.mainLoad(aid, _this.page);

				});
			},
			fav: function()
			{	
				var _this = this;

				//this.oFav
				this.oFav.on('click', function(){

					if(_this.oFavName.html() == '已喜欢')
					{
						return;
					}
					else
					{
						_this.param.cid = $(this).attr('cid');
						_this.requestUri = '/index.php/posts/content/like';
						_this.load();
						_this.suc = function()
						{
							_this.oFavName.html('已喜欢');
						}
					}

				});
			}

		}
	);
	var _uid = _parent.parse().uid;
	var nType = parseInt($('[script-role = user_head]').attr('level'));


	/* m */
	Inspir.param.uid = _uid;
	Inspir.requestUri = '/index.php/view/user/album';
	Inspir.load();
	Inspir.suc = function(data)
	{
		/* V */
		Inspir.data = data;
		Inspir.tempId = 'inspir_list';
		Inspir.tempWrap = oTempWrap;
		Inspir.render();
		Inspir.addEvent();
	};

});