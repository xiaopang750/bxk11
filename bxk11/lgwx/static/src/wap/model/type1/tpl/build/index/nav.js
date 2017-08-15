/*TMODJS:{"version":15,"md5":"9bba1decc7d88ced4ebb578c493c9e6e"}*/
define(function(require) {
    return require("../template")("index/nav", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $out = "";
        $each(data, function($value, $index) {
            $out += ' <li> <a href="';
            $out += $escape($value.menu_url);
            $out += '">';
            $out += $escape($value.menu_name);
            $out += "</a> </li> ";
        });
        return new String($out);
    });
});