<?php
/**
 *description:装修问题
 *author:yanyalong
 *date:2013/11/07
 */
class Qa extends User_Controller {

	function __construct(){
		parent::__construct();
	}
	/**
	 *description:装修问题加载页
	 *author:yanyalong
	 *date:2013/11/07
	 */
	public function questioninfo(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['questioninfo']);	
	}
}


