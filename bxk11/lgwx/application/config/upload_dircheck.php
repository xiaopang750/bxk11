<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*全局上传初始化目录创建*/
$ROOT = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
/*经销商*/
$config['updateDirCheck'][] = $ROOT;
$config['updateDirCheck'][] = $ROOT.'service/';
/*经销商系列商品*/
$config['updateDirCheck'][] = $ROOT.'service/goods/';
$config['updateDirCheck'][] = $ROOT.'service/goods/pic/';
$config['updateDirCheck'][] = $ROOT.'service/goods/pic/source/';
$config['updateDirCheck'][] = $ROOT.'service/goods/pic/thumb_1/';
$config['updateDirCheck'][] = $ROOT.'service/goods/pic/thumb_2/';
$config['updateDirCheck'][] = $ROOT.'service/goods/pic/thumb_3/';
$config['updateDirCheck'][] = $ROOT.'service/goods/pic/thumb_4/';
$config['updateDirCheck'][] = $ROOT.'service/goods/ueditor/';
/*经销商图文采编*/
$config['updateDirCheck'][] = $ROOT.'service/information/';
$config['updateDirCheck'][] = $ROOT.'service/information/toppic/';
$config['updateDirCheck'][] = $ROOT.'service/information/toppic/source/';
$config['updateDirCheck'][] = $ROOT.'service/information/toppic/thumb_1/';
$config['updateDirCheck'][] = $ROOT.'service/information/toppic/thumb_2/';
$config['updateDirCheck'][] = $ROOT.'service/information/toppic/thumb_3/';
$config['updateDirCheck'][] = $ROOT.'service/information/toppic/thumb_4/';
/*服务上商品搭配*/
$config['updateDirCheck'][] = $ROOT.'service/goods/match/';
$config['updateDirCheck'][] = $ROOT.'service/goods/match/source/';
$config['updateDirCheck'][] = $ROOT.'service/goods/match/thumb_1/';
$config['updateDirCheck'][] = $ROOT.'service/goods/match/thumb_2/';
$config['updateDirCheck'][] = $ROOT.'service/goods/match/thumb_3/';
$config['updateDirCheck'][] = $ROOT.'service/goods/match/thumb_4/';
/*经销商品牌*/
$config['updateDirCheck'][] = $ROOT.'service/brand/';
/*经销商加盟*/
$config['updateDirCheck'][] = $ROOT.'service/join/';
/*经销商执照*/
$config['updateDirCheck'][] = $ROOT.'service/license/';
$config['updateDirCheck'][] = $ROOT.'service/license/default/';
$config['updateDirCheck'][] = $ROOT.'service/license/source/';
/*经销商平台模块*/
$config['updateDirCheck'][] = $ROOT.'service/modules/';
$config['updateDirCheck'][] = $ROOT.'service/modules/source/';
/*经销商门店*/
$config['updateDirCheck'][] = $ROOT.'service/shop/';
$config['updateDirCheck'][] = $ROOT.'service/shop/source/';
$config['updateDirCheck'][] = $ROOT.'service/shop/thumb_1/';
$config['updateDirCheck'][] = $ROOT.'service/shop/thumb_2/';
$config['updateDirCheck'][] = $ROOT.'service/shop/thumb_3/';
$config['updateDirCheck'][] = $ROOT.'service/shop/thumb_4/';
/*门店幻灯片*/
$config['updateDirCheck'][] = $ROOT.'service/slide/';
$config['updateDirCheck'][] = $ROOT.'service/slide/source/';
$config['updateDirCheck'][] = $ROOT.'service/slide/thumb_1/';
$config['updateDirCheck'][] = $ROOT.'service/slide/thumb_2/';
$config['updateDirCheck'][] = $ROOT.'service/slide/thumb_3/';
$config['updateDirCheck'][] = $ROOT.'service/slide/thumb_4/';
/*经销商子帐号*/
$config['updateDirCheck'][] = $ROOT.'service/user/';
$config['updateDirCheck'][] = $ROOT.'service/user/source/';
/*excel批量导入数据*/
$config['updateDirCheck'][] = $ROOT.'phpexcel/';
/*jia178标签*/
$config['updateDirCheck'][] = $ROOT.'theme/';
$config['updateDirCheck'][] = $ROOT.'theme/default/';
$config['updateDirCheck'][] = $ROOT.'theme/source/';
/*经销商品牌系列*/
$config['updateDirCheck'][] = $ROOT.'service/series/';
$config['updateDirCheck'][] = $ROOT.'service/series/default/';
$config['updateDirCheck'][] = $ROOT.'service/series/source/';
$config['updateDirCheck'][] = $ROOT.'service/series/thumb_1/';
$config['updateDirCheck'][] = $ROOT.'service/series/thumb_2/';
$config['updateDirCheck'][] = $ROOT.'service/series/thumb_3/';
$config['updateDirCheck'][] = $ROOT.'service/series/thumb_4/';
/*临时目录 */
$config['updateDirCheck'][] = $ROOT.'temp/';
$config['updateDirCheck'][] = $ROOT.'temp/apartment/';
$config['updateDirCheck'][] = $ROOT.'temp/floor/';
$config['updateDirCheck'][] = $ROOT.'temp/service/';
/*户型图*/
$config['updateDirCheck'][] = $ROOT.'apartment/';
$config['updateDirCheck'][] = $ROOT.'apartment/default/';
$config['updateDirCheck'][] = $ROOT.'apartment/source/';
$config['updateDirCheck'][] = $ROOT.'apartment/thumb_1/';
/*用户头像*/
$config['updateDirCheck'][] = $ROOT.'avatar/';
$config['updateDirCheck'][] = $ROOT.'avatar/tmp/';
/*灵感博文*/
$config['updateDirCheck'][] = $ROOT.'blog/';
$config['updateDirCheck'][] = $ROOT.'blog/default/';
$config['updateDirCheck'][] = $ROOT.'blog/source/';
$config['updateDirCheck'][] = $ROOT.'blog/thumb_1/';
$config['updateDirCheck'][] = $ROOT.'blog/thumb_2/';
$config['updateDirCheck'][] = $ROOT.'blog/thumb_3/';
$config['updateDirCheck'][] = $ROOT.'blog/thumb_4/';
/*系统品牌*/
$config['updateDirCheck'][] = $ROOT.'brand/';
$config['updateDirCheck'][] = $ROOT.'brand/default/';
$config['updateDirCheck'][] = $ROOT.'brand/source/';
$config['updateDirCheck'][] = $ROOT.'brand/thumb_1/';
$config['updateDirCheck'][] = $ROOT.'brand/thumb_2/';
$config['updateDirCheck'][] = $ROOT.'brand/thumb_3/';
/*样板间*/
$config['updateDirCheck'][] = $ROOT.'room/';
$config['updateDirCheck'][] = $ROOT.'room/default/';
$config['updateDirCheck'][] = $ROOT.'room/source/';
$config['updateDirCheck'][] = $ROOT.'room/thumb_1/';
$config['updateDirCheck'][] = $ROOT.'room/thumb_2/';
$config['updateDirCheck'][] = $ROOT.'room/thumb_3/';
$config['updateDirCheck'][] = $ROOT.'room/thumb_4/';
$config['updateDirCheck'][] = $ROOT.'room/thumb_5/';
/*装修案例*/
$config['updateDirCheck'][] = $ROOT.'scheme/';
$config['updateDirCheck'][] = $ROOT.'scheme/default/';
/*标准产品库*/
$config['updateDirCheck'][] = $ROOT.'product/';
$config['updateDirCheck'][] = $ROOT.'product/default/';
$config['updateDirCheck'][] = $ROOT.'product/index/';
/*经销商证件信息*/
$config['updateDirCheck'][] = $ROOT.'service/';
$config['updateDirCheck'][] = $ROOT.'service/info/';
$config['updateDirCheck'][] = $ROOT.'service/info/source/';
/*微信公众平台所有图片上传地址*/
$config['updateDirCheck'][] = $ROOT.'service/weixin/';
/*服务商wap站背景图片*/
$config['updateDirCheck'][] = $ROOT.'service/wap_template/';
