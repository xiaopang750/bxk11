/*
 *description:左侧模块导航
 *author:fanwei
 *date:2014/03/24
 */
define(function(require, exports, module){

	function Tree() {

		this.oTree = $('[sc ^= tree]');
		this.oUserHeader = $('[sc = user-header]');
		this.aContent = $('[sc = tree-content]');
	}

	Tree.prototype = {

		init: function() {

			this.events();

		},
		events: function() {

			var _this;

			_this = this;

			//clickTree-module
			this.oTree.on('click', '[sc = tree-head]', function(e){

				_this.toDo( $(this) );

			});

			this.oUserHeader.on('mouseenter', function(){

				_this.scaleBig($(this));

			});

			this.oUserHeader.on('mouseleave', function(){

				_this.scaleSmall($(this));

			});

		},
		scaleBig: function(oImage){

			oImage.animate({
				width: 100,
				height: 100,
				marginLeft: -15,
				marginTop: -15
			});

		},
		scaleSmall: function(oImage){

			oImage.animate({
				width: 70,
				height: 70,
				marginLeft: 0,
				marginTop: 0
			});

		},
		toDo: function( oThis, type ) {

			var index;	

			index = oThis.index();

			oThis.addClass('active').siblings().removeClass('active');
			this.aContent.removeClass('active');
			this.aContent.eq(index).addClass('active');

		}

	}

	var oTree = new Tree();

	oTree.init();
	

});