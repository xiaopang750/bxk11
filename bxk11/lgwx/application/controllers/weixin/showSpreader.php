<?php

class ShowSpreader extends CI_Controller{

	private $spreader_rebate_record;//自助平台推广返利记录表
	const LGWX_REG_URL = "/lgwx/index.php/reg/index";
	public function __construct(){

		parent::__construct();
		$this->load->helper('url');
		
		$this->load->model('t_service_spreader_rebate_record_model');
		$this->spreader_rebate_record = $this->t_service_spreader_rebate_record_model;
	}

	public function index(){

	}

	/**
	 * 显示图片
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function showSpreaderReply(){
		safeFilter();
		$spreader_code = $this->input->get('spreader_code');
		$dates = date("Y-m-d H:i:s",time()-3600*24*30);
		$resulut = array();
		$resulut['re'] = $this->spreader_rebate_record->getSprReRe($dates,$spreader_code);
		
		$this->load->view('weixin/showSpreaderReply',$resulut);
	}

	/**
	 * 显示推广数据
	 * @author liuguangping
	 * @version 1.0 2014/4/17
	 */
	public function showSpread(){

		safeFilter();
		$spreader_code = $this->input->get('spreader_code');

		$text_url = $_SERVER['HTTP_HOST'].self::LGWX_REG_URL."?flg=".$spreader_code;
		if(stripos($text_url, 'http://') === FALSE)
			$text_url = "http://".$text_url;
		 $this->load->library('sm');

		 $this->sm->assign('text_url',$text_url);
         $this->sm->display('extension.php');
	}

	
}