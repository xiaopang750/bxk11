/*TMODJS:{"version":6,"md5":"ecaf417c336bbca810ce0e3044c18d8a"}*/
define(function(require) {
    return require("../template")("new/detail", function($data, $id) {
        var $helpers = this, $escape = $helpers.$escape, data = $data.data, $string = $helpers.$string, $out = "";
        $out += '<h2 class="mb_10 tc font_16">';
        $out += $escape(data.si_title);
        $out += '</h2> <div class="new_content"> ';
        $out += $string(data.si_content);
        $out += " </div>";
        return new String($out);
    });
});