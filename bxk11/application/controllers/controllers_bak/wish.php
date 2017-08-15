<?php
/**
 *description:用户信息
 *author:yanyalong
 *date:2013/11/05
 */
class wish extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:发现好灵感(灵感博文)
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function design(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['wish_design']);	
	}
	
	/**
	 *description:发现好灵感(家居美图)
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function product(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['wish_product']);	
	}

	/**
	 *description:发现好灵感(装修问题)
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function question(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['wish_question']);	
	}
	/**
	 *description:探索页
	 *author:yanyalong
	 *date:2013/11/15
	 */
	public function explore(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['explore']);	
	}
}

