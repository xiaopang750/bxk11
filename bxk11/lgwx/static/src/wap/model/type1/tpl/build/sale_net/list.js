/*TMODJS:{"version":36,"md5":"966029e64c8714970d326ce8d3e90dce"}*/
define(function(require) {
    return require("../template")("sale_net/list", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $string = $helpers.$string, cut = $data.cut === undefined ? $helpers.cut : $data.cut, $out = "";
        $each(data.shoplist, function($value, $index) {
            $out += ' <li class="main clearfix"> <dl> <dt> <img src="';
            $out += $escape($value.shop_pic1);
            $out += '"> </dt> <dd> <ul> <li><span class="bold mr_2">店铺名称:</span>';
            $out += $string(cut($value.shop_name, 7));
            $out += '</li> <li><span class="bold mr_2">店铺地址:</span>';
            $out += $string(cut($value.shop_address, 7));
            $out += '</li> <li><span class="bold mr_2">电话:</span>';
            $out += $escape($value.shop_tel);
            $out += '</li> <a href="';
            $out += $escape($value.shop_url);
            $out += '" class="entry-btn"> <span>进入店铺</span> <span class="entry-logo"></span> </a> </ul> </dd> </dl> </li> ';
        });
        return new String($out);
    });
});