<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
	/*
 * Generator By "Auto Codeigniter" 广告页面及模块管理 Author: 冀帅 QQ: 75426585
 */
class  index extends Admin_Controller {
	public function __construct() {
		parent::__construct ();
	}
	
	public function index(){
		$this->load->view('178admin/template/main');
	}
	public function info(){
		$this->load->view('178admin/template/index');
	}
}
	
