/*TMODJS:{"version":76,"md5":"9ecef53d4c035695ff1d874824002f47"}*/
define(function(require) {
    return require("../template")("brand/list", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $string = $helpers.$string, cut = $data.cut === undefined ? $helpers.cut : $data.cut, $out = "";
        $each(data, function($value, $index) {
            $out += ' <li class="main clearfix"> <dl> <dt> <a href="';
            $out += $escape($value.brandinfo_url);
            $out += '"> <img src="';
            $out += $escape($value.apply_brand_img);
            $out += '"> </a> </dt> <dd> <ul> <li><span class="bold mr_2">品牌名称:</span>';
            $out += $string(cut($value.apply_brand_name, 7));
            $out += '</li> <li><span class="bold mr_2">品牌描述:</span>';
            $out += $string(cut($value.apply_brand_seodesc, 10));
            $out += '</li> <a href="';
            $out += $escape($value.brandinfo_url);
            $out += '" class="entry-btn"> <span>进入展厅</span> <span class="entry-logo"></span> </a> </ul> </dd> </dl> <img src="/lgwx/static/system/wap/brand/';
            if ($value.certified_status == "0") {
                $out += "no";
            } else if ($value.certified_status == "1") {
                $out += "yes";
            }
            $out += '.png" width="20%" class="status"> </li> ';
        });
        return new String($out);
    });
});