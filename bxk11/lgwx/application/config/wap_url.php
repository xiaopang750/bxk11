<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:全局url指向配置信息(wap站)
 *author:yanyalong
 *date:2014/03/24
 */
//主菜单
//首页
$config['wap']['wapindex'] = '/'.APP_DIR.'/index.php/wap/index/index?urlkey=wapindex&levelpage=1';
//品牌展厅
$config['wap']['brandlist'] = '/'.APP_DIR.'/index.php/wap/brand/getlist?urlkey=brandlist&levelpage=1';
//品牌展厅详情
$config['wap']['brandinfo'] = '/'.APP_DIR.'/index.php/wap/brand/info?urlkey=brandinfo';
//最新资讯
$config['wap']['informationlist'] = '/'.APP_DIR.'/index.php/wap/information/getlist?urlkey=informationlist&levelpage=1';
//资讯详情
$config['wap']['informationinfo'] = '/'.APP_DIR.'/index.php/wap/information/info?urlkey=informationinfo';
//经销网络
$config['wap']['shoplist'] = '/'.APP_DIR.'/index.php/wap/shop/getlist?urlkey=shoplist&levelpage=1';
//门店详情
$config['wap']['shopinfo'] = '/'.APP_DIR.'/index.php/wap/shop/info?urlkey=shopinfo';
//店长推荐
$config['wap']['shoprecommend'] = '/'.APP_DIR.'/index.php/wap/shop/recommend?urlkey=shoprecommend';
//店铺商品
$config['wap']['shopgoods'] = '/'.APP_DIR.'/index.php/wap/shop/shopgoods?urlkey=shopgoods';
//联系我们
$config['wap']['shopindexinfo'] = '/'.APP_DIR.'/index.php/wap/shop/index?urlkey=shopindexinfo';
//个人中心
$config['wap']['userspace'] = '/'.APP_DIR.'/index.php/wap/user/index?urlkey=userspace';
//在线商城(列表)
$config['wap']['goodslist'] = '/'.APP_DIR.'/index.php/wap/goods/getlist?urlkey=goodslist';
//商品详情(详情)
$config['wap']['goodsinfo'] = '/'.APP_DIR.'/index.php/wap/goods/info?urlkey=goodsinfo';
////搭配套餐(列表)
//$config['wap']['packlist'] = '/'.APP_DIR.'/index.php/wap/goods/getpacklist?urlkey=packlist';
////相关案例(列表)
//$config['wap']['roomlist'] = '/'.APP_DIR.'/index.php/wap/goods/getroomlist?urlkey=roomlist';
////全景展厅(列表)
//$config['wap']['goods3dlist'] = '/'.APP_DIR.'/index.php/wap/goods3d/getlist?urlkey=goods3dlist';
////全景展厅详情页(详情)
//$config['wap']['goods3dinfo'] = '/'.APP_DIR.'/index.php/wap/goods3d/info?urlkey=goods3dinfo';
//优惠套餐(列表)
$config['wap']['packs'] = '/'.APP_DIR.'/index.php/wap/packs/getlist?urlkey=packs';
//热门排行(列表)
$config['wap']['hotrank'] = '/'.APP_DIR.'/index.php/wap/goods/hotrank?urlkey=hotrank';
//新品上市(列表)
$config['wap']['newgoods'] = '/'.APP_DIR.'/index.php/wap/goods/newgoods?urlkey=newgoods';
//促销活动(列表)
$config['wap']['activitieslist'] = '/'.APP_DIR.'/index.php/wap/activities/getlist?urlkey=activitieslist';
//我收藏的商品(列表)
$config['wap']['goodslikes'] = '/'.APP_DIR.'/index.php/wap/goods/likelist?urlkey=goodslikes';
////我关注的商家(列表)
//$config['wap']['servicelikes'] = '/'.APP_DIR.'/index.php/wap/service/likelist?urlkey=servicelikes';
//我关注的门店(列表)
$config['wap']['shoplikes'] = '/'.APP_DIR.'/index.php/wap/shop/likelist?urlkey=shoplikes';
//参加的活动(列表)
$config['wap']['activitieslikes'] = '/'.APP_DIR.'/index.php/wap/activities/likelist?urlkey=activitieslikes';
//我的装修笔记(列表)
$config['wap']['notelist'] = '/'.APP_DIR.'/index.php/wap/user/notelist?urlkey=notelist';
////商品搭配列表页
//$config['wap']['goods_match_info'] = '/'.APP_DIR.'/index.php/wap/goods/matchinfo?urlkey=goodsmatch';
//登录授权页
$config['wap']['login'] = '/'.APP_DIR.'/index.php/wap/user/login?urlkey=login';
