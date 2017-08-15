<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: ��껳�
 *        Email: dotnet010@gmail.com

 */
class vasService extends Admin_Controller
{	
	
	public $vas_list;
	public function __construct(){
		parent::__construct();

		$this->content = 'index';
		$this->navpage = 'nav';

		$this->load->library('operation_data');

		$this->libs = $this->operation_data;


		$this->load->model('t_vas_list_model');
		$this->vas_list = $this->t_vas_list_model;

		$this->load->helper('fromcheck');
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');

		$this->limit = 10;
	}
	public function index(){

		$data['title']='家178-管理中心-增值服务';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'vasService/index';
		$this->navpage = $this->navpage;
		$result = array();
		
		$key_word = isset($this->getParam->key_word)?$this->getParam->key_word:'';
		$vas_status = isset($this->getParam->vas_status)?$this->getParam->vas_status:'';
		$page = isset($this->getParam->current_page)?$this->getParam->current_page:'';

		if(!is_numeric($page) OR $page < 1 OR !$page)
			$page = 1;
		$total_rows = count($this->vas_list->admin_search_count($vas_status,$key_word));
		$office =  ($page-1)*($this->limit);
		$result['re'] = $this->vas_list->admin_search($vas_status,$key_word,$office,$this->limit);
		$this->libs->base_url = site_url('admin/vasService/index')."?search=0&vas_status=".$vas_status."&key_word=".$key_word;
		$this->libs->total_rows = $total_rows;
		$this->libs->per_page = $this->limit;
		$result['p'] = $this->libs->show_page();
		
		$result['vas_status'] = $vas_status;
		$result['key_word'] = $key_word;
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function add(){
		
		$data['title']='家178-管理中心-添加微信选项';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'vasService/add';
		$this->navpage = $this->navpage;
		$result = array();
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function doadd(){

		$url = site_url('admin/vasService/add');
		$vas_name = $this->postParam->vas_name;
		$vas_price = $this->postParam->vas_price;
		$vas_unit = $this->postParam->vas_unit;
		$vas_status = $this->postParam->vas_status;
		$vas_content = $this->postParam->vas_content;
		$vas_sort = $this->postParam->vas_sort;
		if(!$vas_name){
			jumpAjax("服务名称不能为空",$url);
		}

		if(!$this->is_vas($vas_name,'')){
			jumpAjax("服务名称己占用",$url);
		}

		$this->vas_list->vas_name = $vas_name;
		$this->vas_list->vas_price = $vas_price;
		$this->vas_list->vas_unit = $vas_unit;
		$this->vas_list->vas_status = $vas_status;
		$this->vas_list->vas_content = $vas_content;
		$this->vas_list->vas_sort = $vas_sort;

		if($this->vas_list->insert()){
			$url = site_url('admin/vasService/index');
			jumpAjax("操作成功",$url);
		}else{
			jumpAjax("操作失败",$url);
		}
	}

	public function edit(){
		$data['title']='家178-管理中心-编辑微信选项';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'vasService/edit';
		$this->navpage = $this->navpage;
		$result = array();
		$vas_id = $this->getParam['vas_id'];
		$result = $this->vas_list->get($vas_id);
		$this->pagedata = $result;
		parent::_initpage();
	}

	public function doedit(){
		
		$vas_name = $this->postParam->vas_name;
		$vas_price = $this->postParam->vas_price;
		$vas_unit = $this->postParam->vas_uni;
		$vas_status = $this->postParam->vas_status;
		$vas_content = $this->postParam->vas_content;
		$vas_sort = $this->postParam->vas_sort;
		$vas_id = $this->postParam->vas_id;
		$url = site_url('admin/vasService/edit')."?vas_id=".$vas_id;

		if(!$vas_name){
			jumpAjax("服务名称不能为空",$url);
		}
		
		if(!$this->is_vas($vas_name,$vas_id)){
			jumpAjax("服务名称不能为空",$url);
		}


		$data['vas_name'] = $vas_name;
		$data['vas_price'] = $vas_price;
		$data['vas_unit'] = $vas_unit;
		$data['vas_status'] = $vas_status;
		$data['vas_content'] = $vas_content;
		$data['vas_sort'] = $vas_sort;
	
		$where['vas_id'] = $vas_id;
		if($this->vas_list->updates_global($data,$where)){
			$url = site_url('admin/vasService/index');
			jumpAjax("操作成功",$url);
		}else{
			
			jumpAjax("操作失败",$url);
		}
	}

	//判断菜单名称是否存在
	public function is_vas($vas_name,$vas_id){
		$where['vas_name'] = $vas_name;
		$result = $this->vas_list->getArray('*',$where);
		if($result){
			if($vas_id){
				$is_vas = twotoone_array($result,'vas_id');
				foreach($is_vas as $va){
					if($vas_id != $va){
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

	public function is_AjaxVas(){
		$vas_id = $this->input->post('id');
		$vas_name = $this->input->post('key');
		if($this->is_vas($vas_name,$vas_id)){
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
			$result = $this->vas_list->get($val);
			if($this->vas_list->delete($val)){
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