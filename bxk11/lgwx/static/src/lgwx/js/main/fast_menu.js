/**
 *description:快捷方式设置
 *author:fanwei
 *date:2014/05/21
 */
define(function(require, exports, module){
	
	var global = require('../global/global');
	var until = require('../lib/until/until');
	var select = require('../widget/form/select');
	var modify = require('../widget/dom/modify');


	var oFastMenu = until.extend(function(){

			this.oInfo = $('[sc = menu-fast]');
			this.getDataUrl = _jia178config.reqBase + '/view/wap/shortcutlist';
			this.submitUrl = _jia178config.reqBase + '/post/wap/shortcutlist';
			this.tplId = 'fast-menu';
			

		},{

			init: function() {
					
				this.showPage();

				this.events();

			},
			events: function(){

				var oTarget,
					sRole,
					_this;

				_this = this;	

				//上移,下移,保存
				$(document).on('click', function(e){

					oTarget = $(e.target);
					sRole = oTarget.attr('sc');


					switch( sRole ) {

						case 'up':
							_this.up( oTarget );
						break;

						case 'down':
							_this.down( oTarget );
						break;

						case 'save':
							_this.save();
						break;

					}

				});

			},
			showPage: function( data ) {

				//渲染页面
				var _this = this;

				this.requestUri = this.getDataUrl;
				this.load();
				this.suc = function(data) {

					_this.data = data;
					_this.tempId = _this.tplId;
					_this.tempWrap = this.oInfo;
					_this.render();
					_this.beautySelect( $('[sc = ui-select]') );
					_this.modifyText( $('[sc = ui-modify]') );

				};
			},
			modifyText: function(aText){

				//修改名称显示,modify是jquery对象拓展的方法;
				aText.modify();

			},
			beautySelect: function(aSelect) {

				//美化select;
				aSelect.select();

			},
			up: function(oThis) {

				//上移
				var oList,
					oPrev;

				oList = oThis.parents('[sc = list]');
				oPrev = oList.prev();

				oPrev.before( oList );	
				this.reset();

			},
			down: function(oThis) {

				//下移
				var oList,
					oNext;

				oList = oThis.parents('[sc = list]');
				oNext = oList.next();

				oNext.after( oList );
				this.reset();				

			},
			reset: function() {

				//上移，下移后重置序号;
				var i,
					num,
					aIndex;

				aIndex = $('[sc = menu-index]');	
				num = aIndex.length;

				for (i=0; i<num; i++) {
					aIndex.eq(i).html( i +1 );
				}

			},
			save: function() {

				//保存提交
				var sId,
					sUrl,
					sName,
					sPicUrl,
					oSelectDir,
					nowSelectDir,
					oName,
					oSelectPic,
					allData,
					aList;

				allData = [];
				aList = $('[sc = list]');	
				
				//提交格式:菜单id|指向链接|显示名称|图标地址,菜单id|指向链接|显示名称|图标地址

				aList.each(function(i){

					var arr = [];

					oSelectDir = aList.eq(i).find('[sc = select-dir]');
					oName = aList.eq(i).find('[sc = ui-modify]')
					oSelectPic = aList.eq(i).find('[sc = ui-select]');
					nowSelectDir = oSelectDir.children().eq( oSelectDir.get(0).selectedIndex );

					sId = nowSelectDir.attr('id');
					sUrl = nowSelectDir.attr('url');
					sName = oName.html();
					sPicUrl = oSelectPic.val();

					arr.push( sId );
					arr.push( sUrl );
					arr.push( sName );
					arr.push( sPicUrl );

					allData.push( arr.join('|') );

				});


				this.requestUri = this.submitUrl;
				this.param.shortcut = allData.join(',');
				this.load();
				this.suc = function(data) {
					
					alert(data.msg);
					window.location = window.location;

				};

				this.fail = function(data) {

					alert(data.msg);

				};

			}

		});


		oFastMenu.init();	
});