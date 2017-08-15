<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *description:搜索
 *author:yanyalong
 *date:2013/09/24
 */
class Search extends User_Controller {
	function __construct(){
        parent::__construct();
		$this->checklogin();
    }
	/**
	 *description:综合搜索
	 *author:yanyalong
	 *date:2013/11/13
	 */
	public function index(){
		$this->config->load('view');
		$config = $this->config->item('index');
		$this->load->view($config['search']);	
	}
}
