define(function(require, exports, module){
	
	var global = require('../global/global');
	var fenye = require('../global/fenye2');
	var FnDo = require('../global/fnDo');
	var iScroll = require('../lib/iscroll/iscroll');
	var url = '/index.php?g=Wap&m=Products&a=getclasslist&token=' + token + '&wecha_id=' + wid;
	var param = {
		order:'',
		sort:'',
		sale: '',
		class_id: ''
	}

	var _fenye = new fenye(url, 'data_list', '5', param);

	//todo
	var todo = new FnDo({
		oWrap: $('[script-role = data_wrap]'),
		sTarget: 'fav',
		fnDo: function(oThis) {
			
			if ( !oThis.hasClass('active') ) {

				var url = oThis.attr('target');

				this.req(url, null, function(data){

					oTip.text('已收藏');

					oThis.addClass('active');	

				});

			}

		}
	});

	todo.init();

	//iscroll
	

	//$.css3()
	function GoodsSelect() {

		this.GET_CLASS_URL = '/index.php?g=Wap&m=Products&a=getallclass&token='+ token +'&wecha_id=' + wid;

		this.ROTATE_SPEED = 300;

		this.oGoodsList = $('[script-role = type_detail]');

		this.tplId = 'goods_list';

		this.oSlide = $('[script-role = select_wrap]');

		this.oTriangle = $('[script-role = triangle]');

		this.first = false;

		this.count = 0;

	}

	GoodsSelect.prototype = {

		init: function() {

			//this.getClass();

			this.events();

		},
		events: function() {

			var oRole,
				sName,
				_this;

			_this = this;	

			$(document).on('click', '[script-role = data_select]', function(e){

				oRole = $(e.target);

				sName = oRole.attr('name');

				switch( sName ) {

					case 'sale':
						_this.clickSale(oRole);
						_this.req();
					break;

					case 'class_id':
						_this.clickSelect();
					break;

					case 'order':
						_this.clickOrder(oRole);
						_this.req();
					break;

					case 'class_list':
						_this.clickClassList(oRole);
						_this.req();
					break;

				}

			});

		},
		req: function() {

			this.count ++ ;

			_fenye.refresh( this.count, param );

		},
		clickSale: function( oThis ) {

			if ( oThis.attr('checked') == 'checked' ) {

				param.sale = 0;

			} else {

				param.sale = 1;
			}


		},
		clickClassList: function(oThis) {

			var oRight = oThis.find('[script-role = right_icon]');

			param.class_id = oThis.attr('value');

			this.hideSlide();

			oRight.removeClass('none').parents('[script-role = data_select]').siblings().find('[script-role = right_icon]').addClass('none');

		},
		clickOrder: function(oThis) {

			var oIcon = oThis.find('[script-role = rotate_icon]');

			if ( oThis.attr('svalue') == 'desc' ) {

				oThis.attr('svalue', 'asc');

				oIcon.animate({

					rotate: "0deg"

				},this.ROTATE_SPEED);


			} else {

				oThis.attr('svalue', 'desc');

				oIcon.animate({

					rotate: "180deg"

				},this.ROTATE_SPEED);

			}

			param.order = oThis.attr('type');
			param.sort = oThis.attr('svalue');

		},
		clickSelect: function() {

			if ( this.oSlide.css('display') == 'none' ) {

				if ( !this.first ) {

					this.first = true;
						
					this.getClass();
				}


				this.showSlide();

			} else {

				this.hideSlide();

			}

		},
		showSlide: function() {

			this.oSlide.show();

			this.oTriangle.show();

		},
		hideSlide: function() {

			this.oSlide.hide();

			this.oTriangle.hide();

		},
		getClass: function() {

			var _this = this;
			var html;

			this.load(this.GET_CLASS_URL, null, function( data ){

				html = template(_this.tplId, data);

				_this.oGoodsList.html( html );

				_this.startRoll();

			});
				
		},
		load: function( url, param, callBack ) {

			$.post(url, param, function(data){

				callBack && callBack( data )

			}, 'json');

		},
		startRoll: function() {

			var oScrollWrap = $('[script-role = myscroll]').get(0);

			var myScroll = new iScroll(oScrollWrap);

		}	

	}

	var goods = new GoodsSelect();

	goods.init();
});