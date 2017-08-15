<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: ��껳�
 *        Email: dotnet010@gmail.com

 */
class Content extends Admin_Controller
{	
	public $content;
	public $navpage;
	public function __construct(){
		parent::__construct();
		$this->content = 'content';
		$this->navpage = 'content/nav';

	}
	public function index()
	{
		/*$data['title']='家178-内容管理';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'content/index';
		$this->navpage = $this->navpage;
		
		parent::_initpage();*/
		$url = U('admin/system_disable/index');
		jumpAjax('',$url);
	}
}

?>