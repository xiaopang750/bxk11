<?php
    echo 123;exit;
header('Content-Type: text/html; charset=UTF-8');
require_once("../../API/qqConnectAPI.php");
$qc = new QC();
    echo "<pre>";var_dump($qc);exit;
//echo $qc->qq_callback();
//echo $qc->get_openid();
$userinfo = $qc->get_user_info();
	echo "<pre>";var_dump($userinfo);exit;
