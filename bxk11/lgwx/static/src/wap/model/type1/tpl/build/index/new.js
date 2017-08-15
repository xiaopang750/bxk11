/*TMODJS:{"version":15,"md5":"5488a75eb73899a281c4b6cdcfb34f05"}*/
define(function(require) {
    return require("../template")("index/new", function($data, $id) {
        var $helpers = this, $escape = $helpers.$escape, data = $data.data, $out = "";
        $out += '<!-- <h2 class="font_14"> <span>最新资讯</span> <span class="line"></span> </h2> <h3 class="font_12" style="overflow:hidden;height:2.5rem;text-overflow: ellipsis;"> <a href="';
        $out += $escape(data.si_url);
        $out += '">';
        $out += $escape(data.si_title);
        $out += '</a> </h3> --> <!-- <div class="foc_btn_wrap"> <a class="foc_btn button b_pink" href="javascript:;" script-role="foc" is_follow="';
        $out += $escape(data.is_follow);
        $out += '" target="';
        $out += $escape(data.follow_url);
        $out += '"> ';
        if (data.is_follow == 1) {
            $out += " 已关注 ";
        } else if (data.is_follow == 0) {
            $out += " +关注 ";
        }
        $out += " </a> </div> -->";
        return new String($out);
    });
});