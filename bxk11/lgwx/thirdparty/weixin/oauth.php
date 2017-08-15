<?php 
define('BASEPATH', str_replace("\\", "/",'system'));
session_start();
header("Content-type: text/html; charset=utf-8");
$currentUrlarr = explode('currentUrl=',$_SERVER['PHP_SELF']);
$currentUrl = $currentUrlarr['1'];
include_once $_SERVER['DOCUMENT_ROOT']."/lgwx/application/libraries/wechat.class.php";
include_once $_SERVER['DOCUMENT_ROOT']."/lgwx/application/config/thirdParty.php";
include_once $_SERVER['DOCUMENT_ROOT']."/lgwx/application/config/database.php";
$weixinWapConfig = $config['weixin'];
$options = array(
	'token' => $weixinWapConfig['token'],
	'appid' => $weixinWapConfig['appid'],
	'appsecret' => $weixinWapConfig['appsecret']
);
$weObj = new Wechat($options);
$res = $weObj->getOauthAccessToken();
//若未授权，则根据openid无法获得weobjUserinfo，若已授权，则允许获得相关数据
$weobjUserinfo= $weObj->getOauthUserinfo($res['access_token'],$res['openid']);
$callbackUrl = $weixinWapConfig['callbackUrl'];
$baseUrl = $weixinWapConfig['baseUrl'];

//未授权
if($weobjUserinfo==false){
    $_SESSION['urlflag'] = true;
	$url = $weObj->getOauthRedirectExtend($baseUrl.$callbackUrl."currentUrl=".$currentUrl,'','snsapi_userinfo');
	header("Location: $url"); exit;
	//已授权
}else{
	$weObj->getOauthRefreshToken($res['refresh_token']);
	$DbConfig = $db['default'];
	$con = mysql_connect("$DbConfig[hostname]","$DbConfig[username]","$DbConfig[password]");
	mysql_query("SET NAMES UTF8");
	mysql_select_db($DbConfig['database'],$con);
	$query = mysql_query("select * from t_user_info where user_weixinid='$res[openid]'");
	$userinfo = mysql_fetch_object($query);
	if($userinfo==false){
		mysql_query("insert into t_user (user_nickname,group_id) values('$weobjUserinfo[nickname]',1)");
		$user_id = mysql_insert_id();
		mysql_query("insert into t_user_info (user_id,user_weixinid,user_noticeoptions,user_mailoptions) values($user_id,'$weobjUserinfo[openid]','1,1,1,1,1','1,1')");
    }else{
        $user_id = $userinfo->user_id; 
    }
    $_paraArr = explode(',',$_REQUEST['para']);
    $paraurl = "";
    foreach ($_paraArr as $key=>$val) {
        $paraArr = explode('/',$val);
        if($key==0){
            $paraurl .= "?".$paraArr['0']."=".$paraArr['1'];
        }else{
            $paraurl .= "&".$paraArr['0']."=".$paraArr['1'];
        }
    }
   $url = $baseUrl.$currentUrl.$paraurl."&openid=".$weobjUserinfo['openid'];
    $_SESSION['user_id'] = $user_id;
	header("Location:$url"); exit;
}

