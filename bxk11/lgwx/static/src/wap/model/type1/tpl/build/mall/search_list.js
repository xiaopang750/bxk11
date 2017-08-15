/*TMODJS:{"version":21,"md5":"cd423d3be01ab0f4506c5ba0a85b8b67"}*/
define(function(require) {
    return require("../template")("mall/search_list", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $out = "";
        $out += '<li class="flex1"> <select sc="beauty-select"> <option value="" ui-html="请选择品牌" type="class_id" lid="">请选择品牌</option> ';
        $each(data.brands, function($value, $index) {
            $out += ' <option value="';
            $out += $escape($value.brand_name);
            $out += '" ui-html="';
            $out += $escape($value.brand_name);
            $out += '" type="brand_id" lid="';
            $out += $escape($value.brand_id);
            $out += '" lead-text="请选择品牌" role="main">';
            $out += $escape($value.brand_name);
            $out += "</option> ";
        });
        $out += ' </select> </li> <li class="flex1"> <select sc="beauty-select"> <option value="" ui-html="请选择品类" type="class_id" lid="">请选择品类</option> ';
        $each(data.classlist, function($value, $index) {
            $out += ' <option value="';
            $out += $escape($value.class_name);
            $out += '" ui-html="';
            $out += $escape($value.class_name);
            $out += '" type="class_id" lid="';
            $out += $escape($value.class_id);
            $out += '" lead-text="请选择品类">';
            $out += $escape($value.class_name);
            $out += "</option> ";
        });
        $out += ' </select> </li> <li class="flex1"> <select sc="beauty-select"> <option value="" ui-html="请选择系列" type="class_id" lid="">请选择系列</option> ';
        $each(data.series, function($value, $index) {
            $out += ' <option value="';
            $out += $escape($value.series_name);
            $out += '" ui-html="';
            $out += $escape($value.series_name);
            $out += '" type="series_id" lid="';
            $out += $escape($value.series_id);
            $out += '" lead-text="请选择系列">';
            $out += $escape($value.series_name);
            $out += "</option> ";
        });
        $out += " </select> </li>";
        return new String($out);
    });
});