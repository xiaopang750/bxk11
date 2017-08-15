<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *上传功能相关配置信息,可根据不同需求配置不同数组信息
 */
//经销商加盟相关
$config['serviceJoin']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/service/';
$config['serviceJoin']['service_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/info/source/';
$config['serviceJoin']['relative_path']= '/uploads/temp/service/';
$config['serviceJoin']['relative_upload']= '/uploads/service/info/source/';
$config['serviceJoin']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['serviceJoin']['max_size'] = '20240';
$config['serviceJoin']['min_width']  = '300';
$config['serviceJoin']['min_height']  = '300';
$config['serviceJoin']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';


//经销商门店相关(缩略图)
$config['serviceShop']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/service/';
$config['serviceShop']['service_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/shop/source/';
$config['serviceShop']['relative_path']= '/uploads/temp/service/';
$config['serviceShop']['relative_upload']= '/uploads/service/shop/source/';
$config['serviceShop']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['serviceShop']['max_size'] = '10240';
$config['serviceShop']['min_width']  = '300';
$config['serviceShop']['min_height']  = '300';
$config['serviceShop']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';
$config['serviceShop']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/shop/thumb_1/';
$config['serviceShop']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/shop/thumb_2/';
$config['serviceShop']['thumb_3'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/shop/thumb_3/';
$config['serviceShop']['thumb_4'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/shop/thumb_4/';
$config['serviceShop']['thumb_size_1_x'] = "120";
$config['serviceShop']['thumb_size_1_y'] = "";
$config['serviceShop']['thumb_size_2_x'] = "240";
$config['serviceShop']['thumb_size_2_y'] = "";
$config['serviceShop']['thumb_size_3_x'] = "480";
$config['serviceShop']['thumb_size_3_y'] = "";
$config['serviceShop']['thumb_size_4_x'] = "960";
$config['serviceShop']['thumb_size_4_y'] = "";
$config['serviceShop']['relative_thumb_1_path'] = "/uploads/service/shop/thumb_1/";
$config['serviceShop']['relative_thumb_2_path'] = "/uploads/service/shop/thumb_2/";
$config['serviceShop']['relative_thumb_3_path'] = "/uploads/service/shop/thumb_3/";
$config['serviceShop']['relative_thumb_4_path'] = "/uploads/service/shop/thumb_4/";

//经销商幻灯片相关
$config['serviceFlash']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/service/';
$config['serviceFlash']['service_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/slide/source/';
$config['serviceFlash']['relative_path']= '/uploads/temp/service/';
$config['serviceFlash']['relative_upload']= '/uploads/service/slide/source/';
$config['serviceFlash']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['serviceFlash']['max_size'] = '10240';
$config['serviceFlash']['min_width']  = '300';
$config['serviceFlash']['min_height']  = '300';
$config['serviceFlash']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';
$config['serviceFlash']['thumb_size_source_x'] = "480";
$config['serviceFlash']['thumb_size_source_y'] = "360";
$config['serviceFlash']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/slide/thumb_1/';
$config['serviceFlash']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/slide/thumb_2/';
$config['serviceFlash']['thumb_size_1_x'] = "480";
$config['serviceFlash']['thumb_size_1_y'] = "";
$config['serviceFlash']['thumb_size_2_x'] = "960";
$config['serviceFlash']['thumb_size_2_y'] = "";
$config['serviceFlash']['relative_thumb_1_path'] = "/uploads/service/slide/thumb_1/";
$config['serviceFlash']['relative_thumb_2_path'] = "/uploads/service/slide/thumb_2/";


//经销商帐号相关
$config['serviceUser']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/service/';
$config['serviceUser']['service_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/user/source/';
$config['serviceUser']['relative_path']= '/uploads/temp/service/';
$config['serviceUser']['relative_upload']= '/uploads/service/user/source/';
$config['serviceUser']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['serviceUser']['max_size'] = '10240';
$config['serviceUser']['min_width']  = '300';
$config['serviceUser']['min_height']  = '300';
$config['serviceUser']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';

//经销商品牌授权书相关
$config['serviceBrandLicense']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/service/';
$config['serviceBrandLicense']['service_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/brand/';
$config['serviceBrandLicense']['relative_path']= '/uploads/temp/service/';
$config['serviceBrandLicense']['relative_upload']= '/uploads/service/brand/';
$config['serviceBrandLicense']['allowed_types'] ='gif|jpg|jpeg|png';
$config['serviceBrandLicense']['max_size'] = '10240';
$config['serviceBrandLicense']['min_width']  = '300';
$config['serviceBrandLicense']['min_height']  = '300';
$config['serviceBrandLicense']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';

//经销商品牌logo相关
$config['serviceApplyBrand']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/service/';
$config['serviceApplyBrand']['service_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/brand/';
$config['serviceApplyBrand']['relative_path']= '/uploads/temp/service/';
$config['serviceApplyBrand']['relative_upload']= '/uploads/service/brand/';
$config['serviceApplyBrand']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['serviceApplyBrand']['max_size'] =  '512';
$config['serviceApplyBrand']['min_width']  = '100';
$config['serviceApplyBrand']['min_height']  = '100';
$config['serviceApplyBrand']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';

//经销商商品优惠套餐封面相关
$config['serviceBrandSeries']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/service/';
$config['serviceBrandSeries']['service_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/series/source/';
$config['serviceBrandSeries']['relative_path']= '/uploads/temp/service/';
$config['serviceBrandSeries']['relative_upload']= '/uploads/service/series/source/';
$config['serviceBrandSeries']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['serviceBrandSeries']['max_size'] = '10240';
$config['serviceBrandSeries']['min_width']  = '300';
$config['serviceBrandSeries']['min_height']  = '300';
$config['serviceBrandSeries']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';
$config['serviceBrandSeries']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/series/thumb_1/';
$config['serviceBrandSeries']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/series/thumb_2/';
$config['serviceBrandSeries']['thumb_3'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/series/thumb_3/';
$config['serviceBrandSeries']['thumb_4'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/series/thumb_4/';
$config['serviceBrandSeries']['thumb_size_1_x'] = "120";
$config['serviceBrandSeries']['thumb_size_1_y'] = "";
$config['serviceBrandSeries']['thumb_size_2_x'] = "240";
$config['serviceBrandSeries']['thumb_size_2_y'] = "";
$config['serviceBrandSeries']['thumb_size_3_x'] = "480";
$config['serviceBrandSeries']['thumb_size_3_y'] = "";
$config['serviceBrandSeries']['thumb_size_4_x'] = "960";
$config['serviceBrandSeries']['thumb_size_4_y'] = "";
$config['serviceBrandSeries']['relative_thumb_1_path'] = "/uploads/service/series/thumb_1/";
$config['serviceBrandSeries']['relative_thumb_2_path'] = "/uploads/service/series/thumb_2/";
$config['serviceBrandSeries']['relative_thumb_3_path'] = "/uploads/service/series/thumb_3/";
$config['serviceBrandSeries']['relative_thumb_4_path'] = "/uploads/service/series/thumb_4/";

//经销商系列商品相关(缩略图)
$config['ServiceSeriesGoodsThumb']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/service/';
$config['ServiceSeriesGoodsThumb']['service_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/pic/source/';
$config['ServiceSeriesGoodsThumb']['relative_path']= '/uploads/temp/service/';
$config['ServiceSeriesGoodsThumb']['relative_upload']= '/uploads/service/goods/pic/source/';
$config['ServiceSeriesGoodsThumb']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['ServiceSeriesGoodsThumb']['max_size'] = '10240';
$config['ServiceSeriesGoodsThumb']['min_width']  = '300';
$config['ServiceSeriesGoodsThumb']['min_height']  = '300';
$config['ServiceSeriesGoodsThumb']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';
$config['ServiceSeriesGoodsThumb']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/pic/thumb_1/';
$config['ServiceSeriesGoodsThumb']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/pic/thumb_2/';
$config['ServiceSeriesGoodsThumb']['thumb_3'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/pic/thumb_3/';
$config['ServiceSeriesGoodsThumb']['thumb_4'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/pic/thumb_4/';
$config['ServiceSeriesGoodsThumb']['thumb_size_1_x'] = "120";
$config['ServiceSeriesGoodsThumb']['thumb_size_1_y'] = "";
$config['ServiceSeriesGoodsThumb']['thumb_size_2_x'] = "240";
$config['ServiceSeriesGoodsThumb']['thumb_size_2_y'] = "";
$config['ServiceSeriesGoodsThumb']['thumb_size_3_x'] = "480";
$config['ServiceSeriesGoodsThumb']['thumb_size_3_y'] = "";
$config['ServiceSeriesGoodsThumb']['thumb_size_4_x'] = "960";
$config['ServiceSeriesGoodsThumb']['thumb_size_4_y'] = "";
$config['ServiceSeriesGoodsThumb']['relative_thumb_1_path'] = "/uploads/service/goods/pic/thumb_1/";
$config['ServiceSeriesGoodsThumb']['relative_thumb_2_path'] = "/uploads/service/goods/pic/thumb_2/";
$config['ServiceSeriesGoodsThumb']['relative_thumb_3_path'] = "/uploads/service/goods/pic/thumb_3/";
$config['ServiceSeriesGoodsThumb']['relative_thumb_4_path'] = "/uploads/service/goods/pic/thumb_4/";


//微信裁切
$config['weixin_pic']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/weixin/';
$config['weixin_pic']['relative_upload']= '/uploads/service/weixin/';
$config['weixin_pic']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['weixin_pic']['max_size'] = '10240';
$config['weixin_pic']['min_width']  = '300';
$config['weixin_pic']['min_height']  = '300';
$config['weixin_pic']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';

/**
 * 经销商品缩略图配制信息（后台）liuguangping
 **/
$config['service_WeixinMenu']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/weixin/source/';
$config['service_WeixinMenu']['max_size'] = '10240';
$config['service_WeixinMenu']['min_width'] = '300';
$config['service_WeixinMenu']['min_height'] = '300';
$config['service_WeixinMenu']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['service_WeixinMenu']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/weixin/thumb_1/';
$config['service_WeixinMenu']['thumb_size_1_x'] = "360";
$config['service_WeixinMenu']['thumb_size_1_y'] = "200";
$config['service_WeixinMenu']['relative_path']= '/uploads/service/weixin/';
$config['service_WeixinMenu']['default_1'] = '/uploads/service/weixin/default/thumb_1.jpg';

//经销商图文采编相关(缩略图)
$config['serviceInformation']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/service/';
$config['serviceInformation']['service_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/information/toppic/source/';
$config['serviceInformation']['relative_path']= '/uploads/temp/service/';
$config['serviceInformation']['relative_upload']= '/uploads/service/information/toppic/source/';
$config['serviceInformation']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['serviceInformation']['max_size'] = '10240';
$config['serviceInformation']['min_width']  = '300';
$config['serviceInformation']['min_height']  = '300';
$config['serviceInformation']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';
$config['serviceInformation']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/information/toppic/thumb_1/';
$config['serviceInformation']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/information/toppic/thumb_2/';
$config['serviceInformation']['thumb_3'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/information/toppic/thumb_3/';
$config['serviceInformation']['thumb_4'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/information/toppic/thumb_4/';
$config['serviceInformation']['thumb_size_1_x'] = "120";
$config['serviceInformation']['thumb_size_1_y'] = "";
$config['serviceInformation']['thumb_size_2_x'] = "240";
$config['serviceInformation']['thumb_size_2_y'] = "";
$config['serviceInformation']['thumb_size_3_x'] = "480";
$config['serviceInformation']['thumb_size_3_y'] = "";
$config['serviceInformation']['thumb_size_4_x'] = "960";
$config['serviceInformation']['thumb_size_4_y'] = "";
$config['serviceInformation']['relative_thumb_1_path'] = "/uploads/service/information/toppic/thumb_1/";
$config['serviceInformation']['relative_thumb_2_path'] = "/uploads/service/information/toppic/thumb_2/";
$config['serviceInformation']['relative_thumb_3_path'] = "/uploads/service/information/toppic/thumb_3/";
$config['serviceInformation']['relative_thumb_4_path'] = "/uploads/service/information/toppic/thumb_4/";


/**
 * 系统资讯（后台） liuguangping
 **/
$config['service_InforMation']['upload_path'] =$_SERVER['DOCUMENT_ROOT'].'/uploads/service/information/source/';
$config['service_InforMation']['max_size'] = '10240';
$config['service_InforMation']['min_width'] = '630';
$config['service_InforMation']['min_height'] = '420';
$config['service_InforMation']['allowed_types'] = 'gif|jpg|jpeg|png';

$config['service_InforMation']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/information/thumb_1/';
$config['service_InforMation']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/information/thumb_2/';
$config['service_InforMation']['thumb_size_1_x'] = "63";
$config['service_InforMation']['thumb_size_1_y'] = "63";
$config['service_InforMation']['thumb_size_2_x'] = "630";
$config['service_InforMation']['thumb_size_2_y'] = "420";
$config['service_InforMation']['relative_path']= '/uploads/service/information/';
$config['service_InforMation']['default_1'] = '/uploads/service/information/default/thumb_1.jpg';
$config['service_InforMation']['default_2'] = '/uploads/service/information/default/thumb_2.jpg';

//经销商图文采编内容相关
$config['serviceInformationContent']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/information/';
$config['serviceInformationContent']['service_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/information/';
$config['serviceInformationContent']['relative_upload']= '/uploads/service/information/';
$config['serviceInformationContent']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['serviceInformationContent']['max_size'] = '10240';
$config['serviceInformationContent']['min_width']  = '300';
$config['serviceInformationContent']['min_height']  = '300';

//经销商商品优惠套餐封面相关
$config['serviceGoodsMatch']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/service/';
$config['serviceGoodsMatch']['service_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/match/source/';
$config['serviceGoodsMatch']['relative_path']= '/uploads/temp/service/';
$config['serviceGoodsMatch']['relative_upload']= '/uploads/service/goods/match/source/';
$config['serviceGoodsMatch']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['serviceGoodsMatch']['max_size'] = '10240';
$config['serviceGoodsMatch']['min_width']  = '300';
$config['serviceGoodsMatch']['min_height']  = '300';
$config['serviceGoodsMatch']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';
$config['serviceGoodsMatch']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/match/thumb_1/';
$config['serviceGoodsMatch']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/match/thumb_2/';
$config['serviceGoodsMatch']['thumb_3'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/match/thumb_3/';
$config['serviceGoodsMatch']['thumb_4'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/match/thumb_4/';
$config['serviceGoodsMatch']['thumb_size_1_x'] = "120";
$config['serviceGoodsMatch']['thumb_size_1_y'] = "";
$config['serviceGoodsMatch']['thumb_size_2_x'] = "240";
$config['serviceGoodsMatch']['thumb_size_2_y'] = "";
$config['serviceGoodsMatch']['thumb_size_3_x'] = "480";
$config['serviceGoodsMatch']['thumb_size_3_y'] = "";
$config['serviceGoodsMatch']['thumb_size_4_x'] = "960";
$config['serviceGoodsMatch']['thumb_size_4_y'] = "";
$config['serviceGoodsMatch']['relative_thumb_1_path'] = "/uploads/service/goods/match/thumb_1/";
$config['serviceGoodsMatch']['relative_thumb_2_path'] = "/uploads/service/goods/match/thumb_2/";
$config['serviceGoodsMatch']['relative_thumb_3_path'] = "/uploads/service/goods/match/thumb_3/";
$config['serviceGoodsMatch']['relative_thumb_4_path'] = "/uploads/service/goods/match/thumb_4/";

//经销商logo相关
$config['serviceLogo']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/logo/';
$config['serviceLogo']['relative_upload']= '/uploads/service/logo/';
$config['serviceLogo']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['serviceLogo']['max_size'] = '51200';
$config['serviceLogo']['min_width']  = '100';
$config['serviceLogo']['min_height']  = '100';
$config['serviceLogo']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';

//推广二维码保存
$config['serviceQr']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/qr/';
$config['serviceQr']['relative_upload']= '/uploads/service/qr/';
$config['serviceQr']['size']  = '300';
$config['serviceQr']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.png';

//服务商二维码保存
$config['serviceLogoQr']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/logo/';
$config['serviceLogoQr']['relative_upload']= '/uploads/service/logo/';
$config['serviceLogoQr']['size']  = '300';
$config['serviceLogoQr']['text']  = "/lgwx/index.php/wap/index/index?levelpage=1&urlkey=wapindex"; //wap首页地址
$config['serviceLogoQr']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.png';

$config['avatar']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/avatar/tmp/';
$config['avatar']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['avatar']['max_size'] = '10240';
$config['avatar']['min_width']  = '120';
$config['avatar']['min_height']  = '120';
$config['avatar']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,99999)).'.jpg';
$config['avatar']['thumb_size_1_x'] = "200";
$config['avatar']['thumb_size_1_y'] = "200";
$config['avatar']['thumb_size_2_x'] ="130";
$config['avatar']['thumb_size_2_y'] ="130";
$config['avatar']['thumb_size_3_x']="50";
$config['avatar']['thumb_size_3_y']="50";
$config['avatar']['count']="10000";
$config['avatar']['true_path']= $_SERVER['DOCUMENT_ROOT'].'/uploads/avatar/';
$config['avatar']['relative_path']= '/uploads/avatar/';
$config['avatar']['overwrite']  = true;

//经销商wap站背景图片
$config['serviceLogo']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/wap_template/';
$config['serviceLogo']['relative_upload']= '/uploads/service/wap_template/';
$config['serviceLogo']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['serviceLogo']['max_size'] = '51200';
$config['serviceLogo']['min_width']  = '800';
$config['serviceLogo']['min_height']  = '1000';
$config['serviceLogo']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';
