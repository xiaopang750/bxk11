/*TMODJS:{"version":64,"md5":"a86fee84182b1a9d94ecd1b732910ff2"}*/
define(function(require) {
    return require("../template")("new/list", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $out = "";
        $each(data.informationlist, function($value, $index) {
            $out += ' <li> <dl class="clearfix"> <dt> <a href="';
            $out += $escape($value.si_url);
            $out += '" class="ml_5">';
            $out += $escape($value.si_title);
            $out += '</a> </dt> <dd> <a href="';
            $out += $escape($value.si_url);
            $out += '"> <img src="';
            $out += $escape($value.si_pic);
            $out += '" width="60" height="40"> </a> </dd> </dl> </li> ';
        });
        return new String($out);
    });
});