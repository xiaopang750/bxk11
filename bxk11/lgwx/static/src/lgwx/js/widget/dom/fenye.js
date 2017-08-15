/*
 *description:分页
 *author:fanwei
 *date:2014/04/10
 */

/*
	@param 
	url:请求后台地址;
	tpId:数据模板id;
	param: 提交到服务器的参数;
	callBack: 渲染数据后的回调函数;
	btnStr: 分页按钮dom字符串;
	oWrap: 渲染数据的容器;
	setModel: 修改后台返回的model;
	maxBtn:定义显示的最大页数,默认为5条;

	backbone强制依赖underscore请不要删除underscore;
*/

 define(function(require, exports, module){
 		
 	require('../../lib/underscore/underscore');
	require('../../lib/backbone/backbone');
	var template = require('../../lib/template/template');
 	
	function Fenye(url, tpId, param, callBack, btnStr, oWrap, setModel, maxBtn) {
	
		param = param || {};

		this.param = param;

		oWrap = oWrap || $('[script-role = data_wrap]');

		var that = this;

		var maxBtn = maxBtn || 5;

		this.btnClass = 'active';

		btnStr = btnStr || '<button class="btn btn-sm btn-primary ml_1 mr_1" sc="pagebtn"></button>';

		/* m */
		var Model = Backbone.Model.extend({
			url:url,
			/*row:row,*/
			initialize: function() {

				var _this = this;

				this.on('change:p', function(model, page){

					_this.getData(page, that.param);

				});

				this.on('change:rnd', function(model, param, b){

					_this.getData(1, b);
				});

			},
			getData: function(page, param) {

				param.p = page;

				this.save(null, {

					data: param

				});

			}
		});

		/* v */
		var View = Backbone.View.extend({

			el: oWrap,
			oWrap: oWrap,
			oView: $('[sc = num]'),
			max: 0,
			page: window.location.hash.split('#')[1] || 1,
			first: true,
			events: {
				'click [sc = page-prev]': 'prev',
				'click [sc = page-next]': 'next',
				'click [sc = first]': 'home',
				'click [sc = last]': 'last',
				'click [sc = pagebtn]': 'clickBtn'
			},
			initialize: function() {

				this.listenTo(this.model, 'change:data', this.show);

			},
			show: function() {

				var model;

				model = this.model.toJSON();

				if( setModel ) {
					
					model = setModel( model );

				}
				
				this.max = Math.ceil( model.data.count/that.param.num );

				this.render( model );

				this.showPage(this.page , this.max );

				callBack && callBack( model );
			},
			showPage: function(now, max) {

				this.oBtnWrap = oWrap.find('[sc = num]');

				var i,
					num,
					oBtn,
					limitUp,
					limitDown,
					averge;

				num = max;	

				averge = Math.floor(maxBtn/2);

				if ( max <= maxBtn ) {

					for (i=0; i<num; i++) {

						oBtn = $(btnStr);
						
						oBtn.html(i+1);

						if ( i+1 == now ) {

							oBtn.addClass(that.btnClass);

						}

						this.oBtnWrap.append(oBtn);

					}	

				} else {

					limitUp = parseInt(now) + averge >= max ? max : parseInt(now) + averge;

					limitDown = parseInt(now) - averge <=1  ? 1 : parseInt(now) - averge;

					for ( i=limitDown; i<now; i++ ) {

						oBtn = $(btnStr);

						oBtn.html(i);

						this.oBtnWrap.append(oBtn);

					}

					for (i=now; i<=limitUp; i++) {

						oBtn = $(btnStr);

						oBtn.html(i);

						if ( i == now ) {

							oBtn.addClass(that.btnClass);

						}

						this.oBtnWrap.append(oBtn);

					}

				}

				
			},
			render: function( data ) {

				var sNewHtml = template(tpId, data);

				this.oWrap.html(sNewHtml);

			},
			changeParam: function( param ) {

				var rnd = Math.random();

				this.model.set('rnd', rnd, param);

				//this.showPage(1 , this.max );

			},
			change: function( page ) {
				
				this.model.set('p', page);

				//this.showPage(page , this.max );
			},
			home: function() {

				this.change( 1 );

				this.page = 1;

				R.navigate( this.page.toString() );

			},
			last: function() {

				this.change( this.max );

				this.page = this.max;

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
			},
			clickBtn: function(e) {

				var oThis,
					now;

				oThis = $(e.target);
				now = oThis.html();

				this.change( now );

				this.page = now;

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
		V.change(1);
		var R = new Wrokspace;

		//Backbone.history.start();

		this.V = V;
		this.R = R;
	}

	Fenye.prototype = {

		refresh: function(param) {

			this.param = param;

			this.V.changeParam( param );

			this.R.navigate( "1" );

			this.V.page = 1;

		}

	}

	module.exports = Fenye;
 });