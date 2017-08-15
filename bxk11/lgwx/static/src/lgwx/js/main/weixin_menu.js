/*
 *description:自定义菜单
 *author:fanwei
 *date:2014/04/20
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var dialog = require('../widget/dom/dialog');
	var inputTip = require('../widget/dom/inputTip');
	var template = require('../lib/template/template');
	var oTip = require('../widget/dom/tip');
	var bodyParse = require('../widget/http/bodyParse');

	var addBox = new dialog({
		boxSelector:'[sc = weixin-add-box]'
	});

	var infoBox = new dialog({
		boxSelector:'[sc = info-box]'
	});

	var confirmBox = new dialog({
		boxSelector:'[sc = weixin-remove-confirm]'
	});


	var oAddBoxTitle = addBox.boxTitle();

	function Menu() {

		this.oMenu = $('[sc = menu-wrap]');
		this.oInput = $('[sc = input-name]');
		this.oTodoFront = $('[sc = todoFront]');
		this.oTodoBack = $('[sc = todoBack]');
		this.oConfirm = $('[confirm-type = add]');
		this.oWrongTip = $('[sc = wrong-tip]');
		this.oMenuWrap = $('[sc = menu-content]');

		this.MAIN_LIMIT = 3;
		this.SUB_LIMIT = 5;
		this.ADDURL = '/lgwx/index.php/post/weixin/diy_menu_add';
		this.EDITURL = '/lgwx/index.php/post/weixin/diy_menu_name_mod';
		this.SHOWMENUURL = '/lgwx/index.php/view/weixin/diy_menu';
		this.REMOVEURL = '/lgwx/index.php/post/weixin/diy_menu_del';
		this.SORTURL = '/lgwx/index.php/post/weixin/diy_menu_sort';
		this.SAVEALLURL = '/lgwx/index.php/post/weixin/save_menu';
		this.param = bodyParse();
		this.WID = this.param.wid;
		this.TOKEN = this.param.token;
		this.oAddParent = null;
		this.oHolder = null;
		this.listData = null;
		this.oFatherList = null;

	}

	Menu.prototype = {

		init: function() {

			if( !this.WID || !this.TOKEN ) {

				oTip.say( '非法操作' );

				return;

			}

			this.showMenu();

			this.createHolder();

			this.events();

		},
		showMenu: function() {

			var param = {wid:this.WID, service_token:this.TOKEN};
			var	_this = this;

			$.post(this.SHOWMENUURL, param , function(data){

				if( data.err ) {

					oTip.say( data.msg );

				} else {

					_this.renderList( _this.oMenuWrap, 'main-list-wrap', data );
					_this.cacheData( data );

				}

				var html = template('main-list-wrap', data);

			},'json');

		},
		cacheData: function(data) {

			var arrOut = data.data.menu_list;
			var num = arrOut.length;
			var i,
				k,
				aParent,
				aSub,
				arrInner,
				innerNum;

			aParent = $('[list-parent]');

			for ( i=0; i<num; i++ ) {

				aParent.eq(i).data('info', arrOut[i]);
				arrInner = arrOut[i].smd_son_list ? arrOut[i].smd_son_list : [];
				innerNum = arrInner.length;
				aSub = aParent.eq(i).parents('[role = main-list]').find('[list-sub]');

				for ( k=0; k<innerNum; k++ ) {

					aSub.eq(k).data('info', arrInner[k]);

				}
			}
		},	
		events: function() {

			var _this,
				oTaregt,
				sRole;

			_this = this;

			this.oMenu.on('click', function(e){

				oTaregt = $(e.target);
				sRole = oTaregt.attr('sc');

				switch( sRole ) {

					case 'add-main':

						//添加主菜单
						_this.add_edit('main', 'add', oTaregt);
					break;

					case 'list-add':
						//添加子菜单
						_this.add_edit('sub', 'add', oTaregt);
					break;

					case 'list-edit-main':
						//编辑主菜单
						_this.add_edit('main', 'edit', oTaregt);
					break;

					case 'list-edit-sub':
						//编辑子菜单
						_this.add_edit('sub', 'edit', oTaregt);
					break;

					case 'sort':

						//排序
						_this.toReadySort();
					break;

					
					case 'confirmSort':

						//确认排序
						_this.saveSort();
					break;


					case 'cancel':

						//取消排序
						_this.toCacncelSort();
					break;

					case 'list-del':

						//删除
						_this.remove( oTaregt );
					break;

				}

			});

			this.bindListEvent();

			//box
			var listType,
				reqType,
				listId,
				name;

			addBox.onConfirm = function(oThis) {

				listType = oThis.attr('listType');
				reqType = oThis.attr('reqType');
				listId = oThis.attr('list-id') ? oThis.attr('list-id') : '';
				name = _this.oInput.val();

				_this.req(listType, reqType, listId, name);

			};

			addBox.onClosed = function() {

				_this.wrongHide();
				_this.initInput('');

			};

			addBox.onStart = function() {

				_this.oInput.focus();

			};


			//input-check
			var max;

			this.oInput.on('keyup', function(){

				max = parseInt( $(this).attr('max') );

				_this.judeValue(max, '●菜单名称名字不多于'+ max/2 +'个汉字或'+ max +'个字母');

			});


			//save-all;
			$('[sc = save-all]').on('click', function(){

				_this.saveAll();

			});

		},
		saveAll: function() {

			$.post(this.SAVEALLURL, {service_token:this.TOKEN}, function(data){

				oTip.say( data.msg );

			},'json');

		},
		add_edit: function(listType, reqType, oThis) {

			//添加编辑菜单
			var max,
				title,
				listMax,
				num,
				oList,
				tip,
				id,
				name,
				oName;

			if( listType == 'main' ) {

				max = 8;
				title = '菜单名称名字不多于4个汉字或8个字母:';
				tip = '一级菜单最多只能三个';
				listMax = this.MAIN_LIMIT;
				oList = $('[role = main-list]');
				id = '';
				oName = oThis.parents('[sort-list-main]').find('[sc = main-name]');

			} else if( listType == 'sub' ) {

				max = 16;
				title = '菜单名称名字不多于8个汉字或16个字母:';
				tip = '二级菜单最多只能五个';
				listMax = this.SUB_LIMIT;
				this.oAddParent = oThis.parents('[sort-list-main]').find('[sc = sub-wrap]');
				oList = this.oAddParent.find('[role = sub-list]');
				id = this.oAddParent.attr('list-id');
				oName = oThis.parents('[sort-list-sub]').find('[sc = sub-name]');
				this.oFatherList = oThis.parents('[sc = hover-list]');

			}

			if( reqType == 'edit' ) {

				id = oThis.attr('list-id');
				name = oThis.attr('name');
				this.initInput( name );
				this.oConfirm.data('oName', oName);

			}

			num = oList.length;

			if( num >= listMax && reqType == 'add' ) {

				oTip.say( tip )
				return;

			}

			oAddBoxTitle.html( title );
			addBox.show();
			this.oConfirm.attr({
				listType : listType,
				reqType : reqType,
				'list-id' : id
			});
			this.oInput.attr('max', max);
				
		},
		req: function(listType, reqTtype, id, name) {

			//添加请求

			var isChecked,
				oList,
				reqUrl,
				result,
				tplId,
				paramIdName,
				data,
				_this,
				oMenuWrap,
				oName;

			_this = this;
			isChecked = this.oInput.attr('check');
			data = {};

			if( listType == 'main' ) {

				tplId = 'menu-main';
				oMenuWrap = this.oMenuWrap;	

			} else if( listType == 'sub' ) {

				tplId = 'menu-sub';	
				oMenuWrap = this.oAddParent;
			}

			if( reqTtype == 'add' ) {

				reqUrl = this.ADDURL;
				paramIdName = 'smd_pid';
				

			} else if( reqTtype == 'edit' ) {

				reqUrl = this.EDITURL;
				paramIdName = 'smd_id';
			
			}

			result = this.oInput.attr('check');

			if( result == 'right' ) {

				data[paramIdName] = id;
				data.smd_name = name;
				data.wid = this.WID;
				data.service_token = this.TOKEN;

				$.post(reqUrl, data, function(data){

					if( !data.err ) {

						if( reqTtype == 'add' ) {

							if( listType == 'sub' ) {

								_this.oFatherList.attr('select-type', '-1');

							}

							_this.renderList( oMenuWrap, tplId, data.data );	

						} else if( reqTtype == 'edit' ) {

							oName = _this.oConfirm.data('oName');
							oName.html( name );

						}

						_this.initInput('');
						oRightLay.initShow();
						addBox.close();

					} 

					oTip.say( data.msg );

				},'json');

			}

		},
		bindListEvent: function() {

			var _this = this;

			this.oMenu.on('mouseenter', '[sc = hover-list]', function(e){

				_this.funcBtnShow( $(this) );

			});


			this.oMenu.on('mouseleave', '[sc = hover-list]', function(e){

				_this.funcBtnHide( $(this) );

			});

			this.oMenu.on('click', '[sc = hover-list]', function(e){

				var isFuncBtn;

				isFuncBtn = $(e.target).parents('[sc = func-btn-area]').length;

				if( !isFuncBtn ) {

					_this.selectMenu( $(this) );
				}

				

			});

		},
		cancelListEvent: function() {

			this.oMenu.off('mouseenter');
			this.oMenu.off('mouseleave');
			this.oMenu.off('click', '[sc = hover-list]');

		},
		toReadySort: function() {

			var aMove;
			aMove = $('[sc = list-sort]');

			this.oTodoFront.hide();
			this.oTodoBack.show();
			this.cancelListEvent();
			aMove.addClass('show');
			this.move();
			oRightLay.initShow();
			
		},
		toCacncelSort: function() {

			var aMove;
			aMove = $('[sc = list-sort]');

			this.oTodoBack.hide();
			this.oTodoFront.show();
			this.bindListEvent();
			aMove.removeClass('show');
			this.cancelMove();

		},
		funcBtnShow: function(oThis) {

			var oFuncBtn,
				oHoverList,
				aMove;
			oFuncBtn = oThis.find('[sc = func-btn-area]');
			oHoverList = oThis.find('[sc = inner_menu_link]');
			oFuncBtn.show();
			oHoverList.addClass('active');	

		},
		funcBtnHide: function(oThis) {

			var oFuncBtn,
				oHoverList;
			oFuncBtn = oThis.find('[sc = func-btn-area]');
			oHoverList = oThis.find('[sc = inner_menu_link]');
			oFuncBtn.hide();
			oHoverList.removeClass('active');

		},
		judeValue: function(max, tip) {

			var result = this.checkValue( max );

			if( result ) {

				this.wrongHide();

			} else {

				this.wrongShow( tip );

			}

		},
		wrongShow: function(tip) {

			this.oWrongTip.html(tip);
			this.oWrongTip.removeClass('right');
			this.oWrongTip.addClass('wrong');
			this.oInput.attr('check', 'wrong');

		},	
		wrongHide: function() {

			this.oWrongTip.html('holder');
			this.oWrongTip.removeClass('wrong');
			this.oWrongTip.addClass('right');
			this.oInput.attr('check', 'right');

		},
		initInput: function(str) {

			this.oInput.val(str);
			this.oInput.attr('check', 'wrong');

		},
		checkValue: function(max) {

			max = max ? max : 0;

			var sValue,
				strLength,
				num;

			strLength = 0;
			sValue = this.oInput.val();
			num = sValue.length;

			for ( var i=0; i<num; i++ ) {

				if( sValue.charCodeAt(i) > 255 ) {

					strLength += 2;

				} else {

					strLength += 1;

				}

			}

			if( strLength <= max && strLength >= 1 ) {

				return true;

			} else {

				return false;

			}
			

		},
		renderList: function(oWrap, id, data, clear) {

			if( clear ) {
				oWrap.html('');
			}

			var html = $( template(id, data) );
			oWrap.append( html );

		},
		remove: function(oThis) {

			var id,
				param,
				oParent,
				type,
				_this;

			_this = this;
			type = oThis.attr('type');
			param = {};
			id = oThis.attr('list-id');
			param.smd_id = id;
			if( type == 'main' ) {

				oParent = oThis.parents('[sort-list-main]');	

			} else if( type == 'sub' ) {

				oParent = oThis.parents('[sort-list-sub]');
				//removeReq();
			}

			confirmBox.show();
			confirmBox.onConfirm = removeReq;

			function removeReq() {

				$.post( _this.REMOVEURL, param, function(data){

					if( !data.err ) {

						if( type == 'sub' ) {

							if( !oParent.siblings().length ) {

								var oMainList;
								oMainList = oParent.parents('[role = main-list]').find('[list-parent]');

								oMainList.attr('select-type', '0');
								oMainList.data('info','');								

							}
							
						}

						oRightLay.initShow();
						oTip.say( data.msg );
						oParent.remove();
						confirmBox.close();

						

					} 

					oTip.say( data.msg );

				},'json' );	

			}
		},
		move: function() {

			var _this = this;
			var timer1 = null;
			var timer2 = null;
			var timer3 = null;

			//move
			this.oMenuWrap.on('mousedown', '[move]', function(e){

				var oEvent = e || event;
				var oThis = $(this);
				var orgLeft = oThis.position().left;
				var orgTop = oThis.position().top;
				var orgHeight = oThis.outerHeight(true);

				var disX = oEvent.clientX - orgLeft;
				var disY = oEvent.clientY - orgTop;
				var w = oThis.outerWidth(true);
				var h = oThis.outerHeight(true);
				var aSibligns = oThis.siblings();
				var num = aSibligns.length;
				var i=0;
				var oResult = null;
				var nowIndex,
					targetIndex,
					temp;

				nowIndex = oThis.index();
				oThis.addClass('active');
				_this.oHolder.addClass('show');
				_this.oHolder.css('height', orgHeight);
				oThis.css({
					width:w,
					height:h,
					position:'absolute'
				});
				oThis.after( _this.oHolder );

				_this.oMenuWrap.on('mousemove', '[move]', function(e){
		

					var oEvent = e || event;
					var left = oEvent.clientX - disX;
					var top = oEvent.clientY - disY;
					
					oThis.css({
						left:left,
						top:top
					});

					clearTimeout( timer1 );
					timer1 = setTimeout(function(){

						oResult = _this.findNearest( oThis, aSibligns );

						if( oResult ) {

							targetIndex = oResult.index();

							if( nowIndex > targetIndex ) {

								oResult.before( _this.oHolder );	

							} else {

								oResult.after( _this.oHolder );

							}

							temp = nowIndex;
							nowIndex = targetIndex;
							targetIndex = temp;
						}

					},50);
				});

				_this.oMenuWrap.on('mouseup', '[move]', function(e){

					_this.oMenuWrap.off('mousemove');
					_this.oMenuWrap.off('mouseup');
					oThis.removeClass('active');
					_this.oHolder.removeClass('show');

					clearTimeout( timer2 );
					timer2 = setTimeout(function(){

						_this.oHolder.after( oThis );

					},5);

					clearTimeout( timer3 );
					timer3 = setTimeout(function(){

						$('body').append( _this.oHolder );	

					},10);

					oThis.css({
						width:'',
						height:'',
						left:'',
						top:'',
						position:''
					});

					oThis.get(0).releaseCapture && oThis.get(0).releaseCapture();

				});

				oThis.get(0).setCapture && oThis.get(0).setCapture();

				return false;

			});

		},
		cancelMove: function() {

			this.oMenuWrap.off('mousedown');

		},
		createHolder: function() {

			this.oHolder = $('<div class="placeholder"></div>');
			$('body').append( this.oHolder );

		},
		cdTest: function(obj1, obj2) {

			var l1 = obj1.position().left;
			var r1 = obj1.position().left + obj1.width();
			var t1 = obj1.position().top;
			var b1 = obj1.position().top + obj1.height();

			var l2 = obj2.position().left;
			var r2 = obj2.position().left + obj2.width();
			var t2 = obj2.position().top;
			var b2 = obj2.position().top + obj2.height();

			if(r2 < l1 || l2 > r1 || b2 < t1 || t2 > b1) {

				return false;
			}
			else {

				return true;
			}

		},
		getDis: function(obj1, obj2) {

			var x=obj1.position().left-obj2.position().left;
  
		  	var y=obj1.position().top-obj2.position().top;
		  
		  	var dis=Math.sqrt(Math.pow(x,2)+Math.pow(y,2));
		  
		  	return dis;

		},
		findNearest: function(obj, aSiblings) {

			var iMin=9999999;
			var iMinIndex=-1;
			var num,i,dis;
			num = aSiblings.length;

			for (i=0; i<num; i++) {
				
				if( this.cdTest(obj, aSiblings.eq(i) ) ) {

				    dis = this.getDis( obj, aSiblings.eq(i) );
				   
				    if(dis < iMin){

				    	iMin = dis;
						iMinIndex = i;

				    }
				}
			}
			  
			if( iMinIndex == -1 ) {

			    return null;

			} else {

			    return aSiblings.eq( iMinIndex );
			}

		},
		saveSort: function() {

			var arr,
				aList,
				aNowSubList,
				pid,
				arrSingle,
				arrAll = [],
				result,
				_this;

			_this = this;
			aList = $('[role = main-list]');
			aList.each(function(i){

				arrSingle = [];
				pid = aList.eq(i).attr('list-id');
				aNowSubList = aList.eq(i).find('[role = sub-list]');
				aNowSubList.each(function(i){

					arrSingle.push( aNowSubList.eq(i).attr('list-id') );

				});

				arrAll.push( pid + '^' + arrSingle.join(',') );

			});	

			result = arrAll.join('|');

			$.post( this.SORTURL, {sortData:result}, function(data){

				if( !data.err ) {

					_this.toCacncelSort();

				}

				oTip.say( data.msg );


			},'json');

		},
		selectMenu: function(oThis) {

			var type,
				sid;
			/*	isMainList,
				listWrap,
				thisChildrenNum;

			isMainList = oThis.attr('list-parent');
				
			if( isMainList ) {

				listWrap = oThis.parents('[role = main-list]');
				thisChildrenNum = listWrap.find('[list-sub]').length;

				console.log( oThis.attr('select-type') )

				if( !thisChildrenNum && oThis.attr('select-type') == 0 ) {
					console.log('b')
					oThis.attr('select-type', '0');

				}
				
			}*/

			type = oThis.attr('select-type');
			sid = oThis.attr('list-id');
			oRightLay.NOWSELECTED_ID = sid;
			oRightLay.NOWLIST = oThis;
			oRightLay.judgeShow( type );

		} 
	}

	

	function RightLay() {

		this.aSelect = $('[select-lay]');
		this.oSelectWrap = $('[sc = link-select-wrap]');
		this.oInfoWrap = $('[sc = info-link-wrap]');
		this.oInfoBoxWrap = $('[sc = info-box-wrap]');
		this.oText = $('[sc = text-input]');
		this.oInfoView = $('[sc = info-view]');
		this.oTextTip = $('[sc = text-tip]');

		this.showSelectUrl = '/lgwx/index.php/view/weixin/diy_menu_config';
		this.infoSelectUrl = '/lgwx/index.php/view/weixin/diy_menu_information_list';
		this.saveUrl = '/lgwx/index.php/post/weixin/diy_menu_content';

		this.NOWSELECTED_ID = 0;
		this.NOWLIST = null;
		this.aInfoList = null;


	}

	RightLay.prototype = {

		init: function() {

			this.oInputTip = new inputTip( this.oText, this.oTextTip, 600 );
			this.oInputTip.start();

			//inputTip( this.oText, this.oTextTip, 600 );

			this.events();

			this.initShow();

			this.showSelect();

			this.showInfoSelect();

		},
		initShow: function() {

			this.allLayHide();

			$('[order = -2]').show();

		},
		events: function() {
			//选择发布类
			var _this = this;
			var type;

			$('[sc = order-list]').on('click', function(){

				_this.selectLay( $(this) );

			});


			//选择资讯列表
			$(document).on('click', '[sc = info-select-list]', function(){

				_this.selectInfoList( $(this) );

			});


			//资讯列表弹框打开
			infoBox.onStart = function() {
				
				_this.initSelectInfoList();

			};

			//保存
			$(document).on('click', '[role = save-btn]', function(){

				_this.save( $(this) );

			});

		},
		judgeShow: function(type) {

			var nowData;
				
			
			this.allLayHide();
			$('[order = '+ type +']').show();
			nowData = this.NOWLIST.data('info');
			

			switch( type ) {	

				case "1":
					this.showText(nowData);
				break;

				case "2":
					this.showInfo(nowData);
				break;

				case "3":
					this.showLink(nowData);
				break;

			}

		},
		showText: function(data) {

			var str;
			if( !data ) {
				str = '';
			} else {
				str = data.smd_content;
			}
			
			this.oText.val( str );
			this.oInputTip.calc();

		},
		showInfo: function(data) {

			haha.renderList( this.oInfoView, 'info-list', data , true);

		},
		showLink: function(data) {

			var aOptions,
				nowList,
				nowId,
				id;

			if( !data ) return;
			id = data.smd_content;
			aOptions = this.oSelectWrap.children();

			aOptions.each(function(i){

				nowList = aOptions.eq(i);
				nowId = nowList.attr('id');

				if( nowId == id ) {

					nowList.attr('selected', 'selected');

				}

			});

		},
		allLayHide: function() {

			this.aSelect.hide();

		},
		selectLay: function(oThis) {

			var type;

			type = oThis.attr('click-order');

			if( type == 2 ) {

				infoBox.show();

				this.initShow();

				return;				

			}

			this.judgeShow( type );

		},
		save: function(oThis) {

			var type,
				id,
				sValue,
				data,
				nowListType,
				_this;

			type = oThis.attr('type');
			id = this.NOWSELECTED_ID;
			nowListType = this.NOWLIST.attr('list-parent') ? '0' : '1';
			data = {};
			_this = this;

			switch( type ){

				case '1':
					sValue = this.oText.val();

					if( !sValue ) {

						oTip.say( '内容不能为空' );
						
						return;	
					}
				break;

				case '2':

					var nowId;
					sValue = [];
					
					this.aInfoList.each(function(i){

						if( _this.aInfoList.eq(i).hasClass('active') ) {

							nowId = _this.aInfoList.eq(i).attr('sid');
							sValue.push( nowId );	
						}

					});

					if( !sValue.length ) {

						oTip.say( '请至少选择一条资讯' );

						return;
					}

					sValue = sValue.join(',');

				break;

				case '3':
					sValue = this.oSelectWrap.val();

					if( !sValue ) {

						oTip.say( '请选择' );

						return;
					}

				break;

			}

			data.smd_id = id;
			data.smd_type = type;
			data.smd_content = sValue;
			data.smd_list_type = nowListType;

			$.post(this.saveUrl, data, function(data){

				if( !data.err ) {

					_this.NOWLIST.data('info', data.data);
					_this.NOWLIST.attr('select-type', type);

					if( type == 2 ) {

						_this.judgeShow( type );
						infoBox.close();

					}

				}

				oTip.say( data.msg );

			},'json');


		},
		showSelect: function() {

			var _this = this;

			$.post( this.showSelectUrl, function(data){

				if( !data.err ){

					haha.renderList( _this.oSelectWrap, 'select-list', data );

				}

			},'json' );	

		},
		showInfoSelect: function() {

			var _this = this;

			$.post( this.infoSelectUrl, function(data){

				if( !data.err ){

					haha.renderList( _this.oInfoBoxWrap, 'info-box-list', data );

					_this.aInfoList = $('[sc = info-select-list]'); 
				}

			},'json' );	
		},
		selectInfoList: function(oThis) {

			//选择资讯列表

			var isHasSelect;

			isHasSelect = oThis.hasClass('active');

			isHasSelect ? oThis.removeClass('active') : oThis.addClass('active');

			
		},
		initSelectInfoList: function() {

			$('[sc = info-select-list]').removeClass('active');

		}

	}

	var haha = new Menu();
	var oRightLay = new RightLay();

	haha.init();	
	oRightLay.init();

});