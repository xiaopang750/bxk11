/*
 *description:品牌店铺关联
 *author:fanwei
 *date:2014/05/12
 */

 define(function(require, exports, module){
 		
 	var global = require('../global/global');
 	var until = require('../lib/until/until');

 	var oRelated = until.extend(function(){

 			this.sid = this.parse().shopid;

 		}, {


 			init: function(){

 				this.showPage();

 				this.events();
 			},
 			events: function(){

 				var oTarget,
 					sRole,
 					_this;

 				_this = this;	

 				$(document).on('click', function(e){

 					oTarget = $(e.target);
 					sRole = oTarget.attr('sc');

 					switch( sRole ) {

 						case 'select-list':
 							_this.selectList( oTarget, 'active' );
 						break;

 						case 'add':
 							_this.todo('sin-add');
 						break;

 						case 'addAll':
 							_this.todo('all-add');
 						break;

 						case 'remove':
 							_this.todo('sin-remove');
 						break;

 						case 'removeAll':
 							_this.todo('all-remove');
 						break;

 						case 'save':
 				
 							_this.save();
 						break;


 					}

 				});

 				//prevent default;
 				$(document).on('mousedown', '[sc = select-list]', function(){

 					return false;

 				});

 				//双击移动
 				$(document).on('dblclick', '[sc = select-list]', function(){

 					var oTarget,
 						oParent,
 						sType;

 					oParent = $(this).parent();
 					sType = oParent.attr('sc');
 					
 					if( sType == 'yes' ) {
 						oTarget = $('[sc = no]');
 					} else {
 						oTarget = $('[sc = yes]');
 					}	

 					_this.moveList( $(this), oTarget );

 				});
 			},
 			todo: function(type){

 				var oNo,
 					oYes;

 				oNo = $('[sc = no]');
 				oYes = $('[sc = yes]');	

 				switch( type ) {

 					case 'sin-add':
 						var oSelected = this.getActiveList( oNo );

	 					if( oSelected ) {

	 						this.moveList( oSelected, oYes );
	 					}
 					break;

 					case 'all-add':
 						var aSelected = this.getAll( oNo );

	 					if( aSelected ) {

	 						this.moveList( aSelected, oYes );
	 					}
 					break;

 					case 'sin-remove':
 						var oSelected = this.getActiveList( oYes );

	 					if( oSelected ) {

	 						this.moveList( oSelected, oNo );
	 					}
 					break;

 					case 'all-remove':
 						var aSelected = this.getAll( oYes );

	 					if( aSelected ) {

	 						this.moveList( aSelected, oNo );
	 					}
 					break;

 				}

 			
 			},
 			save: function(){

 				var oYes,
 					aId,
 					aSelected,
 					oSelected,
 					sId;

 				aId = [];
 				oYes = $('[sc = yes]');
 				aSelected = oYes.children();
 				aSelected.each(function(i){

 					oSelected = aSelected.eq(i)
 					sId = oSelected.attr('listid');

 					aId.push( sId );

 				});

 				this.requestUri = '/lgwx/index.php/post/shop/shoptobrand';
 				this.param.brands = aId.join(',');
 				this.param.shopid = this.sid
 				this.load();
 				this.suc = function( data ){

 					alert(data.msg);
 					window.location = data.data;
 				};

 				this.fail = function( data ) {

 					alert(data.msg);

 				};

 			},
 			selectList: function( oThis, activeName ){

 				oThis.addClass(activeName);

 			},
 			getAll: function( oParent ){

 				return oParent.children();

 			},
 			getActiveList: function( oParent ){

				return oParent.find('.active'); 				

 			},
 			moveList: function( aGeter, oTarget ){

 				oTarget.append( aGeter );
 				aGeter.removeClass('active');

 			},
 			showPage: function(){

 				var _this = this;

 				this.param.shopid = this.sid;
 				this.requestUri = '/lgwx/index.php/view/shop/shoptobrand';
 				this.load();
 				this.suc = function( data ){

 					_this.data = data;
 					_this.tempWrap = $('[sc = data-wrap]');
 					_this.tempId = 'bran-shop-list';
 					_this.render();

 				};

 			}

 	});

 	oRelated.init();
 
 });