/*TMODJS:{"version":12,"md5":"6a4436c69f0ab9066a40cd08772ae2d9"}*/
define(function(require) {
    return require("../template")("mall/list", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $string = $helpers.$string, cut = $data.cut === undefined ? $helpers.cut : $data.cut, $out = "";
        $each(data.goods_list, function($value, $index) {
            $out += ' <li class="mb_10 sh"> <dl> <dt> <a href="';
            $out += $escape($value.goods_url);
            $out += '"> <img src="';
            $out += $escape($value.goods_pic);
            $out += '"> </a> </dt> <dd> <p class="mb_5">';
            $out += $string(cut($value.goods_name, 7));
            $out += '</p> <p class="pink">￥';
            $out += $escape($value.goods_upset);
            $out += "</p> </dd> </dl> </li> ";
        });
        return new String($out);
    });
});