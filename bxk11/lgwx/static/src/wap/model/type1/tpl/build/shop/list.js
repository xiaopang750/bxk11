/*TMODJS:{"version":19,"md5":"2d6c1856e10158707b9bb9556f006e25"}*/
define(function(require) {
    return require("../template")("shop/list", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $out = "";
        $out += ' <section class="focus mb_10"> <div widget-role="focus-wrap" widget-width="540" widget-height="300" widget-scale="0.9" style="margin:0 auto"> <ul class="focus_wrap" widget-role="focus-data-wrap"> ';
        $each(data.shop_pic, function($value, $index) {
            $out += ' <li><img src="';
            $out += $escape($value);
            $out += '" link=""/></li> ';
        });
        $out += ' </ul> <div class="dot_wrap" widget-role="focus-dot-wrap"> </div> </div> <img src="/lgwx/static/system/wap/shop/';
        if (data.certified_status == "0") {
            $out += "no";
        } else if (data.certified_status == "1") {
            $out += "yes";
        }
        $out += '.png" width="20%" class="status"> </section> <table cellpadding="0" cellspacing="0" border="0" class="mb_20"> <tr> <td width="30%">店铺简介：</td> <td width="70%">';
        $out += $escape(data.shop_about);
        $out += "</td> </tr> <tr> <td>联系方式：</td> <td>";
        $out += $escape(data.shop_tel);
        $out += "</td> </tr> <tr> <td>店铺地址：</td> <td>";
        $out += $escape(data.shop_address);
        $out += '</td> </tr> </table> <h3 class="mb_5">地图导航：</h3> <div id="map"> </div> ';
        return new String($out);
    });
});