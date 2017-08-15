<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:全局控制器模板加载url路径
 *author:yanyalong
 *date:2013/10/30
 */

//非moudle调用页面配置
$config['lgwx']['service_reg'] = "regist.php";  //经销商加盟页面
$config['lgwx']['service_login'] = "login.php";  //经销商登录页面
//moudle-action调用页面配置 
//key值固定，与数据库同步
////////////////////////////////////////////////////////////////用户桌面
$config['action']['index'] = "index.php"; 
//检测认证状态
$config['action']['join_status'] = "check.php"; 
//申请经销商认证第一步
$config['action']['join_step1'] = "reg_step1.php"; 
//申请经销商认证第二步
$config['action']['join_step2'] = "reg_step2.php"; 
//申请经销商认证第三步
$config['action']['join_step3'] = "reg_step3.php"; 
//申请经销商认证流程完成后公众号绑定向导
$config['action']['join_step4'] = "reg_step4.php"; 
//用户信息修改
$config['action']['service_user_mod'] = "modify.php"; 
//企业信息设置
$config['action']['service_set'] = "manage_info.php";  
//////////////////////////////////////////////////////////////移动官网
//品牌管理
$config['action']['brand_list'] = "manage_brand.php";  
//添加品牌
$config['action']['brand_add'] = "manage_brand_add.php";  
//编辑品牌
$config['action']['brand_edit'] = "manage_brand_add.php";  
//认证品牌
$config['action']['brand_certified'] = "manage_brand_add.php";  
//经销网点管理
$config['action']['shop_list'] = "manage_shop.php";  
//门店关联品牌
$config['action']['shop_to_brand'] = "brand_shop_related.php";  
//添加实体店
$config['action']['shop_add'] = "manage_shop_add.php";   
//编辑实体店
$config['action']['shop_edit'] = "manage_shop_add.php"; 
//实体店认证
$config['action']['shop_certified'] = "manage_shop_add.php"; 
//wap官网模版设置
$config['action']['template_list'] = "model.php";  
//店铺橱窗管理
$config['action']['slide_list'] = "slider.php"; 
//添加橱窗幻灯片
$config['action']['slide_add'] = "slider_edit.php"; 
//编辑橱窗幻灯片
$config['action']['slide_edit'] = "slider_edit.php";  
//快捷方式设置
$config['action']['shortcut_list'] = "fast_menu.php";  
////////////////////////////////////////////////////////////////////////////移动商城
//品牌系列
$config['action']['series_list'] = "series.php";  
//添加系列
$config['action']['series_add'] = "series_add.php";  
//编辑系列
$config['action']['series_edit'] = "series_add.php"; 
//商品列表
$config['action']['goods_list'] = "goods.php";  
//添加商品
$config['action']['goods_add'] = "goods_add.php";  
//编辑商品
$config['action']['goods_edit'] = "goods_add.php";  
//商品优惠套餐列表
$config['action']['goods_match_list'] = "matchlist.php";  
//添加商品优惠套餐
$config['action']['goods_match_add'] = "match.php";  
//编辑商品优惠套餐
$config['action']['goods_match_edit'] = "match.php";  
////////////////////////////////////////////////////////////////////////////////////移动运营
//图文采编管理
$config['action']['information_list'] = "reply.php";  
//添加图文采编
$config['action']['information_add'] = "reply_add.php";  
//编辑图文采编
$config['action']['information_edit'] = "reply_add.php";  
//素材管理
$config['action']['album_list'] = "photo.php";  
//微信公众号管理
$config['action']['weixin_list'] = "weixin_manage.php"; 
//公众号绑定
$config['action']['weixin_add'] = "weixin_code_add.php"; 
//公众号绑定编辑
$config['action']['weixin_edit'] = "weixin_code_add.php"; 
//被添加自动回复
$config['action']['follow_reply'] = "reply_passive.php"; 
//消息自动回复
$config['action']['msg_reply_list'] = "reply_message.php";
//关键词自动回复
$config['action']['text_reply_list'] = "reply_word.php";  
//自定义菜单
$config['action']['diy_menu_list'] = "weixin_menu.php"; 

////增值服务管理
//$config['action']['vas_list'] = "service.php"; 

