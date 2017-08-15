<?php
class Userset extends User_Controller {

	function __construct(){
		parent::__construct();
		$this->checklogin();
	}
	/**
	 *description:个人设置
	 *author:yanyalong
	 *date:2013/11/14
	 */
	public function index(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['modify']);	
	}
	/**
	 *description:sendmsg
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function sendmsg(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['sendmsg']);	
	}
	/**
	 *description:通知页面
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function noticelist(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['noticelist']);	

	}
	/**
	 *description:私信列表页
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function msglist(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['msglist']);	
	}
	/**
	 *description:私信详情页
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function msg(){

		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['msg']);	
	}
	/**
	 *description:我的粉丝列表
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function fanslist(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['fanslist']);	
	}
	/**
	 *description:我的关注列表
	 *author:yanyalong
	 *date:2013/11/09
	 */
	public function followlist(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['followlist']);	
	}

	/**
	 *description:发现好灵感
	 *author:yanyalong
	 *date:2013/11/12
	 */
	public function discovery(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['discovery']);	
	}
}



