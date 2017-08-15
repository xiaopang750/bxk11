/*TMODJS:{"version":13,"md5":"97aa93638471d0c78644c1df19c8cbe5"}*/
define(function(require) {
    return require("../template")("info/goods", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $out = "";
        $each(data.likegoodslist, function($value, $index) {
            $out += ' <li class="mb_10 sh"> <dl> <dt><a href="';
            $out += $escape($value.goods_url);
            $out += '"><img src="';
            $out += $escape($value.goods_pic);
            $out += '"></a></dt> <dd class="clearfix"> <span class="fl mr_10">';
            $out += $escape($value.goods_name.length > 8 ? $value.goods_name.substring(0, 8) + "..." : $value.goods_name);
            $out += '</span> <span class="fl pink">';
            $out += $escape($value.goods_price);
            $out += '</span> <!-- <span class="fr" script-role="fav" target="';
            $out += $escape($value.like_url);
            $out += '" is_like="1" gid="';
            $out += $escape($value.goods_id);
            $out += '">取消收藏</span> --> </dd> </dl> </li> ';
        });
        return new String($out);
    });
});