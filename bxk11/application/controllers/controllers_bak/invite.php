<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *description:邀请码页面
 *author:chenyuda
 *date:2013/08/16
 */

class Invite extends Temp_Controller {
	function __construct(){
        parent::__construct();	
    }
	//显示邀请码页面
	function index()
	{
		$this->load->view('index/invite');	
	}
	//显示添加用户昵称生日页面（成为必修客一员）
	function add_bixiuke(){
		
		$this->load->view('index/hello');
	}
}
