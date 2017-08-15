/*TMODJS:{"version":40,"md5":"04149c2db1acbb4a0e1a9719fd003be4"}*/
define(function(require) {
    return require("../template")("index/module", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $out = "";
        $each(data.shortcut_menu, function($value, $index) {
            $out += ' <li sc="module-list"> <!-- <dl> <dt> <a href="';
            $out += $escape($value.menu_url);
            $out += '"> <img src="';
            $out += $escape($value.menu_pic);
            $out += '" alt="';
            $out += $escape($value.menu_name);
            $out += '"> </a> </dt> <dd> <a href="';
            $out += $escape($value.menu_url);
            $out += '"> ';
            $out += $escape($value.menu_name);
            $out += ' </a> </dd> </dl> --> <a href="';
            $out += $escape($value.menu_url);
            $out += '"> <img src="';
            $out += $escape($value.menu_pic);
            $out += '"> <span>';
            $out += $escape($value.menu_name);
            $out += "</span> </a> </li> ";
        });
        return new String($out);
    });
});