<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("content-type:text/html;charset=utf-8"); 
/**
 *  指定采集的网站的详细内容页面内容
 *  采集文章的‘标题’，‘内容’ 到 $data 数组中
 */
class Domain3 {	
	public function show($url,$getUrl){
		include_once("./application/libraries/collect/Collects.php");
		// 文件路径
		$filepath = $config['coll']['path'];
		// 获取目标地址html
		$str = curl_file_get_contents($getUrl);
		// 正则匹配规则
		preg_match('%<h1 class="title">.*</h1>%',$str,$outstr);
		preg_match('#<div class="data">.*<div class="clear">#isU',$str,$outstr2);
		if(!empty($outstr2))
		{
			$outstr2[0] =  preg_replace('#<div class="data">.*</div>#isU','',$outstr2[0]);
			$outstr2[0] =  preg_replace('#<div class=\'pagerA\' style=text-align:center; height:30px;>.*</div>#isU','',$outstr2[0]);
		}
		// 调用Collects.php中的main_show() 方法
		$data = main_show($outstr,$outstr2,$str,$filepath,$url,$getUrl);
		return $data;
	}
}
?>