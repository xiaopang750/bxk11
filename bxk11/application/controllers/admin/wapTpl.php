<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        liuguangpingAuthor: 服务商管理
 *        Email: liuguangpingtest@163.com

 */
class WapTpl extends Admin_Controller
{	
	//公共用的
	public $member;
	public $navpage;
	public $limit;
	public $libs;
	
	public $wap_template;
	public $service_type;
	public $wap_menu;
	public function __construct(){
		parent::__construct();
		$this->member = "member";
		$this->navpage = 'member/nav';

		
		$this->load->model('t_wap_template_model');
		$this->wap_template = $this->t_wap_template_model;
		$this->service_type = model('t_service_type');
		$this->wap_menu = model('t_service_wap_menu');
	
		//共公有的
		$this->load->helper('import_excel');
		$this->load->helper('content_fun');
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->limit = 20;
		$this->load->helper('url');

	}
	public function index()
	{
		$data['title']='家178-管理中心-服务商-wap模版列表';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'wapTpl/index'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$result=array();
		$key_word = isset($this->getParam->key_word)?$this->getParam->key_word:'';
		$template_type = isset($this->getParam->template_type)?$this->getParam->template_type:'';

		$page = isset($this->getParam->current_page)?$this->getParam->current_page:'';;
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$total_rows = count($this->wap_template->admin_search_count($key_word,$template_type));
		$office =  ($page-1)*($this->limit);
		$result['re'] = $this->wap_template->admin_search($key_word,$template_type,$office,$this->limit);
		
		$this->libs->base_url = site_url('admin/wapTpl/index').'?search=0&key_word='.$key_word."&template_type=".$template_type;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$result['template_type'] = $template_type;
		$result['key_word'] = $key_word;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	
	public function add(){
		$data['title']='家178-管理中心-服务商-wap模版添加';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'wapTpl/add'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$result=array();
		$result['service_type'] = $this->service_type->get_all();
		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面
	}

	public function doadd(){
		$this->wap_template->template_name = $this->postParam->template_name;
		$this->wap_template->template_code = $this->postParam->template_code;
		$this->wap_template->service_type_id = $this->postParam->service_type_id;
		$this->wap_template->service_id = $this->postParam->service_id;
		$this->wap_template->template_status = $this->postParam->template_status;
		$this->wap_template->template_is_default = $this->postParam->template_is_default;
		$this->wap_template->template_type = $this->postParam->template_type;
		//$this->wap_template->template_cover = $this->postParam->template_cover;
		$this->wap_template->main_menu_count = $this->postParam->main_menu_count;
		$this->wap_template->shortcut_menu_count = $this->postParam->shortcut_menu_count;

		if($this->wap_template->insert()){
			jumpAjax('操作成功！',U('admin/wapTpl/index'));
		}else{
			jumpAjax('操作失败！',U('admin/wapTpl/add'));			
		}
	}

	public function edit(){
		$data['title']='家178-管理中心-服务商-wap模版编辑';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'wapTpl/edit'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$result=array();
		$template_id = isset($this->getParam->template_id)?$this->getParam->template_id:'';
		$result['service_type'] = $this->service_type->get_all();
		$result['re'] = $this->wap_template->get($template_id);
		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面
	}

	public function doedit(){
		$data['template_name'] = $this->postParam->template_name;
		$data['template_code'] = $this->postParam->template_code;
		$data['service_type_id'] = $this->postParam->service_type_id;
		$data['service_id'] = $this->postParam->service_id;
		$data['template_status'] = $this->postParam->template_status;
		$data['template_is_default'] = $this->postParam->template_is_default;
		//$data['template_cover'] = $this->postParam->template_cover;
		$data['main_menu_count'] = $this->postParam->main_menu_count;
		$data['shortcut_menu_count'] = $this->postParam->shortcut_menu_count;
		$where['template_id'] = $this->postParam->template_id;
		if($this->wap_template->updates_global($data,$where))
			jumpAjax('操作成功！',U('admin/wapTpl/index'));
		else
			jumpAjax('操作成功！',U('admin/wapTpl/edit',array('template_id'=>$where['template_id'])));
	}

	public function dostatus(){
		$status  = $this->input->post('status');
		$template_id  = $this->input->post('question_id');
		$data = array('template_status'=>$status);
		$where = array('template_id'=>$template_id);
		if($this->wap_template->updates_global($data,$where)){
			print_r($data);
			print_r($where);
			echo 1;
		}else{
			echo 0;
		}

	}
	public function dodele(){
		$status  =$_GET['status'];
		$template_id  =$_GET['question_id'];  
		$data = array('template_status'=>$status);
		$where = array('template_id'=>$template_id);
		if($this->wap_template->updates_global($data,$where)){
		
			echo "<script>history.go(-1);</script>";
		}else{
			echo "删除失败";
		}

	}

	public function wapMenu()
	{
		$data['title']='家178-管理中心-服务商-wap模版列表';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'wapTpl/wapMenu'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$result=array();
		$key_word = isset($this->getParam->key_word)?$this->getParam->key_word:'';
		
		$page = isset($this->getParam->current_page)?$this->getParam->current_page:'';;
		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$total_rows = count($this->wap_menu->admin_search_count($key_word,''));
		$office =  ($page-1)*($this->limit);
		$result['re'] = $this->wap_menu->admin_search($key_word,'',$office,$this->limit);
		
		$this->libs->base_url = site_url('admin/wapTpl/wapMenu').'?search=0&key_word='.$key_word;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		$result['key_word'] = $key_word;
		$result['service_type'] = $this->service_type->get_all();

		$this->pagedata = $result;
		parent::_initpage();
	}
	
	
	public function wapMenuAdd(){
		$data['title']='家178-管理中心-服务商-wap模版添加';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'wapTpl/wapMenuAdd'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$result=array();
		$result['service_type'] = $this->service_type->get_all();
		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面
	}

	public function doWapMenuAdd(){
		$this->wap_menu->service_type_id = $this->postParam->service_type_id;
		$this->wap_menu->menu_name = $this->postParam->menu_name;
		$this->wap_menu->menu_url = $this->postParam->menu_url;
		
		if($this->wap_menu->insert()){
			jumpAjax('操作成功！',U('admin/wapTpl/wapMenu'));
		}else{
			jumpAjax('操作失败！',U('admin/wapTpl/wapMenuAdd'));			
		}
	}

	public function wapMenuEdit(){
		$data['title']='家178-管理中心-服务商-wap模版编辑';
		$data['menu']=$this->member;//顶端选中
		$this->data = $data;
		$this->page = 'wapTpl/wapMenuEdit'; //显示的页面
		$this->navpage = $this->navpage;//左测菜单
		$result=array();
		$menu_id = isset($this->getParam->menu_id)?$this->getParam->menu_id:'';
		$result['service_type'] = $this->service_type->get_all();
		$result['re'] = $this->wap_menu->get($menu_id);
		$this->pagedata = $result;//向页面加入加载数据
		parent::_initpage();//加载页面
	}

	public function doWapMenuEdit(){
		$data['service_type_id'] = $this->postParam->service_type_id;
		$data['menu_name'] = $this->postParam->menu_name;
		$data['menu_url'] = $this->postParam->menu_url;

		$where['menu_id'] = $this->postParam->menu_id;
		if($this->wap_menu->updates_global($data,$where))
			jumpAjax('操作成功！',U('admin/wapTpl/wapMenu'));
		else
			jumpAjax('操作成功！',U('admin/wapTpl/wapMenuEdit',array('menu_id'=>$where['menu_id'])));
	}

	public function doDel(){
		$ids = $this->input->post('ids');
		$idarr = explode(',',$ids);
		$temarr = array();
	
		foreach($idarr as $val){
			$result = $this->wap_menu->get($val);
			if($this->wap_menu->delete($val)){
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
