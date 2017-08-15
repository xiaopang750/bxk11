/*TMODJS:{"version":439,"md5":"cb560ecc96fa024c1832eef0d8fe4f6e"}*/
define(function(require) {
    return require("../template")("goods/detail", function($data, $id) {
        var $helpers = this, $each = $helpers.$each, data = $data.data, $value = $data.$value, $index = $data.$index, $escape = $helpers.$escape, $out = "";
        $out += '<li class="mb_20 main-list"> <dl> <dt>  <section class="focus"> <div widget-role="focus-wrap" widget-width="540" widget-height="300" widget-scale="0.9" style="margin:0 auto"> <ul class="focus_wrap" widget-role="focus-data-wrap"> ';
        $each(data.goods_piclist, function($value, $index) {
            $out += ' <li><img src="';
            $out += $escape($value);
            $out += '" link=""/></li> ';
        });
        $out += ' </ul> <div class="dot_wrap" widget-role="focus-dot-wrap"> </div> </div> </section> <!-- <div class="fav-num"> <span class="faver-logo"></span> <span>';
        $out += $escape(data.goodslikes);
        $out += '</span> </div> --> <!-- <input type="checkbox" class="fav ';
        if (data.is_like == 1) {
            $out += "active";
        }
        $out += '" script-role="fav" is_like="';
        $out += $escape(data.is_like);
        $out += '" target="';
        $out += $escape(data.like_url);
        $out += '"> --> </dt> <dd> <p> 商城价：<span class="pink font_14 mr_10">￥';
        $out += $escape(data.goods_member_price);
        $out += '</span> 市场价格：<span class="thr ml_5 font_09">￥';
        $out += $escape(data.goods_price);
        $out += '</span> </p> <div class="clearfix"> <div class="sale-bg fl mr_10"> <span class="ml_5">促销活动</span> </div> <div class="fl sale-info mt_1"> ';
        if (!data.sales) {
            $out += " 暂无促销活动 ";
            if (data.is_like == 0) {
                $out += ' ，点击 <a href="javascript:;" class="pink" script-role="fav" is_like="0" role="text-fav">收藏</a> 随时关注 ';
            }
            $out += " ";
        } else {
            $out += " ";
            $out += $escape(data.sales);
            $out += " ";
        }
        $out += " </div> </div> <p>商品编号：";
        $out += $escape(data.goods_code);
        $out += "</p> <p>商品尺寸：";
        $out += $escape(data.goods_size);
        $out += "</p> <p>商品材质：";
        $out += $escape(data.goods_materials);
        $out += '</p> </dd> </dl> <div class="qcode" sc="qcode"> </div> </li> <li class="match mb_20 main-list" sc="slide-wrap"> <div class="inner"> <div class="title-area clearfix"> <span class="fl">商品推荐</span> ';
        if (!data.goods_recommend_list) {
            $out += ' <span class="fr">没有相关搭配</span> ';
        } else {
            $out += ' <span class="fr" sc="slide" islide="yes">收起&gt;&gt;</span> ';
        }
        $out += " </div> ";
        if (data.goods_recommend_list) {
            $out += ' <div class="content-area" id="iscroll-wrap" sc="slide-content"> <ul class="clearfix" sc="roll-area"> ';
            $each(data.goods_recommend_list, function($value, $index) {
                $out += ' <li sc="roll-list"> <a href="';
                $out += $escape($value.goods_url);
                $out += '"> <img src="';
                $out += $escape($value.goods_pic);
                $out += '"> </a> <p>';
                $out += $escape($value.goods_name);
                $out += "</p> </li> ";
            });
            $out += " </ul> </div> ";
        }
        $out += ' </div> </li> <li class="case mb_20 main-list" sc="slide-wrap"> <div class="inner"> <div class="title-area clearfix"> <span class="fl">装修案例</span> ';
        if (!data.goods_scheme_list) {
            $out += ' <span class="fr">没有相关案例</span> ';
        } else {
            $out += ' <span class="fr" sc="slide" islide="yes">收起&gt;&gt;</span> ';
        }
        $out += " </div> ";
        if (data.goods_scheme_list) {
            $out += ' <div class="content-area" sc="slide-content"> <ul class="clearfix"> ';
            $each(data.goods_scheme_list, function($value, $index) {
                $out += ' <li class="clearfix"> <p class="fl">';
                $out += $escape($value.scheme_name);
                $out += '</p> <div class="fr"> <span class="small-fav-logo"></span> <span class="fav-num-text">';
                $out += $escape($value.scheme_likes);
                $out += "</span> </div> </li> ";
            });
            $out += " </ul> </div> ";
        }
        $out += ' </div> </li> <li class="net mb_20 main-list" sc="slide-wrap"> <div class="inner"> <div class="title-area clearfix"> <span class="fl">经销网点</span> ';
        if (!data.shop_list) {
            $out += ' <span class="fr">没有相关经销网点</span> ';
        } else {
            $out += ' <span class="fr" sc="slide" islide="yes">收起&gt;&gt;</span> ';
        }
        $out += " </div> ";
        if (data.shop_list) {
            $out += ' <div class="content-area" sc="slide-content"> <ul class="clearfix"> ';
            $each(data.shop_list, function($value, $index) {
                $out += ' <li class="clearfix"> ';
                if ($index == 0) {
                    $out += '<span class="tran"></span>';
                }
                $out += ' <span class="fl">';
                $out += $escape($value.shop_name);
                $out += '</span> <a href="';
                $out += $escape($value.shop_url);
                $out += '" class="fr"> ';
                if ($index == 0) {
                    $out += " 店铺首页 ";
                } else {
                    $out += " 进入店铺 ";
                }
                $out += " </a> </li> ";
            });
            $out += " </ul> </div> ";
        }
        $out += ' </div> </li> <li class="diary-content" sc="diary-content"> <h3>';
        $out += $escape(data.addnote.date);
        $out += '</h3> <p class="mb_5">';
        $out += $escape(data.addnote.showmsg);
        $out += '</p> <table cellspacing="0" cellpadding="0" border="0" width="100%"> <tr sc="point-list"> <td width="20%">外观：</td> <td width="60%"> <span class="point" sc="point"></span> <span class="point" sc="point"></span> <span class="point" sc="point"></span> <span class="point" sc="point"></span> <span class="point" sc="point"></span> </td> <td width="20%" sc="score"></td> </tr> <tr sc="point-list"> <td>舒适度：</td> <td> <span class="point" sc="point"></span> <span class="point" sc="point"></span> <span class="point" sc="point"></span> <span class="point" sc="point"></span> <span class="point" sc="point"></span> </td> <td sc="score"></td> </tr> <tr sc="point-list"> <td>价格：</td> <td> <span class="point" sc="point"></span> <span class="point" sc="point"></span> <span class="point" sc="point"></span> <span class="point" sc="point"></span> <span class="point" sc="point"></span> </td> <td sc="score"></td> </tr> </table> <p class="mb_2">补充描述:</p> <form> <textarea class="mb_10" sc="save-content" time="';
        $out += $escape(data.addnote.date);
        $out += '" desc="';
        $out += $escape(data.addnote.savemsg);
        $out += '" shop_name="';
        $out += $escape(data.shop_name);
        $out += '"></textarea> <input type="submit" class="save fr" sc="save-btn" value="保存笔记"> </form> <div class="clear"></div> </li> <li class="bottom-tool" sc="bottom-tool"> <div class="box"> <div class="flex2 faver-wrap"> <div class="bg" script-role="fav" is_like="';
        $out += $escape(data.is_like);
        $out += '"> <span class="faver ';
        if (data.is_like == 1) {
            $out += "active";
        }
        $out += '" sc="fav-icon"></span> <span class="text" sc="fav-text"> ';
        if (data.is_like == 0) {
            $out += " 马上收藏 ";
        } else {
            $out += " 已收藏 ";
        }
        $out += ' </span> </div> </div> <div class="flex2 diary-wrap" sc="diary-wrap"> <div class="bg"> <span class="diary"></span> <span class="text">装修笔记</span> </div> </div> <div class="flex1 rock-wrap"> <div class="bg" sc="backtop"> <span class="rock"></span> </div> </div> </div> </li>';
        return new String($out);
    });
});