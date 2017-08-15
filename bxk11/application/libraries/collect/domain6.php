<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("content-type:text/html;charset=utf-8"); 
/**
 *  指定采集的网站的详细内容页面内容
 *  采集文章的‘标题’，‘内容’ 到 $data 数组中
 */
class Domain6 {	
	public function show($url,$getUrl){
		include_once("./application/libraries/collect/Collects.php");
		// 文件路径
		$filepath = $config['coll']['path'];
		// 获取目标地址html
		$str = curl_file_get_contents($getUrl);
		$info = parse_url($getUrl);
		$n_url = $info['host'].substr($info['path'],0,strpos(substr($info['path'],1),'/')+2);
		// 正则匹配规则 
		if ($url.'/work/' == $n_url) {
			preg_match('#<h1 class="workTitle">.*</h1>#isU',$str,$outstr);
			preg_match('#<div class="workInfor">.*<div class="center pt30">#isU',$str,$outstr2);		
		}
		else if($url.'/article/' == $n_url)
		{
			preg_match('#<h1 class="workTitle f16 yh">.*</h1>#isU',$str,$outstr);
			preg_match('#<div class="workContentWrapper borderTop">.*<div class="center pt30">#isU',$str,$outstr2);	
		}
		else if($url.'/show/' == $n_url || $url.'/gfx/' == $n_url)
		{
			preg_match('#<h1 class="workTitle">.*</h1>#isU',$str,$outstr);
			preg_match('#<div class="workContentWrapper small">.*<div class="center pt30">#isU',$str,$outstr2);
		}
		else if('www.baicha.me' == $url) {
			preg_match('#<h1 class="entry-title">.*</h1>#isU',$str,$outstr);
			preg_match('#<div class="entry-content">.*<div class="wumii-hook">#isU',$str,$outstr2);
		}
		else{
			$outstr = '';
			$outstr2 = '';
		}
		// 调用Collects.php中的main_show() 方法
		$data = main_show($outstr,$outstr2,$str,$filepath,$url,$getUrl);
		return $data;	
	}
}
?>