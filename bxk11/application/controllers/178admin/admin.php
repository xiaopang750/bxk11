<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
	/*
 * Generator By "Auto Codeigniter" 广告页面及模块管理 Author: 冀帅 QQ: 75426585
 */
class admin extends Admin_Controller {
	public function __construct() {
		parent::__construct ();
	}
	
	public function index(){
		$data['viewurl'] = U('views/178admin/');//定义css等路径网址
		$this->load->view('178admin/ui/admin',$data);
	}
	
	
}
	