/*TMODJS:{"version":20,"md5":"19ea63a4df2865f7f030f56661a39599"}*/
define(function(require) {
    return require("../template")("nav/level2", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $out = "";
        $out += '<ul class="level2"> ';
        $each(data.menulist, function($value, $index) {
            $out += ' <li class="home_btn"> <a href="';
            $out += $escape($value.menu_url);
            $out += '"></a> </li> ';
        });
        $out += " <li>";
        $out += $escape(data.title);
        $out += "</li> </ul>";
        return new String($out);
    });
});