<?php
header("content-type:text/html;charset=utf-8"); 
/**
 *description:采集工具
 *uthor:baohanbin
 */
class Collect extends Temp_Controller {
	function __construct(){
        parent::__construct();	
    }
    /**
	 *  采集图片的页面
	 */
	public function pic(){
		$this->load->view('index/collect/pic.php');
	}
	/**
	 *  采集文章的页面
	 */
	public function nvarchar(){
		$this->load->view('index/collect/nvarchar.php');
	}
	/**
	 *  采集图片
	 */
    function showPage(){
    	include($_SERVER['DOCUMENT_ROOT']."/application/libraries/Collecting.php");
    	$imgdata = array(
			"media"=>get_args("media"),
			"url"=>get_args("url"),
			"w"=>get_args("w"),
			"h"=>get_args("h"),
			"alt"=>get_args("alt"),
			"title"=>get_args("title"),
			"description"=>get_args("description"),
			"media_type"=>get_args("media_type"),
			"video"=>get_args("video"),
			"imgname"=>get_args("name"),
		);
		$imgdata = getimg($imgdata);
		$this->load->view('index/collect/photo',$imgdata);
    }
    /**
	 *  文章、图片采集
	 *  注意：使用echo等输出语句时，输出的内容要符合js的输出语句，否则会报错
	 */
	public function test_version(){
		safeFilter();
		//获取传递的url ---->取出域名
		$getUrl = $this->input->get('url');
		$this->config->load('collect');		
		$arr = $this->config->item('url');	
		$info = parse_url($getUrl);
		$url = $info['host'];
		$flag = 'f';
		//循环collect配置文件的数组、判断并找到对应的方法
		foreach($arr as $key=>$val)
		{
			if($key == $url)
 			{
 				$flag = 't';
 				$this->load->library('collect/'.$val);
 				$res['url'] = $getUrl;
				$res = $this->$val->show($url,$getUrl);
				$show_data = $this->collect_exec($res);
				if(!isset($show_data))
				{
					echo "alert('采集失败、请重新采集');";
				}
				else
				{
					echo 'alert("采集成功");';
				}				
				break;	
			}
			else{
				$flag = 'f';
			}		
		}
		if($flag == 'f')
		{
			$this->load->library('collect/domain');
			$res = $this->domain->show($url,$getUrl);
			$show_data = $this->collect_exec($res);
			if(!isset($show_data))
			{
				echo "alert('采集失败、请重新采集');";
			}
			else
			{
				echo 'alert("采集成功");';
			}
			
		}
	}

	//生活的灵感采集执行
	public function collect_exec($info){
		if(!isset($info))
		{	
			return '';
		}
		else
		{
			//echo 'alert()';
			return 1;
		}


	}

}

