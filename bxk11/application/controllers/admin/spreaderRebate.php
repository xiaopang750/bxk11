<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Generator By "Auto Codeigniter" At 2013/07/29 10:30:17 
 *        dinghaochenAuthor: ��껳�
 *        Email: dotnet010@gmail.com

 */
class SpreaderRebate extends Admin_Controller
{	
	
	public $rebate;
	public function __construct(){
		parent::__construct();
		$this->content = 'index';
		$this->navpage = 'nav';
		$this->load->library('operation_data');
		$this->libs = $this->operation_data;
		$this->rebate = model('t_service_spreader_rebate');
		$this->load->helper('fromcheck');
		$this->load->helper('content_fun');
		$this->load->helper('import_excel');
		$this->limit = 10;
	}
	public function index(){
		$data['title']='家178-管理中心-推广返利';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'spreaderRebate/index';
		$this->navpage = $this->navpage ;
		$result['re'] = $this->rebate->get_all();
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function add(){
		$data['title']='家178-管理中心-添加返利设置';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'spreaderRebate/add';
		$this->navpage = $this->navpage ;
		$result = array();
		$this->pagedata = $result;
		parent::_initpage();
	}
	
	public function doadd(){

		$url = U('admin/spreaderRebate/add');
		$this->rebate->sr_type = $this->postParam->sr_type;
		$this->rebate->sr_unit = $this->postParam->sr_unit;

		$this->rebate->sr_status = $this->postParam->sr_status;
		$this->rebate->sr_amount = $this->postParam->sr_amount;
		$this->rebate->ss_type = $this->postParam->ss_type;
		$this->rebate->sr_desc = $this->postParam->sr_desc;

		if(!$this->rebate->sr_type){
			jumpAjax("返利类型不能为空",$url);
		}

		if($this->rebate->insert()){
			$url = U('admin/spreaderRebate/index');
			jumpAjax("操作成功",$url);
		}else{
			jumpAjax("操作失败",$url);
		}
	}

	public function edit(){
		$data['title']='家178-管理中心-编辑微信选项';
		$data['menu']=$this->content;
		$this->data = $data;
		$this->page = 'spreaderRebate/edit';
		$this->navpage = $this->navpage;
		$result = array();
		$sr_id = $this->input->get('sr_id');
		$result = $this->rebate->get($sr_id);
		$this->pagedata = $result;
		parent::_initpage();
	}

	public function doedit(){
	
		$sr_id = $this->postParam->sr_id;
		$data['sr_type'] = $this->postParam->sr_type;
		$data['sr_unit']= $this->postParam->sr_unit;

		$data['sr_status'] = $this->postParam->sr_status;
		$data['sr_amount'] = $this->postParam->sr_amount;
		$data['ss_type'] = $this->postParam->ss_type;
		$data['sr_desc'] = $this->postParam->sr_desc;

		$url = U('admin/spreaderRebate/edit',array('sr_id'=>$sr_id));

		if(!$sr_id){
			jumpAjax("返利类型不能为空",$url);
		}

		$where['sr_id'] = $sr_id;
		if($this->rebate->updates_global($data,$where)){
			$url = site_url('admin/spreaderRebate/index');
			jumpAjax("操作成功",$url);
		}else{
			$url = site_url('admin/spreaderRebate/edit')."?sr_id=".$sr_id;
			jumpAjax("操作失败",$url);
		}
	}

	//判断菜单名称是否存在
	public function is_menu($c_name,$c_id){
		$where['c_name'] = $c_name;
		$result = $this->rebate->getArray('*',$where);
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
			
			if($this->rebate->delete($val)){
			
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

