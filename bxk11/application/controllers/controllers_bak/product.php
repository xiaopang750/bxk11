<?php
/**
 *description:用户信息
 *author:yanyalong
 *date:2013/11/05
 */
class Product extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:产品详情页
	 *author:yanyalong
	 *date:2013/12/29
	 */
	public function info(){
		//$this->checkdesign();
		$data['title'] = "产品详情";
		$data['config']	= $this->myinfo();
		$data['seo']	="seo";
		//所在地区结束
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['productinfo'],$data);	
	}
}


