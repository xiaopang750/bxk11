/*TMODJS:{"version":30,"md5":"fe8fe0f18c9799e9deacfbacf5f3898a"}*/
define(function(require) {
    return require("../template")("info/list", function($data, $id) {
        var $helpers = this, $escape = $helpers.$escape, data = $data.data, $out = "";
        $out += '<section class="info_wrap m_b"> <section class="info"> <div class="inner clearfix"> <dl class="clearfix pt_7"> <dt class="fl mr_10"> <img src="';
        $out += $escape(data.user_pic);
        $out += '" alt="';
        $out += $escape(data.nickname);
        $out += '" width="60"> </dt> <dd class="fl ml_20 mt_5"> <h3 class="mb_10 white">';
        $out += $escape(data.nickname);
        $out += '</h3> <h4 class="white">';
        $out += $escape(data.user_id);
        $out += '</h4> <h4 class="white"> <a class="white" href="/lgwx/index.php/wap/user/logout?urlkey=login&service_id=';
        $out += $escape(data.service_id);
        $out += '">退出登录</a> </h4> </dd> </dl> </div> </section> </section> <section class="personal clearfix mb_15 mt_25"> <ul script-role="data_wrap" class="mb_25"> <li> <a href="';
        $out += $escape(data.goodsLikeUrl);
        $out += '" class="clearfix"> <span class="icon fl"></span> <span class="fl">我收藏的商品</span> <span class="fr font_16">></span> </a> </li> <li> <a href="';
        $out += $escape(data.shopLikesUrl);
        $out += '" class="clearfix"> <span class="icon fl"></span> <span class="fl">我关注的店铺</span> <span class="fr font_16">></span> </a> </li> <li> <a href="';
        $out += $escape(data.notesUrl);
        $out += '" class="clearfix"> <span class="icon fl"></span> <span class="fl">我的装修笔记</span> <span class="fr font_16">></span> </a> </li> <li> <a href="javascript:;" class="clearfix"> <span class="icon fl"></span> <span class="fl">我的优惠活动</span> <span class="fr font_16">></span> </a> </li> <li> <a href="';
        $out += $escape(data.couponLikesUrl);
        $out += '" class="clearfix"> <span class="icon fl"></span> <span class="fl">我的订阅</span> <span class="fr font_16">></span> </a> </li> </ul> <h3 class="mb_10">您可以使用会员编号和登录密码在电脑上</h3> <h3 class="pb_30">登录JIA178.COM同步查看</h3> </section>';
        return new String($out);
    });
});