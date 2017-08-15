/*TMODJS:{"version":14,"md5":"5900bdd6be27b44c793e687df79feab0"}*/
define(function(require) {
    return require("../template")("info/shop", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $out = "";
        $each(data.shoplist, function($value, $index) {
            $out += ' <li class="main clearfix"> <dl> <dt> <img src="';
            $out += $escape($value.shop_pic1);
            $out += '"> </dt> <dd> <ul> <li><span class="bold mr_2">店铺名称:</span>';
            $out += $escape($value.shop_name);
            $out += '</li> <li><span class="bold mr_2">店铺地址:</span>';
            $out += $escape($value.shop_address);
            $out += '</li> <li><span class="bold mr_2">电话:</span>';
            $out += $escape($value.shop_tel);
            $out += '</li> <a href="';
            $out += $escape($value.shop_url);
            $out += '" class="entry-btn"> <span>进入店铺</span> <span class="entry-logo"></span> </a> </ul> </dd> </dl> </li> ';
        });
        return new String($out);
    });
});