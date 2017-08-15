/*TMODJS:{"version":85,"md5":"7af2d067772a29062d9195e343e81600"}*/
define(function(require) {
    return require("../template")("show/list", function($data, $id) {
        var $helpers = this, $escape = $helpers.$escape, data = $data.data, $each = $helpers.$each, $value = $data.$value, $index = $data.$index, $out = "";
        $out += '<div class="top"> <div class="inner"> <div class="top-banner rel"> <a href="';
        $out += $escape(data.room_url);
        $out += '"> <img src="';
        $out += $escape(data.room_pic);
        $out += '"> </a> <a class="play" href="';
        $out += $escape(data.room_url);
        $out += '"> <div class="trangle"></div> </a> </div> <table cellpadding="0" cellspacing="0" border="0" class="mb_20"> <tr> <td width="30%">空间功能：</td> <td width="70%">';
        $out += $escape(data.room_style);
        $out += "</td> </tr> <tr> <td>面积：</td> <td>";
        $out += $escape(data.room_size);
        $out += "</td> </tr> <tr> <td>装修风格：</td> <td>";
        $out += $escape(data.room_style);
        $out += "</td> </tr> <tr> <td>样板间描述：</td> <td>";
        $out += $escape(data.room_desc);
        $out += '</td> </tr> </table> </div> </div> <div class="match main-list" sc="slide-wrap"> <div class="inner"> <div class="title-area clearfix"> <span class="fl">商品搭配</span> ';
        if (!data.goods_match_list) {
            $out += ' <span class="fr">没有相关搭配</span> ';
        } else {
            $out += ' <span class="fr" sc="slide" islide="yes">收起&gt;&gt;</span> ';
        }
        $out += " </div> ";
        if (data.goods_match_list) {
            $out += ' <div class="content-area" id="iscroll-wrap" sc="slide-content"> <ul class="clearfix" sc="roll-area"> ';
            $each(data.goods_match_list, function($value, $index) {
                $out += ' <li sc="roll-list"> <a href=""> <img src="';
                $out += $escape($value.gm_pic);
                $out += '"> <p>';
                $out += $escape($value.gm_name);
                $out += "</p> </a> </li> ";
            });
            $out += " </ul> </div> ";
        }
        $out += ' </div> </div> <div class="show_fenye"> <ul class="box"> <li class="flex1"> <a href="';
        $out += $escape(data.brand_url);
        $out += '"><span class="fenyeback"></span></a> </li> <li class="flex1"> <a href="';
        $out += $escape(data.prev_url);
        $out += '"> <span class="ltran mr_10 mt_10"></span>上一个 </a> </li> <li class="flex1"> <a href="';
        $out += $escape(data.last_url);
        $out += '"> 上一个<span class="rtran ml_10"></span> </a> </li> <li class="flex1"> <span class="in_bl pt_5"> ';
        $out += $escape(data.current_num);
        $out += "/";
        $out += $escape(data.count_num);
        $out += " </span> </li> </ul> </div>";
        return new String($out);
    });
});