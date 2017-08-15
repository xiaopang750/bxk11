<?php
/**
 * liuguanging
 */
//全局3D样板间配制文件
$config['xml']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/threed/global/';
$config['xml']['relative_path']= '/threed/global/';
$config['xml']['global_xml'] = 'global';
$config['xml']['preview_xml'] = 'preview';
$config['xml']['diy_xml'] = 'diyxml';
$config['xml']['recommend_xml'] = 'rerecommendxml';
$config['xml']['edit_xml'] = 'editor';


//全景音乐
$config['bgsound']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/threed/global/';
$config['bgsound']['relative_path']= '/threed/global/';
$config['bgsound']['allowed_types'] = 'mp3';
$config['bgsound']['overwrite'] = TRUE;
$config['bgsound']['max_size'] = 5*1024*1024;
$config['bgsound']['file_name']  = 'bgsound';

//全景索引图
$config['thumb']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/threed/global/';
$config['thumb']['relative_path']= '/threed/global/';
$config['thumb']['swf_path']= '/threed/plugins/';

$config['thumb']['allowed_types'] = 'png';
$config['thumb']['overwrite'] = TRUE;
$config['thumb']['max_size'] = 2*1024*1024;
$config['thumb']['thumb_name'] = 'thumb';

//全景地图热点
$config['map']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/threed/global/';
$config['map']['relative_path']= '/threed/global/';
$config['map']['swfplugins_path'] = $_SERVER['DOCUMENT_ROOT'].'/threed/plugins/';
$config['map']['swf_path']= '/threed/plugins/';
$config['map']['allowed_types'] = 'jpg|png|gif|swf';
$config['map']['overwrite'] = TRUE;
$config['map']['max_size'] = 2*1024*1024;
$config['map']['localmap_name'] = 'localmap';
$config['map']['baidumap_name'] = 'baidumap';
$config['map']['localmap_name_bak'] = 'localmapbak';

//复制地图地址
$config['map_copy']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/threed/plugins-copy/';
$config['map_copy']['relative_path']= '/threed/plugins-copy/';
$config['map_copy']['swf_path']= '/threed/plugins-copy/';
$config['map_copy']['allowed_types'] = 'jpg|png|gif|swf';
$config['map_copy']['overwrite'] = TRUE;
$config['map_copy']['max_size'] = 2*1024*1024;
$config['map_copy']['localmap_name'] = 'localmap';
$config['map_copy']['baidumap_name'] = 'baidumap';
$config['map_copy']['localmap_name_bak'] = 'localmapbak';

//控制面板
$config['control']['swf_path']= '/threed/_controls/';

//界面元素
$config['face']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/threed/global/';
$config['face']['relative_path']= '/threed/global/';
$config['face']['allowed_types'] = 'jpg|png|gif';
$config['face']['overwrite'] = TRUE;
$config['face']['max_size'] = 5*1024*1024;
$config['face']['file_name']  = 'face';

//热点设置

$config['hotspot']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/threed/_controls/1/';
$config['hotspot']['relative_path']= '/threed/_controls/1/';
$config['hotspot']['allowed_types'] = 'jpg|png|gif|swf';
$config['hotspot']['overwrite'] = TRUE;
$config['hotspot']['max_size'] = 5*1024*1024;
$config['hotspot']['file_name']  = 'info';
$config['hotspot']['url_hotspot']  = 'http://www.jia178.com';


