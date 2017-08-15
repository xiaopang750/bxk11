<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/12/27 10:30:17 
 *        liuguangpingAuthor: 刘广平
 *        Email: liuguangpingtest@163.com

 */
class System extends Admin_Controller
{	
	public $system;
	public $navpage;
	public $t_system_action;
	public $t_system_action_group;
	public $t_system_role;
	public $t_system_admin_permission;
	public $t_system_admin_group;
	
	public $t_system_class;
	public $t_s_class_tag;
	public $t_system_product_pattern;
	public $t_product_brands;
	public $t_product_class_brands_series;
	public $t_product_brands_series;
	public $t_certified_product;
	public $t_certified_product_tag;
	public $t_certified_product_info;
	public $limit;
	public $libs;
	public function __construct(){
		parent::__construct();
	
		$this->system = 'system';
		$this->navpage = 'system/nav';
		//require_once('./lib/FirePHPCore/fb.php');
		//ob_start();
		//fb('',FirePHP::TRACE);
		$this->load->model('t_system_action_model');	
		$this->t_system_action = $this->t_system_action_model;
		$this->load->model('t_system_action_group_model');
		$this->t_system_action_group = $this->t_system_action_group_model;
		$this->load->model('t_system_role_model');
		$this->t_system_role = $this->t_system_role_model;
		$this->load->model('t_system_admin_permission_model');
		$this->t_system_admin_permission = $this->t_system_admin_permission_model;
		$this->load->model('t_system_admin_group_model');
		$this->t_system_admin_group = $this->t_system_admin_group_model;
		
		
		$this->load->model('t_system_class_model');
		$this->t_system_class = $this->t_system_class_model;
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;	
		$this->load->model('t_s_class_tag_model');
		$this->t_s_class_tag = $this->t_s_class_tag_model;
		$this->load->model('t_system_product_pattern_model');
		$this->t_system_product_pattern = $this->t_system_product_pattern_model;
		$this->load->model('t_product_brands_model');
		$this->t_product_brands = $this->t_product_brands_model;
		$this->load->model('t_product_class_brands_series_model');
		$this->t_product_class_brands_series = $this->t_product_class_brands_series_model;
		$this->load->model('t_product_brands_series_model');
		$this->t_product_brands_series = $this->t_product_brands_series_model;
		$this->load->model('t_certified_product_model');
		$this->t_certified_product = $this->t_certified_product_model;
		$this->load->model('t_certified_product_tag_model');
		$this->t_certified_product_tag = $this->t_certified_product_tag_model;
		$this->load->model('t_certified_product_info_model');
		$this->t_certified_product_info = $this->t_certified_product_info_model;
		$this->limit = 10;
	
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');

	}
	public function index(){
		$data['title']='家178-系统管理';
		$data['menu']=$this->system;
		$this->data = $data;
		$this->page = 'system/index';
		$this->navpage = $this->navpage;
		$result = array();

		$field = "s_class_id,s_class_name";
		$where = array('s_class_type'=>12,'s_class_pid'=>0);
		$result['product_class'] = $this->t_system_class->get_tag($field,$where);
		
		$page = $this->input->get('current_page');
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		
		$brand_id = $this->input->get('brand_id');
		$series_id = $this->input->get('series_id');
		$pattern_id = $this->input->get('pattern_id');
		$product_status =  $this->input->get('product_status');
		$code = $this->input->get('code');
		$key_word = $this->input->get('key_word');
		$product_name = $this->input->get('product_name');
		$total_rows = count($this->t_certified_product->admin_search_count($brand_id,$series_id,$pattern_id,$code,$key_word,$product_name,$product_status));
		$office =  ($page-1)*($this->limit);
		$result['brand_id'] = $brand_id;
		$result['series_id'] = $series_id;
		$result['pattern_id'] = $pattern_id;
		$result['code'] = $code;
		$result['key_word'] = $key_word;
		$result['product_name'] = $product_name;
		$result['product_status'] = $product_status;
		$result['re'] = $this->t_certified_product->admin_search($brand_id,$series_id,$pattern_id,$code,$key_word,$product_name,$product_status,$office,$this->limit);
		$this->libs->base_url = site_url('admin/product/index').'?search=0&brand_id='.$brand_id."&pattern_id=".$pattern_id."&code=".$code."&key_word=".$key_word."&key_word=".$key_word.'&product_status='.$product_status;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$this->pagedata = $result;
		parent::_initpage();

		
		/* $brand_id = $this->input->get('brand_id');
		$series_id = $this->input->get('series_id');
		$pattern_id = $this->input->get('pattern_id');
		$code = $this->input->get('code');
		$key_word = $this->input->get('key_word');
		
		$result['re'] = $this->t_certified_product->admin_searchproduct($brand_id,$series_id,$pattern_id,$code,$key_word); */
	}
	
	public function add(){
		
		$data['title']='家178-功能添加';
		$data['menu']=$this->system;
		$this->data = $data;
		$this->page = 'system/add';
		$this->navpage = $this->navpage;
		$result = array();
		$result['system_action_group'] = $this->t_system_action_group->get_all();
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doadd(){
		
		$group_id=$this->input->post('group_id',true);
		if($group_id == 'creat_group'){
			$group_name=$this->input->post('group_name',true);
			if(!$group_name){
				echo "<script type='text/javascript'>alert('分组不能为空！');window.location.href='".site_url('admin/system/add')."'</script>";exit;
			}

			$this->t_system_action_group->group_name = $group_name;
			$group_id = $this->t_system_action_group->insert();
			if($group_id){
				$this->t_system_action->group_id = $group_id;
			}else{
				echo "<script type='text/javascript'>alert('分组添加失败！');window.location.href='".site_url('admin/system/add')."'</script>";exit;
			}
		}else{
			if(!$group_id){
				echo "<script type='text/javascript'>alert('请选择分类！');window.location.href='".site_url('admin/system/add')."'</script>";exit;
			}
			$this->t_system_action->group_id = $group_id;
		}
		$this->t_system_action->action_name =$this->input->post('action_name',true);
		if(!$this->t_system_action->action_name){
			echo "<script type='text/javascript'>alert('请填写功能名称！');window.location.href='".site_url('admin/system/add')."'</script>";exit;
		}
		$this->t_system_action->action_key =$this->input->post('action_key',true);
		if(!$this->t_system_action->action_key){
			echo "<script type='text/javascript'>alert('请填写功能key！');window.location.href='".site_url('admin/system/add')."'</script>";exit;
		}
		if($this->t_system_action->get_key('action_id',array('action_key'=>$this->input->post('action_key',true),'action_depth'=>1))){
			echo "<script type='text/javascript'>alert('功能key己存在,不能在添加了！');window.location.href='".site_url('admin/system/add')."'</script>";exit;
		}
		$this->t_system_action->action_description =$this->input->post('action_description',true);
		$this->t_system_action->action_status =$this->input->post('action_status',true);
		$this->t_system_action->action_pkey = '0';
		$this->t_system_action->action_adminid = $_SESSION['admin_id'];
		$this->t_system_action->action_addtime = date('Y-m-d H:i:s');
		$this->t_system_action->action_depth = 1;
		$this->t_system_action->action_addip =  $this->input->ip_address();
		if($this->t_system_action->insert()){
			echo "<script type='text/javascript'>alert('添加成功！');window.location.href='".site_url('admin/system/index')."'</script>";exit;
		}else{
			echo "<script type='text/javascript'>alert('添加失败！');window.location.href='".site_url('admin/system/add')."'</script>";exit;
		}
		
	}
	
	
	public function add_one(){
	
		
		$data['title']='家178-功能添加';
		$data['menu']=$this->system;
		$this->data = $data;
		$this->page = 'system/add_one';
		$this->navpage = $this->navpage;
		$result = array();
		$action_id = $this->input->get('action_id',true);
		if(!is_numeric($action_id) || $action_id == ''){
			echo "<script type='text/javascript'>alert('请正确添加！');window.location.href='".site_url('admin/system/index')."'</script>";exit;
		}
		$result['system_action'] = $this->t_system_action->get($action_id);
		//var_dump($result['system_action']);die;
		$result['system_action_group'] = $this->t_system_action_group->get_all();
		$result['action_id'] = $action_id;
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doadd_one(){
	
		$group_id=$this->input->post('group_id',true);
		if($group_id == 'creat_group'){
			$group_name=$this->input->post('group_name',true);
			if(!$group_name){
				echo "<script type='text/javascript'>alert('分组不能为空！');window.location.href='".site_url('admin/system/add_one')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
			}
	
			$this->t_system_action_group->group_name = $group_name;
			$group_id = $this->t_system_action_group->insert();
			if($group_id){
				$this->t_system_action->group_id = $group_id;
			}else{
				echo "<script type='text/javascript'>alert('分组添加失败！');window.location.href='".site_url('admin/system/add_one')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
			}
		}else{
			if(!$group_id){
				echo "<script type='text/javascript'>alert('请选择分类！');window.location.href='".site_url('admin/system/add_one')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
			}
			$this->t_system_action->group_id = $group_id;
		}
		$this->t_system_action->action_name =$this->input->post('action_name',true);
		if(!$this->t_system_action->action_name){
			echo "<script type='text/javascript'>alert('请填写功能名称！');window.location.href='".site_url('admin/system/add_one')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
		}
		$this->t_system_action->action_key =$this->input->post('action_key',true);
		if(!$this->t_system_action->action_key){
			echo "<script type='text/javascript'>alert('请填写功能key！');window.location.href='".site_url('admin/system/add_one')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
		}
		if($this->t_system_action->get_key('action_id',array('action_key'=>$this->input->post('action_key',true),'action_depth'=>2))){
			echo "<script type='text/javascript'>alert('功能key己存在,不能在添加了！');window.location.href='".site_url('admin/system/add_one')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
		}
		$this->t_system_action->action_description =$this->input->post('action_description',true);
		$this->t_system_action->action_status =$this->input->post('action_status',true);
		$this->t_system_action->action_pkey = $this->input->post('action_pkey',true);
		$this->t_system_action->action_adminid = $_SESSION['admin_id'];
		$this->t_system_action->action_addtime = date('Y-m-d H:i:s');
		$this->t_system_action->action_depth = 2;
		$this->t_system_action->action_addip =  $this->input->ip_address();
		if($this->t_system_action->insert()){
			echo "<script type='text/javascript'>alert('添加成功！');window.location.href='".site_url('admin/system/index')."'</script>";exit;
		}else{
			echo "<script type='text/javascript'>alert('添加失败！');window.location.href='".site_url('admin/system/add_one')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
		}
	
	}
	
	public function add_two(){
	
	
		$data['title']='家178-功能添加';
		$data['menu']=$this->system;
		$this->data = $data;
		$this->page = 'system/add_two';
		$this->navpage = $this->navpage;
		$result = array();
		$action_id = $this->input->get('action_id',true);
		if(!is_numeric($action_id) || $action_id == ''){
			echo "<script type='text/javascript'>alert('请正确添加！');window.location.href='".site_url('admin/system/index')."'</script>";exit;
		}
		$result['system_action'] = $this->t_system_action->get($action_id);
		$result['system_role'] = $this->t_system_role->get_role('role_id,role_name',array('role_status'=>1));
			//echo "<pre>";var_dump($result['system_role']);
		$result['system_action_group'] = $this->t_system_action_group->get_all();
		$result['action_id'] = $action_id;
		$this->pagedata = $result;
		parent::_initpage();
	}
	public function doadd_two(){
	
		$group_id=$this->input->post('group_id',true);
		if($group_id == 'creat_group'){
			$group_name=$this->input->post('group_name',true);
			if(!$group_name){
				echo "<script type='text/javascript'>alert('分组不能为空！');window.location.href='".site_url('admin/system/add_two')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
			}
	
			$this->t_system_action_group->group_name = $group_name;
			$group_id = $this->t_system_action_group->insert();
			if($group_id){
				$this->t_system_action->group_id = $group_id;
			}else{
				echo "<script type='text/javascript'>alert('分组添加失败！');window.location.href='".site_url('admin/system/add_two')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
			}
		}else{
			if(!$group_id){
				echo "<script type='text/javascript'>alert('请选择功能组！');window.location.href='".site_url('admin/system/add_two')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
			}
			$this->t_system_action->group_id = $group_id;
		}
		$this->t_system_action->action_name =$this->input->post('action_name',true);
		if(!$this->t_system_action->action_name){
			echo "<script type='text/javascript'>alert('请填写功能名称！');window.location.href='".site_url('admin/system/add_two')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
		}
		$this->t_system_action->action_key =$this->input->post('action_key',true);
		if(!$this->t_system_action->action_key){
			echo "<script type='text/javascript'>alert('请填写功能key！');window.location.href='".site_url('admin/system/add_two')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
		}
		if($this->t_system_action->get_key('action_id',array('action_key'=>$this->input->post('action_key',true),'action_depth'=>3))){
			echo "<script type='text/javascript'>alert('功能key己存在,不能在添加了！');window.location.href='".site_url('admin/system/add_two')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
		}
		$this->t_system_action->action_description =$this->input->post('action_description',true);
		$this->t_system_action->action_status =$this->input->post('action_status',true);
		$this->t_system_action->action_pkey = $this->input->post('action_pkey',true);
		$this->t_system_action->action_adminid = $_SESSION['admin_id'];
		$this->t_system_action->action_addtime = date('Y-m-d H:i:s');
		$this->t_system_action->action_depth = 3;
		$this->t_system_action->action_addip =  $this->input->ip_address();
		$role = $this->input->post('role_id');
		if(!$role){
			echo "<script type='text/javascript'>alert('请先选择或创建角色！');window.location.href='".site_url('admin/system/index')."'</script>";exit;
		}
		if($system_action_id = $this->t_system_action->insert()){
			foreach($role as $va){
				$this->t_system_admin_permission->action_id = $system_action_id;
				$this->t_system_admin_permission->role_id = $va;
				$this->t_system_admin_permission->permission_status = $this->input->post('permission_status_'.$va);
				$this->t_system_admin_permission->action_key = $this->input->post('action_key');
				$this->t_system_admin_permission->insert();
			}
			echo "<script type='text/javascript'>alert('添加成功！');window.location.href='".site_url('admin/system/index')."'</script>";exit;
		}else{
			echo "<script type='text/javascript'>alert('添加失败！');window.location.href='".site_url('admin/system/add_two')."?action_id=".$this->input->post('action_pkey',true)."'</script>";exit;
		}
	
	}

	//添加管理员
	public function create_admin(){
		$data['title']='家178-管理员添加';
		$data['menu']=$this->system;
		$this->data = $data;
		$this->page = 'system/create_admin';
		$this->navpage = $this->navpage;
		$result = array();
		$result['system_admin_group'] = $this->t_system_admin_group->get_admin_group('agroup_id,agroup_name',array('agroup_status'=>1));
		//	echo "<pre>";var_dump($result['system_admin_group']);die;
		$this->pagedata = $result;
		parent::_initpage();
	}
	//管理员组
	public function create_group(){
		$data['title']='家178-管理组创建';
		$data['menu']=$this->system;
		$this->data = $data;
		$this->page = 'system/create_group';
		$this->navpage = $this->navpage;
		$result = array();
		$result['system_role'] = $this->t_system_role->get_role('role_id,role_name',array('role_status'=>1));
		$result['system_admin_group'] = $this->t_system_admin_group->get_admin_group('agroup_id,agroup_name',array('agroup_status'=>1));
		//	echo "<pre>";var_dump($result['system_admin_group']);die;
		$this->pagedata = $result;
		parent::_initpage();
	}
	//添加角色
	public function create_role(){

		$data['title']='家178-管理组创建';
		$data['menu']=$this->system;
		$this->data = $data;
		$this->page = 'system/create_role';
		$this->navpage = $this->navpage;
		$result = array();
		$result['system_role'] = $this->t_system_role->get_role('role_id,role_name',array('role_status'=>1));
		$result['system_admin_group'] = $this->t_system_admin_group->get_admin_group('agroup_id,agroup_name',array('agroup_status'=>1));
		//	echo "<pre>";var_dump($result['system_admin_group']);die;
		$this->pagedata = $result;
		parent::_initpage();
	}




}

