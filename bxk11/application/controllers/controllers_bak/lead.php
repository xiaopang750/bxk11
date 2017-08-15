<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:首页登录注册
 *author:chenyuda
 *date:2013/08/01
 */
class Lead extends Temp_Controller {
	function __construct(){
		parent::__construct();
	}

	/**
	 *description:注册页
	 *author:yanyalong
	 *date:2013/11/05
	 */
	public function index()
	{
		
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['regist']);	
	}
}

