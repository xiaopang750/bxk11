<?php
/**
 * liuguanging
 */
//全局配制文件

//新浪配制
$config['sina']['WB_AKEY'] = '3601327105';
$config['sina']['WB_SKEY'] = 'df7f832df70c8340db4a6cd6a1bdc002';
$config['sina']['WB_CALLBACK_URL'] = "http://".$_SERVER['HTTP_HOST'].'/lgwx/index.php/sns/sina/authorize';
$config['sina']['LOGIN_TYPE'] = 2;

//qq互联
$config['qzone']['appid'] = "100546707";
$config['qzone']['appkey']="52a64486521346dfad6562b48951c0b0";
$config['qzone']['callback']="http://".$_SERVER['HTTP_HOST']."/lgwx/index.php/sns/qzone/authorize";
$config['qzone']['scope']="get_user_info";
$config['qzone']['errorReport'] =true;
$config['qzone']['storageType'] ="file";
$config['qzone']['host'] ="localhost";
$config['qzone']['user'] ="root";
$config['qzone']['password'] ="root";
$config['qzone']["database"]="test";
$config['qzone']['login_type'] = 1;

//QQweibo
$config['qqweibo']['QW_CLIENT_ID'] = '801516977';
$config['qqweibo']['QW_CLIENT_SECRET'] = '05974cd917561aae194854f29f3bbb12';
$config['qqweibo']['QW_CALLBACK_URL'] = "http://".$_SERVER['HTTP_HOST'].'/lgwx/index.php/sns/qqweibo/authorize';
$config['qqweibo']['QW_DEBUG'] = false;
$config['qqweibo']['LOGIN_TYPE'] = 4;

//weixin
$config['weixin']['appid'] = 'wxfb7841668b68edb2';
$config['weixin']['secret'] = 'ace9b837fd7bb0fa1e96099718c8abc1';
$config['weixin']['redirect_uri_snsapi_userinfo'] = "http://".$_SERVER['HTTP_HOST'].'/lgwx/index.php/sns/weixin/authorize';
$config['weixin']['redirect_uri_snsapi_base'] = "http://".$_SERVER['HTTP_HOST'].'/lgwx/index.php/sns/weixin/authorize_base';
$config['weixin']['debug'] = false;
$config['weixin']['login_type'] = 3;

//renren
$config['renren']['app_key'] = '39ac040cde504306bc5d8b772e28f3d1'; //RenRen网的API调用地址，不需要修改
$config['renren']['app_secret'] = 'c1cff17e2a9146c5aa3c9a0a3a60a8a2';
//$config['renren']['callback_url'] = "http://fw.athenawyc.com/lgwx/index.php/sns/renren/authorize";
$config['renren']['callback_url'] = "http://".$_SERVER['HTTP_HOST']."/lgwx/index.php/sns/renren/authorize";
$config['renren']['debug'] = false;
$config['renren']['login_type'] = 5;

