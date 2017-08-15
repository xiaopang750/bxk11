<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header("content-type:text/html;charset=utf-8"); 
/**
 *  默认的文章采集---->指不是指定采集的网站
 *  只采集页面中的 ‘标题’ 获取到的url  ----> 保存到$data数组中
 */
class Domain {	
	public function show($url,$getUrl){
		include_once("./application/libraries/collect/Collects.php");
		//文件路径
		$filepath = $config['coll']['path'];
		// 获取目标地址html
		$str = curl_file_get_contents($getUrl);
		// 匹配title标签的正则
		preg_match('%<title>.*</title>%',$str,$outstr);
		// 调用Collects.php中的main_show() 方法
		$data = main_show($outstr,'',$str,$filepath,$url,$getUrl);
		return $data;	
	}
}

?>