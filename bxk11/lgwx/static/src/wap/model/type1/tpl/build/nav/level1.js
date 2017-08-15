/*TMODJS:{"version":19,"md5":"c4eec252f9b23d6135fa8f46c807b250"}*/
define(function(require) {
    return require("../template")("nav/level1", function($data, $id) {
        var $helpers = this, $escape = $helpers.$escape, data = $data.data, $each = $helpers.$each, $value = $data.$value, $index = $data.$index, $out = "";
        $out += '<ul class="level1"> <li class="first"> <a href="';
        $out += $escape(data.userspace);
        $out += '"> <span class="person"></span> </a> </li> ';
        $each(data.menulist, function($value, $index) {
            $out += ' <li> <a href="';
            $out += $escape($value.menu_url);
            $out += '" ';
            if (data.currentPage == $value.menu_name) {
                $out += 'class="active"';
            }
            $out += ">";
            $out += $escape($value.menu_name);
            $out += "</a> </li> ";
        });
        $out += " </ul> ";
        return new String($out);
    });
});