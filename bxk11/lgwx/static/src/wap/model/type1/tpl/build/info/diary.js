/*TMODJS:{"version":26,"md5":"b2c03b90d5f35597ed016375ded677cc"}*/
define(function(require) {
    return require("../template")("info/diary", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $string = $helpers.$string, cut = $data.cut === undefined ? $helpers.cut : $data.cut, $out = "";
        $each(data.note_list, function($value, $index) {
            $out += ' <li sc="diary-list" link="';
            $out += $escape($value.goods_url);
            $out += '"> <div class="inner"> <h2 class="mb_5">';
            $out += $escape($value.note_date);
            $out += '</h2> <h3 class="mb_5">地点：';
            $out += $escape($value.shop_name);
            $out += '</h3> <p> <a href="';
            $out += $escape($value.goods_url);
            $out += '"> ';
            $out += $string(cut($value.note_content, 15));
            $out += ' </a> </p> </div> <div class="time">';
            $out += $escape($value.note_time);
            $out += '</div> <div class="line"></div> </li> ';
        });
        return new String($out);
    });
});