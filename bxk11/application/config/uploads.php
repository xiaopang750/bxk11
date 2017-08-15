<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *上传功能相关配置信息,可根据不同需求配置不同数组信息
 */

/**
 *头像上传配置信息
 */

//灵感博文日期目录名
$time = time();
$datedir = date("Y",$time).'/'.date("m",$time).'/'.date("d",$time).'/';
$config['timedir']['year'] = date('Y');
$config['timedir']['month'] = date('m');
$config['timedir']['day'] = date('d');

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
/**
 *灵感博文上传配置信息
 */
$config['design']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/blog/source/'.$datedir;
$config['design']['timedir'] = $datedir;
$config['design']['time'] = $time;
$config['design']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['design']['max_size'] = '10240';
$config['design']['min_width']  = '700';
$config['design']['min_height']  = '300';
$config['design']['overwrite']  = true;
$config['design']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999));
/**
 *灵感图片存放裁剪配置信息
 */
$config['blog']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/blog/thumb_1/'.$datedir;
$config['blog']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/blog/thumb_2/'.$datedir;
$config['blog']['thumb_3'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/blog/thumb_3/'.$datedir;
$config['blog']['thumb_4'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/blog/thumb_4/'.$datedir;
$config['blog']['thumb_size_1_x'] = "687";
$config['blog']['thumb_size_1_y'] = "";
$config['blog']['thumb_size_2_x'] ="264";
$config['blog']['thumb_size_2_y'] ="196";
$config['blog']['thumb_size_3_x']="264";
$config['blog']['thumb_size_3_y']="";
$config['blog']['thumb_size_4_x']="100";
$config['blog']['thumb_size_4_y']="100";
$config['blog']['relative_path']= '/uploads/blog/';
$config['blog']['default_1'] = '/uploads/blog/default/thumb_1.jpg';
$config['blog']['default_2'] = '/uploads/blog/default/thumb_2.jpg';
$config['blog']['default_3'] = '/uploads/blog/default/thumb_3.jpg';
$config['blog']['default_4'] = '/uploads/blog/default/thumb_4.jpg';

/**
 *主题上传配置信息
 */
$config['theme']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/theme/source/';
$config['theme']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['theme']['max_size'] = '10240';
$config['theme']['min_width']  = '851';
$config['theme']['min_height']  = '312';
$config['theme']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';

/**
 *主题图片存放裁剪配置信息
 */
$config['theme']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/theme/thumb_1/';
$config['theme']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/theme/thumb_2/';
$config['theme']['thumb_3'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/theme/thumb_3/';
$config['theme']['thumb_size_1_x']="229";
$config['theme']['thumb_size_1_y']="300";
$config['theme']['thumb_size_2_x']="242";
$config['theme']['thumb_size_2_y']="242";
$config['theme']['thumb_size_3_x']="1000";
$config['theme']['thumb_size_3_y']="333";
$config['theme']['relative_path']= '/uploads/theme/';
$config['theme']['default_1'] = '/uploads/theme/default/thumb_1.jpg';
$config['theme']['default_2'] = '/uploads/theme/default/thumb_2.jpg';
$config['theme']['default_3'] = '/uploads/theme/default/thumb_3.jpg';
$config['theme']['overwrite']  = true;


/**
 *装修问题存放裁剪配置信息
 */
//$config['question']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/question/source/';
//$config['question']['siteDomain'] = "http://{$_SERVER['HTTP_HOST']}/uploads/question/source/";
//$config['question']['allowed_types'] = 'gif|jpg|jpeg|png';
//$config['question']['max_size'] = '10240';
//$config['question']['min_width']  = '350';
//$config['question']['min_height']  = '200';
//$config['question']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999));
//$config['question']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/question/thumb_1/';
//$config['question']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/question/thumb_2/';
//$config['question']['thumb_size_1_x']="1000";
//$config['question']['thumb_size_1_y']="";
//$config['question']['thumb_size_2_x']="350";
//$config['question']['thumb_size_2_y']="";
//$config['question']['relative_path']= '/uploads/question/';
//$config['question']['default_1'] = '/uploads/question/default/thumb_1.jpg';
//$config['question']['default_2'] = '/uploads/question/default/thumb_2.jpg';

/**
 *设计灵感批量上传配置信息
 */
$config['upload_file']['source_url'] = $_SERVER['DOCUMENT_ROOT'].'/uplist/pictures/';
$config['upload_file']['ext_arr'] = 'xls|xlsm|xlsx';
$config['upload_file']['max_size'] = 2*1024*1024;
$config['upload_file']['url']  = './application';
$config['upload_file']['save_url']  = './uploads/phpexcel/';
$config['upload_file']['error_url'] = "./application/errors/error_phpexcel.txt";
$config['upload_file']['rs_url'] = "./application/errors/error_rs.txt";//批量生成样板间和案例
$config['upload_file']['count'] = 2;
$config['upload_file']['prname'] = 'jia178';
$config['upload_file']['tdescripttion'] = '欢迎加入jia718';
$config['upload_file']['themes'] = 'jia718';

$config['upload_file']['user_company'] = 'jia718机构';

$config['upload_file']['rzpeizhi'] = '装饰元素';
$config['upload_file']['rzpeizhichil'] = '皮革';
$config['upload_file']['style'] = '装修风格';
$config['upload_file']['stylechil'] = '现代简约';
$config['upload_file']['color'] = '色彩搭配';
$config['upload_file']['colorchil'] = '蓝色';
$config['upload_file']['hometype'] = '户型';
$config['upload_file']['hometypechil'] = '一居室';
$config['upload_file']['jubu'] = '局部';
$config['upload_file']['jubu_arr'] = array( 
	"背景墙",
	"玄关",
	"衣帽架",
	"楼梯",
	"露台",
	"吧台",
	"鞋柜",
	"飘窗");
$config['upload_file']['gn'] = '功能';
$config['upload_file']['gn_arr'] = array( 
	"卧室",
	"老人房",
	"儿童房",
	"书房",
	"餐厅",
	"门厅",
	"会客室",
	"影音室",
	"保姆间",
	"化妆间",
	"花园房",
	"厨房",
	"卫浴室",
	"庭院",
	"其他");
/**
 * 推荐案例标签主分类的关键字来查询推荐的标签数组
 */
$config['recommend']['tag'] = '房间功能,设计风格';


/**
 * 标签分类上传配置信息
 */
$config['importtt']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/phpexcel/';
$config['importtt']['allowed_types'] = 'json|txt';
$config['importtt']['max_size'] = '10240';
$config['importtt']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.txt';

/**
 *  上传产品默认配制
 */
$config['upload_product']['source_url'] = $_SERVER['DOCUMENT_ROOT'].'/uplist/product/';
$config['upload_product']['error_url'] = "./application/errors/error_product.txt";

/**
 *  上传资讯默认配制
 */
$config['upload_information']['source_url'] = $_SERVER['DOCUMENT_ROOT'].'/uplist/information/';
$config['upload_information']['error_url'] = "./application/errors/error_product.txt";
$config['upload_information']['min_width'] = "630";
$config['upload_information']['min_height'] = "420";






/**
 *楼盘户型上传配置信息
 */
$config['apartment']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/apartment/';
$config['apartment']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['apartment']['max_size'] = '10240';
$config['apartment']['min_width']  = '160';
$config['apartment']['min_height']  = '160';
$config['apartment']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999));
$config['apartment']['overwrite']  = true;
/**
 *楼盘户型图片存放裁剪配置信息
 */
$config['apartment']['source'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/apartment/source/'; //原图 
$config['apartment']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/apartment/thumb_1/';
$config['apartment']['thumb_size_1_x'] = "200";
$config['apartment']['thumb_size_1_y'] = "";
$config['apartment']['relative_path']= '/uploads/apartment/';
$config['apartment']['default_1'] = '/uploads/apartment/default/thumb_1.jpg';



/**
 *平面布置图上传配置信息
 */
$config['floor_pic1']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/floor/';
$config['floor_pic1']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['floor_pic1']['max_size'] = '10240';
$config['floor_pic1']['min_width']  = '270';
$config['floor_pic1']['min_height']  = '370';
$config['floor_pic1']['file_name'] = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';
$config['floor_pic1']['overwrite']  = true;
/**
 *平面布置图片存放裁剪配置信息
 */
$config['floor_pic1']['pic1_1'] = 'pic1_1.jpg';
$config['floor_pic1']['pic1_2'] = 'pic1_2.jpg';
$config['floor_pic1']['pic1_source']  = 'pic1_source.jpg';
$config['floor_pic1']['pic1_copy']  = 'pic1_copy.jpg';
$config['floor_pic1']['pic1_temp'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/temp/floor/';
$config['floor_pic1']['thumb_size_1_x'] = "270";
$config['floor_pic1']['thumb_size_1_y'] = "370";
$config['floor_pic1']['thumb_size_2_x'] = "405";
$config['floor_pic1']['thumb_size_2_y'] = "555";
$config['floor_pic1']['thumb_size_temp_x'] = "500";//旋转返回用
$config['floor_pic1']['thumb_size_temp_y'] = "";//旋转返回用
$config['floor_pic1']['relative_path']= '/uploads/scheme/';
$config['floor_pic1']['temp_path']= '/uploads/temp/floor/';
$config['floor_pic1']['default_pic1_1'] = '/uploads/scheme/default/pic1_1.jpg';
$config['floor_pic1']['default_pic1_2'] = '/uploads/scheme/default/pic1_2.jpg';


/**
 *房间平面图片上传配置信息
 */
$config['room_2d']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/room/source/';
$config['room_2d']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['room_2d']['max_size'] = '10240';
$config['room_2d']['min_width']  = '500';
$config['room_2d']['min_height']  = '400';
$config['room_2d']['overwrite']  = true;
$config['room_2d']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999));
/**
 *房间场景图片存放裁剪配置信息
 */
$config['room_2d']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_1/';
$config['room_2d']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_2/';
$config['room_2d']['thumb_3'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_3/';
$config['room_2d']['thumb_4'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_4/';
$config['room_2d']['thumb_5'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/room/thumb_5/';
$config['room_2d']['thumb_size_1_x'] = "1920";
$config['room_2d']['thumb_size_1_y'] = "1280";
$config['room_2d']['thumb_size_2_x'] ="710";
$config['room_2d']['thumb_size_2_y'] ="500";
$config['room_2d']['thumb_size_3_x']="470";
$config['room_2d']['thumb_size_3_y']="276";
$config['room_2d']['thumb_size_4_x']="112";
$config['room_2d']['thumb_size_4_y']="75";
$config['room_2d']['thumb_size_5_x']="291";
$config['room_2d']['thumb_size_5_y']="172";
$config['room_2d']['relative_path']= '/uploads/room/';
$config['room_2d']['default_1'] = '/uploads/room/default/thumb_1.jpg';
$config['room_2d']['default_2'] = '/uploads/room/default/thumb_2.jpg';
$config['room_2d']['default_3'] = '/uploads/room/default/thumb_3.jpg';
$config['room_2d']['default_4'] = '/uploads/room/default/thumb_4.jpg';
$config['room_2d']['default_5'] = '/uploads/room/default/thumb_5.jpg';

/**
 *房间场景图片上传配置信息
 */
$config['room_3d']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/room/';
$config['room_3d']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['room_3d']['max_size'] = '10240';
$config['room_3d']['min_width']  = '1000';
$config['room_3d']['max_width']  = '5000';
$config['room_3d']['thumb_height']  = '96';//缩略图
$config['room_3d']['thumb_width']  = '96';//缩略图
$config['room_3d']['thumb_name']  = 'thumb.jpg';//缩略图
$config['room_3d']['thumb_white']  = '3';//缩略图白边大小
$config['room_3d']['long_name']  = 'long.jpg';
$config['room_3d']['xml_name']  = 'room';
$config['room_3d']['big_thumb']  = 'big_thumb.jpg';//大图缩略
$config['room_3d']['big_thumb_width']  = '760';//大图缩略
$config['room_3d']['big_thumb_height']  = '500';//大图缩略
$config['room_3d']['rectangle_thumb']  = 'rectangle_thumb.jpg';//矩形图
$config['room_3d']['rectangle_thumb_width']  = '467';
$config['room_3d']['rectangle_thumb_height']  = '231';
$config['room_3d']['recommend_name']  = 'recommend_thumb.jpg';//矩形图
$config['room_3d']['recommend_width']  = '760';
$config['room_3d']['recommend_height']  = '500';
$config['room_3d']['relative_path'] = '/uploads/room/default/';
$config['room_3d']['js3d_width'] = '512';
$config['room_3d']['js3d_height'] = '512';
$config['room_3d']['js3dthumb_name'] = 'jsthumb.jpg';
$config['room_3d']['js3dthumb_width'] = '450';
$config['room_3d']['js3dthumb_height'] = '220';

//这个是方案设置
$config['room_3d']['room_xml_name']  = 'room';
$config['room_3d']['preview_name']  = 'preview.jpg';
$config['room_3d']['recommend_xml_name']  = 'recommend';
$config['room_3d']['preview_width']  = '768';
$config['room_3d']['preview_height']  = '128';
$config['room_3d']['overwrite']  = true;
$config['room_3d']['pic1_2']  ="pic1_2.jpg";
$config['room_3d']['pic1_1']  ="pic1_1.jpg";

//diy设置
$config['room_3d']['diy_xml_name']  = 'diy';
//编辑xml
$config['room_3d']['edit_xml_name']  = 'edit';
/**
 *房间场景图片正则匹配名称配置信息
 */
$config['room_3d_name'][] = "BK";
$config['room_3d_name'][] = "DN";
$config['room_3d_name'][] = "FR";
$config['room_3d_name'][] = "LF";
$config['room_3d_name'][] = "RT";
$config['room_3d_name'][] = "UP";

/**
 *房间场景图片正则修改名称配置信息，flash插件bug要求前后名称对调
 */
$config['room_3d_rname']["UP"] = "u.jpg";
$config['room_3d_rname']["DN"] = "d.jpg";
$config['room_3d_rname']['LF'] = "l.jpg";
$config['room_3d_rname']["RT"] = "r.jpg";
$config['room_3d_rname']["BK"] = "f.jpg";
$config['room_3d_rname']["FR"] = "b.jpg";

/**
 *灵感博文上传配置信息
 */
$config['product']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/product/source/';
$config['product']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['product']['max_size'] = '10240';
$config['product']['min_width']  = '100';
$config['product']['min_height']  = '100';
$config['product']['overwrite']  = true;
$config['product']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).".jpg";
/**
 *产品图片裁剪配置信息
 */
$config['product']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/product/thumb_1/';
$config['product']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/product/thumb_2/';
$config['product']['thumb_3'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/product/thumb_3/';
$config['product']['index'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/product/index/';
$config['product']['thumb_size_1_x'] = "569";
$config['product']['thumb_size_1_y'] = "376";
$config['product']['thumb_size_2_x'] ="292";
$config['product']['thumb_size_2_y'] ="193";
$config['product']['thumb_size_3_x']="100";
$config['product']['thumb_size_3_y']="100";
$config['product']['thumb_size_index_x']="265";
$config['product']['thumb_size_index_y']="265";
$config['product']['relative_path']= '/uploads/product/';
$config['product']['default_1'] = '/uploads/product/default/thumb_1.jpg';
$config['product']['default_2'] = '/uploads/product/default/thumb_2.jpg';
$config['product']['default_3'] = '/uploads/product/default/thumb_3.jpg';
$config['product']['default_index'] = '/uploads/product/default/index.jpg';

/**
 * 经销商证件配制信息（后台）liuguangping
 **/
$config['service']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/info/source/';
$config['service']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['service']['relative_path']= '/uploads/service/info/';
$config['service']['max_size'] = '10240';
$config['service']['min_width'] = '100';
$config['service']['min_height'] = '100';

/**
 * 经销商模块图标配制信息（后台）liuguangping
 **/
$config['service_module']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/modules/source/';
$config['service_module']['allowed_types'] = 'jpg';
$config['service_module']['max_size'] = '10240';
$config['service_module']['max_width'] = '1024';
$config['service_module']['max_height'] = '768';

/**
 * 门店认证图标配制信息（后台）liuguangping
 **/
$config['service_license']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/shop/source/';
$config['service_license']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['service_license']['max_size'] = '10240';
$config['service_license']['min_width'] = '100';
$config['service_license']['min_height'] = '100';
$config['service_license']['relative_path']= '/uploads/service/shop/';

/**
 * 员工照片配制信息（后台）liuguangping
 **/
$config['service_user']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/user/source/';
$config['service_user']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['service_user']['max_size'] = '10240';
$config['service_user']['min_width'] = '100';
$config['service_user']['min_height'] = '100';
$config['service_user']['relative_path']= '/uploads/service/user/';

/**
 * 经销商品颜色贴面配制信息（后台）liuguangping
 **/
$config['service_color']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/color/source/';
$config['service_color']['allowed_types'] = 'jpg|jpeg';
$config['service_color']['overwrite'] = true;
$config['service_color']['max_size'] = '10240';
$config['service_color']['min_width'] = '900';
$config['service_color']['min_height'] = '600';

$config['service_color']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/color/thumb_1/';
$config['service_color']['thumb_size_1_x'] = "80";
$config['service_color']['thumb_size_1_y'] = "80";

$config['service_color']['relative_path']= '/uploads/service/goods/color/';
$config['service_color']['default_1'] = '/uploads/service/goods/color/default/thumb_1.jpg';



/**
 * 经销商品缩略图配制信息（后台）liuguangping
 **/
$config['service_ProductPic']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/pic/source/';
$config['service_ProductPic']['max_size'] = '10240';
$config['service_ProductPic']['min_width'] = '900';
$config['service_ProductPic']['min_height'] = '600';
$config['service_ProductPic']['allowed_types'] = 'jpg|jpeg';

$config['service_ProductPic']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/goods/pic/thumb_1/';
$config['service_ProductPic']['thumb_size_1_x'] = "120";
$config['service_ProductPic']['thumb_size_1_y'] = "120";
$config['service_ProductPic']['relative_path']= '/uploads/service/goods/pic/';
$config['service_ProductPic']['default_1'] = '/uploads/service/goods/default/pic/thumb_1.jpg';

/**
 * 系统品牌图标 liuguangping
 **/
$config['brand']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/source/';
$config['brand']['allowed_types'] = 'jpg|jpeg';
$config['brand']['max_size'] = '10240';
$config['brand']['min_width']  = '300';
$config['brand']['min_height']  = '100';
$config['brand']['overwrite']  = true;
$config['brand']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).".jpg";
/**
 *系统品牌裁剪配置信息
 */
$config['brand']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/thumb_1/';
$config['brand']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/thumb_2/';
$config['brand']['thumb_3'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/brand/thumb_3/';
$config['brand']['thumb_size_1_x'] = "569";
$config['brand']['thumb_size_1_y'] = "376";
$config['brand']['thumb_size_2_x'] = "292";
$config['brand']['thumb_size_2_y'] = "193";
$config['brand']['thumb_size_3_x']= "100";
$config['brand']['thumb_size_3_y']= "100";
$config['brand']['relative_path']= '/uploads/brand/';
$config['brand']['default_1'] = '/uploads/brand/default/thumb_1.jpg';
$config['brand']['default_2'] = '/uploads/brand/default/thumb_2.jpg';
$config['brand']['default_3'] = '/uploads/brand/default/thumb_3.jpg';

/**
 * 系统系列图标 liuguangping
 **/
$config['series']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/series/source/';
$config['series']['allowed_types'] = 'jpg|jpeg|gif|png';
$config['series']['max_size'] = '10240';
$config['series']['min_width']  = '900';
$config['series']['min_height']  = '600';
$config['series']['overwrite']  = true;
$config['series']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).".jpg";
/**
 *系统系列裁剪配置信息
 */
$config['series']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/series/thumb_1/';
$config['series']['thumb_size_1_x'] = "480";
$config['series']['thumb_size_1_y'] = "320";
$config['series']['relative_path']= '/uploads/series/';
$config['series']['default_1'] = '/uploads/series/default/thumb_1.jpg';

/**
 * 经销商品缩略图配制信息（后台）liuguangping
 **/
$config['service_WeixinMenu']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/weixin/source/';
$config['service_WeixinMenu']['max_size'] = '10240';
$config['service_WeixinMenu']['min_width'] = '420';
$config['service_WeixinMenu']['min_height'] = '230';
$config['service_WeixinMenu']['allowed_types'] = 'jpg|jpeg';

$config['service_WeixinMenu']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/weixin/thumb_1/';
$config['service_WeixinMenu']['thumb_size_1_x'] = "360";
$config['service_WeixinMenu']['thumb_size_1_y'] = "200";
$config['service_WeixinMenu']['relative_path']= '/uploads/service/weixin/';
$config['service_WeixinMenu']['default_1'] = '/uploads/service/weixin/default/thumb_1.jpg';


/**
 * 系统资讯（后台） liuguangping
 **/
$config['service_InforMation']['upload_path'] =$_SERVER['DOCUMENT_ROOT'].'/uploads/service/information/source/';
$config['service_InforMation']['max_size'] = '10240';
$config['service_InforMation']['min_width'] = '630';
$config['service_InforMation']['min_height'] = '420';
$config['service_InforMation']['allowed_types'] = 'jpg|jpeg';

$config['service_InforMation']['thumb_1'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/information/thumb_1/';
$config['service_InforMation']['thumb_2'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/service/information/thumb_2/';
$config['service_InforMation']['thumb_size_1_x'] = "63";
$config['service_InforMation']['thumb_size_1_y'] = "63";
$config['service_InforMation']['thumb_size_2_x'] = "630";
$config['service_InforMation']['thumb_size_2_y'] = "420";
$config['service_InforMation']['relative_path']= '/uploads/service/information/';
$config['service_InforMation']['default_1'] = '/uploads/service/information/default/thumb_1.jpg';
$config['service_InforMation']['default_2'] = '/uploads/service/information/default/thumb_2.jpg';


//全站广告推荐位图片
$config['system_ad']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/ad/';
$config['system_ad']['relative_upload']= '/uploads/ad/';
$config['system_ad']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['system_ad']['file_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';
