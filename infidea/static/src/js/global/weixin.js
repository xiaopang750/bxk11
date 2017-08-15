/**
 *description:weixin
 *author:fanwei
 *date:2014/4/16
 */
define(function(require, exports, module){
	
	var timer = null;


    $('[sc = weixinlogo]').hover(function(){

        clearTimeout( timer );

        $('[sc = weixinbig]').show();

    }, function(){

        timer = setTimeout(function(){

            $('[sc = weixinbig]').hide();   

        },500) 

    });
	
});