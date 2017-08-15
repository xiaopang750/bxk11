/*TMODJS:{"version":37,"md5":"53612a4b23f5f1b160c552d22679401f"}*/
define(function(require) {
    return require("../template")("goods/list", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $string = $helpers.$string, cut = $data.cut === undefined ? $helpers.cut : $data.cut, $out = "";
        $each(data.goods_list, function($value, $index) {
            $out += ' <li class="mb_10 sh"> <dl> <dt> <a href="';
            $out += $escape($value.goods_url);
            $out += '"> <img src="';
            $out += $escape($value.goods_pic);
            $out += '"> </a> </dt> <dd> <p class="mb_5">';
            $out += $string(cut($value.goods_name, 7));
            $out += '</p> <p class="pink">￥';
            $out += $escape($value.goods_price);
            $out += '</p> <p script-role="fav" gid="';
            $out += '$value.goods_id}" is_like="1">取消收藏</p> </dd> </dl> </li> ';
        });
        return new String($out);
    });
});