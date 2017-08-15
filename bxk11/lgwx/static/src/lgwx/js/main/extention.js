/*
 *description:推广
 *author:fanwei
 *date:2014/6/11
 */
define(function(require, exports, module){
	
	var focus = require('../../../wap/global/js/widget/focus/focus');
	var aImage = $('img');
	var num = aImage.length;
	var i,count;
	count = 0;

	var foc = new focus({
		cycle: false,
		auto: false,
		oWrap: $('[widget-role = focus-wrap]')
	});

	for ( i=0 ;i<num; i++ ) {

		var oImage = new Image();

		oImage.onload = function() {

			count ++;

			if( count == num ) {

				foc.init();

			}

		};

		oImage.src = aImage.eq(i).attr('src');

	}


	$('[sc = link]').on('click', function(){

		window.location = $(this).attr('href');

	});


	//share-friend
	document.addEventListener('WeixinJSBridgeReady', function() {
           
        WeixinJSBridge.on('menu:share:appmessage', function(argv){
           	
        	WeixinJSBridge.invoke('sendAppMessage',{
                "appid": '',
                "img_url": 'http://www.jia178.com/lgwx/static/system/lgwx/logo/logo.jpg',
                "img_width": "200",
                "img_height": "200",
                "link": 'http://www.jia178.com/lgwx/index.php/reg',
                "desc": '专业为家居行业服务的移动营销平台，一站式接入微信微博和6亿手机用户',
                "title": '免费注册移动官网+移动商城'
            }, function(res) {
               
            }); 

        });

    }, false);

});