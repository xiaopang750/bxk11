<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:全局url指向配置信息
 *author:yanyalong
 *date:2013/09/09
 */
//个人空间地址
$config['url']['userspace'] = '/index.php/user/index?uid=';
//灵感详情页地址

$config['url']['contenturl'] = '/index.php/content/designinfo?cid=';
//灵感标签判断中转地址


//分类精选聚合页地址
$config['url']['tagurl'] = '/index.php/tag/index?type=';

//分类聚合页标签地址传值
$config['url']['tagpara'] = '&tag=';

//发布设计方案
$config['url']['addscheme'] = "/index.php/scheme/addscheme?pid=";

//样本间预览并生成地址
$config['url']['preview3d'] = "/index.php/room/preview?rid=";

//样本间预览
$config['url']['previewShow3d'] = "/index.php/room/previewShow?rid=";

//案例查看预览地址
$config['url']['xml3d'] = "/index.php/room/xml3dShow?sid=";

//3d案例首页推荐预览地址
$config['url']['xml3drecommend'] = "/index.php/room/xml3dRecommend?sid=";

//DIY案例查看预览并生成地址
$config['url']['xml3ddiy'] = "/index.php/room/xml3Ddiy?sid=";

//DIY案例预览地址
$config['url']['xml3ddiyshow'] = "/index.php/room/xml3DdiyShow?sid=";

//案例详情页
$config['url']['schemeinfo'] = "/index.php/scheme/info?sid=";

//样板间详情页
$config['url']['roominfo'] = "/index.php/room/info?rid=";

//案例搜索页
$config['url']['schemesearch'] = "/index.php/scheme/search?";

//样板间搜索页
$config['url']['roomsearch'] = "/index.php/room/search?";

//样板间搜索页
$config['url']['sendmsg'] = "/index.php/user/sendmsg/";

//产品详情页
$config['url']['productinfo'] = '/index.php/product/info?pid=';


////装修问详情页地址
//$config['url']['questionurl'] = '/index.php/qa/questioninfo?qid=';

////全局物理地址
//$config['url']['static_url'] = $_SERVER['DOCUMENT_ROOT'].'/application/';

////顶部综合搜索地址
//$config['url']['top_search'] = "/index.php/search/index?wd=";

//灵感辑列表页
$config['album']['list'] = '/view/user/album_list';





