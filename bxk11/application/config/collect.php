<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
*能采集网站的地址
*/
$config['url']['deco.rayli.com.cn'] = 'domain1';
$config['url']['www.id-china.com.cn']  = 'domain1';
$config['url']['mixinfo.id-china.com.cn']  = 'domain1';
$config['url']['sns.id-china.com.cn']  = 'domain1';

$config['url']['dapei.pchouse.com.cn'] = 'domain2';
$config['url']['sheji.pchouse.com.cn'] = 'domain2';
$config['url']['zhuangxiu.pchouse.com.cn'] = 'domain2';
$config['url']['zt.pchouse.com.cn'] = 'domain2';
$config['url']['jiaju.pchouse.com.cn'] = 'domain2';
$config['url']['fengshui.pchouse.com.cn'] = 'domain2';
$config['url']['tuliao.pchouse.com.cn'] = 'domain2';
$config['url']['news.pchouse.com.cn'] = 'domain2';
$config['url']['www.pchouse.com.cn'] = 'domain2';
$config['url']['jiadian.pchouse.com.cn'] = 'domain2';
$config['url']['cizhuan.pchouse.com.cn'] = 'domain2';
$config['url']['weiyu.pchouse.com.cn'] = 'domain2';
$config['url']['diban.pchouse.com.cn'] = 'domain2';
$config['url']['maichang.pchouse.com.cn'] = 'domain2';
$config['url']['sh.pchouse.com.cn'] = 'domain2';
$config['url']['bj.pchouse.com.cn'] = 'domain2';
$config['url']['gz.pchouse.com.cn'] = 'domain2';
$config['url']['zhanhui.pchouse.com.cn'] = 'domain2';
$config['url']['life.pchouse.com.cn'] = 'domain2';

$config['url']['zhuanghuang.topdw.com'] = 'domain3';
$config['url']['ruanzhuang.topdw.com'] = 'domain4';
$config['url']['www.cnmd.net'] = 'domain5';

$config['url']['www.zcool.com.cn'] = 'domain6';
$config['url']['www.baicha.me'] = 'domain6';

$config['url']['zixun.jia.com'] = 'domain7';
$config['url']['www.adstyle.com.cn'] = 'domain7';

$config['url']['home.ifeng.com'] = 'domain8';


/**
 * 配置采集的路径、名称
 */
$config['coll']['siteDomain'] = "http://{$_SERVER['HTTP_HOST']}/uploads/collect/source/";
$config['coll']['path'] = $_SERVER['DOCUMENT_ROOT'].'/uploads/collect/source/';
$config['coll']['img_name']  = md5(date('Y-m-d-h-i-s',time())."-".rand(999,999999)).'.jpg';

?>