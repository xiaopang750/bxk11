/*TMODJS:{"version":21,"md5":"509fdfdbfe0f41bfc39af4c1388be695"}*/
define(function(require) {
    return require("../template")("match/list", function($data, $id) {
        var $helpers = this, err = $data.err, $escape = $helpers.$escape, msg = $data.msg, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $out = "";
        if (err) {
            $out += ' <div class="tc">';
            $out += $escape(msg);
            $out += "</div> ";
        } else {
            $out += " ";
            $each(data.list, function($value, $index) {
                $out += ' <div class="main"> <div class="list"> <div class="header"> <ul class="box white font_09"> <li class="flex1 left"> <span class="number">';
                $out += $escape($index);
                $out += "</span> <span>";
                $out += $escape($value.pack_name);
                $out += '</span> <span class="font_08">原价</span> <span class="thr font_09">￥ ';
                $out += $escape($value.product_price);
                $out += "</span> <span>套餐价￥";
                $out += $escape($value.goods_upset);
                $out += '</span> </li> </ul> </div> <ul class="main"> ';
                $each($value.product_list, function($value, $index) {
                    $out += ' <li> <dl class="clearfix"> <dt> <a href="';
                    $out += $escape($value.product_url);
                    $out += '"><img src="';
                    $out += $escape($value.product_pic);
                    $out += '"></a> </dt> <dd class="clearfix font_08"> <div class="inner"> <p>产品名称：';
                    $out += $escape($value.poduct_name);
                    $out += "</p> <p>价格：￥";
                    $out += $escape($value.product_price);
                    $out += "元</p> </div> </dd> </dl> </li> ";
                });
                $out += " </ul> </div> </div> ";
            });
            $out += " ";
        }
        $out += " ";
        return new String($out);
    });
});