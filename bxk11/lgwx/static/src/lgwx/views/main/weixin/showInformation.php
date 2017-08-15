<!DOCTYPE html>
<html> 
<head> 
<title><?php echo $si_title;?></title>
<meta http-equiv=Content-Type content="text/html;charset=utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="format-detection" content="telephone=no"> 
<style>

    html{background:#FFF;color:#000;}
    body, div, dl, dt, dd, h1, h2, h3, h4, h5, h6, pre, code, form, fieldset, legend, input, textarea, p, blockquote, th, td{margin:0;padding:0;}
    table{border-collapse:collapse;border-spacing:0;}
    fieldset, img{border:0;}
    address, caption, cite, code, dfn,  th, var{font-style:normal;font-weight:normal;}
    ol, ul{list-style:none;}
    caption, th{text-align:left;}
    h1, h2, h3, h4, h5, h6{font-size:100%;font-weight:normal;}
    q:before, q:after{content:'';}
    abbr, acronym{border:0;font-variant:normal;}
    sup{vertical-align:text-top;}
    sub{vertical-align:text-bottom;}
    input, textarea, select{font-family:inherit;font-size:inherit;font-weight:inherit;}
    input, textarea, select{font-size:100%;}
    legend{color:#000;}
    html{background-color:#f8f7f5;}
    body{background:#f8f7f5;color:#222;font-family:Helvetica, STHeiti STXihei, Microsoft JhengHei, Microsoft YaHei, Tohoma, Arial;height:100%;padding:15px 15px 0;position:relative;}
    body > .tips{display:none;left:50%;padding:20px;position:fixed;text-align:center;top:50%;width:200px;z-index:100;}
    .page{padding:15px;}
    .page .page-error, .page .page-loading{line-height:30px;position:relative;text-align:center;}
    .btn{background-color:#fcfcfc;border:1px solid #cccccc;border-radius:5px;box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);color:#222;cursor:pointer;display:block;font-size:15px;font-weight:bold;margin:15px 0;moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);padding:10px;text-align:center;text-decoration:none;webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.3);}
    .icons{background:url(../images/icons176ed4.png) no-repeat 0 0;border-radius:5px;height:25px;overflow:hidden;position:relative;width:25px;}
    .icons.arrow-r{background:url(../images/brand_profileinweb_arrow@2x176ed4.png) no-repeat center center;background-size:100%;height:16px;width:12px;}
    .icons.check{background-position:-25px 0;}
    #activity-detail .page-bizinfo .header #activity-name{color:#000;font-size:20px;font-weight:bold;word-break:normal;word-wrap:break-word;}
    /*===================== Added by xushengni on 04/26 ==================================*/
    .activity-info{}
    .activity-meta{display:inline-block;margin-left:8px;;padding-top:2px;padding-bottom:2px;color:#8c8c8c;font-size:11px;}
    .activity-meta.no-extra{margin-left:0;}
    .activity-info .text-ellipsis{display:inline-block;max-width:104px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
    a.activity-meta{
        text-decoration:none;outline:0;color:#607FA6;
        /*-webkit-tap-highlight-color:rgba(255,255,255,0);*/
    }
    a.activity-meta:active{
        /*background-color:#CACACA;border-radius:10px;box-shadow:inset 0 1px 1px #777;*/
        color:#607FA6;
    }
    a.activity-meta:active .icon_link_arrow{background:transparent url(../images/link_arrow_right_blue1913d0.png) no-repeat 0 0;-webkit-background-size:100%;-moz-background-size:100%;-o-background-size:100%;background-size:100%;}
    .activity-info .icon_link_arrow{
        margin-left:3px;
        margin-top:-5px;
    }
    .icon_link_arrow{display:none;vertical-align:middle;width:7px;height:7px;background:transparent url(../images/link_arrow_right_blue1913d0.png) no-repeat 0 0;-webkit-background-size:100%;-moz-background-size:100%;-o-background-size:100%;background-size:100%;}
    /*=========================================================*/
    #activity-detail .page-bizinfo #biz-link.btn{background:url(../images/brand_profileinweb_bg@2x176ed4.png) no-repeat center center;background-size:100% 100%;border:none;border-radius:0;box-shadow:none;height:42px;padding:12px;padding-left:62px;position:relative;text-align:left;}
    #activity-detail .page-bizinfo #biz-link.btn:hover{background-image:url(../images/brand_profileinweb_bg_HL@2x176ed4.png);}
    #activity-detail .page-bizinfo #biz-link.btn .arrow{position:absolute;right:15px;top:25px;}
    #activity-detail .page-bizinfo #biz-link.btn .logo{height:42px;left:5px;overflow:hidden;padding:6px;position:absolute;top:6px;width:42px;}
    #activity-detail .page-bizinfo #biz-link.btn .logo img{position:relative;width:42px;z-index:10;}
    #activity-detail .page-bizinfo #biz-link.btn .logo .circle{background:url(../images/brand_photo_middleframe@2x176ed4.png) no-repeat center center;background-size:100% 100%;height:54px;left:0;position:absolute;top:0;width:54px;z-index:100;}
    #activity-detail .page-bizinfo #biz-link.btn #nickname{color:#454545;font-size:15px;text-shadow:0 1px 1px white;}
    #activity-detail .page-bizinfo #biz-link.btn #weixinid{color:#a3a3a3;font-size:12px;line-height:20px;text-shadow:0 1px 1px white;}
    #activity-detail .page-content{margin:18px 0 0;padding-bottom:18px;}
    #activity-detail .page-content .media{margin:18px 0;text-align: center;}
    #activity-detail .page-content .media img{width:100%;}
    #activity-detail .page-content .text{color:#3e3e3e;line-height:1.5; width: 100%; }
    #activity-detail .page-content .text p{*zoom:1;min-height:1.5em;min-height: 1.5em;}
    #activity-detail .page-content .text p:after{content: "\200B"; display: block; height: 0; clear: both; }
    #activity-list .header{font-size:20px;}
    #activity-list .page-list{border:1px solid #ccc;border-radius:5px;margin:18px 0;overflow:hidden;}
    #activity-list .page-list .line.btn{border-radius:0;margin:0;text-align:left;}
    #activity-list .page-list .line.btn .checkbox{height:25px;line-height:25px;padding-left:35px;position:relative;}
    #activity-list .page-list .line.btn .checkbox .icons{background-color:#ccc;left:0;position:absolute;top:0;}
    #activity-list .page-list .line.btn.off .icons{background-image:none;}
    /*#activity-list #save.btn{background-image:linear-gradient(#22dd22, #009900);background-image:-moz-linear-gradient(#22dd22, #009900);background-image:-ms-linear-gradient(#22dd22, #009900);background-image:-o-linear-gradient(#22dd22, #009900);background-image:-webkit-gradient(linear, left top, left bottom, from(#22dd22), to(#009900));background-image:-webkit-linear-gradient(#22dd22, #009900);}*/
    .vm{vertical-align:middle;}
    .tc{text-align:center;}
    .db{display:block;}
    .dib{display:inline-block;}
    .b{font-weight:700;}
    .clr{clear:both;}
    .text img{max-width:100%!important;height:auto!important;}
    .page-toolbar{padding-top:18px;overflow:hidden;*zoom:1;}
    .page-toolbar a{color:#607FA6;font-size:14px;text-decoration:none;text-shadow:0 1px #ffffff;-webkit-text-shadow:0 1px #ffffff;-moz-text-shadow:0 1px #ffffff;}
    .page-url{float:left;}
    .page-toolbar a.page-imform{float:right;color:#7B7B7B;}

</style>

<script>
    document.domain = "qq.com";
    var _wxao = window._wxao || {};

    _wxao.appid = "wx1bc509d4d039b25a";
    _wxao.version = "1.0.0";
    _wxao.begin = (+new Date());

    (function() {
    var _onBridgeReady = function(){_wxao.jsbReady=true;};
    if(document.addEventListener){
    document.addEventListener('WeixinJSBridgeReady', _onBridgeReady, false);
    } else if(document.attachEvent){
    document.attachEvent('WeixinJSBridgeReady', _onBridgeReady); 
    document.attachEvent('onWeixinJSBridgeReady', _onBridgeReady);
    }
    var wxa = document.createElement('script'); wxa.type = 'text/javascript'; wxa.async = true, version = _wxao.version||"1.0";
    wxa.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'res.wx.qq.com/mmbizwap/zh_CN/htmledition/js/wxa/wxa-' + version + '.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wxa, s);
    })();
</script>

 <style>  #nickname{overflow: hidden;white-space: nowrap;text-overflow: ellipsis;max-width: 90%;  }  ol,ul{    list-style-position:inside;      }</style>    <style>  #activity-detail .page-content .text{font-size:16px;}</style>
 </head> 


 <body id="activity-detail">   

  <div class="page-bizinfo">

    <div class="header">
         <h1 id="activity-name"><?php echo $si_title;?></h1>
         <p class="activity-info">
             <span id="post-date" class="activity-meta no-extra"><?php echo $si_addtime;?></span>                    
             <a href="javascript:;" id="post-user" class="activity-meta">
             <span class="text-ellipsis"><?php echo $si_desc;?></span><i class="icon_link_arrow"></i></a>
         </p>
     </div>
    </div>
    <div class="page-content">
        <div class="media" id="media">

          <img src="<?php echo $si_pic;?>" />

        </div>
        <div class="text"><?php echo $si_content;?></div>
            <p class="page-toolbar">
               <!-- <a href="<?php echo $url_reply;?>"  class="page-url">阅读原文</a> 
                <a href="javascript:report_article();" class="page-imform">举报</a>-->
            </p>
    </div>
   <script>
      function getStrFromTxtDom(selector){
        var url = jQuery('#txt-' + selector)
                  .html()                  
                  .replace(/&lt;/g, '<')
                  .replace(/&gt;/g, '>');
        return jQuery.trim(url);
      }
    
      var title     = trim("<?php echo $si_title;?>".replace(/&lt;/g, '<').replace(/&gt;/g, '>'));
      var sourceurl = trim("<?php echo $url_reply;?>".replace(/&lt;/g, '<').replace(/&gt;/g, '>'));
        // 举报 
      function report_article(){
          var url   = sourceurl == '' ? location.href : sourceurl;
          var query = [
          "<?php echo $username;?>", 
          location.href, 
          title,
          url
          ].join("|WXM|");

          location.href = 'http://mp.weixin.qq.com/mp/readtemplate?t=wxm-appmsg-inform&__biz=MjM5MDgzMDYyMA==&info=' + encodeURIComponent(query) + "#wechat_redirect";
      }

    function getStrFromTxtDomAndDecode(selector){
        var selectorStr = getStrFromTxtDom(selector);
        if (selectorStr.indexOf("://") < 0)
          selectorStr = "http://" + selectorStr;
        return 'http://'+ window.location.host +'/mp/redirect?url=' + encodeURIComponent(selectorStr);
    }

  function report(link, fakeid, action_type){
      var parse_link = parseUrl(link);
      if(parse_link == null)
      {
        return ;
      }
      var query_obj = parseParams( parse_link['query_str'] );
      query_obj['action_type'] = action_type;
      query_obj['uin'] = fakeid;
      var report_url = '/mp/appmsg/show?' + jQuery.param( query_obj );
      jQuery.ajax({
        url: report_url,
        type: 'POST',
        timeout: 2000
      })
    };

  function share_scene(link, scene_type){
      var parse_link = parseUrl(link);
      if(parse_link == null)
      {
        return link;
      }
      var query_obj = parseParams( parse_link['query_str'] );
      query_obj['scene'] = scene_type;
      var share_url = 'http://' + parse_link['domain'] + parse_link['path'] + '?' + jQuery.param( query_obj ) + (parse_link['sharp'] ? parse_link['sharp'] : '');
      return share_url;
  };
          

  (function(){
          var onBridgeReady =  function () {
              var 
                appId  = "<?php echo $appid;?>",
                imgUrl = "<?php echo $si_pic;?>",
                link   = "<?php echo $url_reply;?>",
                title  = htmlDecode("<?php echo $si_title;?>"),
                desc   = htmlDecode("<?php echo $si_desc;?>"),
                fakeid = "",
                desc = desc || link;

               if ("1" == "0"){
                  WeixinJSBridge.call("hideOptionMenu");  
              }

              jQuery("#post-user").click(function(){
                WeixinJSBridge.invoke('profile',{'username':"<?php echo $username;?>",'scene':'57'});
              })

              // 发送给好友; 
            WeixinJSBridge.on('menu:share:appmessage', function(argv){
                  
                WeixinJSBridge.invoke('sendAppMessage',{
                  "appid"      : appId,
                  "img_url"    : imgUrl,
                  "img_width"  : "640",
                  "img_height" : "640",
                  "link"       : share_scene(link, 1),
                  "desc"       : desc,
                  "title"      : title
                  }, function(res) {report(link, fakeid, 1);
                });
            });
            // 分享到朋友圈;
           WeixinJSBridge.on('menu:share:timeline', function(argv){
                report(link, fakeid, 2);
                WeixinJSBridge.invoke('shareTimeline',{
                  "img_url"    : imgUrl,
                  "img_width"  : "640",
                  "img_height" : "640",
                  "link"       : share_scene(link, 2),
                  "desc"       : desc,
                  "title"      : title
                  }, function(res) {
                });
                  
            });

          // 分享到微博;
          var weiboContent = '';
              WeixinJSBridge.on('menu:share:weibo', function(argv){
                
              WeixinJSBridge.invoke('shareWeibo',{
                "img_url"    : imgUrl,
                "img_width"  : "640",
                "img_height" : "640",
                "content" : title + share_scene(link, 3),
                "url"     : share_scene(link, 3) 
                }, function(res) {report(link, fakeid, 3);
                });
          });

          // 分享到Facebook
          WeixinJSBridge.on('menu:share:facebook', function(argv){
                report(link, fakeid, 4);
                WeixinJSBridge.invoke('shareFB',{
                "img_url"    : imgUrl,
                "img_width"  : "640",
                "img_height" : "640",
                "link"       : share_scene(link, 4),
                "desc"       : desc,
                "title"      : title
                }, function(res) {} );
          });

          // 隐藏右上角的选项菜单入口;
          //WeixinJSBridge.call('hideOptionMenu');
      };
      if(document.addEventListener){
        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
      } else if(document.attachEvent){
        document.attachEvent('WeixinJSBridgeReady'   , onBridgeReady);
        document.attachEvent('onWeixinJSBridgeReady' , onBridgeReady);
      }
  })();

  (function(){

      var cookie = {
          get: function(name){
          if( name=='' ){
          return '';
                  }
                  var reg = new RegExp(name+'=([^;]*)');
                  var res = document.cookie.match(reg);
                  return (res && res[1]) || '';
              },
              set: function(name, value){
          var now = new Date();
          now.setDate(now.getDate() + 1);
                  var exp = now.toGMTString();
                  document.cookie = name + '=' + value + ';expires=' + exp;
                  return true;
              }
      };

      var timeout = null;
      var val = 0;
      var url = location.search.substr(1);
      var params = parseParams( url );
      var biz = params['__biz'];
      while( ~biz.search('=') ){
        biz = biz.replace('=','#');
      }
      var key = biz + params['appmsgid'] + params['itemidx'];

      // window.onload
      jQuery(function(){
          var val = cookie.get(key);
          jQuery(window).scrollTop(val);
      });

      jQuery(window).bind('unload',function(){
          cookie.set(key,val);
      });

      jQuery(window).bind('scroll',function(){
      clearTimeout(timeout);
      timeout = setTimeout(function(){
      val = jQuery(window).scrollTop();
      },500);
      });

    })();

    function nbspDecode(str){
      if(str == undefined )
      {
        return "";
      }
      var nbsp ="&nbsp;";
      var replaceFlag = "<nbsp>";
      var matchList = str.match(/(&nbsp;){1,}/g);
      if(matchList){
        var replacedStr = str.replace(/(&nbsp;){1,}/g,replaceFlag);

        for(var idx = 0 ; idx < matchList.length; idx ++){
          var tmpNbsp = matchList[idx];
          tmpNbsp = tmpNbsp.replace(nbsp, " ");
         replacedStr = replacedStr.replace(replaceFlag,tmpNbsp);
        }
        return replacedStr;               
      }else{
       return str;
      }
    }

    var title = $("#activity-name").html();
    title = nbspDecode(title);
    $("#activity-name").html(title);
  //弹出框中图片的切换
  (function() {
      var imgs = jQuery('img'),
      imgsSrc = [],
      minWidth = 0;
      imgs.each(function() {
          var jqthis = jQuery(this),
          src = jqthis.attr('data-src') || jqthis.attr('src');
          if (jqthis.width() >= minWidth && src) {
            imgsSrc.push(src);
            jqthis.on('click', function() {
              reviewImage(src);
            });
          }
      });

      function reviewImage(src) {
          if (typeof window.WeixinJSBridge != 'undefined') {
            WeixinJSBridge.invoke('imagePreview', {
            'current' : src,
            'urls' : imgsSrc
            });
          }
      }
  })();

    // 图片延迟加载
    (function(){
        var timer  = null;
        var height = jQuery(window).height() + 40;
        var images = [];
        function detect(){
            var scrollTop = jQuery(window).scrollTop() - 20;
            jQuery.each(images, function(idx,img){
                var offsetTop = img.el.offset().top;
                if( !img.show && scrollTop < offsetTop+img.height && scrollTop+height > offsetTop ){
                    img.el.attr('src', img.src);
                    img.show = true;
                }
            });
        }
        jQuery('img').each(function(){
            var img = $(this);
            if( img.attr('data-src') ){
                images.push({
                    el     : img,
                    top    : img.offset().top,
                    src    : img.attr('data-src'),
                    height : img.height(),
                    show   : false
                });
            }
        });
        jQuery(window).on('scroll', function(){
            clearTimeout(timer);
            timer = setTimeout(detect, 100);
        });

        detect();
    })();

</script>
   </body></html>