<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: 丁昊臣
 *        Email: dotnet010@gmail.com
 */
class Home extends Admin_Controller
{
	public function __construct(){
		parent::__construct();
		
	}
	public function index()
	{
	/*	$data['title']='家178管理后台';
		$data['base_url']=config_item("site_url");
		$data['menu']='index';
	
		$this->data = $data;
		$this->page = 'index';
		$this->navpage = 'nav';
		parent::_initpage();*/

		$url = U('admin/three_config/index');
		jumpAjax('',$url);
	}
}

?>
