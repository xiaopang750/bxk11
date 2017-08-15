<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("content-type:text/html;charset=utf-8"); 
/**
 *  指定采集的网站的详细内容页面内容
 *  采集文章的‘标题’，‘内容’ 到 $data 数组中
 */
class Domain1 {	
	public function show($url,$getUrl){
		include_once("./application/libraries/collect/Collects.php");
		// 文件路径
		$filepath = $config['coll']['path'];
		// 获取目标地址html
		$str = curl_file_get_contents($getUrl);
		// 正则匹配规则 
		if('deco.rayli.com.cn' == $url){
			preg_match('%<div class="w645 txtCenter">.*</div>%',$str,$outstr);
			preg_match('#<div class="titlexia f14 lh25">.*</div>#isU',$str,$outstr1);
			preg_match('#<div class="clear clean">.*<p class="txtRright f12">#isU',$str,$outstr2);
			$outstr = character($outstr);
			$outstr1 = character($outstr1);
			$outstr2 = character($outstr2);
			if(empty($outstr))
			{}else
			{
				$outstr2[0] = $outstr1[0].$outstr2[0];
			}	
		}else if('mixinfo.id-china.com.cn' == $url)
		{
			preg_match('#<h1 class="title_art">.*</h1>#isU',$str,$outstr);
			preg_match('#<div id=\"content-context\">.*<!--<div class="ad_468">#isU',$str,$outstr2);
		}else if ('sns.id-china.com.cn' == $url) {
			preg_match('#<div id="sns_alxx_l">.*</h4>#isU',$str,$outstr);
			preg_match('#<div id="sns_alxx_xxnr">.*<div class="sns_alxx_xx">#isU',$str,$outstr2);
		}
		// 调用Collects.php中的main_show() 方法
		$data = main_show($outstr,$outstr2,$str,$filepath,$url,$getUrl);
		return $data;	
	}
}
?>