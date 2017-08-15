/*
 *description:tab
 *author:fanwei
 *date:2014/04/09
 */
define(function(require, exports, module){
	
	function Tab(opts) {

		opts = opts || {};
		this.oWrap = opts.oWrap || null;
		this.onclick = opts.onclick || null;
		this.headClass = opts.headClass || 'active';
		this.contentClass = opts.contentClass || 'active';
	}

	Tab.prototype = {

		init: function() {

			this.widgetInit();

			this.events();

		},
		widgetInit: function() {

			this.aHead = this.oWrap.find('[widget-role = tab-head]');
			this.aContent = this.oWrap.find('[widget-role = tab-content]');

			this.tab(0);

		},
		events: function() {

			var _this,
				oTarget,
				sRole,
				index;

			_this = this;	

			$(document).on('click', function(e){

				oTarget = $(e.target);

				sRole = oTarget.attr('widget-role');

				if (  sRole == 'tab-head' ) {

					index = oTarget.index();

					_this.tab( index );

					_this.onclick && _this.onclick();

				}

			});

		},
		tab: function(iNow) {


			this.aHead.removeClass( this.headClass );
			this.aHead.eq( iNow ).addClass( this.headClass );
			this.aContent.eq(iNow).addClass( this.headClass );

			this.aContent.removeClass( this.headClass );
			this.aContent.eq(iNow).addClass( this.headClass );
			this.aContent.hide();
			this.aContent.eq(iNow).show();

		}

	};

	module.exports = Tab;

});