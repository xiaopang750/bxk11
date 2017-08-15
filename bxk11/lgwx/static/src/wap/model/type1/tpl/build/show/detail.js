/*TMODJS:{"version":7,"md5":"8982f98fccc3f9f0d8d2e47b6df392f6"}*/
define(function(require) {
    return require("../template")("show/detail", function($data, $id) {
        var $helpers = this, $escape = $helpers.$escape, msg = $data.msg, $out = "";
        $out += '<div class="tc">';
        $out += $escape(msg);
        $out += "</div>";
        return new String($out);
    });
});