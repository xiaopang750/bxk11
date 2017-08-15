<?php
/**
 *description:装修项目控制器
 *author:yanyalong
 *date:2013/12/11
 */
class Project extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:添加、编辑项目
	 *author:yanyalong
	 *date:2013/12/11
	 */
	public function addproject(){
		$this->checkdesign();
		$data['title'] = "创建装修项目";
		$data['config']	= $this->myinfo();
		$data['seo']	="seo";
		//所在地区结束
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['addproject'],$data);	
	}
}


