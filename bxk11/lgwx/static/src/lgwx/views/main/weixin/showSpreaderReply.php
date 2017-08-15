<!DOCTYPE html>
<html> 
<head> 
<title><?php echo $si_title;?></title>
<meta http-equiv=Content-Type content="text/html;charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
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
    
    .text table {
        width: 100%;
        border-collapse: collapse;
    }

    .text table td {
        border:1px solid #ccc;
    }

    .title {
        width: 20px;
        display: inline-block;
    }

    td {
        text-align: center;
        padding: 5px;
    }

    .gray {
        background: #e7e2e2;
    }
    
</style>



 <style>  #nickname{overflow: hidden;white-space: nowrap;text-overflow: ellipsis;max-width: 90%;  }  ol,ul{    list-style-position:inside;      }</style>    <style>  #activity-detail .page-content .text{font-size:16px;}</style>
 </head> 


 <body id="activity-detail">   

  <div class="page-bizinfo">

    <div class="header">
         <h1 id="activity-name">返利记录</h1>
         <p class="activity-info">
             <span id="post-date" class="activity-meta no-extra"><?php echo date('Y-m-d H:i:s',time());?></span>                    
             <a href="javascript:;" id="post-user" class="activity-meta">
             <span class="text-ellipsis"><?php echo "返利记录总条数:".count($re);?></span><i class="icon_link_arrow"></i></a>
         </p>
     </div>
    </div>
    <div class="page-content">
        
        <div class="text">

          <table data-sort="sortDisabled">
            <tbody>
                <?php if($re){foreach ($re as $key => $value) {?>
                    <tr>
                        <td rowspan="2"><?php echo $key + 1; ?></td>
                        <td colspan="2" rowspan="1" valign="top" class="gray">
                            发放时间
                        </td>
                        <td colspan="2" rowspan="1" valign="top"><?php echo $value->rr_grant_time;?></td>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="1" valign="top" class="gray">
                            充值卡号
                        </td>
                        <td colspan="2" rowspan="1" valign="top"><?php echo $value->rr_card_number;?></td>
                    </tr>
                <?php }} ?>
            </tbody>
        </table>

        </div>
            <p class="page-toolbar">
               <!-- <a href="<?php echo $url_reply;?>"  class="page-url">阅读原文</a> 
                <a href="javascript:report_article();" class="page-imform">举报</a>-->
            </p>
    </div>
   </body></html>