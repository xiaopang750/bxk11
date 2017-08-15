<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: ��껳�
 *        Email: dotnet010@gmail.com

 */
class WeixinMenu extends Admin_Controller
{	
	
	public $menu_config;
	public function __construct(){
		parent::__construct();
		$this->content = 'index';
		$this->navpage = 'nav';
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->load->model('t_service_menu_config_model');
		$this->menu_config = $this->t_service_menu_config_model;
		$this->load->helper('fromcheck');
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');

		$this->limit = 10;
	}
	public function index(){
		$data['title']='家178-管理中心-微信选项';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'weixinMenu/index';
		$this->navpage = $this->navpage ;
		$result['re'] = $this->menu_config->get_all();
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function add(){
		$data['title']='家178-管理中心-添加微信选项';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'weixinMenu/add';
		$this->navpage = $this->navpage ;
		$result = array();
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function doadd(){

		$url = U('admin/weixinMenu/add');
		$c_name = $this->input->post('c_name',true);
		$c_url = $this->input->post('c_url',true);
		$c_desc = $this->input->post('c_desc',true);
		if(!$c_name){
			jumpAjax("菜单名称不能为空",$url);
		}
/*		if(!CheckHttp($c_url)){
			jumpAjax("菜单链接地址不正确",$url);
		}*/
		if(!$c_url){
			jumpAjax("菜单链接地址不正确",$url);
		}
		if(!$this->is_menu($c_name,'')){
			jumpAjax("菜单名称己占用",$url);
		}

		$this->menu_config->c_name = $c_name;
		$this->menu_config->c_url = $c_url;
		$this->menu_config->c_desc = $c_desc;
		$this->menu_config->c_pic = '';

		$this->load->library('upload');
		$c_picUrl = $this->upload->upMenuPicModule("c_pic");
		if($c_picUrl){
			$this->menu_config->c_pic = $c_picUrl;
		}else{
			jumpAjax("请上传菜单图片",$url);
		}

		if($this->menu_config->insert()){
			$url = site_url('admin/weixinMenu/index');
			jumpAjax("操作成功",$url);
		}else{
			jumpAjax("操作失败",$url);
		}
	}

	public function edit(){
		$data['title']='家178-管理中心-编辑微信选项';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'weixinMenu/edit';
		$this->navpage = $this->navpage;
		$result = array();
		$c_id = $this->input->get('c_id');
		$result = $this->menu_config->get($c_id);
		$this->config->load('uploads');
		$config = $this->config->item('service_WeixinMenu');
		$result->root_pic = $config['relative_path'];
		$this->pagedata = $result;
		parent::_initpage();
	}

	public function doedit(){
		
		$c_id = $this->input->post('c_id');
		$c_name = $this->input->post('c_name',true);
		$c_url = $this->input->post('c_url',true);
		$c_desc = $this->input->post('c_desc',true);
		$sc_pic = $this->input->post('sc_pic_bak',true);
		$url = site_url('admin/weixinMenu/edit')."?c_id=".$c_id;

		if(!$c_name){
			jumpAjax("菜单名称不能为空",$url);
		}
		/*if(!CheckHttp($c_url)){
			jumpAjax("菜单链接地址不正确",$url);
		}*/
		if(!$c_url){
			jumpAjax("菜单链接地址不正确",$url);
		}
		if(!$this->is_menu($c_name,$c_id)){
			jumpAjax("菜单名称己占用",$url);
		}


		$data['c_name'] = $c_name;
		$data['c_url'] = $c_url;
		$data['c_desc'] = $c_desc;
		$data['c_pic'] = $sc_pic;
		$this->load->library('upload');
		$c_picUrl = $this->upload->upMenuPicModule("c_pic");
		if($c_picUrl){
			$data['c_pic']  = $c_picUrl;
		}else{
			$data['c_pic']  = $sc_pic;
		}
		$where['c_id'] = $c_id;
		if($this->menu_config->updates_global($data,$where)){
			$url = site_url('admin/weixinMenu/index');
			jumpAjax("操作成功",$url);
		}else{
			$url = site_url('admin/weixinMenu/edit')."?c_id=".$c_id;
			jumpAjax("操作失败",$url);
		}
	}

	//判断菜单名称是否存在
	public function is_menu($c_name,$c_id){
		$where['c_name'] = $c_name;
		$result = $this->menu_config->getArray('*',$where);
		if($result){
			if($c_id){
				$is_menu = twotoone_array($result,'c_id');
				foreach($is_menu as $va){
					if($c_id != $va){
						return false;
					}
				}
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}

	public function is_AjaxMenuOpt(){
		$c_id = $this->input->post('id');
		$c_name = $this->input->post('key');
		if($this->is_menu($c_name,$c_id)){
			echo 0;
		}else{
			echo 1;
		}
	}

	public function doDel(){
		$ids = $this->input->post('ids');
		$idarr = explode(',',$ids);
		$temarr = array();
	
		foreach($idarr as $val){
			$result = $this->menu_config->get($val);
			if($this->menu_config->delete($val)){
				$this->config->load('uploads');
				$config = $this->config->item('service_WeixinMenu');
				$urlSourcue = $config['upload_path'].$result->c_pic;
				$urlThumb_1= $config['thumb_1'].$result->c_pic;
				@unlink($urlSourcue);
				@unlink($urlThumb_1);
				$temarr[] = $val;
			}
		}
		if($temarr){
			echo echojson('0',$temarr);
		}else{
			echo echojson('1',$temarr,'删除失败');
		}
	}
}

?>