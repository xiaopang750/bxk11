define(function(require, exports, module){

	require('../lib/underscore/underscore');
	require('../lib/backbone/backbone');
	var template = require('../lib/template/template');

	function Fenye(url, tpId, row, param, callBack) {

		param = param || {};

		var that = this;

		/* m */
		var Model = Backbone.Model.extend({
			url:url,
			row:row,
			initialize: function() {

				var _this = this;

				this.on('change:p', function(model, page){

					_this.getData(page, param);

				});

				this.on('change:count', function(model, count){

					_this.getData(1, that.param);
				});

			},
			getData: function(page, param) {

				param.p = page;

				param.row = row;

				this.save(null, {

					data: param

				});

			}
		});

		/* v */
		var View = Backbone.View.extend({

			el: $('[script-role = fenye_wrap]'),
			oWrap: $('[script-role = data_wrap]'),
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

				this.max = Math.ceil( model.data.count/this.model.row );

				this.showPage(this.page , this.max );

				this.render( model );	

				//loading

				loading();

				callBack && callBack( model );
			},
			showPage: function(now, max) {

				this.oView.html(now + '/' + max);

			},
			render: function( data ) {

				var sNewHtml = template(tpId, data);

				this.oWrap.html(sNewHtml);

			},
			changeParam: function( count, param ) {

				this.model.set('count', count);

				this.showPage(1 , this.max );

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

		this.V = V;
		this.R = R;
	}

	Fenye.prototype = {

		refresh: function(count, param) {
			//alert(JSON.stringify(param));

			this.param = param;

			this.V.changeParam( count, param );

			this.R.navigate( "1" );

			this.V.page = 1;

		}

	}

	module.exports = Fenye;

});