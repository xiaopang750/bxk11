/*TMODJS:{"version":9,"md5":"f7f4688f95da0a1033cc051ac3212453"}*/
define(function(require) {
    return require("../template")("sale_net/detail", function($data, $id) {
        var $helpers = this, data = $data.data, $escape = $helpers.$escape, $out = "";
        $out += '<img src="/lgwx/static/system/wap/shop/';
        if (data.certified_status == "0") {
            $out += "no";
        } else if (data.certified_status == "1") {
            $out += "yes";
        }
        $out += '.png" width="20%" class="status"> <p class="mb_10">关于我们:';
        $out += $escape(data.shop_about);
        $out += "</p> <p>地址:";
        $out += $escape(data.shop_address);
        $out += "</p>";
        return new String($out);
    });
});