<?php

class servicerDemo extends CI_Controller{


	public function __construct(){

		parent::__construct();
		$this->demo();
	}

	public function index(){

	}

	/**
	 * 显示图片
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	private function demo(){
		 safeFilter();
		 $service_token = $this->input->get('service_token');
		 $data['service_token'] = $service_token;
		 $this->load->view('weixin/demo',$data);
	}

	
}