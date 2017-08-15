<?php
/*description:单一标签聚合
 *author:yanyalong
 *date:2013/07/28
 */
class Tag extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:标签、主题判断跳转
	 *author:yanyalong
	 *date:2013/08/29
	 */
	//public function index(){
		//$tag_name = isset($_GET['tag'])?$_GET['tag']:"";
		//if($tag_name==""){
			//echojson(1,"","无相关数据");
		//}
		//$taginfo = model("t_tag")->taginfobyname($tag_name);
		//if(empty($taginfo)){
			//echojson(1,"","无相关数据");
		//}
		//if($taginfo['tag_type']==1){
			//$tagurl = $this->config->site_url()."/tag/tags?tag=".$tag_name;
		//}elseif($taginfo['tag_type']==2){
			//$tagurl = $this->config->site_url()."/tag/themegood?tag=".$tag_name;
		//}
		//header("Location:$tagurl");exit;
	//}
	/**
	 *description:标签聚合展示页
	 *author:yanyalong
	 *date:2013/08/30
	 */
	//public function	tags(){
		//$this->config->load('view');
		//$config = $this->config->item('index');
		//$this->load->view($config['tag'],$data);	
	//}
	/**
	 *description:主题精选展示页
	 *author:yanyalong
	 *date:2013/08/30
	 */
	public function index(){
		safeFilter();
$type= isset($_GET['type'])?$this->input->get('type'):"";
if($type==""){
	$type = "装修风格";
}
		$data['config']	= $this->myinfo();
		$data['title']	= "标签精选聚合页";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['taggood'],$data);	
	}
	/**
	 *description:主题最新聚合展示页
	 *author:yanyalong
	 *date:2013/08/30
	 */
	public function tagnew(){
		safeFilter();
$type= isset($_GET['type'])?$this->input->get('type'):"";
if($type==""){
	$type = "装修风格";
}
		$data['config']	= $this->myinfo();
		$data['title']	= "标签最新聚合页";
		$data['seo']	="seo";
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['tag'],$data);	
	}
	/**
	 *description:我的订阅页面
	 *author:yanyalong
	 *date:2013/11/13
	 */
	public function takelist(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['takelist']);	
	}
	/**
	 *description:标签浏览页面
	 *author:yanyalong
	 *date:2013/11/13
	 */
	public function browsetag(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['browsetag']);	
	}
}


