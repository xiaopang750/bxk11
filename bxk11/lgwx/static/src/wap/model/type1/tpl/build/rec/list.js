/*TMODJS:{"version":48,"md5":"78c4d2fef9a07acde72fc2265d97d414"}*/
define(function(require) {
    return require("../template")("rec/list", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $out = "";
        $out += '  <section class="focus"> <div widget-role="focus-wrap" widget-width="540" widget-height="300" widget-scale="0.9" style="margin:0 auto"> <ul class="focus_wrap" widget-role="focus-data-wrap"> ';
        $each(data.slide, function($value, $index) {
            $out += ' <li><img src="';
            $out += $escape($value.slide_pic);
            $out += '" link="';
            $out += $escape($value.slide_url);
            $out += '"/></li> ';
        });
        $out += ' </ul> <div class="dot_wrap" widget-role="focus-dot-wrap"> </div> </div> </section> <div class="case main-list" sc="slide-wrap"> <div class="inner"> <div class="title-area clearfix"> <span class="fl">热门排行</span> <span class="fr" sc="slide" islide="yes">收起&gt;&gt;</span> </div> <div class="content-area" sc="slide-content"> <ul class="clearfix"> ';
        $each(data.goods_rank, function($value, $index) {
            $out += ' <li class="clearfix"> <p class="fl"> <a href="';
            $out += $escape($value.goods_url);
            $out += '"><span class="mr_10">Top';
            $out += $escape($index + 1);
            $out += "</span>";
            $out += $escape($value.goods_title);
            $out += '</a> </p> <div class="fr"> <span class="small-fav-logo vt_m"></span> <span class="fav-num-text">';
            $out += $escape($value.goods_likes);
            $out += "</span> </div> </li> ";
        });
        $out += ' </ul> </div> </div> </div> <div class="match main-list" sc="slide-wrap"> <div class="inner"> <div class="title-area clearfix"> <span class="fl">优惠套餐</span> <span class="fr" sc="slide" islide="yes">收起&gt;&gt;</span> </div> <div class="content-area" id="iscroll-wrap" sc="slide-content"> <ul class="clearfix" sc="roll-area"> ';
        $each(data.packs, function($value, $index) {
            $out += ' <li sc="roll-list" class="clearfix"> <img src="';
            $out += $escape($value.pack_pic);
            $out += '" width="60" height="40" class="fl mr_10"> <span class="fl mt_10"> <a href="';
            $out += $escape($value.pack_url);
            $out += '">';
            $out += $escape($value.pack_title);
            $out += '</a> </span> <span class="fr pink mt_10"> ￥';
            $out += $escape($value.pack_price);
            $out += ' <span class="gray2 thr ml_5">';
            $out += $escape($value.all_price);
            $out += "</span> </span> </li> ";
        });
        $out += ' </ul> </div> </div> </div> <div class="net main-list" sc="slide-wrap"> <div class="inner"> <div class="title-area clearfix"> <span class="fl">促销活动</span> <span class="fr" sc="slide" islide="yes">收起&gt;&gt;</span> </div> <div class="content-area" sc="slide-content"> <ul class="clearfix"> ';
        $each(data.acts, function($value, $index) {
            $out += ' <li class="clearfix"> <span class="fl">';
            $out += $escape($value.act_title);
            $out += '</span> <a href="';
            $out += $escape($value.act_url);
            $out += '" class="fr">进入店铺</a> </li> ';
        });
        $out += " </ul> </div> </div> </div>";
        return new String($out);
    });
});