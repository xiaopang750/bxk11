/**
 *description:new
 *author:fanwei
 *date:2014/4/16
 */
define(function(require, exports, module){
	
	var template = require('../lib/template/template');
	var Fenye = require('../widget/dom/fenye');
	var global = require('../global/global');

	function News() {

		this.configDomain = 'http://www.jia178.com';

		this._param = {num:5,p:1,keywords:"",it_id:""};
		this.getDataUrl = this.configDomain + '/lgwx/index.php/api/informationView/getlist';
		this.tplId = 'data-new';
		this.btnStr = '<a class="btn btn-sm btn-default ml_1 mr_1" href="#" sc="pagebtn"></a>';

		this.oInput = $('[sc = search-input]');
		this.oSearch = $('[sc = search]');

	}

	News.prototype = {

		init: function() {

			this.showPage();

			this.showHot();

			this.showType();

			this.events();

		},
		events: function() {

			var _this = this;

			$(document).on('click', '[sc = select-type]', function(){

				_this._param.it_id = $(this).attr('select-id');

				$(this).addClass('active').parent().siblings().find('a').removeClass('active');

				_this.page.refresh( _this._param );

			});

			this.oSearch.on('click', function(){

				var sValue;

				sValue = _this.oInput.val();

				_this._param.keywords = sValue;

				_this.page.refresh( _this._param );


			});

		},
		showPage: function() {

			var _fenye = new Fenye(this.getDataUrl, this.tplId, this._param, function(){

				setTimeout(function(){

					$('[sc = info-list]').addClass('active');

				},500);

			}, this.btnStr);

	   		this.page = _fenye;

		},
		showHot: function() {

			var oWrap = $('[sc = hot-wrap]');
			var html,
				tplId;

			tplId = 'data-hot';

			$.ajax({
				url:this.configDomain + '/lgwx/index.php/api/informationView/getHostSport',
				dataType:'jsonp',
				jsonp:'cb',
				success: function(data) {

					html = template(tplId, data);
					oWrap.html( html );
				}
			});

		},
		showType: function() {

			var oWrap = $('[sc = type]');
			var html,
				tplId;

			tplId = 'data-type';

			$.ajax({
				url:this.configDomain + '/lgwx/index.php/api/informationView/getType',
				dataType:'jsonp',
				jsonp:'cb',
				success: function(data) {

					html = template(tplId, data);
					oWrap.html( html );
				}
			});

		}

	};

	var oNews = new News();

	oNews.init();

});