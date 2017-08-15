/*TMODJS:{"version":5,"md5":"d96ee8b9212e47d88cb79ccc382ef3a8"}*/
define(function(require) {
    return require("../template")("nav/level3", function($data, $id) {
        var $helpers = this, $escape = $helpers.$escape, data = $data.data, $out = "";
        $out += '<ul class="level3"> <li class="back_btn"> <a href="javascript:;" sc="back-btn"></a> </li> <li>';
        $out += $escape(data.title);
        $out += "</li> </ul>";
        return new String($out);
    });
});