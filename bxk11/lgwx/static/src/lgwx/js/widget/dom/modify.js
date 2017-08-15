/*
 *description:文字修改
 *author:fanwei
 *date:2013/11/01
 */

/*
	调用方法
	$(ele).modify();
*/

 define(function(require, exports, module){
 	
 	var selectText = require('./selectText');

 	$.fn.modify = function() {

 		var oModify;

 		return $(this).each(function(){

 			oModify = new Modify( $(this) );

 			oModify.init();

 		});

 	};

 	function Modify(ele) {

 		this.ele = ele;
 		this.org = this.ele.html();

 	}

 	Modify.prototype = {

 		init: function() {

 			this.initWidget();

 			this.makeInput();

 			this.events();

 		},
 		events: function() {

 			var _this = this;

 			this.oWrap.on('click', '[sc = ui-modify-btn]', function(){

 				_this.editShow();

 				return false;

 			});

 			this.oInput.on('blur', function(){

 				var str = $(this).val();

 				_this.eidtHide( str );

 			});

 		},
 		initWidget: function() {

 			this.oWrap = this.ele.parent();

 			this.oWrap.css('position','relative');

 		},
 		makeInput: function() {

 			this.oInput = $('<input>');

 			this.oInput.hide();

 			this.oWrap.append( this.oInput );

 			this.text = this.ele.html();

 			this.oInput.val( this.text );
 		},
 		position: function() {

 			var l,
 				t,
 				w,
 				h;

 			l = this.ele.position().left;
 			t = this.ele.position().top;
 			w = this.ele.innerWidth(true);
 			h = this.ele.innerHeight(true);	

 			this.oInput.css({
 				position:'absolute',
 				left:l,
 				top:t,
 				width:w,
 				height:h,
 				border:'1px solid #ccc',
 				fontSize: '12px',
 				display:'block'
 			});

 		},
 		_judgeShow: function() {

 			var isShow;

 			isShow = this.oInput.is(':visible');

 			if( isShow ) {

 				this.oInput.hide();

 			} else {

 				this.oInput.show();

 			}

 		},
 		editShow: function() {

 			var num = this.oInput.val().length;

 			this.position();
 			this.oInput.show();
 			selectText(this.oInput, num, num);

 		},
 		eidtHide: function( str ) {

 			if( !str ) {

 				this.ele.html( this.org );
 				this.oInput.val( this.org );

 			} else {

 				this.ele.html( str );

 			}

 			this.oInput.hide();
 			

 		}

 	}


 
 });