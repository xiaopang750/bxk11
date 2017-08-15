define(function(require, exports, module){

	require('../../lib/underscore/underscore');
	require('../../lib/backbone/backbone');

	function fenye(oWrap, url, oTpl, row, param, callBack) {

		param = param || {};

		/* m */
		var Model = Backbone.Model.extend({
			url:url,
			row:row,
			initialize: function() {

				var _this = this;

				this.on('change:p', function(model, page){

					_this.getData(page, param);

				});

			},
			getData: function(page, param) {

				param.p = page;

				param.num = row;

				this.save(null, {

					data: param

				});

			}
		});

		/* v */
		var View = Backbone.View.extend({

			el: $('[script-role = fenye_wrap]'),
			oWrap: oWrap,
			oView: $('[script-role = page_show]'),
			max: 0,
			page: window.location.hash.split('#')[1] || 1,
			first: true,
			events: {
				'click [script-role = page_prev]': 'prev',
				'click [script-role = page_next]': 'next',
				'click [script-role = page_home]': 'home'
			},
			initialize: function() {

				this.listenTo(this.model, 'change:data', this.show);

			},
			show: function() {

				var model;

				model = this.model.toJSON();

				if ( this.first ) {

					this.first = false;

					this.max = Math.ceil( model.data.count/this.model.row );
				}

				this.showPage(this.page , this.max );

				this.render( model );	

				//loading

				//loading();

				callBack && callBack( model );
			},
			showPage: function(now, max) {

				this.oView.html(now + '/' + max);

			},
			render: function( data ) {

				var sNewHtml = oTpl( data );

				this.oWrap.html(sNewHtml);

			},
			change: function( page ) {

				this.model.set('p', page);

				this.showPage(page , this.max );
			},
			home: function() {

				this.change( 1 );

				this.page = 1;

				R.navigate( this.page.toString() );

			},
			prev: function(e) {

				this.page --;

				if ( this.page < 1 ) {

					this.page = 1;

					return;

				}else {

					this.change( this.page );

				}

				R.navigate( this.page.toString() );

			},
			next: function() {

				this.page ++ ;

				if ( this.page > this.max ) {

					this.page = this.max;

					return;

				}else {

					this.change( this.page );

				}

				R.navigate( this.page.toString() );
			}
		});

		/* r */
		var Wrokspace = Backbone.Router.extend({

			routes: {

				"": "index",
				":p": "page"
			},
			index: function() {

				V.change(1);

			},
			page: function(p) {

				V.page = p;

				V.change(p);

			}

		});

		var M = new Model();
		var V = new View({model: M});
		var R = new Wrokspace;
		Backbone.history.start();

	}

	return fenye;

});