<?php
session_start();
//unset($_SESSION['islogin']);exit;
$login = isset($_SESSION['islogin'])?'true':'false';
if($login=='false'){
	$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx5da2cd9b64bfc966&redirect_uri=http://aiqisong.azzsh.com/yanyalong/auth2test.php&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
	header("Location: $url"); 
}else{
echo 1234323;exit;
}
